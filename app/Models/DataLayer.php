<?php

namespace App\Models;

class DataLayer{

    //list elements
    public function list_companies(){
        return Company::orderBy('name','asc')->get();
    }

    public function list_workers(){
        return Worker::all();
    }

    public function list_offers(){
        return Offer::all();
    }
    
    public function list_company_offers($company_id){
        return Offer::where('company_id', $company_id)->get();
    }

    public function list_worker_offers($worker_id){
        return Worker::find($worker_id)->offers()->get();
    }

    public function list_offer_candidates($offer_id){
        return Offer::find($offer_id)->candidates()->get();
    }

    //find elements
    public function find_worker_by_id($id){
        return Worker::find($id);
    }
    
    public function find_company_by_id($id){
        return Company::find($id);
    }

    public function find_offer_by_id($id){
        return Offer::find($id);
    }

    public function find_user_by_id($id){
        return User::find($id);
    }

    //delete elements
    public function delete_worker($worker_id){
        Worker::find($worker_id)->delete();
    }
    
    public function delete_offer($offer_id){
        Offer::find($offer_id)->delete();
    }

    public function delete_company($company_id){
        Company::find($company_id)->delete();
    }

    //edit elements
    
}




?>