<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Offer;


class OfferController extends Controller
{
    public function index(){
        $dl = new DataLayer();
        $offers = $dl->list_offers();

        return view('index')->with('offers', $offers);
    }

    public function filter(Request $request){
        $dl = new DataLayer();
        $company_filter = $request->input('company_filter');
        $role_filter = $request->input('role_filter');
        $location_filter = $request->input('location_filter');
        $offers = $dl->filter_offers($company_filter, $role_filter, $location_filter);

        return view('index')->with('offers', $offers)->with('company_filter', $company_filter)->with('role_filter', $role_filter)->with('location_filter', $location_filter);
    }

    public function create(){
        return view('company.edit_offer');
    }

    public function store(Request $request){
        $this->validate($request, Offer::$rules);
        $dl = new DataLayer();

        $user_id = auth()->id();
        $company_id = Auth::user()->company->id;
        $offer = $dl->add_offer($request->input('title'), $request->input('description'), $request->input('location'), $request->input('starting_salary'), $request->input('edu_requirements'), $company_id);
        $offer_id = $offer->id;

        $skill_requirements = $request->input('skill_requirement');
        if(isset($skill_requirement)){
            foreach($skill_requirements as $sr){
                if(!empty($sr)){
                    $dl->add_skill_requirement($sr, $offer_id);
                }
            }
        }

        $language_requirements = $request->input('language_requirement');
        if(isset($language_requirement)){
            foreach($language_requirements as $lr){
                if(!empty($lr)){
                    $dl->add_language_requirement($lr, $offer_id);
                }
            }
        }
        return Redirect::to(route('offer.show', ['offer' => $offer_id]));
    } 

    public function show($id){
        $dl = new DataLayer();
        $offer = $dl->find_offer_by_id($id);

        return view('company.offer')->with('offer', $offer);
    } 
    
    public function edit($id){
        $dl = new DataLayer();
        $offer = $dl->find_offer_by_id($id);

        if($offer->company->id == Auth::user()->company->id){
            return view('company.edit_offer')->with('offer',$offer);
        }else{
            return view('company.offer')->with('offer',$offer);
        }
    } 

    public function update(Request $request, $id){
        $this->validate($request, Offer::$rules);
        $dl = new DataLayer();

        $offer = $dl->find_offer_by_id($id);
        $user_id = auth()->id();
        $company_id = Auth::user()->company->id;
        $dl->update_offer($id, $request->input('title'), $request->input('description'), $request->input('location'), $request->input('starting_salary'), $request->input('edu_requirements'), $company_id);
        $offer_id = $offer->id;

        foreach($offer->skill_requirements as $sr){
            $dl->delete_skill_requirement($sr->id);
        }
        $skill_requirements = $request->input('skill_requirement');
        if(isset($skill_requirements)){
            foreach($skill_requirements as $sr){
                if(!empty($sr)){
                    $dl->add_skill_requirement($sr, $offer_id);
                }
            }
        }

        foreach($offer->language_requirements as $lr){
            $dl->delete_language_requirement($lr->id);
        }
        $language_requirements = $request->input('language_requirement');
        if(isset($language_requirements)){
            foreach($language_requirements as $lr){
                if(!empty($lr)){
                    $dl->add_language_requirement($lr, $offer_id);
                }
            }
        }
        return Redirect::to(route('offer.show', ['offer' => $id]));
    } 

    public function candidate(Request $request){
        $dl = new DataLayer();
        $dl->candidate($request->input('offer'), $request->input('worker'));

        $response = array('done' => true);
        return response()->json($response);
    }

    public function uncandidate(Request $request){
        $dl = new DataLayer();
        $dl->uncandidate($request->input('offer'), $request->input('worker'));
        $response = array('done' => true);

        return response()->json($response);
    }

    public function rejectCandidate($offer_id, $candidate_id){
       $dl = new DataLayer();

       $dl->reject_candidate($offer_id, $candidate_id);
       
       return Redirect::to(route('offer.show',['offer'=>$offer_id]));
    }

    public function reconsiderCandidate($offer_id, $candidate_id){
       $dl = new DataLayer();

       $dl->reconsider_candidate($offer_id, $candidate_id);
       
       return Redirect::to(route('offer.show',['offer'=>$offer_id]));
    }

    public function destroy($offer){
        $dl = new DataLayer();
        $company = $dl->find_company_by_offer_id($offer);
        $dl->delete_offer($offer);
        
        return Redirect::to(route('company.show',['company'=>$company->id]));
    } 

    public function ajaxCheckForWorker(Request $request){
        //return a JSON {'found':true/false}

        $dl = new DataLayer();

        if($dl->exists_application($request->input('offer'), $request->input('worker'))){
            $response = array('found' => true);
        }else{
            $response = array('found' => false);
        }
        return response()->json($response);
    }
}
