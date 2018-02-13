@extends('layouts.app')

@section('content')
    

    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div>
                <a href="{{ route('tags') }}" class="btn btn-info">Back to Tags</a>
            </div>
        </div>
        <div class="panel-body">
            <form action="{{ route('tag.update',['id'   => $tag->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="tag">Name</label>
                    <input  type="text" 
                            name="tag" 
                            class="form-control" 
                            @if( $tag )
                                value="{{ $tag->tag }}"
                            @endif
                    >
                </div>
    
                <div class="form-group">    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Tag</button>
                    </div>
                </div>
        
            </form>
        </div>
    </div>    
@endsection