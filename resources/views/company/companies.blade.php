@extends('layouts.master')

@section('titolo',trans('labels.companies'))

@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item active ms-auto"><a href="#">@lang('labels.companies')</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row g-4">
        @foreach($companies as $company)
        <div class="col-6 col-sm-4 col-md-3">
            <a class="card-link" href="{{ route('company.show', ['company' => $company->id]) }}">
                <div class="col">
                    <div class="card card-responsive">
                        <div class="card-body">
                            <div class="image-holder">
                                <img class="card-img-top" src="{{ asset('storage/img/company_profile/'.$company->image) }}">
                            </div>
                            <h5 class="card-title text-center">{{ $company->name }}</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection