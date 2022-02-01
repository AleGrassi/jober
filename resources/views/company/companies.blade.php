@extends('layouts.master')

@section('titolo','Companies')

@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">Companies</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">Professionals</a></li>
<!-- <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Professionisti<b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li><a href="">Books List</a></li>
        <li><a href="">Authors List</a></li>
    </ul>
</li> -->
@endsection


@section('breadcrumb')
<li class="breadcrumb-item active ms-auto"><a href="#">Companies</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4">

        @foreach($companies as $company)
        <a class="card-link" href="{{ route('company.show', ['company' => $company->id]) }}">
            <div class="col">
                <div class="card card-responsive">
                    <div class="image-holder">
                        <img class="card-img-top" src="{{ url('/') }}/img/company_profile/{{ $company->image }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $company->name }}</h5>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        
<!-- 
        <div class="col">
            <div class="card card-responsive">
                <div class="image-holder">
                    <img class="card-img-top" src="{{ url('/') }}/img/intel.png">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Tesla Motors</h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-responsive">
                <div class="image-holder">
                    <img class="card-img-top" src="{{ url('/') }}/img/ibm.png">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Tesla Motors</h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-responsive">
                <div class="image-holder">
                    <img class="card-img-top" src="{{ url('/') }}/img/ibm.png">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Tesla Motors</h5>
                </div>
            </div>
        </div>
-->
    </div>
    
</div>
@endsection