<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\KnowledgeBase;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class GetProfessionsController extends Controller
{
    public function create(Request $request)
    {
        $professions = Profession::all('id as profId', 'name');
        return view('KnowledgeBase.KnowledgeBase', ['professions' => $professions]);

    }
}
