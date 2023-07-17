<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    {{-- {{ dd($roles) }} --}}
    <div>
        <table class="table table-hover mt-5 py-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Role</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->role->role_name}}</td>
                    {{-- @foreach ($roles as $role)
                        @if ($role->id == $user->role_id)
                            <td>{{ $role->role_name }}</td>
                        @endif
                    @endforeach --}}
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td colspan="3">
                        <button type="button" class="btn btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        <button type="button" class="btn btn-outline-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
