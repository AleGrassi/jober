
@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
@endsection


@section('breadcrumb')
    @if(isset($worker))
        <li class="breadcrumb-item ms-auto"><a href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('worker.show', ['worker'=> $worker->id]) }}">{{ $worker->name }} {{ $worker->surname }}</a></li>
        <li class="breadcrumb-item active"><a href="#">@lang('labels.edit')</a></li>
    @else
        <li class="breadcrumb-item ms-auto"><a href="#">@lang('labels.registration')</a></li>
    @endif
@endsection

@section('corpo')
@if(isset($worker->id))
    <form name="worker" method="post" action="{{ route('worker.update', ['worker' => $worker->id]) }}" enctype="multipart/form-data">
@else
    <form name="worker" method="post" action="{{ route('worker.store') }}" enctype="multipart/form-data"> 
@endif
@csrf
        <div class="container">
            <div class="row g-4 table-like">
                
                <div class="col-12 col-sm-3">
                    <div class="card card-responsive">
                        <div class="my-auto">
                            <div class="basic-info-image-holder">
                                <label for="profile_image">
                                    @if(isset($worker))
                                        <img id="image" class="card-img-top" src="{{ asset('storage/img/worker_profile/'.$worker->image) }}">
                                    @else
                                        <img id="image" class="card-img-top" src="{{ asset('storage/img/worker_profile/worker_profile_tmp.png') }}">
                                    @endif
                                    <input type="file" name="profile_image" id="profile_image" style="display:none;" accept="image/*" onchange="showImage(this)"/>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row mb-2">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">@lang('labels.name'):</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="surname" class="col-md-4 col-form-label text-md-end">@lang('labels.surname'):</label>
                                    <div class="col-md-6">
                                        @if(isset($worker))
                                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $worker->surname }}" required autofocus>
                                        @else
                                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="" required autofocus>
                                        @endif
                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="age" class="col-md-4 col-form-label text-md-end">@lang('labels.age'):</label>
                                    <div class="col-md-6">
                                        @if(isset($worker))
                                            <input id="age" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $worker->date_of_birth }}" required autofocus>
                                        @else
                                            <input id="age" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="" required autofocus>
                                        @endif
                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nationality" class="col-md-4 col-form-label text-md-end">@lang('labels.nationality'):</label>
                                    <div class="col-md-6">
                                        @if(isset($worker))
                                            <input id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ $worker->nationality }}" required autofocus>
                                        @else
                                            <input id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="" required autofocus>
                                        @endif
                                        @error('nationality')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="main_profession" class="col-md-4 col-form-label text-md-end">@lang('labels.main_profession'):</label>
                                    <div class="col-md-6">
                                        @if(isset($worker))
                                            <input id="main_profession" type="text" class="form-control @error('main_profession') is-invalid @enderror" name="main_profession" value="{{ $worker->main_profession }}" required autofocus>
                                        @else
                                            <input id="main_profession" type="text" class="form-control @error('main_profession') is-invalid @enderror" name="main_profession" value="" required autofocus>
                                        @endif
                                        @error('main_profession')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-2">
                    <input id="mySubmit" type="submit" class="btn btn-contact mb-2" value="Save"/>
                    @if(isset($worker))
                        <a class="btn btn-contact" href="{{ route('worker.show',['worker'=> $worker->id]) }}">
                            @lang('labels.cancel')
                        </a>
                    @else
                        <!-- Da gestire -->
                    @endif
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
                                            @if(isset($worker))
                                                @foreach($worker->educations as $education)
                                                    <li class="list-group-item" id="education_field">
                                                            <div class="row my-auto">
                                                                <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                                    <input class="form-control" type="text" id="education" name="education[]" placeholder="School or university..." value="{{ $education->name }}">
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
                                            @endif
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
                                        <div id="former_job_fields">
                                            @if(isset($worker))
                                                @foreach($worker->former_jobs as $fj)
                                                    <li class="list-group-item">
                                                            <div class="row my-auto">
                                                                <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                                    <input class="form-control" type="text" id="former_job" name="former_job[]" placeholder="Former Job..." value="{{ $fj->name }}">
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
                                            @endif
                                        </div>
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
                                        <div id="skill_fields">
                                            @if(isset($worker))
                                                @foreach($worker->skills as $skill)
                                                    <li class="list-group-item">
                                                            <div class="row my-auto">
                                                                <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                                    <input class="form-control" type="text" id="skill" name="skill[]" placeholder="Skill..." value="{{ $skill->name }}">
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
                                            @endif
                                        </div>
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
                                        <div id="language_fields">
                                            @if(isset($worker))
                                                @foreach($worker->languages as $language)
                                                    <li class="list-group-item">
                                                            <div class="row my-auto">
                                                                <div class="col-12 col-sm-8 col-md-9 my-auto">
                                                                    <input class="form-control" type="text" id="language" name="language[]" placeholder="Language..." value="{{ $language->name }}">
                                                                </div> 
                                                                <div class="col-12 col-sm-4 col-md-3 my-auto" onclick="addDeleteFieldEffect(this)">
                                                                    <a class="btn btn-delete-field">
                                                                        <i class="bi bi-trash-fill"></i> 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                    </li>
                                                @endforeach
                                            @else
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
                                            @endif
                                        </div>
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

