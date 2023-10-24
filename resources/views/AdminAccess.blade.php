@extends('layouts.app')

@section('content')
    <h1>User List</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_admin)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @if ($user->is_admin)
                            <form method="POST" action="{{ route('revokeAdminAccess', $user) }}">
                                @csrf
                                <button type="submit">Revoke Admin Access</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('grantAdminAccess', $user) }}">
                                @csrf
                                <button type="submit">Grant Admin Access</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection