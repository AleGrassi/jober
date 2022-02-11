
@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
<li class="breadcrumb-item active"><a href="#">@lang('labels.companys_offer',['company'=>$offer->company->name])</a></li>
@endsection

@section('corpo')
<div class="container">
    <row class="g-4">
        <div class="card card-reponsive popup-message mb-3 alert alert-danger text-center" id="msg_error">
            <strong id="msg_error_text"></strong>
        </div>
        <div class="card card-reponsive popup-message mb-3 alert alert-success text-center" id="msg_success">
            <strong id="msg_success_text"></strong>
        </div>
    </row>
    <div class="row g-4">

        <div class="col-12 col-sm-3">
            <a  class="card-link" href="{{ route('company.show', ['company'=> $offer->company->id]) }}">
                <div class="card card-responsive">
                    <div class="image-holder">
                        <img class="card-img-top" src="{{ asset('storage/img/company_profile/'.$offer->company->image) }}">
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
                        <h6 class="card-title">@lang('labels.location')</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $offer->location }}</p>
                    </div>
            </div>
            
        </div>

        <div class="col-12 col-sm-2">
            @if(isset(Auth::user()->company) AND Auth::user()->company->id == $offer->company->id)
                <a class="btn btn-contact" href="{{ route('offer.edit', ['offer'=> $offer->id]) }}">
                    @lang('labels.edit')
                </a>
            @elseif(!isset(Auth::user()->company))
                @if(isset(Auth::user()->worker))
                    @if(Auth::user()->worker->isApplied($offer->id))
                        <button id="candidate_btn" class="btn btn-contact mb-2" onclick="event.preventDefault(); removeApplication({{ $offer->id }}, {{ Auth::user()->worker->id }});">
                            @lang('labels.uncandidate')
                        </button>
                    @else
                        <button id="candidate_btn" class="btn btn-contact mb-2" onclick="event.preventDefault(); candidate({{ $offer->id }}, {{ Auth::user()->worker->id }});">
                            @lang('labels.candidate')
                        </button>
                    @endif
                @else
                    <a class="btn btn-contact mb-2" href="{{ route('login') }}">
                        @lang('labels.candidate')
                    </a>
                @endif
            @endif
        </div>    
    </div>
</div>

<div class="container top-buffer mb-4">
        <div class="row row-cols-1 g-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">@lang('labels.job_descriprion')</h6>
                    </div>
                    <div class="card-body">
                        <div style="white-space: pre-line">{{ $offer->description }}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">@lang('labels.education_requirements')</h6>
                    </div>
                    @if(empty($offer->education_requirements))
                        <div class="card-body">
                            <div style="white-space: pre-line">@lang('labels.no_education_requirements')</div>
                        </div>
                    @else
                        <div class="card-body">
                            <div style="white-space: pre-line">{{ $offer->education_requirements }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">@lang('labels.skill_requirements')</h6>
                    </div>
                    @if(count($offer->skill_requirements) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($offer->skill_requirements as $skill)
                            <li class="list-group-item">{{ $skill->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <div class="card-body">
                            @lang('labels.no_skill_requirements')
                        </div>
                    @endif
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">@lang('labels.language_requirements')</h6>
                    </div>
                    @if(count($offer->language_requirements) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($offer->language_requirements as $language)
                            <li class="list-group-item">{{ $language->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <div class="card-body">
                            @lang('labels.no_language_requirements')
                        </div>
                    @endif
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">@lang('labels.starting_salary')</h6>
                    </div>
                    <div class="card-body">
                        @if(empty($offer->starting_salary))
                            @lang('labels.no_starting_salary')
                        @else
                            <div style="white-space: pre-line">{{ $offer->starting_salary }}</div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
</div>

@if((Auth::user() !== null))
    @if(isset(Auth::user()->company) AND Auth::user()->company->id == $offer->company->id)
        <div class="container top-buffer mb-4">
            <div class="row">
                <div class="col-12">
                    <h1>Candidates:</h1>
                </div>
                <div class="col-12">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-3"></div>
                            <div class="col-3 text-center">
                                <h4>@lang('labels.name')</h4>
                            </div>
                            <div class="col-3 text-center">
                                <h4>@lang('labels.main_profession')</h4>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </div>
                </div>


                @if(count($offer->candidates) > 0)
                    @foreach($offer->candidates as $candidate)
                        @if($candidate->pivot->status == 'pending')
                            <div class="col-12 my-auto mb-2">
                                <a class="card-link" href="{{ route('worker.show', ['worker'=>$candidate->id]) }}">
                                    <div class="card card-responsive my-auto">
                                        <div class="container">
                                            <div class="row g-4 my-auto">
                                                <div class="col-3 my-auto">
                                                    <div class="logo-img-holder">
                                                        <img class="card-img-top" src="{{ asset('storage/img/worker_profile/'.$candidate->image) }}">
                                                    </div>
                                                </div>
                                                <div class="col-3 text-center my-auto">
                                                    <p class="my-auto">{{ $candidate->name }}</p>
                                                </div>
                                                <div class="col-3 my-auto text-center">
                                                    <p class="my-auto">{{ $candidate->main_profession }}</p>
                                                </div>
                                                <div class="col-3 g-4 my-auto text-center">
                                                    <form method="get" action="{{ route('offer.reject', ['offer'=>$offer->id, 'worker'=>$candidate->id]) }}">
                                                        <button type="submit" class="btn btn-sm btn-contact d-block mb-2 mt-2">@lang('labels.reject')</button>
                                                    </form>
                                                    <form method="get" action="{{ route('worker.contact', ['worker'=>$candidate->id]) }}">
                                                        <button type="submit" class="btn btn-sm btn-contact d-block mb-2">@lang('labels.contact')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @foreach($offer->candidates as $candidate)
                        @if($candidate->pivot->status == 'rejected')
                            <div class="col-12 my-auto mb-2">
                                <a class="card-link" href="{{ route('worker.show', ['worker'=>$candidate->id]) }}">
                                    <div class="card border-danger border-2 card-responsive my-auto">
                                        <div class="container">
                                            <div class="row g-4 my-auto">
                                                <div class="col-3 my-auto">
                                                    <div class="logo-img-holder">
                                                        <img class="card-img-top" src="{{ asset('storage/img/worker_profile/'.$candidate->image) }}">
                                                    </div>
                                                </div>
                                                <div class="col-3 text-center my-auto">
                                                    <p class="my-auto">{{ $candidate->name }}</p>
                                                </div>
                                                <div class="col-3 my-auto text-center">
                                                    <p class="my-auto">{{ $candidate->main_profession }}</p>
                                                </div>
                                                <div class="col-3 g-4 my-auto text-center">
                                                    <form method="get" action="{{ route('offer.reconsider', ['offer'=>$offer->id, 'worker'=>$candidate->id]) }}">
                                                        <button type="submit" class="btn btn-sm btn-contact d-block mb-2 mt-2">@lang('labels.reconsider')</button>
                                                    </form>
                                                    <form method="get" action="{{ route('worker.contact', ['worker'=>$candidate->id]) }}">
                                                        <button type="submit" class="btn btn-sm btn-contact d-block mb-2">@lang('labels.contact')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                @lang('labels.no_candidates')
                            </div>
                        </div>
                    </div>
                @endif



            </div>

        </div>
    @endif
@endif

@endsection