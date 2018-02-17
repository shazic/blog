@extends('layouts.app')

@section('content')
    
    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('posts') }}" class="btn btn-info">Back to posts</a>
        </div>
        <div class="panel-body">
            <form action="{{ route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                </div>
            
                <div class="form-group">
                        <label for="featured">Image (leave blank to keep the current image)</label>
                        <input type="file" name="featured" class="form-control">
                        <p>current image: {{ $post->featured }}</p>
                        <img src="{{ url($post->featured) }}" height="90px" width="90px">
                </div>

                <div class="form-group">
                    <label for="category_id">Select a Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach( $categories as $category)
                            <option value="{{ $category->id }}" 
                                    @if ($category->id == $post->category_id) 
                                    selected="selected"
                                    @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Select tags</label>
                    @foreach( $tags as $tag )
                        <div class="form-check">
                            <input  type="checkbox" 
                                    name="tags[]" 
                                    class="form-check-input" 
                                    value="{{ $tag->id }}"
                                    @foreach( $post->tags as $selectedTag)
                                        @if ( $selectedTag->id == $tag->id)
                                            checked
                                        @endif
                                    @endforeach
                                    
                            >
                            <label class="form-check-label">{{ $tag->tag }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control" cols="5" rows="10">{{ $post->content }}</textarea>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>    
    
@endsection