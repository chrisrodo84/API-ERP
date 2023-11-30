<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\Items;

class CotizacionesController extends Controller
{
    public function index() {
        $json = array(
            "status" => "400",
            "detalle" => "Solicitud incorrecta, proporcione el id de una Ov"
        );
        
        return json_encode($json, true);
    }

    public function show(int $idOv) {
        $json = array();
        $arrGralItems = array();

        $cotizacion = Cotizaciones::select()
            ->where('cotizaciones.id_ov', $idOv)
            ->where('cotizaciones.estatus_cotizacion', 2)
        ->get();

        if (count($cotizacion) > 0) {
            $arrCoti = json_decode($cotizacion, true); 
            $idCoti = $arrCoti[0]["id_cotizacion"];

            $item = Items::select()
                ->where('id_cotizacion', $idCoti)
            ->get();

            $arrItems = json_decode($item, true);

            // echo '<pre>'; print_r($arrItems); echo '</pre>';

            // Se calcula las horas por área de forma global
            $horasAM = 0;
            $horasAU = 0;
            $horasCM = 0;
            $horasCR = 0;
            $horasDD = 0;
            $horasDE = 0;
            $horasED = 0;
            $horasPR = 0;
            $arrTotalHorasArea = array();

            foreach ($arrItems as $key => $item) {
                $am = explode(',', $item["horas_am"]);
                $au = explode(',', $item["horas_au"]);
                $cm = explode(',', $item["horas_cm"]);
                $cr = explode(',', $item["horas_cr"]);
                $dd = explode(',', $item["horas_dd"]);
                $de = explode(',', $item["horas_de"]);
                $ed = explode(',', $item["horas_ed"]);
                $pr = explode(',', $item["horas_pr"]);

                for ($i=0; $i < count($am); $i++) { 
                    if ($am[$i] !== '0') {
                        $horasAM = $horasAM + intval($am[$i]);
                    }
                }

                for ($i=0; $i < count($au); $i++) { 
                    if ($au[$i] !== '0') {
                        $horasAU = $horasAU + intval($au[$i]);
                    }
                }
                
                for ($i=0; $i < count($cm); $i++) { 
                    if ($cm[$i] !== '0') {
                        $horasCM = $horasCM + intval($cm[$i]);
                    }
                }
                
                for ($i=0; $i < count($cr); $i++) { 
                    if ($cr[$i] !== '0') {
                        $horasCR = $horasCR + intval($cr[$i]);
                    }
                }
                
                for ($i=0; $i < count($dd); $i++) { 
                    if ($dd[$i] !== '0') {
                        $horasDD = $horasDD + intval($dd[$i]);
                    }
                }
                
                for ($i=0; $i < count($de); $i++) { 
                    if ($de[$i] !== '0') {
                        $horasDE = $horasDE + intval($de[$i]);
                    }
                }
                
                for ($i=0; $i < count($ed); $i++) { 
                    if ($ed[$i] !== '0') {
                        $horasED = $horasED + intval($ed[$i]);
                    }
                }
                
                for ($i=0; $i < count($pr); $i++) { 
                    if ($pr[$i] !== '0') {
                        $horasPR = $horasPR + intval($pr[$i]);
                    }
                }
                
                $arrTotalHorasArea = array(
                    "area_medica" => $horasAM,
                    "audiovisual" => $horasAU,
                    "comercial" => $horasCM,
                    "creativo" => $horasCR,
                    "diseno_digital" => $horasDD,
                    "diseno_editorial" => $horasDE,
                    "editorial" => $horasED,
                    "programacion" => $horasPR,
                );
            }

            foreach ($arrItems as $key => $item) {
                $totalHorasAM = 0;
                $totalHorasAU = 0;
                $totalHorasCR = 0;
                $totalHorasCM = 0;
                $totalHorasDD = 0;
                $totalHorasDE = 0;
                $totalHorasED = 0;
                $totalHorasPR = 0;

                $am = explode(',', $item["horas_am"]);
                $au = explode(',', $item["horas_au"]);
                $cm = explode(',', $item["horas_cm"]);
                $cr = explode(',', $item["horas_cr"]);
                $dd = explode(',', $item["horas_dd"]);
                $de = explode(',', $item["horas_de"]);
                $ed = explode(',', $item["horas_ed"]);
                $pr = explode(',', $item["horas_pr"]);

                for ($i=0; $i < count($am); $i++) { 
                    if ($am[$i] !== '0') {
                        $totalHorasAM = $totalHorasAM + intval($am[$i]);
                    }
                }

                for ($i=0; $i < count($au); $i++) { 
                    if ($au[$i] !== '0') {
                        $totalHorasAU = $totalHorasAU + intval($au[$i]);
                    }
                }
                
                for ($i=0; $i < count($cm); $i++) { 
                    if ($cm[$i] !== '0') {
                        $totalHorasCM = $totalHorasCM + intval($cm[$i]);
                    }
                }
                
                for ($i=0; $i < count($cr); $i++) { 
                    if ($cr[$i] !== '0') {
                        $totalHorasCR = $totalHorasCR + intval($cr[$i]);
                    }
                }
                
                for ($i=0; $i < count($dd); $i++) { 
                    if ($dd[$i] !== '0') {
                        $totalHorasDD = $totalHorasDD + intval($dd[$i]);
                    }
                }
                
                for ($i=0; $i < count($de); $i++) { 
                    if ($de[$i] !== '0') {
                        $totalHorasDE = $totalHorasDE + intval($de[$i]);
                    }
                }
                
                for ($i=0; $i < count($ed); $i++) { 
                    if ($ed[$i] !== '0') {
                        $totalHorasED = $totalHorasED + intval($ed[$i]);
                    }
                }
                
                for ($i=0; $i < count($pr); $i++) { 
                    if ($pr[$i] !== '0') {
                        $totalHorasPR = $totalHorasPR + intval($pr[$i]);
                    }
                }
                
                $arrHorasArea = array(
                    "horas_area_medica" => $totalHorasAM,
                    "horas_audiovisual" => $totalHorasAU,
                    "horas_comercial" => $totalHorasCM,
                    "horas_creativo" => $totalHorasCR,
                    "horas_diseno_digital" => $totalHorasDD,
                    "horas_diseno_editorial" => $totalHorasDE,
                    "horas_editorial" => $totalHorasED,
                    "horas_programacion" => $totalHorasPR,
                );
                
                // Se crea el arreglo para el JSON
                $newArrItem = array(
                    // "total_horas_area" => $arrTotalHorasArea,
                    "nombre_item" => $item["nombre_item"],
                    "total_horas_item" => $arrHorasArea
                );
                array_push($arrGralItems, $newArrItem);
            }

            $arrFinal = array(
                "id_cotizacion_aprtobada" => $idCoti,
                "total_horas_area" => $arrTotalHorasArea,
                "detalle_items" => $arrGralItems
            );

            $json = array(
                "status" => "200",
                "detalle" => $arrFinal
            );
            
            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay cotización aprobada con la Ov proporcionada"
            );
            
            return json_encode($json, true);
        }
    }
}
