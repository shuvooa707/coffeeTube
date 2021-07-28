@extends("admin.dashboard")

@section('main')
<!-- Report -->
<div class="card report mb">
    <div class="card-header bg-dark text-white">
        Administration
    </div>
    <div class="card-body border border-dark p-2 pb-3 m-2">
        {{ $users->links() }}
        <table class="table border" style="">
            <thead class="bg-dark text-light">
                <tr>
                    <th>Id</th>
                    <th>User</th>
                    <th>Role</th>
                    <th class="text-center">
                        <i class="fas fa-cog"></i>
                    </th>
                </tr>
            <tbody>
                @foreach($users as $user)
                <tr class="py-1" data-user-id="{{$user->id}}">
                    <td class="py-1">
                        <strong class="badge border border-success text-success">
                            {{ $user->id }}
                        </strong>
                    </td>
                    <td class="py-1">
                        <a href="{{ route('user') }}/{{$user->id}}">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="py-1" style="position:relative;">
                        <span class="badge">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="text-center py-1" style="position:relative;">
                        <a href="{{ route('administration.moderateuser') }}/{{$user->id}}" class="btn btn-sm p-1 border-primary" onclick="show">
                            Moderate
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
<!-- /Report -->
@endsection
