<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AreasController extends Controller
{
    public function index() {
        $json = array();

        $areas = DB::table('area_miramar')
            ->select('id_area_mir', 'area_miramar')
            ->get();

        if (!empty($areas)) {
            $json = array(
                "status" => "200",
                "detalle" => $areas
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay áreas dadas de alta"
            );
            
            return json_encode($json, true);
        }
    }
}
