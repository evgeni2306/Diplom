<?php
declare(strict_types=1);
namespace App\Http\Controllers\Site\Statistic;

use App\Http\Controllers\Controller;
use App\Models\CatQuestCount;
use App\Models\Interview;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class StatisticGeneralController extends Controller
{
    public function index(int $id):\Illuminate\Contracts\View\View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $diagramData = Interview::getStatisticDiagram($id, $userId);
        return view('Statistic.StatisticGeneral.StatisticGeneral', ['diagramData' => $diagramData]);
    }
}
