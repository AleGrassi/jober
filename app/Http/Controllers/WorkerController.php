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

    }

    public function store(){

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
