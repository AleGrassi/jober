@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">Companies</a></li>
<li class="nav-item active"><a class="nav-link" href="{{ route('worker.index') }}">Professionals</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('company.index') }}">Companies</a></li>
<li class="breadcrumb-item active"><a href="#">{{ $company->name }}</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row g-4">

        <div class="col-12 col-sm-3">
            <div class="card company-info-card">
                <div class="my-auto">
                    <div class="company-info-image-holder">
                        <img class="card-img-top" src="{{ url('/') }}/img/company_profile/{{ $company->image }}">
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
            <div class="card">
                <a class="btn btn-contact">
                    <p>Contact</p>
                </a>
            </div>  
            <div class="card">
                <a class="btn btn-contact" href="{{ route('company.edit', ['company' => $company->id]) }}">
                    <p>Edit</p>
                </a>
            </div>  
        </div>    
    </div>
</div>

<div class="container top-buffer">
        <div class="row row-cols-1">
            <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Locations</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($company->locations as $location)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">{{ $location->name }}</div>
                                        <div class="col">{{ $location->email }}</div>
                                        <div class="col">{{ $location->phone }}</div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
            </div>
        </div>


</div>


<br>
<div class="container top-buffer">
    <div class="row row-cols-1 g-4">
        <h1>Offers:</h1>
    </div>

    <div class="row row-cols-1 g-4">
        <div class="col">
            <div class="row row-cols-4">
                <div class="col"></div>
                <div class="col text-center">
                    <h4>Company</h4>
                </div>
                <div class="col text-center">
                    <h4>Role</h4>
                </div>
                <div class="col text-center">
                    <h4>Location</h4>
                </div>
            </div> 
        </div>

        @foreach($company_offers as $offer)        
        <div class="col">
            <a class="card-link" href="{{ route('offer.show',['offer'=> $offer->id]) }}">
                <div class="card card-responsive">
                    <div class="row row-cols-4">
                        <div class="col my-auto">
                            <div class="logo-img-holder">
                                <img class="card-img-top" src="{{ url('/') }}/img/company_profile/{{ $offer->company->image }}">
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



    </div>
</div>
@endsection