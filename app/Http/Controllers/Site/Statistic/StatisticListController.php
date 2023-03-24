<?php
declare(strict_types=1);
namespace App\Http\Controllers\Site\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Support\Facades\Auth;

class StatisticListController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $interviews = Interview::getStatisticList($userId);
        return view('Statistic.StatisticList.StatisticList', ['interviews' => $interviews]);
    }
}
