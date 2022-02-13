<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use GuzzleHttp\Client;

class CompanyController extends Controller
{
    public function index(){
        $dl = new DataLayer();
        $companies = $dl->list_companies();

        return view('company.companies')->with('companies', $companies);
    }

    public function filter(Request $request){
        $dl = new DataLayer();
        $name_filter = $request->input('name');
        $companies = $dl->filter_companies($name_filter);

        return view('company.companies')->with('companies', $companies)->with('name_filter', $name_filter);
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

    public function contactForm($company_id){
        $dl = new DataLayer();
        $company = $dl->find_company_by_id($company_id);
        return view('contact_form')->with('company',$company);
    }

    public function contact(Request $request, $company){
        $dl = new DataLayer();
        $receiver = $dl->find_company_by_id($company);

        if(isset(Auth::user()->worker)){
            $sender = Auth::user()->worker;
            $sender_email = $sender->email;
            $sender_name = $sender->name.' '.$sender->surname;
        }elseif(isset(Auth::user()->company)){
            $sender = Auth::user()->company;
            $sender_email = $sender->email;
            $sender_name = $sender->name;
        }

        $receiver_email = $receiver->email;
        $receiver_name = $receiver->name;
        $subject = $request->input('subject');
        $message = $request->input('message');

        try{
            $client = new Client([
                // URI da contattare
                'base_uri' => 'http://localhost:8086',
                'timeout'  => 60.0,
            ]);
            
            $response = $client->request('POST', '', [
                 'form_params' => ['sender_email' => $sender_email, 'sender_name' => $sender_name, 'receiver_email' => $receiver_email, 'receiver_name' => $receiver_name, 'subject' => $subject, 'message' => $message],
                 'headers' => ['source' => 'Jober', 'content-type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json']
            ]);

            $result = json_decode($response->getBody());
            if ($result->result == "positive") {
                return view('company.company_profile')->with('company', $receiver)->with('message','Message sent correctly');
            }else{
                return view('company.company_profile')->with('company', $receiver)->with('error','Message not sent. Something went wrong');
            }
        }catch(\GuzzleHttp\Exception\ConnectException $e){
            return view('company.company_profile')->with('company', $receiver)->with('error','Message not sent. Something went wrong');
        }
    }

    public function destroy(){

    } 
}

