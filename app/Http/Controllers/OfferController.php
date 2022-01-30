<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;


class OfferController extends Controller
{
    public function index(){
        session_start();

        $dl = new DataLayer();
        $offers = $dl->list_offers();

        return view('index')->with('offers', $offers);
    }

    public function create(){

    }

    public function store(){

    } 

    public function show($id){
        session_start();

        $dl = new DataLayer();
        $offer = $dl->find_offer_by_id($id);

        return view('company.offer')->with('offer', $offer);
    } 
    
    public function edit(){

    } 

    public function update(){

    } 

    public function destroy(){

    } 
}
