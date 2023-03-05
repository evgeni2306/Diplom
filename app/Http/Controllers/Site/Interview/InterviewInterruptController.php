<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site\Interview;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class InterviewInterruptController extends Controller
{
    public function interrupt(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (isset($_SESSION['interviewId'])) {
            $interview = Interview::interrupt($_SESSION['interviewId']);
            unset($_SESSION['interviewId'], $_SESSION['taskId'], $_SESSION['profId'], $_SESSION['profName']);
        }
        return redirect(route(RouteServiceProvider::USERHOME));
    }
}
