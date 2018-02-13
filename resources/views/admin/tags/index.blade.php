@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
            <table class="table table-hover">
                    <thead>
                        <th>
                            Tag Name
                        </th>
                        <th>
                            Editing
                        </th>
                        <th>
                            Deleting
                        </th>
                    </thead>
                    <tbody>
                        @if($tags->count() > 0)
                            @foreach( $tags as $tag)
                                <tr>
                                    <td>
                                        {{ $tag->tag }}
                                    </td>
                                
                                    <td>
                                        <a  href="{{ route('tag.edit',
                                                            ['id'   => $tag->id
                                                            ]
                                                    ) 
                                                    }}" 
                                            class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                
                                    <td>
                                        <a href="{{ route('tag.delete',
                                                        ['id'   => $tag->id
                                                        ]
                                                    ) 
                                                }}" 
                                            class="btn btn-danger">
                                            Delete
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