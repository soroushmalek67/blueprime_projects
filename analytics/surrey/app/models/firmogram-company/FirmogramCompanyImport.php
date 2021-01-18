<?php

class FirmogramCompanyImport
{
    use FormObject;

    protected $file;
    protected $project_id;
    protected $database_name;

    public function __construct($file, $database_name)
    {
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', -1);
        $this->file          = $file;
        $this->database_name = $database_name;
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
                    $name = (array_search('name', $columns)!==false) ? trim($data[array_search('name', $columns)]) : "";
                    $name_2 = (array_search('name_2', $columns)!==false) ? trim($data[array_search('name_2', $columns)]) : "";
                    $address = (array_search('address', $columns)!==false) ? trim($data[array_search('address', $columns)]) : "";
                    $address_2 = (array_search('address_2', $columns)!==false) ? trim($data[array_search('address_2', $columns)]) : "";
                    $town_center = (array_search($headers['town_center'], $columns)!==false) ? trim($data[array_search($headers['town_center'], $columns)]) : $town_center = "";               
                    $city = (array_search('city', $columns)!==false) ? trim($data[array_search('city', $columns)]) : "";
                    $postal = (array_search('postal', $columns)!==false) ? trim($data[array_search('postal', $columns)]) : "";
                    $province = (array_search('province', $columns)!==false) ? trim($data[array_search('province', $columns)]) : "";
                    $country = (array_search('country', $columns)!==false) ? trim($data[array_search('country', $columns)]) : "";
                    $phone = (array_search('phone', $columns)!==false) ? trim($data[array_search('phone', $columns)]) : "";
                    $url = (array_search('url', $columns)!==false) ? trim($data[array_search('url', $columns)]) : "";
                    $naics = (array_search('naics', $columns)!==false) ? trim($data[array_search('naics', $columns)]) : "";
                    $naics_2 = (array_search('naics_2', $columns)!==false) ? trim($data[array_search('naics_2', $columns)]) : "";
                    $contact_1_first_name = (array_search('contact_1_first_name', $columns)!==false) ? trim($data[array_search('contact_1_first_name', $columns)]) : "";
                    $contact_1_last_name = (array_search('contact_1_last_name', $columns)!==false) ? trim($data[array_search('contact_1_last_name', $columns)]) : "";
                    $contact_2_first_name = (array_search('contact_2_first_name', $columns)!==false) ? trim($data[array_search('contact_2_first_name', $columns)]) : "";
                    $contact_2_last_name = (array_search('contact_2_last_name', $columns)!==false) ? trim($data[array_search('contact_2_last_name', $columns)]) : "";
                    $contact_3_first_name = (array_search('contact_3_first_name', $columns)!==false) ? trim($data[array_search('contact_3_first_name', $columns)]) : "";
                    $contact_3_last_name = (array_search('contact_3_last_name', $columns)!==false) ? trim($data[array_search('contact_3_last_name', $columns)]) : "";
                    $nationality = (array_search('nationality', $columns)!==false) ? trim($data[array_search('nationality', $columns)]) : "";
                    $established_at = (array_search('established_at', $columns)!==false) ? trim($data[array_search('established_at', $columns)]) : "";
                    $revenue = (array_search('revenue', $columns)!==false) ? trim($data[array_search('revenue', $columns)]) : "";
                    $employees = (array_search('employees', $columns)!==false) ? trim($data[array_search('employees', $columns)]) : "";
                    $services = (array_search('services', $columns)!==false) ? trim($data[array_search('services', $columns)]) : "";
                    $description = (array_search('description', $columns)!==false) ? trim($data[array_search('description', $columns)]) : "";
                    
                    //grab naics descriptions
                    $naicsObject = NaicsCode::where('naics', '=', $naics)->first();
                    $naics_description = ($naicsObject) ? $naicsObject->description : "";
                    $naicsObject = NaicsCode::where('naics', '=', $naics_2)->first();
                    $naics_2_description = ($naicsObject) ? $naicsObject->description : "";

                    //grab lat and lng
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

                    $params = [ 'name' => $name,
                                'name_2' => $name_2,
                                'address' => $address, 
                                'address_2' => $address_2,
                                'town_center' => $town_center,
                                'city' => $city,
                                'postal' => $postal, 
                                'province' => $province,
                                'country' => $country,
                                'phone' => $phone,
                                'url' => $url,
                                'naics' => $naics,
                                'naics_2' => $naics_2,
                                'contact_1_first_name' => $contact_1_first_name,
                                'contact_1_last_name' => $contact_1_last_name,
                                'contact_2_first_name' => $contact_2_first_name,
                                'contact_2_last_name' => $contact_2_last_name,
                                'contact_3_first_name' => $contact_3_first_name,
                                'contact_3_last_name' => $contact_3_last_name,
                                'nationality' => $nationality,
                                'established_at' => $established_at,
                                'revenue' => $revenue,
                                'employees' => $employees,
                                'services' => $services,
                                'description' => $description,
                                'lat' => $lat,
                                'lng' => $lng,
                                'naics_description' => $naics_description,
                                'naics_2_description' => $naics_2_description,
                                'database_name' =>  $this->database_name ];

                                    
                    $firmogramCompany = new FirmogramCompany($params);
                    $firmogramCompany->save();
                }
            }
        }

        return true;
    }

    public function getFile()
    {
        return $this->file;
    }
}
