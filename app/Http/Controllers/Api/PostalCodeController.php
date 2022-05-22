<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PostalCodeController extends Controller
{
    public function zip_code(Request $request) 
    {
        $new_data = $this->query_json($request->code);
        if(count($new_data)) {
            $settlements = [];
            foreach($new_data as $key => $value) {
                $settlements[] =  [
                    "key" => intval($value['id_asenta_cpcons']),
                    "name" => $this->spetialChars($value['d_asenta']),
                    "zone_type" => $this->spetialChars($value['d_zona']),
                    "settlement_type" => [
                        "name" => $value['d_tipo_asenta'],
                    ]
                ];
                        
                $new_data = [
                    "zip_code" => $value['d_codigo'],
                    "locality" => $this->spetialChars($value['d_ciudad']),
                    "federal_entity" => [
                        "key" => intval($value['c_estado']), 
                        "name"=> $this->spetialChars($value['d_estado']),
                        "code"=> empty($value['c_CP']) ? null : $value['c_CP']
                    ],
                    "settlements" => $settlements,
                    "municipality" => [
                        "key" => $value['c_mnpio'],
                        "name" => $this->spetialChars($value['D_mnpio'])
                    ]
                ];
            }
        }
        return response()->json($new_data);
    }
    
    public function query_json($code) 
    {
        setlocale(LC_ALL, "es_ES.utf8");
        $data = file_get_contents("https://vipar.com.py/mexico_zip_codes.json");
        $array = json_decode($data,1);
        $new_data = array_filter($array[0]['data'], function ($var) use ($code) {
            return ($var['d_codigo'] == $code);
        });
        return $new_data;
    }
    
    public function spetialChars($string) 
    {
        if(!empty($string)) {
            return strtoupper(iconv('UTF-8','ASCII//TRANSLIT',$string));
        }
        return $string;
    }
}
