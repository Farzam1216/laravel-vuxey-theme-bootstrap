@can('cars.edit')
    <a class="dropdown-item" href="{{ route('cars.edit', ['id' => encryptParams($id)]) }}">
        Edit Car Details
    </a>
@endcan

<a class="dropdown-item" href="{{ route('car-location', ['id' => $id]) }}">
    View Car Location
</a>
