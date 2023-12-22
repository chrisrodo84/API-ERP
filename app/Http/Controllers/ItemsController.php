<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Tareas;

class ItemsController extends Controller
{
    public function index() {
        $json = array(
            "status" => "400",
            "detalle" => "Solicitud incorrecta, proporcione el id de una cotización"
        );

        return json_encode($json, true);
    }

    public function show(int $idCotizacion) {
        $json = array();
        $arrGralItems = array();

        $items = Items::select()
            ->where('id_cotizacion', $idCotizacion)
        ->get();

        if (count($items) > 0) {
            $arrItems = json_decode($items, true);

            foreach ($arrItems as $key => $item) {
                $totalHorasAM = 0;
                $totalHorasAU = 0;
                $totalHorasCR = 0;
                $totalHorasCM = 0;
                $totalHorasDD = 0;
                $totalHorasDE = 0;
                $totalHorasED = 0;
                $totalHorasPR = 0;

                $tareasAM = array();
                $tareasAU = array();
                $tareasCR = array();
                $tareasCM = array();
                $tareasDD = array();
                $tareasDE = array();
                $tareasED = array();
                $tareasPR = array();

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

                        $tarea = Tareas::select()
                            ->where('id_custom', 'am_t'.($i+1))
                        ->get();

                        $arrTarea = json_decode($tarea, true);

                        $detalle_tarea = array(
                            "nombre_tarea" => $arrTarea[0]["descripcion_tarea"],
                            "horas_tarea" => intval($am[$i])
                        );

                        array_push($tareasAM, $detalle_tarea);
                    }
                }

                for ($i=0; $i < count($au); $i++) {
                    if ($au[$i] !== '0') {
                        $totalHorasAU = $totalHorasAU + intval($au[$i]);

                        $tarea = Tareas::select()
                            ->where('id_custom', 'au_t'.($i+1))
                        ->get();

                        $arrTarea = json_decode($tarea, true);

                        $detalle_tarea = array(
                            "nombre_tarea" => $arrTarea[0]["descripcion_tarea"],
                            "horas_tarea" => intval($au[$i])
                        );

                        array_push($tareasAU, $detalle_tarea);
                    }
                }

                for ($i=0; $i < count($cm); $i++) {
                    if ($cm[$i] !== '0') {
                        $totalHorasCM = $totalHorasCM + intval($cm[$i]);

                        $tarea = Tareas::select()
                            ->where('id_custom', 'cm_t'.($i+1))
                        ->get();

                        $arrTarea = json_decode($tarea, true);

                        $detalle_tarea = array(
                            "nombre_tarea" => $arrTarea[0]["descripcion_tarea"],
                            "horas_tarea" => intval($cm[$i])
                        );

                        array_push($tareasCM, $detalle_tarea);
                    }
                }

                for ($i=0; $i < count($cr); $i++) {
                    if ($cr[$i] !== '0') {
                        $totalHorasCR = $totalHorasCR + intval($cr[$i]);

                        $tarea = Tareas::select()
                            ->where('id_custom', 'cr_t'.($i+1))
                        ->get();

                        $arrTarea = json_decode($tarea, true);

                        $detalle_tarea = array(
                            "nombre_tarea" => $arrTarea[0]["descripcion_tarea"],
                            "horas_tarea" => intval($cr[$i])
                        );

                        array_push($tareasCR, $detalle_tarea);
                    }
                }

                for ($i=0; $i < count($dd); $i++) {
                    if ($dd[$i] !== '0') {
                        $totalHorasDD = $totalHorasDD + intval($dd[$i]);

                        $tarea = Tareas::select()
                            ->where('id_custom', 'dd_t'.($i+1))
                        ->get();

                        $arrTarea = json_decode($tarea, true);

                        $detalle_tarea = array(
                            "nombre_tarea" => $arrTarea[0]["descripcion_tarea"],
                            "horas_tarea" => intval($dd[$i])
                        );

                        array_push($tareasDD, $detalle_tarea);
                    }
                }

                for ($i=0; $i < count($de); $i++) {
                    if ($de[$i] !== '0') {
                        $totalHorasDE = $totalHorasDE + intval($de[$i]);

                        $tarea = Tareas::select()
                            ->where('id_custom', 'de_t'.($i+1))
                        ->get();

                        $arrTarea = json_decode($tarea, true);

                        $detalle_tarea = array(
                            "nombre_tarea" => $arrTarea[0]["descripcion_tarea"],
                            "horas_tarea" => intval($de[$i])
                        );

                        array_push($tareasDE, $detalle_tarea);
                    }
                }

                for ($i=0; $i < count($ed); $i++) {
                    if ($ed[$i] !== '0') {
                        $totalHorasED = $totalHorasED + intval($ed[$i]);

                        $tarea = Tareas::select()
                            ->where('id_custom', 'ed_t'.($i+1))
                        ->get();

                        $arrTarea = json_decode($tarea, true);

                        $detalle_tarea = array(
                            "nombre_tarea" => $arrTarea[0]["descripcion_tarea"],
                            "horas_tarea" => intval($ed[$i])
                        );

                        array_push($tareasED, $detalle_tarea);
                    }
                }

                for ($i=0; $i < count($pr); $i++) {
                    if ($pr[$i] !== '0') {
                        $totalHorasPR = $totalHorasPR + intval($pr[$i]);

                        $tarea = Tareas::select()
                            ->where('id_custom', 'pr_t'.($i+1))
                        ->get();

                        $arrTarea = json_decode($tarea, true);

                        $detalle_tarea = array(
                            "nombre_tarea" => $arrTarea[0]["descripcion_tarea"],
                            "horas_tarea" => intval($pr[$i])
                        );

                        array_push($tareasPR, $detalle_tarea);
                    }
                }

                $area_medica = array(
                    "total_horas" => $totalHorasAM,
                    "tareas_item" => $tareasAM
                );

                $audiovisual = array(
                    "total_horas" => $totalHorasAU,
                    "tareas_item" => $tareasAU
                );

                $comercial = array(
                    "total_horas" => $totalHorasCM,
                    "tareas_item" => $tareasCM
                );

                $creativo = array(
                    "total_horas" => $totalHorasCR,
                    "tareas_item" => $tareasCR
                );

                $diseno_digital = array(
                    "total_horas" => $totalHorasDD,
                    "tareas_item" => $tareasDD
                );

                $diseno_editorial = array(
                    "total_horas" => $totalHorasDE,
                    "tareas_item" => $tareasDE
                );

                $editorial = array(
                    "total_horas" => $totalHorasED,
                    "tareas_item" => $tareasED
                );

                $programacion = array(
                    "total_horas" => $totalHorasPR,
                    "tareas_item" => $tareasPR
                );

                $arrHorasArea = array(
                    "area_medica" => $area_medica,
                    "audiovisual" => $audiovisual,
                    "comercial" => $comercial,
                    "creativo" => $creativo,
                    "diseno_digital" => $diseno_digital,
                    "diseno_editorial" => $diseno_editorial,
                    "editorial" => $editorial,
                    "programacion" => $programacion,
                );

                // Se crea el arreglo para el JSON
                $newArrItem = array(
                    // "total_horas_area" => $arrTotalHorasArea,
                    "id_item" => $item["id_items"],
                    "nombre_item" => $item["nombre_item"],
                    "detalle_item" => $arrHorasArea
                );
                array_push($arrGralItems, $newArrItem);
            }

            $json = array(
                "status" => "200",
                "detalle" => $arrGralItems
            );

            return json_encode($json, true);
        } else {
            $json = array(
                "status" => "200",
                "detalle" => "No hay ítems en la cotización proporcionada"
            );

            return json_encode($json, true);
        }
    }
}
