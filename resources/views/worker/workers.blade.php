@extends('layouts.master')

@section('titolo',trans('labels.professionals'))

@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">@lang('labels.companies')</a></li>
<li class="nav-item active"><a class="nav-link" href="{{ route('worker.index') }}">@lang('labels.professionals')</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item active ms-auto"><a href="#">@lang('labels.professionals')</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row row-cols-1 g-4">
        <div class="col">
            <div class="row row-cols-4">
                <div class="col"></div>
                <div class="col text-center">
                    <h4>@lang('labels.name')</h4>
                </div>
                <div class="col text-center">
                    <h4>@lang('labels.age')</h4>
                </div>
                <div class="col text-center">
                    <h4>@lang('labels.main_profession')</h4>
                </div>
            </div> 
        </div>

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
                            <p class="age my-auto">{{ $worker->date_of_birth }}</p>
                        </div>
                        <div class="col my-auto text-center">
                            <p class="my-auto">{{ $worker->main_profession }}</p>
                        </div>
                    </div> 
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<script>
$('.age').each(function(index){
    let birth_date = $(this).text();
    let age = computeAge(birth_date);
    $(this).text(age);
});
</script>

@endsection