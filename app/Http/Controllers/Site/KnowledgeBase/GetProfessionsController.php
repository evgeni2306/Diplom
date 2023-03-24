<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\KnowledgeBase;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class GetProfessionsController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $professions = Profession::all('id as profId', 'name');
        return view('KnowledgeBase.KnowledgeBase', ['professions' => $professions]);

    }
}
