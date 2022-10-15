<?php

namespace App\Http\Controllers;

use App\Models\resource_del_records;
use App\Models\resource_updt_records;
use App\Models\stage_deleted_records;
use App\Models\stage_updated_records;
use App\Models\understage_deleted_records;
use App\Models\understage_updt_records;
use App\Models\user_del_records;
use App\Models\user_updt_records;
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

        $subStagesDel = understage_deleted_records::join('localities', 'localities.localityId', '=', 'understage_deleted_records.localityid')
            ->join('neighborhoods', 'hoodId', '=', 'neighborhoodid')
            ->get();

        $mainStagesUpdt = stage_updated_records::join('localities', 'localityId', '=', 'locality_updt')
            ->join('neighborhoods', 'hoodId', '=', 'neighborhood_updt')
            ->get();

        $subStagesUpdt = understage_updt_records::join('localities', 'localities.localityId', '=', 'understage_updt_records.localityid')
            ->join('neighborhoods', 'hoodId', '=', 'neighborhoodid')
            ->get();

        return view('reports.historicReportView.stagesHistoric', compact('mainStagesDel', 'subStagesDel', 'mainStagesUpdt', 'subStagesUpdt'));
    }

    public function resourcesHistoricRecords()
    {
        $resourcesDel = resource_del_records::get();
        $resourcesUpdt = resource_updt_records::get();
        return view('reports.historicReportView.resourcesHistoric', compact('resourcesDel', 'resourcesUpdt'));
    }

    public function usersHistoricRecords()
    {
        $usersDel = User_Del_Records::get();
        $usersUpdt = User_Updt_Records::get();

        return view('reports.historicReportView.usersHistoric', compact('usersDel', 'usersUpdt'));
    }
}
