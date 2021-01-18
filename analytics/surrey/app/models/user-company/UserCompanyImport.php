<?php

class UserCompanyImport
{
    use FormObject;

    protected $file;
    protected $project_id;
    protected $columns;

    public function __construct($file)
    {
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', -1);
        $this->file         = $file;
        $this->columns      = Company::getColumns();
    }

    public function import()
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
                    self::importCompanyData($columns, $data);
                }
            }
        }

        return true;
    }

    public function getFile()
    {
        return $this->file;
    }

    public static function importCompanyData($columns, $data, $headers = null)
    {
        if($headers == null)
        {
            $headers = $this->columns;
            $headers = array_combine($headers, $headers);
        }

        $name = (array_search($headers['name'], $columns)!==false) ? trim($data[array_search($headers['name'], $columns)]) : "";                  
        $address = (array_search($headers['address'], $columns)!==false) ? trim($data[array_search($headers['address'], $columns)]) : "";
        $town_center = (array_search($headers['town_center'], $columns)!==false) ? trim($data[array_search($headers['town_center'], $columns)]) : $town_center = "";
        $city = (array_search($headers['city'], $columns)!==false) ? trim($data[array_search($headers['city'], $columns)]) : $city = "";
        $province = (array_search($headers['province'], $columns)!==false) ? trim($data[array_search($headers['province'], $columns)]) : "";
        $country = (array_search($headers['country'], $columns)!==false) ? trim($data[array_search($headers['country'], $columns)]) : "";
        $postal = (array_search($headers['postal'], $columns)!==false) ? trim($data[array_search($headers['postal'], $columns)]) : "";
        $phone = (array_search($headers['phone'], $columns)!==false) ? trim($data[array_search($headers['phone'], $columns)]) : "";
        $url = (array_search($headers['url'], $columns)!==false) ? trim($data[array_search($headers['url'], $columns)]) : "";
        $naics = (array_search($headers['naics'], $columns)!==false) ? trim($data[array_search($headers['naics'], $columns)]) : "";
        $employees = (array_search($headers['employees'], $columns)!==false) ? trim($data[array_search($headers['employees'], $columns)]) : "";
        $revenue = (array_search($headers['revenue'], $columns)!==false) ? trim($data[array_search($headers['revenue'], $columns)]) : ""; 
        $established_at = (array_search($headers['established_at'], $columns)!==false) ? trim($data[array_search($headers['established_at'], $columns)]) : "";                                        
        $services = (array_search($headers['services'], $columns)!==false) ? trim($data[array_search($headers['services'], $columns)]) : "";  
        $description = (array_search($headers['description'], $columns)!==false) ? trim($data[array_search($headers['description'], $columns)]) : "";  
        $linkedin_url = (array_search($headers['linkedin_url'], $columns)!==false) ? trim($data[array_search($headers['linkedin_url'], $columns)]) : "";
        $facebook_url = (array_search($headers['facebook_url'], $columns)!==false) ? trim($data[array_search($headers['facebook_url'], $columns)]) : "";
        $twitter_url = (array_search($headers['twitter_url'], $columns)!==false) ? trim($data[array_search($headers['twitter_url'], $columns)]) : "";

        $naicsObject = NaicsCode::where('naics', '=', $naics)->first();
        $naics_description = ($naicsObject) ? $naicsObject->description : "";

        $postal = strtoupper(str_replace(" ", "", $postal));
        $postalObject = PostalCode::where('postal', '=', $postal)->first();

        if($postalObject){
            $lat = $postalObject->lat;
            $lng = $postalObject->lng;
        }
        else{
            $lat = 0;
            $lng = 0;
        }

        $params       = ['name'              => $name,
                         'address'           => $address,
                         'town_center'       => $town_center,
                         'city'              => $city,
                         'province'          => $province,
                         'country'           => $country,
                         'postal'            => $postal,
                         'lat'               => $lat,
                         'lng'               => $lng,                           
                         'phone'             => $phone,
                         'url'               => $url,
                         'naics'             => $naics,
                         'employees'         => $employees,
                         'revenue'           => $revenue,
                         'established_at'    => $established_at,
                         'services'          => $services,
                         'description'       => $description,
                         'linkedin_url'      => $linkedin_url,
                         'facebook_url'      => $facebook_url,
                         'twitter_url'       => $twitter_url,
                         'naics_description' => $naics_description ];
                         

        $userCompany      = new UserCompany($params);
        $userCompany->save();

        return $userCompany->id;
    }
}