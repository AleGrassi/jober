@extends('layouts.master')

@section('titolo','Jober | '.trans('labels.companies'))
@section('intestazione',trans('labels.companies'))

@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link active" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item active ms-auto"><a href="#">@lang('labels.companies')</a></li>
@endsection

@section('corpo')
<div class="container">
    <form method="get" action="{{ route('company.filter') }}">
        <div class="row g-2 mb-4 d-flex">
            <div class="col-12 col-sm-8 col-md-3">
                @if(isset($name_filter))
                    <input type="text" class="form-control" id="name" name="name" value="{{ $name_filter }}">
                @else
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('labels.name') }}">
                @endif
            </div>
            <div class="col-12 col-sm-4 col-md-2">
                <button class="btn btn-contact" type="submit">@lang('labels.filter')</button>
            </div>
            <div class="col-0 col-md-4"></div>
            <div class="col-8 col-sm-8 col-md-1 col-lg-2 text-end">
                <label class="text-end col-form-label" for="elem_num">@lang('labels.view')</label>
            </div>
            <div class="col-4 col-sm-4 col-md-2 col-lg-1 text-end">
                <select class="form-select" name="elem_num" onchange="if (this.value) paginate(document.getElementById('companies'),this.value,5);">
                    <option value="4">4</option>
                    <option value="10">10</option> 
                    <option value="15">15</option>
                    <option value="20" selected>20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </form>
    <div id="companies" class="row g-4">
        @if(count($companies) > 0)
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
        @else
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @lang('labels.no_companies_with_filter')
                    </div>
                </div>
            </div>
        @endif
    </div>
    <nav id="pagination-nav" class="d-flex justify-content-center align-items-center mt-5"></nav>
</div>
<script>
    paginate(document.getElementById('companies'), 20,5);
</script>
@endsection