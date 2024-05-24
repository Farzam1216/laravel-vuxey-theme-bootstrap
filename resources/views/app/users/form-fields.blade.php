<div class="card mb-3">
    <div class="card-body" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
        <div class="row mb-1 align-items-end">
            <div class="col-lg-4 col-md-4 position-relative">
                <label class="form-label fs-6" for="name">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-md fs-6 @error('name') is-invalid @enderror"
                    id="name" name="name" placeholder="Full Name"
                    value="{{ isset($user) ? $user->name : old('name') }}" />
                <small class="text-muted">Enter Full Name</small>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4 col-md-4 position-relative  mt-1">
                <label class="form-label fs-6" for="type_name">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-md fs-6 @error('email') is-invalid @enderror"
                    id="email" name="email" placeholder="Email" autocomplete="false"
                    value="{{ isset($user) ? $user->email : old('email') }}" />
                <small class="text-muted">Enter Email</small></br>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @can('sites.users.edit.password')
                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mt-1">
                    <label class="form-label fs-6" for="type_name">Password <span class="text-danger">*</span></label>

                    <input id="password" type="password"
                        class="form-control fs-6 form-control-md @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="Password" autocomplete="false">
                    <small class="text-muted">Enter Password</small></br>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 position-relative mt-1">
                    <label for="password-confirm" class="form-label fs-6">Confirm Password <span
                            class="text-danger">*</span></label>
                    <input id="password-confirm" class="form-control form-control-md fs-6" type="password"
                        class="form-control" placeholder="Confirm Password" name="password_confirmation">
                    <small class="text-muted">Re-Enter Password</small>
                </div>
            @endcan

            <div class="col-lg-4 col-md-4 col-sm-4 mt-1">
                <label class="form-label fs-6" for="contact">Mobile Contact <span
                        class="text-danger">*</span></label>
                <input type="tel"
                value="{{ isset($user) ? $user->mobile_no : old('mobile_no') }}"
                    class="form-control form-control-md ContactNoError @error('mobile_no') is-invalid @enderror"
                    id="mobile_no" name="mobile_no" placeholder="" />
                <small class="text-muted">Enter Mobile Number</small>
                @error('mobile_no')
                    <div class="invalid-feedback ">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-1 pe-0">
                <div class="col-lg-12 col-md-12 col-sm-12 position-relative pe-0">
                    <label class="form-label fs-6" style="font-size: 15px" for="role_id">Role <span
                            class="text-danger">*</span></label>
                    <select class="form-select" id="role_id" name="role_id[]" multiple="multiple"
                        placeholder="Select Roles">
                        <option disabled>Select Role</option>
                        @foreach ($roles as $key => $value)
                            <option value="{{ $value->id }}"
                                {{ isset($Selectedroles) && in_array($value->name, $Selectedroles) ? 'selected' : null }}>
                                {{ $value->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Select Role</small><br>
                    @error('role_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <input type="hidden" name="Userid" value="{{ isset($user) ? $user->id : '' }}">

    </div>
</div>
