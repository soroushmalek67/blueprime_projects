<?php

class ProjectCompanyImport
{
    use FormObject;

    protected $file;
    protected $project_id;
    protected $type;

    public function __construct($file, $project_id = 0, $type = 'firmogram_compnay')
    {
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', -1);
        $this->file         = $file;
        $this->project_id   = $project_id;
        $this->type         = $type; 
    }

    public function getHeaders()
    {
        $headers = array();
        if (($handle = fopen($this->file, "r")) !== FALSE) 
        {
             if( ($data = fgetcsv($handle)) !== FALSE )
                $headers = array_map('strtolower', $data);
        }

        return $headers;
    }

    public function import($headers, $capabilities = array())
    {
        if (($handle = fopen($this->file, "r")) !== FALSE) 
        {
            $header_line = true;
            $columns = array();
            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($header_line)
                {
                    $header_line = false;
                    $columns = $data;
                    $columns = array_map('strtolower', $columns);
                    continue;

                }
                if(!empty($data[0]))
                {
                    $name = (array_search($headers['name'], $columns)!==false) ? trim($data[array_search($headers['name'], $columns)]) : "";
                    if ($this->type == "firmogram_companies")
                        $matching_company_id = $this->getMatchingFirmogramCompany($name);
                    else 
                        $matching_company_id = UserCompanyImport::importCompanyData($columns, $data, $headers);

                    
                    $params = [ 'name'                  => $name, 
                                'project_id'            => $this->project_id,
                                'matching_source'       => $this->type,
                                'matching_company_id'   => $matching_company_id ];
                                    
                    $projectCompany = new ProjectCompany($params);
                    $projectCompany->save();


                    foreach ($capabilities as $title) 
                    {
                        $description = (array_search($title, $columns)!==false) ? trim($data[array_search($title, $columns)]) : "";
                        if($description != "")
                        {
                            $params       = ['project_id'   => $this->project_id,
                                             'company_id'   => $projectCompany->id,
                                             'title'        => $title, 
                                             'description'  => $description];
                            $capability_company = new CompanyCapability($params);
                            $capability_company->save();
                        }        
                    }
                }
            }
        }

        return true;
    }

    public function getFile()
    {
        return $this->file;
    }

    private function getMatchingFirmogramCompany($name)
    {
        $match = FirmogramCompany::where('name', 'LIKE', $name)
                                    ->orWhere('name_2', 'LIKE', $name)->first();
        if($match){
            return $match->id;
        } else {
            return 0;
        }
    }
}
