
@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="breadcrumb-item active"><a href="{{ route('company.show', ['company'=> Auth::user()->company->id]) }}">{{ Auth::user()->company->name }}</a></li>
@if(isset($offer))
    <li class="breadcrumb-item active"><a href="#">@lang('labels.editing_offer')</a></li>
@else
    <li class="breadcrumb-item active"><a href="#">@lang('labels.new_offer')</a></li>
@endif
@endsection

@section('corpo')
@if(isset($offer))
    <form name="offer" method="post" action="{{ route('offer.update', ['offer' => $offer->id]) }}">
@else
    <form name="offer" method="post" action="{{ route('offer.store') }}">
@endif
@csrf
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-info-image-holder">
                                <img class="card-img-top" src="{{ asset('storage/img/company_profile/'.Auth::user()->company->image) }}">
                            </div>
                            <h6 class="card-title text-center">{{ Auth::user()->company->name }}</h6>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-7">   

                    <div class="card company-name-card text-center">
                        <div class="card-body">
                            @if(isset($offer))
                                <input class="form-control" type="text" id="title" name="title" required placeholder="Role title" value="{{ $offer->title }}">
                            @else
                                <input class="form-control" type="text" id="title" name="title" required placeholder="Role title" value="">
                            @endif
                        </div>
                    </div>
                    <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">@lang('labels.location')</h6>
                            </div>
                            <div class="card-body">
                                @if(isset($offer))
                                    <textarea class="form-control" style="resize:none;" id="location" name="location" rows="4" placeholder="Location" required>{{ $offer->location }}</textarea>
                                @else
                                    <textarea class="form-control" style="resize:none;" id="location" name="location" rows="4" placeholder="Location" required></textarea>
                                @endif
                            </div>
                    </div>
                    
                </div>

                <div class="col-12 col-sm-2">
                    <input id="mySubmit" type="submit" class="btn btn-contact mb-2" value="Save"/>
                    <a class="btn btn-contact" href="{{ route('company.show',['company'=>Auth::user()->company->id]) }}">
                        @lang('labels.cancel')
                    </a>
                </div>
            </div>
        </div>

        <div class="container top-buffer">
            <div class="row row-cols-1 g-3 mb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">@lang('labels.job_descriprion')</h6>
                        </div>
                        <div class="card-body">
                            @if(isset($offer))
                                <textarea class="form-control" style="resize:none;" id="description" name="description" rows="10" placeholder="These are the main tasks, duties and responsabilities" required>{{ $offer->description }}</textarea>
                            @else
                                <textarea class="form-control" style="resize:none;" id="description" name="description" rows="10" placeholder="These are the main tasks, duties and responsabilities" required></textarea>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">@lang('labels.education_requirements')</h6>
                        </div>
                        <div class="card-body">
                            @if(isset($offer))
                                <textarea class="form-control" style="resize:none;" id="edu_requirements" name="edu_requirements" rows="5" placeholder="These are the education requirements">{{ $offer->education_requirements }}</textarea>
                            @else
                                <textarea class="form-control" style="resize:none;" id="edu_requirements" name="edu_requirements" rows="5" placeholder="These are the education requirements"></textarea>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">@lang('labels.skill_requirements')</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <div id="skill_requirement_fields">
                                @if(isset($offer))
                                    @foreach($offer->skill_requirements as $sr)
                                        <li class="list-group-item" id="skill_requirement_field">
                                                <div class="row my-auto">
                                                    <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                        <input class="form-control" type="text" id="skill_requirement" name="skill_requirement[]" placeholder="Skill requirement..." value="{{ $sr->name }}">
                                                    </div> 
                                                    <div class="col-12 col-sm-4 col-md-3 my-auto">
                                                        <a class="btn btn-delete-field" onclick="addDeleteFieldEffect(this)">
                                                            <i class="bi bi-trash-fill"></i> 
                                                        </a>
                                                    </div>
                                                </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item" id="skill_requirement_field">
                                        <div class="row my-auto">
                                            <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                <input class="form-control" type="text" id="skill_requirement" name="skill_requirement[]" placeholder="Skill requirement...">
                                            </div> 
                                            <div class="col-12 col-sm-4 col-md-3 my-auto">
                                                <a class="btn btn-delete-field" onclick="addDeleteFieldEffect(this)">
                                                    <i class="bi bi-trash-fill"></i> 
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </div>
                            <li class="list-group-item center-text">
                                <a class="btn btn-add" onclick="addSkillRequirementField()">
                                    @lang('labels.add')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">@lang('labels.language_requirements')</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <div id="language_requirement_fields">
                                @if(isset($offer))
                                    @foreach($offer->language_requirements as $lr)
                                        <li class="list-group-item" id="language_requirement_field">
                                                <div class="row my-auto">
                                                    <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                        <input class="form-control" type="text" id="language_requirement" name="language_requirement[]" placeholder="Language requirement..." value="{{ $lr->name }}">
                                                    </div> 
                                                    <div class="col-12 col-sm-4 col-md-3 my-auto">
                                                        <a class="btn btn-delete-field" onclick="addDeleteFieldEffect(this)">
                                                            <i class="bi bi-trash-fill"></i> 
                                                        </a>
                                                    </div>
                                                </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item" id="language_requirement_field">
                                        <div class="row my-auto">
                                            <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                <input class="form-control" type="text" id="language_requirement" name="language_requirement[]" placeholder="Language requirement...">
                                            </div> 
                                            <div class="col-12 col-sm-4 col-md-3 my-auto">
                                                <a class="btn btn-delete-field" onclick="addDeleteFieldEffect(this)">
                                                    <i class="bi bi-trash-fill"></i> 
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </div>
                            <li class="list-group-item center-text">
                                <a class="btn btn-add" onclick="addLanguageRequirementField()">
                                    @lang('labels.add')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">@lang('labels.starting_salary')</h6>
                        </div>
                        <div class="card-body">
                            @if(isset($offer))
                                <input type="text" class="form-control" id="starting_salary" name="starting_salary" placeholder="Starting salary (optional)" value="{{ $offer->starting_salary }}">
                            @else
                                <input type="text" class="form-control" id="starting_salary" name="starting_salary" placeholder="Starting salary (optional)">
                            @endif
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </form>


@endsection