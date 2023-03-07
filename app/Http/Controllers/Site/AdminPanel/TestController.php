<?php

namespace App\Http\Controllers\Site\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionOffer;


class TestController extends Controller
{
    public function test()
    {
$offer = Question::query()->find(8);
dd($offer->category->name);
    }


}
