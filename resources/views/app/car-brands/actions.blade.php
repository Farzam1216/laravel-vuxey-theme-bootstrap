@can('car-brands.edit')
    <a class="dropdown-item" href="{{ route('car-brands.edit', ['id' => encryptParams($id)]) }}">
        Edit Car Brands
    </a>
@endcan
