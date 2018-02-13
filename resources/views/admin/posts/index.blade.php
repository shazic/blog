@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
            <table class="table table-hover">
                    <thead>
                        <th>
                            Image
                        </th>
                        <th>
                            Post Title
                        </th>
                        <th>
                            Edit post
                        </th>
                        <th>
                            Send to Trash
                        </th>
                    </thead>
                    <tbody>
                        @if($posts->count() > 0)
                            @foreach( $posts as $post)
                                <tr>
                                    <td>
                                        <img 
                                            src="{{ url($post->featured) }}" 
                                            alt="Image for {{ $post->title }}"
                                            style="max-width:10em ; max-height: 8em;"
                                        >
                                    </td>
                                    <td>
                                        {{ $post->title }}
                                    </td>
                                
                                    <td>
                                        <a  href="{{ route('post.edit',
                                                            ['id'   => $post->id
                                                            ]
                                                    ) 
                                                    }}" 
                                            class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                
                                    <td>
                                        <a href="{{ route('post.delete',
                                                        ['id'   => $post->id
                                                        ]
                                                    ) 
                                                }}" 
                                            class="btn btn-danger">
                                            Trash
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">Nothing to show here</td>
                            </tr>
                        @endif
                    </tbody>
                    
                </table>
    </div>
</div>
@endsection