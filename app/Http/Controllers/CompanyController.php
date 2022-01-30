<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class CompanyController extends Controller
{
    public function index(){
        session_start();

        $dl = new DataLayer();
        $companies = $dl->list_companies();

        return view('company.companies')->with('companies', $companies);
    }

    public function create(){

    }

    public function store(){

    } 

    public function show($id){
        session_start();

        $dl = new DataLayer();
        $company = $dl->find_company_by_id($id);
        $company_offers = $dl->list_company_offers($id);

        return view('company.company_profile')->with('company',$company)->with('company_offers',$company_offers);
    } 
    
    public function edit(){

    } 

    public function update(){

    } 

    public function destroy(){

    } 
}

