@extends('layouts.master')
@section('stile','style.css')
@section('titolo','Jober | '.$company->name)

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="breadcrumb-item active"><a href="#">{{ $company->name }}</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row g-3">
        @if(isset($message))
        <div class="col">
            <div class="card card-reponsive mb-3 alert alert-success text-center" id="msg_success">
                <strong id="msg_success_text">{{ $message }}</strong>
            </div>
        </div>
        @elseif(isset($error))
        <div class="col">
            <div class="card card-reponsive mb-3 alert alert-danger text-center" id="msg_error">
                <strong id="msg_error_text">{{ $error }}</strong>
            </div>
        </div>
        @endif
    </div>
    <div class="row g-4">
        <div class="col-12 col-sm-3">
            <div class="card">
                <div class="my-auto">
                    <div class="basic-info-image-holder">
                        <img class="card-img-top" src="{{ asset('storage/img/company_profile/'.$company->image) }}">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-7">   

            <div class="card company-name-card text-center">
                <h1>{{ $company->name }}</h1>
            </div>
            <div class="card company-contacts-card p-3 scroll">
                <p>{{ $company->description }}</p>
            </div>
            
        </div>

        <div class="col-12 col-sm-2">
            @if(!isset(Auth::user()->company) OR Auth::user()->company->id !== $company->id)
                <a class="btn btn-contact mb-2" href="{{ route('company.contact.form',['company'=>$company->id]) }}">
                    @lang('labels.contact')
                </a>
            @else
                <a class="btn btn-contact mb-2" href="{{ route('company.edit', ['company'=>$company->id]) }}">
                    @lang('labels.edit')
                </a>
                <a class="btn btn-contact" href="{{ route('offer.create') }}">
                    @lang('labels.add_offer')
                </a>
            @endif
        </div>        
    </div>
</div>

<div class="container top-buffer">
        <div class="row row-cols-1">
            <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">@lang('labels.locations')</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if(count($company->locations) > 0)
                                    @foreach($company->locations as $location)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col">{{ $location->name }}</div>
                                            <div class="col">{{ $location->email }}</div>
                                            <div class="col">{{ $location->phone }}</div>
                                        </div>
                                    </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">
                                        @lang('labels.no_locations', ['company'=>$company->name])
                                    </li>
                                @endif
                            </ul>
                        </div>
            </div>
        </div>


</div>


<br>
<div class="container top-buffer mb-4">
    <div class="row row-cols-1 g-4">
        <h1>@lang('labels.offers'):</h1>
    </div>

    <div class="row row-cols-1 g-4">
        <div class="col">
            <div class="row row-cols-4">
                <div class="col"></div>
                <div class="col text-center">
                    <h4>@lang('labels.company')</h4>
                </div>
                <div class="col text-center">
                    <h4>@lang('labels.role')</h4>
                </div>
                <div class="col text-center">
                    <h4>@lang('labels.location')</h4>
                </div>
            </div> 
        </div>

        @if(count($company->offers) > 0)
            @foreach($company->offers as $offer)        
            <div class="col">
                <a class="card-link" href="{{ route('offer.show',['offer'=> $offer->id]) }}">
                    <div class="card card-responsive">
                        <div class="row row-cols-4">
                            <div class="col my-auto">
                                <div class="logo-img-holder">
                                    <img class="card-img-top" src="{{ asset('storage/img/company_profile/'.$offer->company->image) }}">
                                </div>
                            </div>
                            <div class="col text-center my-auto">
                                <p class="my-auto">{{ $offer->company->name }}</p>
                            </div>
                            <div class="col my-auto text-center">
                                <p class="my-auto">{{ $offer->title }}</p>
                            </div>
                            <div class="col my-auto text-center">
                                <p class="my-auto">{{ $offer->location }}</p>
                            </div>
                        </div> 
                    </div>
                </a>
            </div>
            @endforeach
        @else
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @lang('labels.no_offers')
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection