@extends('layouts.master')
@section('stile','style.css')


@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">Companies</a></li>
<li class="nav-item active"><a class="nav-link" href="{{ route('worker.index') }}">Professionals</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('worker.index') }}">Professionals</a></li>
<li class="breadcrumb-item active"><a href="#">{{ $worker->name }} {{ $worker->surname }}</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row g-4">

        <div class="col-12 col-sm-3">
            <div class="card">
                <div class="my-auto">
                    <div class="basic-info-image-holder">
                        <img class="card-img-top" src="{{ asset('storage/img/worker_profile/'.$worker->image) }}">
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
                        <p>{{ $worker->name }}</p>
                        <p>{{ $worker->surname }}</p>
                        <p id="birth_date"></p>
                        <p>{{ $worker->nationality }}</p>
                        <p>{{ $worker->main_profession }}</p>
                    </div>
                </div> 
            </div>
        </div>

        <div class="col-12 col-sm-2">
            @if(!isset(Auth::user()->worker) OR Auth::user()->worker->id !== $worker->id)
                <a class="btn btn-contact mb-2" href="{{ route('worker.contact', ['worker'=>$worker->id]) }}">
                    Contact
                </a>
            @else
                <a class="btn btn-contact" href="{{ route('worker.edit', ['worker'=>$worker->id]) }}">
                    Edit
                </a>
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
                                @if(count($worker->educations) > 0)
                                    @foreach($worker->educations as $education)
                                        <li class="list-group-item">{{ $education->name }}</li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">This professional hasn't added any education entry</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Former Jobs</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if(count($worker->former_jobs) > 0)
                                    @foreach($worker->former_jobs as $job)
                                        <li class="list-group-item">{{ $job->name }}</li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">This professional hasn't added any former job entry</li>
                                @endif
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
                                @if(count($worker->skills) > 0)
                                    @foreach($worker->skills as $skill)
                                        <li class="list-group-item">{{ $skill->name }}</li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">This professional hasn't added any skill entry</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Languages</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if(count($worker->languages) > 0)
                                    @foreach($worker->languages as $language)
                                        <li class="list-group-item">{{ $language->name }}</li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">This professional hasn't added any language entry</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>


</div>
</div>

<script>
let birth_date = @json($worker->date_of_birth);
let age = computeAge(birth_date);
document.getElementById('birth_date').innerHTML = age;
</script>
@endsection