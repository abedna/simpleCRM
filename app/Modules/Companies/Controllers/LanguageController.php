<?php

namespace App\Modules\Companies\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLanguage($lang, Request $request)
    {

        $request->session()->put('locale', $lang);
        return back();
    }
}
