<div class="col-lg-12 col-md-12 col-sm-12 position-relative">
    <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
        <div class="card-body">
            <div class="row mb-1">

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Select Car Category<span
                            class="text-danger">*</span></label>
                    <select class="select2-size-lg roles form-select" id="roles" name="category_id">

                        <option value="0" selected>Select Car Category</option>
                        @forelse ($categories as $roleRow)
                            <option value="{{ $roleRow['id'] }}"
                                {{ (isset($role) ? $role->category_id : old('type')) == $roleRow['id'] ? 'selected' : '' }}>
                                {{ $loop->index + 1 }} - {{ $roleRow['name'] }}</option>
                        @empty
                            No Category Available
                        @endforelse
                    </select>
                    @error('name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Car Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md @error('name') is-invalid @enderror"
                        id="name" name="name" placeholder="Car Name" required
                        value="{{ isset($car) ? $car->name : null }}" />
                    @error('name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Brand Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md @error('brand_name') is-invalid @enderror"
                        id="brand_name" name="brand_name" placeholder="Brand Name" required
                        value="{{ isset($car) ? $car->brand_name : null }}" />
                    @error('brand_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Registraion Number<span
                            class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control form-control-md @error('registration_no') is-invalid @enderror"
                        id="registration_no" name="registration_no" placeholder="Registration No" required
                        value="{{ isset($car) ? $car->reg_no : null }}" />
                    @error('registration_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Color<span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md @error('color') is-invalid @enderror"
                        id="color" name="color" placeholder="Color" required
                        value="{{ isset($car) ? $car->color : null }}" />
                    @error('color')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Model<span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md @error('model') is-invalid @enderror"
                        id="model" name="model" placeholder="Model" required
                        value="{{ isset($car) ? $car->model : null }}" />
                    @error('model')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Owner Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md @error('owner_name') is-invalid @enderror"
                        id="owner_name" name="owner_name" placeholder="Owner Name" required
                        value="{{ isset($car) ? $car->owner_name : null }}" />
                    @error('owner_name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Owner Contact Number<span
                            class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control form-control-md @error('owner_contact_no') is-invalid @enderror"
                        id="owner_contact_no" name="owner_contact_no" placeholder="Owner Contact Number" required
                        value="{{ isset($car) ? $car->owner_contact_no : null }}" />
                    @error('owner_contact_no')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Owner Email<span class="text-danger">*</span></label>
                    <input type="email"
                        class="form-control form-control-md @error('owner_email') is-invalid @enderror" id="owner_email"
                        name="owner_email" placeholder="Owner Email" required
                        value="{{ isset($car) ? $car->owner_email : null }}" />
                    @error('owner_email')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Full Day Rate With Fuel<span
                            class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control form-control-md @error('full_day_rate_with_fuel') is-invalid @enderror"
                        id="full_day_rate_with_fuel" name="full_day_rate_with_fuel"
                        placeholder="Full Day Rate With Fuel" required
                        value="{{ isset($car) ? $car->full_day_rate_with_fuel : null }}" />
                    @error('full_day_rate_with_fuel')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Full Day Rate Without Fuel<span
                            class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control form-control-md @error('full_day_rate_without_fuel') is-invalid @enderror"
                        id="full_day_rate_without_fuel" name="full_day_rate_without_fuel"
                        placeholder="Full Day Rate Without Fuel" required
                        value="{{ isset($car) ? $car->full_day_rate_without_fuel : null }}" />
                    @error('full_day_rate_without_fuel')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Per Kilometer With Fuel<span
                            class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control form-control-md @error('per_km_rate_with_fuel') is-invalid @enderror"
                        id="per_km_rate_with_fuel" name="per_km_rate_with_fuel" placeholder="Per Kilometer With Fuel" required
                        value="{{ isset($car) ? $car->per_km_rate_with_fuel : null }}" />
                    @error('per_km_rate_with_fuel')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Per Kilometer Without Fuel<span
                            class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control form-control-md @error('per_km_rate_without_fuel') is-invalid @enderror"
                        id="per_km_rate_without_fuel" name="per_km_rate_without_fuel" placeholder="Per Kilometer Without Fuel"
                        required value="{{ isset($car) ? $car->per_km_rate_without_fuel : null }}" />
                    @error('per_km_rate_without_fuel')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Longitude<span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control form-control-md @error('longitude') is-invalid @enderror" id="longitude"
                        name="longitude" placeholder="Longitude" required
                        value="{{ isset($car) ? $car->longitude : null }}" />
                    @error('longitude')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Latitude<span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control form-control-md @error('latitude') is-invalid @enderror" id="latitude"
                        name="latitude" placeholder="Latitude" required
                        value="{{ isset($car) ? $car->latitude : null }}" />
                    @error('latitude')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Sale Price<span
                            class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control form-control-md @error('sale_price') is-invalid @enderror"
                        id="sale_price" name="sale_price" placeholder="Sale Price" required
                        value="{{ isset($car) ? $car->sale_price : null }}" />
                    @error('sale_price')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Discounted Sale Price<span
                            class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control form-control-md @error('discounted_sale_price') is-invalid @enderror"
                        id="discounted_sale_price" name="discounted_sale_price" placeholder="Discounted Sale Price"
                        required value="{{ isset($car) ? $car->discounted_sale_price : null }}" />
                    @error('discounted_sale_price')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
