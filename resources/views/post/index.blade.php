@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <router-view name="postsIndex"></router-view>
                <router-view></router-view>
            </div>
        </div>
    </div>
@endsection