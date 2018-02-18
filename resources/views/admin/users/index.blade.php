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
                            Name
                        </th>
                        <th>
                            Permissions
                        </th>
                        <th>
                            Delete
                        </th>
                    </thead>
                    <tbody>
                        @if($users->count() > 0)
                            @foreach( $users as $user)
                                <tr>
                                    <td>
                                        <img 
                                            src="{{ url($user->profile->avatar) }}" 
                                            alt="Image for {{ $user->name }}"
                                            style="max-width:8em ; max-height: 5em;"
                                        >
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                
                                    <td>
                                        @if ($user->admin)
                                            <a  href="{{ route('user.demote', [
                                                                            'id' => $user->id
                                            ]) }}" 
                                                class="btn btn-warning">
                                                Remove as Admin
                                            </a>
                                        @else
                                            <a  href="{{ route('user.admin', [
                                                                            'id' => $user->id
                                            ]) }}" 
                                                class="btn btn-primary">
                                                Promote as Admin
                                            </a>
                                        @endif
                                    </td>
                                
                                    <td>
                                        <a href="{{ route('user.delete',
                                                        ['id'   => $user->id
                                                        ]
                                                    ) 
                                                }}" 
                                            class="btn btn-danger">
                                            Delete User
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