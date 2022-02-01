<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class WorkerController extends Controller
{
    public function index(){
        session_start();

        $dl = new DataLayer();
        $workers = $dl->list_workers();

        return view('worker.workers')->with('workers', $workers);
    }

    public function create(){
        $dl = new DataLayer();

        $user = $dl->find_user_by_id(auth()->id());
        $user_name = $user->name;

        return view('worker.edit_worker_profile')->with('user_name', $user_name);
    }

    public function store(Request $request){
        $dl = new DataLayer();

        $user_id = auth()->id();
        $user_email = $dl->find_user_by_id($user_id)->email;
        $worker = $dl->add_worker($request->input('name'), $request->input('surname'), $request->input('image'), $request->input('date_of_birth'), $user_email, $request->input('main_profession'), $request->input('nationality'), $user_id);
        $dl->console_log($worker);
        $worker_id = $worker->id;

        $educations = $request->input('education');
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
            foreach($former_jobs as $fb){
                if(!empty($fb)){
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

        return view('worker.worker_profile')->with('worker', $worker);
    } 

    public function show($id){
        session_start();
        
        $dl = new DataLayer();
        $worker = $dl -> find_worker_by_id($id);

        return view('worker.worker_profile')->with('worker', $worker);
    } 
    
    public function edit(){

    } 

    public function update(){

    } 

    public function destroy(){

    } 


}
