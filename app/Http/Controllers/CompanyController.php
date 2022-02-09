<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

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

    public function store(Request $request){
        $this->validate($request, Company::$rules);
        $dl = new DataLayer();

        $user_id = auth()->id();
        $user_email = Auth::user()->email;

        $dl->console_log($request->input());

        if($request->file("profile_image")!==null){
            $dl->console_log("ho un'immagine");
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('profile_image')->storeAs('public/img/company_profile/',$fileNameToStore);
        }else{
            $fileNameToStore = 'company_profile_tmp.jpeg';
            $dl->console_log("non ho un'immagine");
        }

        $company = $dl->add_company($request->input('name'), $request->input('description'), $fileNameToStore, $user_email, $user_id);
        $dl->console_log($company);
        $company_id = $company->id;

        $locations_names = $request->input('location_name');
        $locations_emails = $request->input('location_email');
        $locations_phones = $request->input('location_phone');
        if(isset($locations_names)){
            for($i=0; $i<count($locations_names); $i++){
                if(!empty($locations_names[$i])){
                    $dl->add_company_location($locations_names[$i], $locations_emails[$i], $locations_phones[$i], $company->id);
                }
            }
        }
        return Redirect::to(route('company.show', ['company' => $company->id]));
    } 

    public function show($id){
        $dl = new DataLayer();
        $company = $dl->find_company_by_id($id);

        return view('company.company_profile')->with('company',$company);
    } 
    
    public function edit($id){
        if($id == Auth::user()->company->id){
            return view('company.edit_company_profile')->with('company', Auth::user()->company);
        }else{
            return Redirect::to(route('company.show', ['company' => $id]));
        }
    } 

    public function update(Request $request, $id){
        $this->validate($request, Company::$rules);
        $dl = new DataLayer();
        $company = $dl->find_company_by_id($id);

        $user_id = auth()->id();
        $user_email = Auth::user()->email;

        $dl->console_log($request->input());

        if($request->hasFile("profile_image")){
            $dl->console_log("ho un'immagine");
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('profile_image')->storeAs('public/img/company_profile/',$fileNameToStore);
        }else{
            $fileNameToStore = $company->image;
            $dl->console_log("non ho un'immagine");
        }

        $dl->update_company($id, $request->input('name'), $request->input('description'), $fileNameToStore, $user_email, $user_id);
        $dl->update_user_name($user_id, $request->input('name'));

        foreach($company->locations as $location){
            $dl->delete_company_location($location->id);
        }

        $locations_names = $request->input('location_name');
        $locations_emails = $request->input('location_email');
        $locations_phones = $request->input('location_phone');
        if(isset($locations_names)){
            for($i=0; $i<count($locations_names); $i++){
                if(!empty($locations_names[$i])){
                    $dl->add_company_location($locations_names[$i], $locations_emails[$i], $locations_phones[$i], $id);
                }
            }
        }
        return Redirect::to(route('company.show', ['company' => $id]));
    } 

    public function destroy(){

    } 
}

