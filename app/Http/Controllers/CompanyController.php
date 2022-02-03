<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index(){
        $dl = new DataLayer();
        $companies = $dl->list_companies();

        return view('company.companies')->with('companies', $companies);
    }

    public function create(){
        return view('company.edit_company_profile');
    }

    public function store(){

    } 

    public function show($id){
        $dl = new DataLayer();
        $company = $dl->find_company_by_id($id);
        $company_offers = $dl->list_company_offers($id);

        return view('company.company_profile')->with('company',$company)->with('company_offers',$company_offers);
    } 
    
    public function edit($id){
        if($id == Auth::user()->company->id){
            return view('company.edit_company_profile')->with('company', Auth::user()->company);
        }else{
            return Redirect::to(route('company.show', ['company' => $id]));
        }
    } 

    public function update(){

    } 

    public function destroy(){

    } 
}

