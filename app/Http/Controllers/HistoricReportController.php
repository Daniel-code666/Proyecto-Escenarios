<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoricReportController extends Controller
{
    public function index()
    {
        return view('reports.historicReports');
    }

}
