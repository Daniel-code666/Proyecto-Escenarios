<?php

namespace App\Http\Controllers;

use App\Models\Disciplines;
use App\Models\MiscListStates;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Understage;
use App\Reports\StageReport;
use App\Reports\TestReport;
use App\Reports\SubStageReport;

class StageReportController extends Controller
{
    public function index()
    {
        $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')->get();
        $disciplines['disciplines'] = Disciplines::get();
        $misclist['misclist'] = MiscListStates::where("tableParent", "=", 'stages')->get();
        $underStages['underStages'] = Understage::join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')->get();
        return view('reports.stageReport', $stages)->with('disciplines', $disciplines)->with('misclist', $misclist)->with('underStages', $underStages);
    }

    public function viewReport($id)
    {
        $subStagesArr = Understage::select('idUnderstage')
            ->where('idStage', $id)->get();
        $report = new StageReport(array("id"=>$id, "subStages"=>$subStagesArr));
        $report->run();
        return view('reports.reportViews.viewStageReport', compact('report'));
    }

    public function viewSubReport($idUnderstage)
    {
        $id = Understage::select('idStage')->where('idUnderstage', $idUnderstage)->first();
        $report = new SubStageReport(array("idUnderstage"=>$idUnderstage, "id"=>$id->idStage));
        $report->run();
        return view('reports.reportViews.viewSubStageReport', compact('report'));
    }

    public function testReport()
    {
        $report = new TestReport();
        $report->run();
        return view('reports.reportViews.testReport', compact('report'));
    }
}
