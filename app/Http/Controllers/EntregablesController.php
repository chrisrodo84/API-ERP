<?php

namespace App\Http\Controllers;

use App\Models\Entregables;
use Illuminate\Http\Request;

class EntregablesController extends Controller
{
    public function index() {
        $json = array();

        $entregables = Entregables::select('id_entregable as id', 'entregable_especifico', 'tipo_entregable')->get();

        if (!empty($entregables)) {
            $json = array(
                "status" => "200",
                "detalle" => $entregables
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay entregables dados de alta"
            );
            
            return json_encode($json, true);
        }
    }
}
