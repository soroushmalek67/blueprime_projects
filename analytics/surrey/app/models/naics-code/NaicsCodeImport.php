<?php

class NaicsCodeImport
{
    use FormObject;

    protected $file;

    public function __construct($file)
    {
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', -1);
        $this->file         = $file;
    }

    public function import()
    {

        if (($handle = fopen($this->file, "r")) !== FALSE) 
        {
            $header_line = true;
            $columns = array();
            while (($data = fgetcsv($handle, 1000)) !== FALSE) 
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

                    $naics = (array_search('naics', $columns)!==false) ? trim($data[array_search('naics', $columns)]) : "";
                    $description = (array_search('description', $columns)!==false) ? trim($data[array_search('description', $columns)]) : "";                    
 

                    $params       = ['naics'       => $naics,
                                     'description' => $description];
                                     

                    $naicsCode    = new NaicsCode($params);
                    $naicsCode->save();
                }
            }
        }

    }

    public function getFile()
    {
        return $this->file;
    }
}