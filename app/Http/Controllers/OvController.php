<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Entregables;
use App\Models\Formatos;
use App\Models\Marcas;
use App\Models\Ov;
use App\Models\Targets;

class OvController extends Controller
{
    public function index() {
        $json = array();

        $ov = Ov::join('alias_cliente', 'ov.cliente', '=', 'alias_cliente.id_alias_cliente')
            ->join('marcas', 'ov.marcas', '=', 'marcas.id_marca')
            ->join('targets', 'ov.target', '=', 'targets.id_target')
            ->join('area_miramar', 'ov.areas_involucradas', '=', 'area_miramar.id_area_mir')
            ->join('entregables', 'ov.entregables', '=', 'entregables.id_entregable')
            ->join('formatos', 'ov.formatos_entregables', '=', 'formatos.id_formato')
            // ->select('alias_cliente.nombre_comercial', 'ov.marcas', 'marcas.producto_clave_lab', 'ov.target as t', 'targets.target', 'ov.areas_involucradas', 'area_miramar.area_miramar', 'ov.entregables', 'entregables.entregable_especifico', 'ov.formatos_entregables', 'formatos.formato')
            ->select('ov.id_ov', 'alias_cliente.nombre_comercial', 'ov.marcas', 'ov.target', 'ov.areas_involucradas', 'ov.entregables', 'ov.formatos_entregables')
        ->get();

        $arrOV = json_decode($ov, true);
        $arrGralOV = array();

        foreach ($arrOV as  $key => $value) {
            $marcas = explode(',', $value["marcas"]);
            $targets = explode(',', $value["target"]);
            $areas = explode(',', $value["areas_involucradas"]);
            $entregables = explode(',', $value["entregables"]);
            $formatos = explode(',', $value["formatos_entregables"]);

            $strMarcas = '';
            for ($i=0; $i < count($marcas); $i++) {
                $resultado = Marcas::select('id_marca', 'producto_clave_lab')->where('id_marca', $marcas[$i])->get();
                
                $arrMarcas = json_decode($resultado, true);
                $strMarcas .= $arrMarcas[0]['producto_clave_lab'].', ';
            }
            $value["marcas"] = $strMarcas;

            $strTargets = '';
            for ($i=0; $i < count($targets); $i++) {
                $resultado = Targets::select('id_target', 'target')->where('id_target', $targets[$i])->get();
                
                $arrTarget = json_decode($resultado, true);
                $strTargets .= $arrTarget[0]['target'].', ';
            }
            $value["target"] = $strTargets;

            $strAreas = '';
            for ($i=0; $i < count($areas); $i++) {
                $resultado = Areas::select('id_area_mir', 'area_miramar')->where('id_area_mir', $areas[$i])->get();
                
                $arrAreas = json_decode($resultado, true);
                $strAreas .= $arrAreas[0]['area_miramar'].', ';
            }
            $value["areas_involucradas"] = $strAreas;

            $strEntregables = '';
            for ($i=0; $i < count($entregables); $i++) {
                $resultado = Entregables::select('id_entregable', 'entregable_especifico', 'tipo_entregable')->where('id_entregable', $entregables[$i])->get();
                
                $arrEntrergables = json_decode($resultado, true);
                $strEntregables .= $arrEntrergables[0]["entregable_especifico"].' - '.$arrEntrergables[0]["tipo_entregable"].', ';
            }
            $value["entregables"] = $arrEntrergables;

            $strFormatos = '';
            for ($i=0; $i < count($formatos); $i++) {
                $resultado = Formatos::select('id_formato', 'formato')->where('id_formato', $formatos[$i])->get();
                
                $arrFormatos = json_decode($resultado, true);
                $strFormatos .= $arrFormatos[0]["formato"].', ';
            }

            $value["entregables"] = $arrFormatos;

            // Se crea el arreglo para el JSON
            $newArrOv = array(
                "id_ov" => $value["id_ov"],
                "laboratorio" => $value["nombre_comercial"],
                "marcas" => trim($strMarcas, ', '),
                "target" => trim($strTargets, ', '),
                "areas_involucradas" => trim($strAreas, ', '),
                "entregables" => trim($strEntregables, ', '),
                "formatos_entregables" => trim($strFormatos, ', '),
            );
            array_push($arrGralOV, $newArrOv);
        }

        if (!empty($arrGralOV)) {
            $json = array(
                "status" => "200",
                "detalle" => $arrGralOV
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay Ov en el sistema"
            );
            
            return json_encode($json, true);
        }
    }

    public function show(int $id) {
        $ovLaboratorio = Ov::join('alias_cliente', 'ov.cliente', '=', 'alias_cliente.id_alias_cliente')
            ->join('marcas', 'ov.marcas', '=', 'marcas.id_marca')
            ->join('targets', 'ov.target', '=', 'targets.id_target')
            ->join('area_miramar', 'ov.areas_involucradas', '=', 'area_miramar.id_area_mir')
            ->join('entregables', 'ov.entregables', '=', 'entregables.id_entregable')
            ->join('formatos', 'ov.formatos_entregables', '=', 'formatos.id_formato')
            ->select('ov.id_ov', 'alias_cliente.nombre_comercial', 'ov.marcas', 'ov.target', 'ov.areas_involucradas', 'ov.entregables', 'ov.formatos_entregables')
            ->where('cliente', $id)
        ->get();

        $arrOVLab = json_decode($ovLaboratorio, true);
        $arrGralOVLab = array();

        foreach ($arrOVLab as  $key => $value) {
            $marcas = explode(',', $value["marcas"]);
            $targets = explode(',', $value["target"]);
            $areas = explode(',', $value["areas_involucradas"]);
            $entregables = explode(',', $value["entregables"]);
            $formatos = explode(',', $value["formatos_entregables"]);

            $strMarcas = '';
            for ($i=0; $i < count($marcas); $i++) {
                $resultado = Marcas::select('id_marca', 'producto_clave_lab')->where('id_marca', $marcas[$i])->get();
                
                $arrMarcas = json_decode($resultado, true);
                $strMarcas .= $arrMarcas[0]['producto_clave_lab'].', ';
            }
            $value["marcas"] = $strMarcas;

            $strTargets = '';
            for ($i=0; $i < count($targets); $i++) {
                $resultado = Targets::select('id_target', 'target')->where('id_target', $targets[$i])->get();
                
                $arrTarget = json_decode($resultado, true);
                $strTargets .= $arrTarget[0]['target'].', ';
            }
            $value["target"] = $strTargets;

            $strAreas = '';
            for ($i=0; $i < count($areas); $i++) {
                $resultado = Areas::select('id_area_mir', 'area_miramar')->where('id_area_mir', $areas[$i])->get();
                
                $arrAreas = json_decode($resultado, true);
                $strAreas .= $arrAreas[0]['area_miramar'].', ';
            }
            $value["areas_involucradas"] = $strAreas;

            $strEntregables = '';
            for ($i=0; $i < count($entregables); $i++) {
                $resultado = Entregables::select('id_entregable', 'entregable_especifico', 'tipo_entregable')->where('id_entregable', $entregables[$i])->get();
                
                $arrEntrergables = json_decode($resultado, true);
                $strEntregables .= $arrEntrergables[0]["entregable_especifico"].' - '.$arrEntrergables[0]["tipo_entregable"].', ';
            }
            $value["entregables"] = $arrEntrergables;

            $strFormatos = '';
            for ($i=0; $i < count($formatos); $i++) {
                $resultado = Formatos::select('id_formato', 'formato')->where('id_formato', $formatos[$i])->get();
                
                $arrFormatos = json_decode($resultado, true);
                $strFormatos .= $arrFormatos[0]["formato"].', ';
            }

            $value["entregables"] = $arrFormatos;

            // Se crea el arreglo para el JSON
            $newArrOvLab = array(
                "id_ov" => $value["id_ov"],
                "laboratorio" => $value["nombre_comercial"],
                "marcas" => trim($strMarcas, ', '),
                "target" => trim($strTargets, ', '),
                "areas_involucradas" => trim($strAreas, ', '),
                "entregables" => trim($strEntregables, ', '),
                "formatos_entregables" => trim($strFormatos, ', '),
            );
            array_push($arrGralOVLab, $newArrOvLab);
        }

        if (!empty($arrGralOVLab)) {
            $json = array(
                "status" => "200",
                "detalle" => $arrGralOVLab
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay Ov para el laboratorio proporcionado"
            );
            
            return json_encode($json, true);
        }
    }
}
