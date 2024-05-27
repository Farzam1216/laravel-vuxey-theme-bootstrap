<div class="col-lg-12 col-md-12 col-sm-12 position-relative">
    <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
        <div class="card-body">
            <div class="row mb-1">

                <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                    <label class="form-label fs-6" for="name"> Car Category Name<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md @error('name') is-invalid @enderror"
                        id="name" name="name" placeholder="Car Category Name"
                        value="{{ isset($carCategory) ? $carCategory->name : null }}" />
                    @error('name')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
