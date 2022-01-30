
@extends('layouts.master')
@section('stile','style.css')

@section('left_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('companies') }}">Companies</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('workers') }}">Professionals</a></li>
@endsection


@section('breadcrumb')
<li class="breadcrumb-item ms-auto"><a href="{{ route('workers') }}">Companies</a></li>
<li class="breadcrumb-item active"><a href="#">company-name</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="row g-4">

        <div class="col-12 col-sm-3">
            <div class="card card-responsive">
                <div class="image-holder">
                    <img class="card-img-top" src="{{ url('/') }}/img/Tesla.png">
                </div>
                <div class="card-body">
                    <h6 class="card-title text-center">Tesla</h6>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-7">   

            <div class="card company-name-card text-center">
                <div class="card-body">
                    <input class="form-control" type="text" id="title" name="title" placeholder="Role title" value="qui va messo il role title del db">
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Location</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="location" name="location" rows="2" placeholder="Location" required></textarea>
                    </div>
            </div>
            
        </div>

        <div class="col-12 col-sm-2">
            <div class="card">
                    <a class="btn btn-contact" href="#">
                        <p>Save</p>
                    </a>
                </div>  
                <div class="card">
                    <a class="btn btn-contact" href="#">
                        <p>Cancel</p>
                    </a>
                </div>       
            </div>    
    </div>
</div>

<div class="container top-buffer">
        <div class="row row-cols-1 g-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Main Tasks, duties and Responsabilities</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="description" name="description" rows="10" placeholder="These are the main tasks, duties and responsabilities" required></textarea>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Education Requirements</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="edu_requirements" name="edu_requirements" rows="10" placeholder="These are the education requirements" required></textarea>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Skill Requirements</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="kill_requirements" name="skill_requirements" rows="10" placeholder="These are the skill requirements" required></textarea>
                    </div>
                </div>
            </div>
        </div>
</div>


@endsection