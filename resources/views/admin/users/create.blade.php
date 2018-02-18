@extends('layouts.app')

@section('content')
    
@include('includes.errors')

<div class="panel panel-default">
<div class="panel-heading">
    Create a new user
</div>
<div class="panel-body">
    <form action="{{ route('user.store') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="User Name">
        </div>
    
        <div class="form-group">
            <label for="name">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="E-mail">
        </div>

        <div class="form-group">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
        </div>
        
    </form>
</div>
</div>    

@endsection