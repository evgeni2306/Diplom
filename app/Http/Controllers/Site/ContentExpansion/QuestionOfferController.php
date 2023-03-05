<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\ContentExpansion;

use App\Models\Category;
use App\Models\QuestionOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionOfferController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View
    {
        $offers = QuestionOffer::getUsersQuestionOffers(Auth::user()->getAuthIdentifier());
        foreach ($offers as $offer) {
            $offer = $this->getStatus($offer);
        }
        return view('ContentExpansion.QuestionOfferList.QuestionOfferList', ['offers' => $offers]);
    }

    public function form($questionOffer = null): \Illuminate\Contracts\View\View
    {
        $categories = Category::query()->get(['name'])->all();
        return view('ContentExpansion.QuestionOfferForm.QuestionOfferForm', ['categories' => $categories, 'questionOffer' => $questionOffer]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
    {
        if ($request->method() == "GET") {
            return $this->form();
        }
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|string|max:255|exists:categories,name',
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            dd($validator->errors());
        }

        $fields = $request->all('category_id', 'question', 'answer');
        $fields['creator_id'] = Auth::user()->getAuthIdentifier();
        $fields['category_id'] = Category::getIdByName($fields['category_id'])->id;
        QuestionOffer::query()->create($fields);
        return redirect(route('expansionContent'));
    }

    public function view(int $id): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $questionOffer = QuestionOffer::getQuestionOfferById($id, $userId);
        $questionOffer = $this->getStatus($questionOffer);
        if ($questionOffer === null) {
            return redirect()->back();
        }
        return view('ContentExpansion.QuestionOfferView.QuestionOfferView', ['questionOffer' => $questionOffer]);
    }

    public function delete(int $id): \Illuminate\Http\RedirectResponse
    {
        $userId = Auth::user()->getAuthIdentifier();
        QuestionOffer::deleteOfferById($id, $userId);
        return redirect(route('expansionContent'));
    }

    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
    {
        if ($request->method() === "GET") {
            $userId = Auth::user()->getAuthIdentifier();
            $questionOffer = QuestionOffer::getQuestionOfferById($id, $userId);
            if ($questionOffer === null) {
                return redirect()->back();
            }
            return $this->form($questionOffer);
        }
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|string|max:255|exists:categories,name',
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            dd($validator->errors());
        }
        $userId = Auth::user()->getAuthIdentifier();
        $fields = $request->all('category_id', 'question', 'answer');
        $fields['category_id'] = Category::getIdByName($fields['category_id'])->id;
        $update = QuestionOffer::updateOffer($id, $userId, $fields);
        if ($update === null) {
            return redirect()->back;
        }
        return redirect(route('expansionContent'));
    }

    public function visible(int $id): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $visible = QuestionOffer::changeVisible($id, $userId);
        if ($visible === null) {
            return redirect()->back;
        }
        return redirect(route('expansionContent'));
    }

    public function getStatus($questionOffer)
    {

        switch ($questionOffer->status) {
            case 'Yellow':
                $questionOffer->statusName = 'На рассмотрении';
                break;

            case 'Red':
                $questionOffer->statusName = 'Отказ';
                break;
            case 'Green':
                $questionOffer->statusName = 'Принят';
                break;
        }
        return $questionOffer;

    }
}
