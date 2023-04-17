<?php
declare(strict_types=1);
namespace App\Http\Controllers\Site\FavoriteSection;

use App\Http\Controllers\Controller;
use App\Models\FavoriteQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteSectionController extends Controller
{

    public function index(): \Illuminate\Contracts\View\View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $favorites = FavoriteQuestion::getFavoriteList($userId);
        return view('Favorite.Favorite',['favorites'=>$favorites]);
    }
}
