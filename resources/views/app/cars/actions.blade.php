@can('cars.edit')
    <a class="dropdown-item" href="{{ route('cars.edit', ['id' => encryptParams($id)]) }}">
        Edit Car Details
    </a>
@endcan
