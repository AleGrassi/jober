<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Worker;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class WorkerController extends Controller
{
    public function index(){
        $dl = new DataLayer();
        $workers = $dl->list_workers();

        return view('worker.workers')->with('workers', $workers);
    }

    public function filter(Request $request){
        $dl = new DataLayer();
        $workers = $dl->filter_workers($request->input('name'), $request->input('profession'));

        return view('worker.workers')->with('workers', $workers);
    }

    public function create(){
        $dl=new DataLayer();
        $dl->console_log('sono qui');
        return view('worker.edit_worker_profile');
    }

    public function store(Request $request){
        $this->validate($request, Worker::$rules);
        $dl = new DataLayer();

        $user_id = auth()->id();
        $user_email = $dl->find_user_by_id($user_id)->email;

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
            $path = $request->file('profile_image')->storeAs('public/img/worker_profile/',$fileNameToStore);
        }else{
            $fileNameToStore = 'worker_profile_tmp.jpeg';
            $dl->console_log("non ho un'immagine");
        }


        $worker = $dl->add_worker($request->input('name'), $request->input('surname'), $fileNameToStore, $request->input('date_of_birth'), $user_email, $request->input('main_profession'), $request->input('nationality'), $user_id);
        $dl->console_log($worker);
        $worker_id = $worker->id;

        $educations = $request->input('education');
        $dl->console_log('educations is empty? '. empty($educations));
        if(!empty($educations)){
            foreach($educations as $edu){
                if(!empty($edu)){
                    $dl->add_education($edu, $worker_id);
                }
            }
        }
        
        $skills = $request->input('skill');
        if(!empty($skills)){
            foreach($skills as $s){
                if(!empty($s)){
                    $dl->add_skill($s, $worker_id);
                }
            }
        }

        $former_jobs = $request->input('former_job');
        if(!empty($former_jobs)){
            foreach($former_jobs as $fj){
                if(!empty($fj)){
                    $dl->add_former_job($fj, $worker_id);
                }
            }
        }

        $languages = $request->input('language');
        if(!empty($languages)){
            foreach($languages as $l){
                if(!empty($l)){
                    $dl->add_language($l, $worker_id);
                }
            }
        }
        return Redirect::to(route('worker.show', ['worker' => $worker->id]));
    } 

    public function show($id){
        $dl = new DataLayer();
        $worker = $dl -> find_worker_by_id($id);

        return view('worker.worker_profile')->with('worker', $worker);
    } 
    
    public function edit($id){
        if($id == Auth::user()->worker->id){
            return view('worker.edit_worker_profile')->with('worker', Auth::user()->worker);
        }else{
            return Redirect::to(route('worker.show', ['worker' => $id]));
        }
    } 

    public function update(Request $request, $id){
        $this->validate($request, Worker::$rules);
        $dl = new DataLayer();
        $worker = $dl->find_worker_by_id($id);
        $user_email = Auth::user()->email;

        $dl->console_log($request->input());

        if($request->hasFile("profile_image")){
            $dl->console_log('immagine inserita');
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('profile_image')->storeAs('public/img/worker_profile/',$fileNameToStore);
        }else{
            $dl->console_log('immagine non inserita');
            $fileNameToStore = $worker->image;
        }

        $worker_id = $worker->id;
        $user_id = Auth::user()->id; 
        $dl->update_worker($worker_id, $request->input('name'), $request->input('surname'), $fileNameToStore, $request->input('date_of_birth'), $user_email, $request->input('main_profession'), $request->input('nationality'), $user_id);
        $dl->update_user_name($user_id, $request->input('name'));

        foreach($worker->educations as $edu){
            $dl->delete_education($edu->id);
        }
        $educations = $request->input('education');
        if(!empty($educations)){
            foreach($educations as $edu){
                if(!empty($edu)){
                    $dl->add_education($edu, $worker_id);
                }
            }
        }
        
        foreach($worker->skills as $s){
            $dl->delete_skill($s->id);
        }
        $skills = $request->input('skill');
        if(!empty($skills)){
            foreach($skills as $s){
                if(!empty($s)){
                    $dl->add_skill($s, $worker_id);
                }
            }
        }

        foreach($worker->former_jobs as $fj){
            $dl->delete_former_job($fj->id);
        }
        $former_jobs = $request->input('former_job');
        if(!empty($former_jobs)){
            foreach($former_jobs as $fj){
                if(!empty($fj)){
                    $dl->add_former_job($fj, $worker_id);
                }
            }
        }

        foreach($worker->languages as $l){
            $dl->delete_language($l->id);
        }
        $languages = $request->input('language');
        if(!empty($languages)){
            foreach($languages as $l){
                if(!empty($l)){
                    $dl->add_language($l, $worker_id);
                }
            }
        }
        return Redirect::to(route('worker.show', ['worker' => $worker->id]));
        
    } 

    public function contactForm($worker_id){
        $dl = new DataLayer();
        $worker = $dl->find_worker_by_id($worker_id);
        return view('contact_form')->with('worker',$worker);
    }

    public function contact(Request $request, $worker){
        $dl = new DataLayer();
        $receiver = $dl->find_worker_by_id($worker);

        if(isset(Auth::user()->worker)){
            $sender = Auth::user()->worker;
            $sender_email = $sender->email;
            $sender_name = $sender->name;
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
                return view('worker.worker_profile')->with('worker', $receiver)->with('message','Message sent correctly');
            }else{
                return view('worker.worker_profile')->with('worker', $receiver)->with('message','Message sent correctly');
            }
        }catch(\GuzzleHttp\Exception\ConnectException $e){
            return Redirect::to(route('worker.show', ['worker' => $receiver->id, 'error'=>'Something went wrong']));
        }


    }

    public function destroy(){

    } 


}
