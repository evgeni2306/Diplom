<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
//        'registration',
//        'login',
//        'interview/start',
//        'interview/results',
//        'interview/question',
//        'interview/question/answer',
//
//        'question/favorite/list',
//        'question/favorite/add',
//        'question/favorite/delete',
//        'interview/templates',
//        'interview/templates/delete',
//
//        'knowledgebase/professions',
//        'knowledgebase/professions/questions'
    ];
}
