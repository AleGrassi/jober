<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class FrontController extends Controller
{
    public function getHome() {
        
        session_start();
        
        $dl = new DataLayer();
        $offers = $dl->list_offers();

        return view('index')->with('offers',$offers);
        /* if(isset($_SESSION['logged'])) {
            return view('index')->with('logged',true)->with('loggedName', $_SESSION['loggedName']);
        } else {
            return view('index')->with('logged',false);
        } */
    }
}
