<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplines;
use App\Models\MiscListStates;
use App\Models\Stage;
use App\Models\Understage;
use App\Models\warehouse;
use App\Reports\ResourcesReport;
use App\Reports\ResupplyReport;
use App\Reports\SubStageResReport;
use App\Reports\SubStageResupplyReport;

class ResourcesReportController extends Controller
{
    public function index()
    {
        $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'stages.id_category')
            ->join('localities', 'localities.localityid', '=', 'stages.localityid')
            ->join('neighborhoods', 'neighborhoods.hoodId', '=', 'stages.neighborhoodid')
            ->where('misc_list_states.tableParent', 'stages')->get();
        $disciplines['disciplines'] = Disciplines::get();
        $misclist['misclist'] = MiscListStates::where("tableParent", "=", 'stages')->get();
        $underStages['underStages'] = Understage::join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'understages.id_category_understg')
            ->join('stages', 'stages.id', '=', 'understages.idStage')
            ->where('misc_list_states.tableParent', 'stages')->get();
        return view('reports.resourcesReport', $stages)->with('disciplines', $disciplines)->with('misclist', $misclist)->with('underStages', $underStages);
    }

    public function viewReport($id)
    {
        $warehousesArr = warehouse::select('warehouseId')
            ->where('warehouseLocation', $id)
            ->where('locationCheck', 1)->get();

        $report = new ResourcesReport(array("id" => $id, "warehousesArr" => $warehousesArr));
        $report->run();
        return view('reports.reportViews.viewResourceReport', compact('report'));
    }

    public function viewSubStageReport($idUnderstage)
    {
        $warehousesArr = warehouse::select('warehouseId')
            ->where('warehouseLocation', $idUnderstage)
            ->where('locationCheck', 0)->get();

        $report = new SubStageResReport(array("idUnderstage" => $idUnderstage, "warehousesArr" => $warehousesArr));
        $report->run();
        return view('reports.reportViews.viewSubResourceReport', compact('report'));
    }

    public function viewResupplyReport($id)
    {
        $warehousesArr = warehouse::select('warehouseId')
            ->where('warehouseLocation', $id)
            ->where('locationCheck', 1)->get();

        $report = new ResupplyReport(array("id" => $id, "warehousesArr" => $warehousesArr));
        $report->run();
        return view('reports.reportViews.viewResupplyReport', compact('report'));
    }

    public function viewSubResupplyReport($idUnderstage)
    {
        $warehousesArr = warehouse::select('warehouseId')
            ->where('warehouseLocation', $idUnderstage)
            ->where('locationCheck', 0)->get();

        $report = new SubStageResupplyReport(array("idUnderstage" => $idUnderstage, "warehousesArr" => $warehousesArr));
        $report->run();
        return view('reports.reportViews.viewSubStageResupplyReport', compact('report'));
    }
}
