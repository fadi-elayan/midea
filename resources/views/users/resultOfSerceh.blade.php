@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'dashboard'])
@section('content')
    <div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Search</h4>
        </div>
        <div class="card-body">
            @foreach($users as $user)
                <div class="alert alert-info">
                    <img src="/image/{{$user->image->path}}" class="avatar">
                   <a href="/user/search/id/{{$user->id}}">
                       <span><b class="text-secondary">{{$user->name}}</b></span></a>
                </div>
            @endforeach
        </div>
    </div>
 </div>
        <div class="container">
            <div class="row">
                {{$users->render()}}
            </div>
        </div>
</div>
@endsection