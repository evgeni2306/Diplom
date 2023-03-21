<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\Direction;
use App\Models\Profession;
use App\Models\Sphere;
use App\Models\Technology;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\CatQuestCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GenerateContentController extends Controller
{
    public function createContent(string $admin)
    {
        $userFields = [
            'name' => 'admin',
            'surname' => 'admin',
            'login' => 'a',
            'password' => Hash::make('a'),];
        $admin = AdminUser::query()->create($userFields);

        $user = User::create($userFields);

        $web = Direction::create(['name' => 'Web', 'creator_id' => $user->id]);
        $mobile = Direction::create(['name' => 'Mobile', 'creator_id' => $user->id]);

        $juniorPHP = Profession::create(['name' => 'Junior PHP-разработчик', 'creator_id' => $user->id, 'direction_id' => $web->id]);
        $juniorCSharp = Profession::create(['name' => 'Junior C#-разработчик', 'creator_id' => $user->id, 'direction_id' => $web->id]);
        $juniorJS = Profession::create(['name' => 'Junior Javascript-разработчик', 'creator_id' => $user->id, 'direction_id' => $web->id]);
        $juniorKotlin = Profession::create(['name' => 'Junior kotlin-разработчик', 'creator_id' => $user->id, 'direction_id' => $mobile->id]);

        $catSQL = Category::create(['name' => 'SQL', 'creator_id' => $user->id]);
        $catCSharp = Category::create(['name' => 'C#', 'creator_id' => $user->id]);
        $catJavascript = Category::create(['name' => 'Javascript', 'creator_id' => $user->id]);
        $catHtml = Category::create(['name' => 'Html', 'creator_id' => $user->id]);
        $catCss = Category::create(['name' => 'CSS', 'creator_id' => $user->id]);
        $catPhp = Category::create(['name' => 'PHP', 'creator_id' => $user->id]);
        $catKotlin = Category::create(['name' => 'Kotlin', 'creator_id' => $user->id]);
        $catOOP = Category::create(['name' => 'ООП', 'creator_id' => $user->id]);
        $catHTTP = Category::create(['name' => 'HTTP', 'creator_id' => $user->id]);





        $countKotlin = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorKotlin->id, 'category_id' => $catKotlin->id]);
        $countJavascript = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorJS->id, 'category_id' => $catJavascript->id]);
        $countHtml = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorJS->id, 'category_id' => $catHtml->id]);
        $countCSS = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorJS->id, 'category_id' => $catCss->id]);
        $countPHP = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorPHP->id, 'category_id' => $catPhp->id]);
        $countSQLPHP = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorPHP->id, 'category_id' => $catSQL->id]);
        $countHTTPPHP = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorPHP->id, 'category_id' => $catHTTP->id]);
        $countOOPPHP = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorPHP->id, 'category_id' => $catOOP->id]);
        $countCSharp = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorCSharp->id, 'category_id' => $catCSharp->id]);
        $countSQLCSharp = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorCSharp->id, 'category_id' => $catSQL->id]);
        $countHTTPCSharp = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorCSharp->id, 'category_id' => $catHTTP->id]);
        $countOOPCSharpP = CatQuestCount::create(['count' => 2, 'profession_id' => $juniorCSharp->id, 'category_id' => $catOOP->id]);

        $this->questions();
        dd('ok');
    }
    public function questions(){
        $file = Storage::disk('local')->get('questions.tsv');
        $file = explode("\r", $file);
        $file = implode($file);
        $file = explode("\n", $file);
        $z = Category::query()->where('name', 'PHPz')->first();
        foreach($file as $str) {
            $x = explode("\t", $str);
            $cat = Category::query()->where('name', $x[2])->first();
            if($cat!=null){
                Question::query()->create(['creator_id'=>1,'category_id'=>$cat->id,'question'=>$x[0],'answer'=>$x[1]]);
            }else{
                $cat = Category::query()->create(['name'=>$x[2],'creator_id'=>1]);
                Question::query()->create(['creator_id'=>1,'category_id'=>$cat->id,'question'=>$x[0],'answer'=>$x[1]]);

            }
        }
    }

}

