@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
            <table class="table table-hover">
                    <thead>
                        <th>
                            Category Name
                        </th>
                        <th>
                            Editing
                        </th>
                        <th>
                            Deleting
                        </th>
                    </thead>
                    <tbody>
                        @if($categories->count() > 0)
                            @foreach( $categories as $category)
                                <tr>
                                    <td>
                                        {{ $category->name }}
                                    </td>
                                
                                    <td>
                                        <a  href="{{ route('category.edit',
                                                            ['id'   => $category->id
                                                            ]
                                                    ) 
                                                    }}" 
                                            class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                
                                    <td>
                                        <a href="{{ route('category.delete',
                                                        ['id'   => $category->id
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