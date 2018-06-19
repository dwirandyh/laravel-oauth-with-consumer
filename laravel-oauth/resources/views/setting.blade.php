@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <passport-authorized-clients></passport-authorized-clients>
                <passport-clients></passport-clients>
            </div>
            <div class="col-sm-8">
                <passport-personal-access-token></passport-personal-access-token>
            </div>
        </div>
    </div>
@endsection
