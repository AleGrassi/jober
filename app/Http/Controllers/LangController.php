<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\DataLayer;


class LangController extends Controller
{
    public function changeLanguage(Request $request, $lang){
        Session::put('language', $lang);
        $dl = new DataLayer();
        $dl -> console_log(Session::get('language'));
        return redirect()->back();
    }
}
