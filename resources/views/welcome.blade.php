@extends('master')
@section('title', 'Home')


@section('content')
<div class="welcome">
        <div class="container d-flex full-height">
            <div class="row justify-content-center align-self-center">
                <h3 style="width: 120px; text-align: center;">FIXIT</h3>
                <div style="width:100%">
                <form action="/issues/" method="GET">
                <div class="form-group">
                    <label for="exampleInputEmail1">Search</label>
                    <input type="search" name="search" autofocus class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search for issues...">
                    <small id="emailHelp" class="form-text text-muted">Public issues will be shown to users.</small>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection