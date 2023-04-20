<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\Profession;
use Illuminate\Support\Facades\Auth;

class StatisticGeneralController extends Controller
{
    public function index(int $id): \Illuminate\Contracts\View\View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $professionName = Profession::query()->find($id);
        $diagramData = Interview::getStatisticDiagram($id, $userId);
        $categoryData = Profession::getGeneralStatistic($id, $userId);
        $generalData = Profession::getGeneralCorrectAnswersPercent($id, $userId);
        return view('Statistic.StatisticGeneral.StatisticGeneral',
            ['diagramData' => $diagramData, 'categoryData' => $categoryData,'generalData'=>$generalData,'professionName'=>$professionName->name]);
    }
}
