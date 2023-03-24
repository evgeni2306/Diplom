<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\CatQuestCount;

class PreviewPageController extends Controller
{
    public function index($id):\Illuminate\Contracts\View\View
    {
        if (is_numeric($id) and $id > 0) {

            $profession = Profession::getProfById((int)$id);
            foreach ($profession as $prof) {
                $prof->count = CatQuestCount::getSumCountQuestsForProf((int)$id);
                $profession = $profession[0];
                $_SESSION['profName'] = $profession->name;
                return view('Interview.InterviewPreview.InterviewPreview',['previewPageInfo' => $profession]);
            }
            return redirect()->back;
        }
    }
}
