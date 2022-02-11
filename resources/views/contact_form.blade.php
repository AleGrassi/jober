@extends('layouts.master')
@section('stile','style.css')
@if(isset($worker))
    @section('titolo',trans('labels.contact').' '.$worker->name.' '.$worker->surname)
@elseif(isset($company))
    @section('titolo',trans('labels.contact').' '.$company->name)
@endif
@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
@endsection


@section('breadcrumb')
    @if(isset($company))
        <li class="breadcrumb-item ms-auto"><a href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('company.show', ['company'=>$company->id]) }}">{{ $company->name }}</a></li>
        <li class="breadcrumb-item active"><a href="#">@lang('labels.contact')</a></li>
    @elseif(isset($worker))
        <li class="breadcrumb-item ms-auto"><a href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('worker.show', ['worker'=>$worker->id]) }}">{{ $worker->name }} {{ $worker->surname }}</a></li>
        <li class="breadcrumb-item active"><a href="#">@lang('labels.contact')</a></li>
    @endif
@endsection

@section('corpo')
@if(Auth::user() !== null) <!-- qualcuno sta inviando un messagggio -->
    @if(isset($worker)) <!-- qualcuno sta inviando un messaggio a un altro worker -->
        <form name="message_form" method="post" action="{{ route('worker.contact',['worker'=>$worker->id]) }}" enctype="multipart/form-data">
    @elseif(isset($company)) <!-- qualcuno sta inviando un messaggio ad una company -->
        <form name="message_form" method="post" action="{{ route('company.contact',['company'=>$company->id]) }}" enctype="multipart/form-data">
    @endif
@endif
@csrf
            <div class="container">
                <div class="row g-3">
                    <div class="col-12">
                        <input id="subject" name="subject" type="text" class="form-control" required placeholder="{{ trans('labels.subject') }}">
                    </div>
                    <div class="col-12">
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" required placeholder="{{ trans('labels.message') }}"></textarea>
                    </div>
                    <div class="col-0 col-sm-8 col-md-10"></div>
                    <div class="col-12 col-sm-4 col-md-2">
                        <button type="submit" class="btn btn-contact">@lang('labels.send')</button>
                    </div>
                </div>
            </div>
        </form>
@endsection