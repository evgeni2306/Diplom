<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\QuestionOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionOfferController extends Controller
{
    public function list()
    {
        $offers = QuestionOffer::adminOffersList();
        return view('AdminPanel.QuestionOfferList.QuestionOfferList', ['offers' => $offers]);
    }


    public function form($questionOffer = null)
    {
        $categories = Category::query()->get(['name'])->all();
        return view('ContentExpansion.QuestionOfferForm.QuestionOfferForm', ['categories' => $categories, 'questionOffer' => $questionOffer]);
    }


    public function view(int $id)
    {
        $questionOffer = QuestionOffer::adminGetQuestionOfferById($id);
        if ($questionOffer === null) {
            return redirect()->back();
        }
        return view('AdminPanel.QuestionOfferView.QuestionOfferView', ['questionOffer' => $questionOffer]);
    }

    public function store(Request $request, int $id)
    {
        dd($request->all());
    }

    public function refuse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int|exists:question_offers,id',
            'comment' => 'required|string|max:255',
        ]);
        $fields = $request->all();
        QuestionOffer::adminStatusRefuse((int)$fields['id'],$fields['comment']);
        return redirect(route('admin.expansion'));
    }


}
