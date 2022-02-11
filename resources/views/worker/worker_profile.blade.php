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
        <li class="breadcrumb-item active"><a href="#">{{ $worker->name }} {{ $worker->surname }}</a></li>
    @endif
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
                        <img class="card-img-top" src="{{ asset('storage/img/worker_profile/'.$worker->image) }}">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-7 basic-info-card">
            <div class="card basic-info-card">
                <div class="row row-cols-2">
                    <div class="col padded-text">
                        <p>@lang('labels.name'):</p>
                        <p>@lang('labels.surname'):</p>
                        <p>@lang('labels.age'):</p>
                        <p>@lang('labels.nationality'):</p>
                        <p>@lang('labels.main_profession'):</p>
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
                <a class="btn btn-contact mb-2" href="{{ route('worker.contact.form', ['worker'=>$worker->id]) }}">
                    @lang('labels.contact')
                </a>
            @else
                <a class="btn btn-contact" href="{{ route('worker.edit', ['worker'=>$worker->id]) }}">
                    @lang('labels.edit')
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
                                <h5 class="card-title">@lang('labels.education')</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if(count($worker->educations) > 0)
                                    @foreach($worker->educations as $education)
                                        <li class="list-group-item">{{ $education->name }}</li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">@lang('labels.no_education')</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">@lang('labels.former_jobs')</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if(count($worker->former_jobs) > 0)
                                    @foreach($worker->former_jobs as $job)
                                        <li class="list-group-item">{{ $job->name }}</li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">@lang('labels.no_former_jobs')</li>
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
                                <h5 class="card-title">@lang('labels.skills')</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if(count($worker->skills) > 0)
                                    @foreach($worker->skills as $skill)
                                        <li class="list-group-item">{{ $skill->name }}</li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">@lang('labels.no_skills')</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">@lang('labels.languages')</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if(count($worker->languages) > 0)
                                    @foreach($worker->languages as $language)
                                        <li class="list-group-item">{{ $language->name }}</li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">@lang('labels.no_languages')</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>


</div>
</div>
@if(Auth::user() !== null) 
    @if(isset(Auth::user()->worker) AND Auth::user()->worker->id == $worker->id)
        <br>
        <div class="container top-buffer mb-4">
            <div class="row row-cols-1 g-4">
                <h1>@lang('labels.applications'):</h1>
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
                            <h4>@lang('labels.status')</h4>
                        </div>
                    </div> 
                </div>

                @if(count($worker->offers) > 0)
                    @foreach($worker->offers as $offer)        
                        @if($offer->pivot->status == 'pending')
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
                                                <p class="my-auto">{{ $offer->pivot->status }}</p>
                                            </div>
                                        </div> 
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @foreach($worker->offers as $offer)        
                        @if($offer->pivot->status == 'rejected')
                            <div class="col">
                                <a class="card-link" href="{{ route('offer.show',['offer'=> $offer->id]) }}">
                                    <div class="card card-responsive border-danger border-2">
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
                                                <p class="my-auto text-danger">{{ $offer->pivot->status }}</p>
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
                                @lang('labels.no_applications')
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endif
<script>
let birth_date = @json($worker->date_of_birth);
let age = computeAge(birth_date);
document.getElementById('birth_date').innerHTML = age;
</script>
@endsection