
@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">Companies</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">Professionals</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('offer.index') }}">Offers</a></li>
<li class="breadcrumb-item active"><a href="#">{{ $offer->company->name }}'s offer</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row g-4">

        <div class="col-12 col-sm-3">
            <a  class="card-link" href="{{ route('company.show', ['company'=> $offer->company->id]) }}">
                <div class="card card-responsive">
                    <div class="image-holder">
                        <img class="card-img-top" src="{{ url('/') }}/img/company_profile/{{ $offer->company->image }}">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-center">{{ $offer->company->name }}</h6>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-sm-7">   

            <div class="card company-name-card text-center">
                <h4>{{ $offer->title }}</h4>
            </div>
            <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Location</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $offer->location }}</p>
                    </div>
            </div>
            
        </div>

        <div class="col-12 col-sm-2">
            <div class="card">
                <a class="btn btn-contact">
                    <p>Candidate</p>
                </a>
            </div>  
            <div class="card">
                <a class="btn btn-contact" href="{{ route('edit_offer') }}">
                    <p>Edit</p>
                </a>
            </div>  
        </div>    
    </div>
</div>

<div class="container top-buffer">
        <div class="row row-cols-1 g-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Main Tasks, duties and Responsabilities</h6>
                    </div>
                    <div class="card-body">
                        <div style="white-space: pre-line">{{ $offer->description }}</div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Education Requirements</h6>
                    </div>
                    <div class="card-body">
                        <div style="white-space: pre-line">{{ $offer->education_requirements }}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Skill Requirements</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($offer->skill_requirements as $skill)
                        <li class="list-group-item">{{ $skill->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Language Requirements</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($offer->language_requirements as $language)
                        <li class="list-group-item">{{ $language->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Starting salary</h6>
                    </div>
                    <div class="card-body">
                        <div style="white-space: pre-line">{{ $offer->starting_salary }}</div>
                    </div>
                </div>
            </div>
            
        </div>
</div>


@endsection