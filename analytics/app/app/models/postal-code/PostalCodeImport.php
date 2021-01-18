<?php

class PostalCodeImport
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

                    $postal = (array_search('postal', $columns)!==false) ? trim($data[array_search('postal', $columns)]) : "";
                    $lat = (array_search('lat', $columns)!==false) ? trim($data[array_search('lat', $columns)]) :  "";                    
                    $lng = (array_search('lng', $columns)!==false) ?  trim($data[array_search('lng', $columns)]) : "";                    
                    $city = (array_search('city', $columns)!==false) ?  trim($data[array_search('city', $columns)]) : "";
                    $province = (array_search('province', $columns)!==false) ? trim($data[array_search('province', $columns)]) : "";


                    $params       = ['postal'   => $postal,
                                     'lat'      => $lat,
                                     'lng'      => $lng,
                                     'city'     => $city,
                                     'province' => $province];
                                     

                    $postalCode      = new PostalCode($params);
                    $postalCode->save();
                }
            }
        }

    }

    public function getFile()
    {
        return $this->file;
    }
}