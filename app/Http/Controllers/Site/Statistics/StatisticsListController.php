<?php

namespace App\Http\Controllers\Site\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Support\Facades\Auth;

class StatisticsListController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $interviews = Interview::getStatisticList($userId);
        return view('Statistics.StatisticsList.StatisticsList', ['interviews' => $interviews]);
    }
}
