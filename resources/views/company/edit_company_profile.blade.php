@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">Companies</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">Professionals</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
@endsection


@section('breadcrumb')
    @if(isset($company))
        <li class="breadcrumb-item ms-auto"><a href="{{ route('company.index') }}">Companies</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('company.show', ['company'=>$company->id]) }}">{{ $company->name }}</a></li>
        <li class="breadcrumb-item active"><a href="#">Edit</a></li>
    @else
        <li class="breadcrumb-item ms-auto"><a href="#">Registration</a></li>
    @endif
@endsection

@section('corpo')
@if(isset($company->id))
    <form name="company" method="post" action="{{ route('company.update', ['company' => $company->id]) }}" enctype="multipart/form-data">
@else
    <form name="company" method="post" action="{{ route('company.store') }}" enctype="multipart/form-data"> 
@endif
@csrf
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-sm-3">
                    <div class="card card-responsive">
                        <div class="my-auto">
                            <div class="basic-info-image-holder">
                                <label for="profile_image">
                                    @if(isset($company))
                                        <img id="image" class="card-img-top my-auto" src="{{ asset('storage/img/company_profile/'.$company->image) }}">
                                    @else
                                        <img id="image" class="card-img-top my-auto" src="{{ asset('storage/img/company_profile/company_profile_tmp.jpeg') }}">
                                    @endif
                                    <input type="file" name="profile_image" id="profile_image" style="display:none;" accept="image/*" onchange="showImage(this)"/>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-7">   

                    <div class="card company-name-card p-3 text-center">
                        <input id="name" type="text" class="form-control" name="name" placeholder="Company name..." value="{{ Auth::user()->name }}" required autofocus>
                    </div>
                    <div class="card company-contacts-card p-3 scroll">
                        @if(isset($company))
                            <textarea id="description" style="height:100%; resize:none;" class="form-control" name="description" placeholder="Company description..." required autofocus>{{ $company->description }}</textarea>
                        @else
                            <textarea id="description" style="height:100%; resize:none;" class="form-control" name="description" placeholder="Company description..." required autofocus></textarea>
                        @endif
                    </div>
                    
                </div>

                <div class="col-12 col-sm-2">
                    <input id="mySubmit" type="submit" class="btn btn-contact mb-2" value="Save"/>
                    @if(isset($company))
                        <a class="btn btn-contact" href="{{ route('company.show',['company'=> $company->id]) }}">
                            Cancel
                        </a>
                    @else
                        <!-- da gestire -->
                    @endif
                </div>    
            </div>
        </div>

        <div class="container top-buffer mb-4">
            <div class="row row-cols-1">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Locations</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <div id="location_fields">
                                @if(isset($company))
                                    @foreach($company->locations as $location)
                                        <li class="list-group-item" id="location_field">
                                                <div class="row my-auto">
                                                    <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                        <input class="form-control mb-2" type="text" id="location_name" name="location_name[]" placeholder="Location..." value="{{ $location->name }}">
                                                        <input class="form-control mb-2" type="email" id="location_email" name="location_email[]" placeholder="Location email..." value="{{ $location->email }}">
                                                        <input class="form-control mb-2 mb-sm-0" type="text" id="location_phone" name="location_phone[]" placeholder="Location phone number..." value="{{ $location->phone }}">
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
                                    <li class="list-group-item" id="location_field">
                                            <div class="row my-auto">
                                                <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                    <input class="form-control mb-2" type="text" id="location_name" name="location_name[]" placeholder="Location..." value="">
                                                    <input class="form-control mb-2" type="email" id="location_email" name="location_email[]" placeholder="Location email..." value="">
                                                    <input class="form-control mb-2 mb-sm-0" type="text" id="location_phone" name="location_phone[]" placeholder="Location phone number..." value="">
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
                                <a class="btn btn-add" onclick="addLocationField()">
                                    Add
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection