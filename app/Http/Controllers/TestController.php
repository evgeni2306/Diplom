<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Interview;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function test()
    {
        return view('statistics.main');
    }
}
