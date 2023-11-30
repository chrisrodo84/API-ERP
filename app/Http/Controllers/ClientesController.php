<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index() {
        $json = array();

        $clientes = DB::table('alias_cliente')
            ->select('id_alias_cliente', 'razon_social', 'nombre_comercial')
            ->get();

        if (!empty($clientes)) {
            $json = array(
                "status" => "200",
                "detalle" => $clientes
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay información de clientes"
            );
            
            return json_encode($json, true);
        }
    }
}
