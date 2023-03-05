<?php

namespace App\Http\Middleware;

use App\Models\Interview;
use Closure;
use Illuminate\Http\Request;

class CheckSimulationActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset($_SESSION['interviewId'])){
            if (isset($_SESSION['interviewId'])) {
                $interview = Interview::interrupt($_SESSION['interviewId']);
                unset($_SESSION['interviewId'], $_SESSION['taskId'], $_SESSION['profId'], $_SESSION['profName']);
            }
            return $next($request);
        }
        return $next($request);
    }
}
