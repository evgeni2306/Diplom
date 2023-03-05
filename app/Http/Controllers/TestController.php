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
        $file = Storage::disk('local')->get('questions.tsv');
        $file = explode("\r\n", $file);
        for ($i = 1; $i < count($file); $i++) {
            $z = explode("\t", $file[$i]);
            if(isset($z[4])){
                if (str_starts_with($z[4], '66') ||
                    str_starts_with($z[4], '96') ||
                    str_starts_with($z[4], '196')
                ) {
                    if($z[9]!="Аннулирована"){
                        echo $z[4] .' '. "<br/> ";
                    }

                }
            }

        }
        dd('finish');
        $z = explode("\t", $file[1000]);
        if (str_starts_with($z[4], '66')) {
            dd('yes');
        }
        var_dump($z[4]);;
        dd($z);

        $file = implode($file);
        $file = explode("\n", $file);
        $z = Category::query()->where('name', 'PHPz')->first();
        foreach ($file as $str) {
            $x = explode("\t", $str);
            $cat = Category::query()->where('name', $x[2])->first();
            if ($cat != null) {
                Question::query()->create(['creator_id' => 1, 'category_id' => $cat->id, 'question' => $x[0], 'answer' => $x[1]]);
            } else {
                $cat = Category::query()->create(['name' => $x[2], 'creator_id' => 1]);
                Question::query()->create(['creator_id' => 1, 'category_id' => $cat->id, 'question' => $x[0], 'answer' => $x[1]]);

            }
        }
    }
}
