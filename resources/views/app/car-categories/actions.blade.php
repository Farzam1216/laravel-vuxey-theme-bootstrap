@can('car-categories.edit')
    <a class="dropdown-item" href="{{ route('car-categories.edit', ['id' => encryptParams($id)]) }}">
        Edit Car Category
    </a>
@endcan
