<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PostalCodeController extends Controller
{
    public function zip_code(Request $request) 
    {
        $data = file_get_contents("https://vipar.com.py/mexico_zip_codes.json");
        $array = json_decode($data,1);
        $ID = $request->code;
        $new_data = array_filter($array[0]['data'], function ($var) use ($ID) {
            return ($var['d_codigo'] == $ID);
        });
        if(count($new_data)) {
            foreach($new_data as $key => $value) {

                $new_data = [
                    "zip_code" => $value['d_codigo'],
                    "locality" => $value['d_ciudad'],
                    "federal_entity" => [
                        "key" => $value['c_estado'],
                        "name"=> $value['d_estado'],
                        "code"=> $value['c_CP']
                    ],
                    "settlements" => [
                        [
                            "key" => $value['id_asenta_cpcons'],
                            "name" => $value['d_asenta'],
                            "zone_type" => $value['d_zona'],
                            "settlement_type" => [
                                "name" => $value['d_tipo_asenta']
                            ]
                        ]
                    ],
                    "municipality" => [
                        "key" => $value['c_mnpio'],
                        "name" => $value['D_mnpio']
                    ]
                ];
                
            }
        }
        return $new_data;
    }
}
