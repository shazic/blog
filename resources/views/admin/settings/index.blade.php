@extends('layouts.app')

@section('content')
    
@include('includes.errors')

<div class="panel panel-default">
<div class="panel-heading">
    Settings
</div>
<div class="panel-body">
    <form action="{{ route('settings.update') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="site_name">Name</label>
            <input type="text" name="site_name" class="form-control" value="{{ $settings->site_name }}">
        </div>
    
        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ $settings->contact_number }}">
        </div>

        <div class="form-group">
                <label for="contact_email">E-mail</label>
                <input type="email" name="contact_email" class="form-control" value="{{ $settings->contact_email }}">
        </div>

        <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $settings->address }}">
        </div>

        <div class="form-group">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Settings</button>
            </div>
        </div>
        
    </form>
</div>
</div>    

@endsection