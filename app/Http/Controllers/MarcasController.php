<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marcas;
use App\Models\Ov;

class MarcasController extends Controller
{
    public function index(Request $request) {
        $json = array();

        if ($request["id_ov"]) {
            $ov = Ov::select()
                ->where('id_ov', $request["id_ov"])
            ->get();

            $arrOV = json_decode($ov, true);
            $arrGralMarcasOV = array();

            foreach ($arrOV as $key => $value) {
                $marcas = explode(',', $value["marcas"]);

                $strMarcas = '';
                $strLineas = '';
                for ($i=0; $i < count($marcas); $i++) {
                    $resultado = Marcas::select('id_marca', 'producto_clave_lab', 'clase_terapeutica_n4')->where('id_marca', $marcas[$i])->get();
                    
                    $arrMarcas = json_decode($resultado, true);
                    $strMarcas .= $arrMarcas[0]['producto_clave_lab'].', ';
                    $strLineas .= $arrMarcas[0]['clase_terapeutica_n4'].', ';
                }

                $arrMarcasOv = array(
                    "nombres_marcas" => trim($strMarcas, ', '),
                    "lineas_terapeuticas" => trim($strLineas, ', ')
                );
                array_push($arrGralMarcasOV, $arrMarcasOv);
            }
            
            if (!empty($arrGralMarcasOV)) {
                $json = array(
                    "status" => "200",
                    "detalle" => $arrGralMarcasOV
                );
                
                return json_encode($json, true);
            } else {
                $json = array(
                    "status" => "200",
                    "detalle" => "No existe la Ov en el sistema"
                );
                
                return json_encode($json, true);
            }

        } else if ($request["id_laboratorio"]) {
            $marcas = Marcas::select('id_marca as id', 'producto_clave_lab as marca', 'clase_terapeutica_n4 as linea_terapeutica')
                ->where('id_razon_social', $request["id_laboratorio"])
            ->get();

            $json = array(
                "status" => "200",
                "detalle" => $marcas
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "400",
                "detalle" => "Solicitud incorrecta, proporcione un id de laboratorio o de una Ov"
            );

            return json_encode($json, true);
        }
    }
}
