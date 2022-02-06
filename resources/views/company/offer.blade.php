
@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('company.index') }}">Companies</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('worker.index') }}">Professionals</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('offer.index') }}">Offers</a></li>
<li class="breadcrumb-item active"><a href="#">{{ $offer->company->name }}'s offer</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row g-4">

        <div class="col-12 col-sm-3">
            <a  class="card-link" href="{{ route('company.show', ['company'=> $offer->company->id]) }}">
                <div class="card card-responsive">
                    <div class="image-holder">
                        <img class="card-img-top" src="{{ asset('storage/img/company_profile/'.$offer->company->image) }}">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-center">{{ $offer->company->name }}</h6>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-sm-7">   

            <div class="card company-name-card text-center">
                <h4>{{ $offer->title }}</h4>
            </div>
            <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Location</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $offer->location }}</p>
                    </div>
            </div>
            
        </div>

        <div class="col-12 col-sm-2">
            @if(isset(Auth::user()->company) AND Auth::user()->company->id == $offer->company->id)
                <a class="btn btn-contact" href="{{ route('offer.edit', ['offer'=> $offer->id]) }}">
                    Edit
                </a>
            @elseif(!isset(Auth::user()->company))
            <!-- qua la gestione deve essere fatta grazie ai middleware, non come e' fatta ora -->
                @if(isset(Auth::user()->worker))
                    <a class="btn btn-contact mb-2" href="{{ route('offer.candidate', ['offer'=>$offer->id, 'worker'=>Auth::user()->worker->id]) }}">
                        Candidate
                    </a>
                @else
                    <a class="btn btn-contact mb-2" href="{{ route('login') }}">
                        Candidate
                    </a>
                @endif
            @endif
        </div>    
    </div>
</div>

<div class="container top-buffer mb-4">
        <div class="row row-cols-1 g-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Main Tasks, duties and Responsabilities</h6>
                    </div>
                    <div class="card-body">
                        <div style="white-space: pre-line">{{ $offer->description }}</div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Education Requirements</h6>
                    </div>
                    @if(empty($offer->education_requirements))
                        <div class="card-body">
                            <div style="white-space: pre-line">No education requirement was added</div>
                        </div>
                    @else
                        <div class="card-body">
                            <div style="white-space: pre-line">{{ $offer->education_requirements }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Skill Requirements</h6>
                    </div>
                    @if(count($offer->skill_requirements) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($offer->skill_requirements as $skill)
                            <li class="list-group-item">{{ $skill->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <div class="card-body">
                            No skill requirement was added
                        </div>
                    @endif
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Language Requirements</h6>
                    </div>
                    @if(count($offer->language_requirements) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($offer->language_requirements as $language)
                            <li class="list-group-item">{{ $language->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <div class="card-body">
                            No education requirement was added
                        </div>
                    @endif
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Starting salary</h6>
                    </div>
                    <div class="card-body">
                        @if(empty($offer->starting_salary))
                            No starting salary has been specified
                        @else
                            <div style="white-space: pre-line">{{ $offer->starting_salary }}</div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
</div>


<div class="container top-buffer mb-4">
    <div class="row">
        <div class="col-12">
            <h1>Candidates:</h1>
        </div>
        <div class="col-12">
            <div class="container">
                <div class="row g-4">
                    <div class="col-3"></div>
                    <div class="col-3 text-center">
                        <h4>Name</h4>
                    </div>
                    <div class="col-3 text-center">
                        <h4>Main profession</h4>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>


        @if(count($offer->candidates) > 0)
            @foreach($offer->candidates as $candidate)
            <div class="col-12 my-auto">
                <a class="card-link" href="{{ route('worker.show', ['worker'=>$candidate->id]) }}">
                    <div class="card card-responsive my-auto">
                        <div class="container my-auto">
                            <div class="row g-4 my-auto">
                                <div class="col-12 my-auto">
                                    <div class="container my-auto">
                                        <div class="row my-auto">
                                            <div class="col-3 my-auto">
                                                <div class="logo-img-holder">
                                                    <img class="card-img-top" src="{{ asset('storage/img/worker_profile/'.$candidate->image) }}">
                                                </div>
                                            </div>
                                            <div class="col-3 text-center my-auto">
                                                <p class="my-auto">{{ $candidate->name }}</p>
                                            </div>
                                            <div class="col-3 my-auto text-center">
                                                <p class="my-auto">{{ $candidate->main_profession }}</p>
                                            </div>
                                            <div class="col-3 my-auto">
                                                <div class="container my-auto">
                                                    <div class="row my-auto">
                                                        <form method="get" action="{{ route('offer.reject', ['offer'=>$offer->id, 'worker'=>$candidate->id]) }}">
                                                            <button type="submit" class="btn btn-contact d-block mb-2 mt-2">Reject</button>
                                                        </form>
                                                        <form method="get" action="{{ route('worker.contact', ['worker'=>$candidate->id]) }}">
                                                            <button type="submit" class="btn btn-contact d-block mb-2">Contact</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        There are no candidates at the moment.
                    </div>
                </div>
            </div>
        @endif



    </div>

</div>


@endsection