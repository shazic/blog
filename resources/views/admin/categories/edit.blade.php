@extends('layouts.app')

@section('content')
    

    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div>
                <a href="{{ route('categories') }}" class="btn btn-info">Back to categories</a>
            </div>
        </div>
        <div class="panel-body">
            <form action="{{ route('category.update',['id'   => $category->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input  type="text" 
                            name="name" 
                            class="form-control" 
                            @if( $category )
                                value="{{ $category->name }}"
                            @endif
                    >
                </div>
    
                <div class="form-group">    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
        
            </form>
        </div>
    </div>    
@endsection