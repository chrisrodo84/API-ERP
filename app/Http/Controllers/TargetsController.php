<?php

namespace App\Http\Controllers;

use App\Models\Targets;

class TargetsController extends Controller
{
    public function index() {
        $json = array();

        $targets = Targets::select()->get();

        if (!empty($targets)) {
            $json = array(
                "status" => "200",
                "detalle" => $targets
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay targets dadas de alta"
            );
            
            return json_encode($json, true);
        }
    }
}
