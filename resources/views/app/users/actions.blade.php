@can('users.edit')
    <a class="dropdown-item" href="{{ route('users.edit', ['id' => encryptParams($id)]) }}">
        Edit User
    </a>
@endcan
