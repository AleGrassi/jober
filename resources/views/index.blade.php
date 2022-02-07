@extends('layouts.master')

@section('titolo',trans('labels.latest_offers'))

@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item active ms-auto"><a href="#">@lang('labels.offers')</a></li>
@endsection

@section('corpo')
<div class="container">
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

        @foreach($offers as $offer)
        <div class="col">
            <a class="card-link" href="{{ route('offer.show', ['offer' => $offer->id]) }}">
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

        
    </div>
</div>
@endsection