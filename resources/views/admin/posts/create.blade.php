@extends('layouts.app')

@section('customstyles')
    <!-- include summernote css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('customjs')
    <!-- include summernote js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
            $('#content').summernote({
                placeholder: 'Create a blog post',
                tabsize: 2,
                height: 200
            });
    </script>
@endsection

@section('content')
    
    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            Create a new post
        </div>
        <div class="panel-body">
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Post Title">
                </div>
            
                <div class="form-group">
                        <label for="featured">Image</label>
                        <input type="file" name="featured" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category_id">Select a Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach( $categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tags">Select tags</label>
                    @foreach( $tags as $tag )
                        <div class="form-check">
                            <input type="checkbox" name="tags[]" class="form-check-input" id="tag" value="{{ $tag->id }}">
                            <label class="form-check-label" for="tag">{{ $tag->tag }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control" cols="5" rows="10"></textarea>
                        <!--div id="content" name="content"></div-->
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>    
    
@endsection