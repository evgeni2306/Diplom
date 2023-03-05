<?php

declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Inertia\Inertia;

class GetProfessionsController extends Controller
{
    public function create(int $id)
    {

        if (is_numeric($id) and $id > 0) {
            $professions = Profession::getProfByDirectionId((int)$id);
            foreach ($professions as $profession) {
                $profession->url = "interviewPreview";
            }
            return view('Interview.InterviewProfessions.InterviewProfessions',['professions' => $professions]);
            //return Inertia::render('Interview/InterviewProfessions/interviewProfessions', ['professions' => $professions]);
        }
        return redirect()->back;
    }
}
