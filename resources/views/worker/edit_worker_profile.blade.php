
@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">Companies</a></li>
<li class="nav-item active"><a class="nav-link" href="{{ route('worker.index') }}">Professionals</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('worker.index') }}">Professionals</a></li>
<li class="breadcrumb-item active"><a href="#">worker-name</a></li>
@endsection

@section('corpo')
@if(isset($worker->id))
    <form name="worker" method="post" action="{{ route('worker.update', ['id' => $worker->id]) }}">
@else
    <form name="worker" method="post" action="{{ route('worker.store') }}">
@endif
@csrf
        <div class="container">
            <div class="row g-4 table-like">
                

                <div class="col-12 col-sm-3">
                    <div class="card">
                        <div class="my-auto">
                            <div class="basic-info-image-holder">
                                <img class="card-img-top" src="{{ url('/') }}/img/worker_profile/worker_profile_tmp.png">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row mb-2">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Name:</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $user_name }}" required autofocus>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="surname" class="col-md-4 col-form-label text-md-end">Surname:</label>
                                    <div class="col-md-6">
                                        <input id="surname" type="text" class="form-control" name="surname" value="" required autofocus>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="age" class="col-md-4 col-form-label text-md-end">age:</label>
                                    <div class="col-md-6">
                                        <input id="age" type="date" class="form-control" name="date_of_birth" value="" required autofocus>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nationality" class="col-md-4 col-form-label text-md-end">nationality:</label>
                                    <div class="col-md-6">
                                        <input id="nationality" type="text" class="form-control" name="nationality" value="" required autofocus>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="main_profession" class="col-md-4 col-form-label text-md-end">Main Profession:</label>
                                    <div class="col-md-6">
                                        <input id="main_profession" type="text" class="form-control" name="main_profession" value="" required autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-12 col-sm-2">
                    <button class="btn btn-contact mb-2">
                        Contact
                    </button>
                    <input id="mySubmit" type="submit" class="btn btn-contact" value="Save"/>
                </div>    
            </div>
        </div>


        <div class="container top-buffer">
                <div class="row row-cols-1 row-cols-sm-2 mb-4">

                    <div class="container mb-4">
                        <div class="row row-cols-1 g-4">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Education</h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <div id="education_fields">
                                            <li class="list-group-item" id="education_field">
                                                    <div class="row my-auto">
                                                        <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                            <input class="form-control" type="text" id="education" name="education[]" placeholder="School or university..." value="">
                                                        </div> 
                                                        <div class="col-12 col-sm-4 col-md-3 my-auto">
                                                            <a class="btn btn-delete-field" onclick="addDeleteFieldEffect(this)">
                                                                <i class="bi bi-trash-fill"></i> 
                                                            </a>
                                                        </div>
                                                    </div>
                                            </li>
                                        </div>
                                        <li class="list-group-item center-text">
                                            <a class="btn btn-add" onclick="addEducationField()">
                                                Add
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Former jobs</h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                                <div class="row my-auto">
                                                    <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                        <input class="form-control" type="text" id="former_job" name="former_job[]" placeholder="Former Job..." value="">
                                                    </div> 
                                                    <div class="col-12 col-sm-4 col-md-3 my-auto">
                                                        <a class="btn btn-delete-field" onclick="addDeleteFieldEffect(this)">
                                                            <i class="bi bi-trash-fill"></i> 
                                                        </a>
                                                    </div>
                                                </div>
                                        </li>
                                        <div id="former_job_fields"></div>
                                        <li class="list-group-item center-text">
                                            <a class="btn btn-add" onclick="addFormerJobField()">
                                                Add
                                            </a>
                                        </li>
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
                                        <li class="list-group-item">
                                                <div class="row my-auto">
                                                    <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                        <input class="form-control" type="text" id="skill" name="skill[]" placeholder="Skill..." value="">
                                                    </div> 
                                                    <div class="col-12 col-sm-4 col-md-3 my-auto">
                                                        <a class="btn btn-delete-field" onclick="addDeleteFieldEffect(this)">
                                                            <i class="bi bi-trash-fill"></i> 
                                                        </a>
                                                    </div>
                                                </div>
                                        </li>
                                        <div id="skill_fields"></div>
                                        <li class="list-group-item center-text">
                                            <a class="btn btn-add" onclick="addSkillField()">
                                                Add
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Languages</h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                                <div class="row my-auto">
                                                    <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                        <input class="form-control" type="text" id="language" name="language[]" placeholder="Language..." value="">
                                                    </div> 
                                                    <div class="col-12 col-sm-4 col-md-3 my-auto" onclick="addDeleteFieldEffect(this)">
                                                        <a class="btn btn-delete-field">
                                                            <i class="bi bi-trash-fill"></i> 
                                                        </a>
                                                    </div>
                                                </div>
                                        </li>
                                        <div id="language_fields"></div>
                                        <li class="list-group-item center-text">
                                            <a class="btn btn-add" onclick="addLanguageField()">
                                                Add
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

