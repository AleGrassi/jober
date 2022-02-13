@extends('layouts.master')

@section('titolo','Jober | '.trans('labels.professionals'))
@section('intestazione',trans('labels.professionals'))

@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item"><a class="nav-link active" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('offer.index') }}">@lang('labels.offers')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item active ms-auto"><a href="#">@lang('labels.professionals')</a></li>
@endsection

@section('corpo')
<div class="container">
    <form method="get" action="{{ route('worker.filter') }}">
        <div class="row row-cols-4 mb-4">
            <div class="col">
                <button class="btn btn-contact">@lang('labels.filter')</button>
            </div>
            <div class="col text-center">
                @if(isset($name_filter))
                    <input id="name" name="name" type="text" class="form-control px-3 text-center" value="{{ $name_filter }}">
                @else
                    <input id="name" name="name" type="text" class="form-control px-3 text-center" placeholder="{{ trans('labels.name') }}">
                @endif
            </div>
            <div class="col text-center">
                @if(isset($profession_filter))
                    <input id="profession" name="profession" type="text" class="form-control text-center" placeholder="{{ $profession_filter }}">
                @else
                    <input id="profession" name="profession" type="text" class="form-control text-center" placeholder="{{ trans('labels.main_profession') }}">
                @endif
            </div>
            <div class="col text-center">
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
                    <select class="form-select text-center" name="elem_num" onchange="if (this.value) paginate(document.getElementById('workers'),this.value,5);">
                        <option value="4">4</option>
                        <option value="10" selected>10</option> 
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-3 text-center">
                    <h4>@lang('labels.name')</h4>
                </div>
                <div class="col-3 text-center">
                    <h4>@lang('labels.main_profession')</h4>
                </div>
                <div class="col-3 text-center">
                    <h4>@lang('labels.age')</h4>
                </div>
            </div> 
        </div>
    </div>
    <div id="workers" class="row row-cols-1 g-4">
        @if(count($workers) > 0)
            @foreach($workers as $worker)
            <div class="col">
                <a class="card-link" href="{{ route('worker.show', ['worker' => $worker->id]) }}">
                    <div class="card card-responsive">
                        <div class="row row-cols-4">
                            <div class="col my-auto">
                                <div class="profile-img-holder">
                                    <img class="card-img-top" src="{{ asset('storage/img/worker_profile/'.$worker->image) }}">
                                </div>
                            </div>
                            <div class="col text-center my-auto">
                                <p class="my-auto">{{ $worker->name }} {{ $worker->surname }}</p>
                            </div>
                            <div class="col my-auto text-center">
                                <p class="my-auto">{{ $worker->main_profession }}</p>
                            </div>
                            <div class="col my-auto text-center">
                                <p class="age my-auto">{{ $worker->date_of_birth }}</p>
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
                        @lang('labels.no_workers_with_filter')
                    </div>
                </div>
            </div>
        @endif
    </div>
    <nav id="pagination-nav" class="d-flex justify-content-center align-items-center mt-5"></nav>
</div>

<script>
$('.age').each(function(index){
    let birth_date = $(this).text();
    let age = computeAge(birth_date);
    $(this).text(age);
});
paginate(document.getElementById('workers'), 20,5);
</script>

@endsection