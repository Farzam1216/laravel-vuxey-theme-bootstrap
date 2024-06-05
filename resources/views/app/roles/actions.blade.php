@can('roles.edit')
    <a class="dropdown-item" href="{{ route('roles.edit', ['id' => encryptParams($id)]) }}">
        Edit Roles
    </a>
@endcan
