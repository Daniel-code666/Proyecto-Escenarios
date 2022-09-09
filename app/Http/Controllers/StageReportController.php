<?php

namespace App\Http\Controllers;

use App\Models\Disciplines;
use App\Models\MiscListStates;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Understage;
use App\Reports\StageReport;
use App\Reports\TestReport;

class StageReportController extends Controller
{
    public function index()
    {
        $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')->get();
        $disciplines['disciplines'] = Disciplines::get();
        $misclist['misclist'] = MiscListStates::where("tableParent", "=", 'stages')->get();
        return view('reports.stageReport', $stages)->with('disciplines', $disciplines)->with('misclist', $misclist);
    }

    public function viewReport($id)
    {
        $subStagesArr = Understage::select('idUnderstage')
            ->where('idStage', $id)->get();
        $report = new StageReport(array("id"=>$id, "subStages"=>$subStagesArr));
        $report->run();
        return view('reports.reportViews.viewStageReport', compact('report'));
    }

    public function testReport()
    {
        $report = new TestReport();
        $report->run();
        return view('reports.reportViews.testReport', compact('report'));
    }
}
