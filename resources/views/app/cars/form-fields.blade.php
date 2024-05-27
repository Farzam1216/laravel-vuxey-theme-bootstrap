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
                        id="name" name="name" placeholder="Car Name"
                        value="{{ isset($carCategory) ? $carCategory->name : null }}" />
                    @error('name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mb-2">
                    <label class="form-label fs-6" for="name">Car Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md @error('name') is-invalid @enderror"
                        id="name" name="name" placeholder="Car Name"
                        value="{{ isset($carCategory) ? $carCategory->name : null }}" />
                    @error('name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
