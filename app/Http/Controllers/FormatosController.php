<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class FormatosController extends Controller
{
    public function index() {
        $json = array();

        $formatos = DB::table('formatos')
            ->select('id_formato', 'formato')
            ->get();

        if (!empty($formatos)) {
            $json = array(
                "status" => "200",
                "detalle" => $formatos
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay formatos de entregables dados de alta"
            );
            
            return json_encode($json, true);
        }
    }
}
