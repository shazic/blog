@extends('layouts.app')

@section('content')
    
@include('includes.errors')

<div class="panel panel-default">
<div class="panel-heading">
    Edit user profile
</div>
<div class="panel-body">
    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
    
        <div class="form-group">
            <label for="name">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" class="form-control" placeholder="Type a new password">
        </div>

        <div class="form-group">
            <label for="avatar">Profile Avatar (leave blank to keep current image)</label>
            <input type="file" name="avatar" class="form-control">
            <p>current image:</p>
            <img src="{{ url($user->profile->avatar) }}" height="90px" width="90px">
        </div>

        <div class="form-group">
            <label for="facebook">Facebook page</label>
            <input type="text" name="facebook" class="form-control" value="{{ $user->profile->facebook }}">
        </div>

        <div class="form-group">
            <label for="youtube">YouTube Channel</label>
            <input type="text" name="youtube" class="form-control" value="{{ $user->profile->youtube }}">
        </div>

        <div class="form-group">
            <label for="twiter">Twiter handle</label>
            <input type="text" name="twiter" class="form-control" value="{{ $user->profile->twiter }}">
        </div>

        <div class="form-group">
            <label for="about">About me</label>
            <textarea name="about" id="about" class="form-control" cols="5" rows="10">{{ $user->profile->about }}</textarea>
        </div>

        <div class="form-group">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </div>
        
    </form>
</div>
</div>    

@endsection