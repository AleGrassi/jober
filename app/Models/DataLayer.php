<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

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

    public function exists_application($offer_id, $worker_id){
        $offers = DB::select("SELECT offer.* FROM offer, offer_worker WHERE (worker_id = ? AND offer_id = ?)", [$worker_id,$offer_id]);

        if(count($offers) == 0){
            return false;
        }else{
            return true;
        }
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

    public function add_company($name, $description, $image, $email, $user_id){
        $company = new Company();
        $company->name = $name;
        $company->description = $description;
        $company->image = $image;
        $company->email = $email;
        $company->user_id = $user_id;
        $company->save();
        return $company;
    }

    public function add_company_location($name, $email, $phone, $company_id){
        $location = new CompanyLocation();
        $location->name = $name;
        $location->email = $email;
        $location->phone = $phone;
        $location->company_id = $company_id;
        $location->save();
    }

    public function add_offer($title, $description, $location, $starting_salary, $education_requirements, $company_id){
        $offer = new Offer();
        $offer->title = $title;
        $offer->description = $description;
        $offer->location = $location;
        $offer->starting_salary = $starting_salary;
        $offer->education_requirements = $education_requirements;
        $offer->company_id = $company_id;
        $offer->save();
        return $offer;
    }

    public function add_skill_requirement($name, $offer_id){
        $skill_requirement = new SkillRequirement();
        $skill_requirement->name = $name;
        $skill_requirement->offer_id = $offer_id;
        $skill_requirement->save();
    }

    public function add_language_requirement($name, $offer_id){
        $language_requirement = new LanguageRequirement();
        $language_requirement->name = $name;
        $language_requirement->offer_id = $offer_id;
        $language_requirement->save();
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

    public function update_offer($id, $title, $description, $location, $starting_salary, $education_requirements, $company_id){
        $offer = Offer::find($id);
        $offer->title = $title;
        $offer->description = $description;
        $offer->location = $location;
        $offer->starting_salary = $starting_salary;
        $offer->education_requirements = $education_requirements;
        $offer->company_id = $company_id;
        $offer->save();
    }

    public function update_skill_requirement($id, $name, $offer_id){
        $skill_requirement = SkillRequirement::find($id);
        $skill_requirement->name = $name;
        $skill_requirement->offer_id = $offer_id;
        $skill_requirement->save();
    }

    public function update_language_requirement($id, $name, $offer_id){
        $language_requirement = LanguageRequirement::find($id);
        $language_requirement->name = $name;
        $language_requirement->offer_id = $offer_id;
        $language_requirement->save();
    }

    public function reject_candidate($offer_id, $worker_id){
        $offer = Offer::find($offer_id);
        $worker = $offer->candidates->find($worker_id);
        $worker->pivot->status = 'rejected';
        $worker->pivot->save();
    }

    public function reconsider_candidate($offer_id, $worker_id){
        $offer = Offer::find($offer_id);
        $worker = $offer->candidates->find($worker_id);
        $worker->pivot->status = 'pending';
        $worker->pivot->save();
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

    public function delete_company_location($id){
        CompanyLocation::find($id)->delete();
    }

    public function delete_skill_requirement($id){
        SkillRequirement::find($id)->delete();
    }

    public function delete_language_requirement($id){
        LanguageRequirement::find($id)->delete();
    }
    
    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    public function update_company($company_id, $name, $description, $image, $email, $user_id){
        $company = Company::find($company_id);
        $company->name = $name;
        $company->description = $description;
        $company->image = $image;
        $company->email = $email;
        $company->user_id = $user_id;
        $company->save();
    }

}




?>