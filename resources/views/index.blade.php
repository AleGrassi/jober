@extends('layouts.master')

@section('titolo','Jober | '.trans('labels.latest_offers'))
@section('intestazione',trans('labels.latest_offers'))

@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
<li class="nav-item"><a class="nav-link active" href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item active ms-auto"><a href="#">@lang('labels.offers')</a></li>
@endsection

@section('corpo')
<div class="container">
    <form method="get" action="{{ route('offer.filter') }}">
        <div class="row row-cols-4 mb-4">
            <div class="col">
                <button class="btn btn-contact">@lang('labels.filter')</button>
            </div>
            <div class="col text-center">
                @if(isset($company_filter))
                    <input id="company_filter" name="company_filter" type="text" class="form-control px-3 text-center" value="{{ $company_filter }}">
                @else
                    <input id="company_filter" name="company_filter" type="text" class="form-control px-3 text-center" placeholder="{{ trans('labels.company') }}">
                @endif
            </div>
            <div class="col text-center">
                @if(isset($role_filter))
                    <input id="role_filter" name="role_filter" type="text" class="form-control text-center" value="{{ $role_filter }}">
                @else
                    <input id="role_filter" name="role_filter" type="text" class="form-control text-center" placeholder="{{ trans('labels.role') }}">
                @endif
            </div>
            <div class="col text-center">
                @if(isset($location_filter))
                    <input id="location_filter" name="location_filter" type="text" class="form-control text-center" value="{{ $location_filter }}">
                @else
                    <input id="location_filter" name="location_filter" type="text" class="form-control text-center" placeholder="{{ trans('labels.location') }}">
                @endif
            </div>
        </div> 
    </form>
    <div class="row row-cols-1 g-4 mb-3">
        <div class="col">
            <div class="row">
                <div class="col-1 col-lg-2 text-end">
                    <label class="text-end col-form-label" for="elem_num">@lang('labels.view')</label>
                </div>
                <div class="col-2 col-lg-1 text-end">
                    <select class="form-select text-center" name="elem_num" onchange="if (this.value) paginate(document.getElementById('offers'),this.value,5);">
                        <option value="4">4</option>
                        <option value="10" selected>10</option> 
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-3 text-center">
                    <h4>@lang('labels.company')</h4>
                </div>
                <div class="col-3 text-center">
                    <h4>@lang('labels.role')</h4>
                </div>
                <div class="col-3 text-center">
                    <h4>@lang('labels.location')</h4>
                </div>
            </div> 
        </div>
    </div>

    <div id="offers" class="row row-cols-1 g-4">
        @if(count($offers) > 0)
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
        @else
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @lang('labels.no_offers_with_filter')
                    </div>
                </div>
            </div>
        @endif
    </div>
    <nav id="pagination-nav" class="d-flex justify-content-center align-items-center mt-5"></nav>
</div>
<script>
    paginate(document.getElementById('offers'), 10,5);
</script>
@endsection