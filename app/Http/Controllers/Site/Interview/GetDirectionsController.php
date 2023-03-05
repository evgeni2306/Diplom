<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Http\Controllers\Controller;
use App\Models\Direction;


class GetDirectionsController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View
    {
        $directions = Direction::all('name', 'id');
        foreach ($directions as $direction) {
            $direction->url = "interviewProfession";
        }
        return view('Interview.InterviewDirections.InterviewDirections', ['directions' => $directions]);
    }
}
