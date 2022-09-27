<?php

namespace App\Http\Controllers;

use App\Models\stage_deleted_records;
use App\Models\stage_updated_records;
use App\Models\understage_deleted_records;
use App\Models\understage_updt_records;
use Illuminate\Http\Request;

class HistoricReportController extends Controller
{
    public function index()
    {
        return view('reports.historicReports');
    }

    public function stagesHistoricRecords()
    {
        $mainStagesDel = stage_deleted_records::join('localities', 'localityId', '=', 'locality')
            ->join('neighborhoods', 'hoodId', '=', 'neighborhood')
            ->get();
        $subStagesDel = understage_deleted_records::get();

        $mainStagesUpdt = stage_updated_records::join('localities', 'localityId', '=', 'locality_updt')
            ->join('neighborhoods', 'hoodId', '=', 'neighborhood_updt')
            ->get();
        $subStagesUpdt = understage_updt_records::get();

        return view('reports.historicReportView.stagesHistoric', compact('mainStagesDel', 'subStagesDel', 'mainStagesUpdt', 'subStagesUpdt'));
    }
}
