@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('companies') }}">Companies</a></li>
<li class="nav-item active"><a class="nav-link" href="{{ route('workers') }}">Professionals</a></li>
@endsection


@section('right_navbar')
<li class="nav-item">
    <a class="nav-link">Login</a>
</li>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active"><a href="#">login</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row g-4">

        <div class="col-12 col-sm-3">
            <div class="card basic-info-card">
                <div class="my-auto">
                    <div class="basic-info-image-holder">
                        <img class="card-img-top" src="{{ url('/') }}/img/profile_img/1.jpeg">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-7 basic-info-card">
            <div class="card basic-info-card">
                <div class="row row-cols-2">
                    <div class="col padded-text">
                        <p>Name:</p>
                        <p>Surname:</p>
                        <p>Age:</p>
                        <p>Nationality:</p>
                        <p>Main profession:</p>
                    </div>
                    <div class="col padded-text">
                        <p>Alessandra</p>
                        <p>Barbarossa</p>
                        <p>30</p>
                        <p>Italian</p>
                        <p>Segretaria</p>
                    </div>
                </div> 
            </div>
        </div>

        <div class="col-12 col-sm-2">
            <div>
                <a class="btn btn-contact">
                    <p>Contact</p>
                </a>
            </div>      
        </div>    
    </div>
</div>

<div class="container top-buffer">
        <div class="row row-cols-1 row-cols-sm-2">

            <div class="container">
                <div class="row row-cols-1 g-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Education</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Liceo Classico Arnaldo Brescia</li>
                                <li class="list-group-item">Universita' degli studi di Verona, Lettere</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Former Jobs</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Lavoro 1</li>
                                <li class="list-group-item">Lavoro 2</li>
                                <li class="list-group-item">Lavoro 3</li>
                                <li class="list-group-item">Lavoro 4</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="container">
                <div class="row row-cols-1 g-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Skills</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Leggere</li>
                                <li class="list-group-item">Scrivere</li>
                                <li class="list-group-item">Pensare</li>
                                <li class="list-group-item">Indagare</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Languages</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Italiano</li>
                                <li class="list-group-item">Inglese</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>


</div>


</div>
@endsection