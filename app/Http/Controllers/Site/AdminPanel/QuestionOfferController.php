<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\QuestionOffer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Files\Helpers\searchSimiliar;

class QuestionOfferController extends Controller
{
    use searchSimiliar;
    public function list()
    {
        $offers = QuestionOffer::adminOffersList();
        return view('AdminPanel.QuestionOfferList.QuestionOfferList', ['offers' => $offers]);
    }


    public function view(int $id)
    {
        $questionOffer = QuestionOffer::adminGetQuestionOfferById($id);
        if ($questionOffer === null) {
            return redirect()->back();
        }
        return view('AdminPanel.QuestionOfferView.QuestionOfferView', ['questionOffer' => $questionOffer]);
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int|exists:question_offers,id',
            'category_id' => 'required|string|max:255|exists:categories,name',
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back();
        }
        $fields = $request->all();
        $fields['id'] = (int)$fields['id'];
        QuestionOffer::adminStatusAccepted($fields['id'], $fields['question'], $fields['answer']);
        Question::addOfferedQuestion($fields['id']);
        return redirect(route('admin.expansion'));
    }

    public function refuse(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int|exists:question_offers,id',
            'comment' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back();
        }
        $fields = $request->all();
        QuestionOffer::adminStatusRefuse((int)$fields['id'], $fields['comment']);
        return redirect(route('admin.expansion'));
    }

    public function searchSimiliar(int $id): \Illuminate\Http\JsonResponse
    {
        $str = QuestionOffer::adminGetQuestionOfferTextById($id);
        $collection = Question::query()->get()->all();
         $ids = $this->search($str, $collection);
         $similiar = [];
         foreach($ids as $item){
             $question = Question::adminGetListSimiliar($item);
             array_push($similiar,$question);

         }
        return response()->json($similiar, 200, ['Content-Type' => 'array']);
    }
}
