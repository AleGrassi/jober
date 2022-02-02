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

    public function find_worker_by_user_id($user_id){
        return Worker::where('user_id', $user_id)->get();
    }

    public function find_company_by_user_id($user_id){
        return Company::where('user_id', $user_id)->get();
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

    //add elements
    public function add_worker($name, $surname, $image, $date_of_birth, $email, $main_profession, $nationality, $user_id){
        $worker = new Worker();
        $worker->name = $name;
        $worker->surname = $surname;
        $worker->image = $image;
        $worker->date_of_birth = $date_of_birth;
        $worker->email = $email;
        $worker->main_profession = $main_profession;
        $worker->nationality = $nationality;
        $worker->user_id = $user_id;
        $worker->save();
        return $worker;
    }

    public function add_education($name,$worker){
        $education = new Education();
        $education->name = $name;
        $education->worker_id = $worker;
        $education->save();
    }

    public function add_former_job($name,$worker){
        $former_job = new FormerJob();
        $former_job->name = $name;
        $former_job->worker_id = $worker;
        $former_job->save();
    }
    
    public function add_skill($name,$worker){
        $skill = new Skill();
        $skill->name = $name;
        $skill->worker_id = $worker;
        $skill->save();
    }
    
    public function add_language($name,$worker){
        $language = new Language();
        $language->name = $name;
        $language->worker_id = $worker;
        $language->save();
    }

    //update elements
    public function update_worker($id, $name, $surname, $image, $date_of_birth, $email, $main_profession, $nationality, $user_id){
        $worker = Worker::find($id);
        $worker->name = $name;
        $worker->surname = $surname;
        $worker->image = $image;
        $worker->date_of_birth = $date_of_birth;
        $worker->email = $email;
        $worker->main_profession = $main_profession;
        $worker->nationality = $nationality;
        $worker->user_id = $user_id;
        $worker->save();
    }
    
    public function update_user_name($user_id, $new_name){
        $user = User::find($user_id);
        $user->name = $new_name;
        $user->save();
    }

    //remove elements
    public function delete_education($id){
        Education::find($id)->delete();
    }
    
    public function delete_former_job($id){
        FormerJob::find($id)->delete();
    }
    
    public function delete_skill($id){
        Skill::find($id)->delete();
    }
    
    public function delete_language($id){
        Language::find($id)->delete();
    }
    
    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
}




?>