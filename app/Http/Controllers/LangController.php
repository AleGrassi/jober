<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\DataLayer;


class LangController extends Controller
{
    public function changeLanguage(Request $request, $language){
        $dl=new DataLayer();
        $dl->console_log('lingua cambiata, vecchia lingua: ' . Session::get('language'));
        Session::put('language', $language);
        $dl->console_log('lingua cambiata, nuova lingua: ' . Session::get('language'));
        return redirect()->back();
    }
}
