<?php

namespace App\Services\User;

use App\Models\FileSignatureConfiguration;
use App\Models\Role;
use App\Models\User;
use App\Services\User\Interface\UserInterface;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LDAP\Result;
use Request;
use Spatie\Permission\Models\Role as ModelsRole;

class UserService implements UserInterface
{
  public function model()
  {
    return new User();
  }

  public function getByAll($site_id)
  {
    return $this->model()->where('site_id', $site_id)->get();
  }

  public function store($site_id, $inputs, $customFields)
  {
    DB::transaction(function () use ($site_id, $inputs, $customFields) {
      $residential = $inputs['residential'];

      $data['residential_address_type'] = $residential['address_type'];
      $data['residential_address'] = $residential['address'];
      $data['residential_country_id'] = $residential['country'] > 0 ? $residential['country'] : 167;
      $data['residential_postal_code'] = $residential['postal_code'];
      $data['residential_state_id'] = $residential['state'];
      $data['residential_city_id'] = $residential['city'];
      //mailing address fields
      $mailing = $inputs['mailing'];
      $data['mailing_address_type'] = $mailing['address_type'];
      $data['mailingAddress'] = $mailing['mailingAddress'];
      $data['mailing_postal_code'] = $mailing['postal_code'];
      $data['mailing_country_id'] = $mailing['country'] > 0 ? $mailing['country'] : 167;
      $data['mailing_state_id'] = $mailing['state'];
      $data['mailing_city_id'] = $mailing['city'];
      $data['site_id'] = decryptParams($site_id);
      $data['name'] = $inputs['name'];
      $data['email'] = $inputs['email'];
      $data['password'] = Hash::make($inputs['password']);
      $data['designation'] = $inputs['designation'];
      $data['contact'] = $inputs['contact'];
      $data['cnic'] = $inputs['cnic'];
      // $data['pay_schedule_id'] = $inputs['pay_schedule_id'];

      // $data['mailing_address']  = $inputs['mailing_address'];
      // $data['address']  = $inputs['address'];
      $data['countryDetails'] = $inputs['countryDetails'];
      $data['optional_contact'] = $inputs['optional_contact'];
      $data['OptionalCountryDetails'] = $inputs['OptionalCountryDetails'];
      $data['father_name'] = $inputs['father_name'];
      $data['ntn'] = $inputs['ntn'];
      // $data['occupation']  = $inputs['occupation'];
      $data['comments'] = $inputs['comments'];
      $data['employment_status_id'] = $inputs['employment_status_id'];
      $data['hiring_date'] = $inputs['hiring_date'];
      $data['attendance_working_schedule_id'] = $inputs['attendance_working_schedule_id'];
      $data['office_email'] = $inputs['office_email'];
      $data['date_of_birth'] = $inputs['date_of_birth'];
      $data['referred_by'] = $inputs['referred_by'];
      $data['is_local'] = isset($inputs['is_local']);



      // $data['country_id'] = isset($inputs['country_id']) && $inputs['country_id'] > 0 ? $inputs['country_id'] : 167;
      // $data['state_id'] = isset($inputs['state_id']) ? $inputs['state_id'] : 0;
      // $data['city_id'] = isset($inputs['city_id']) ? $inputs['city_id'] : 0;
      $data['nationality'] = isset($inputs['nationality']) ? $inputs['nationality'] : 'pakistani';

      $user = $this->model()->create($data);
      // dd($user);
      $user->assignRole([$inputs['role_id']]);

      $user->clearMediaCollection('photo_attachment');
      if (isset($inputs['photo_attachment'])) {
        $attachment = getFilePath($inputs['photo_attachment']);
        $user->addMedia($attachment)->preservingOriginal()->toMediaCollection('photo_attachment');

        changeImageDirectoryPermission();
      }

      $user->clearMediaCollection('cv_attachment');
      if (isset($inputs['cv_attachment'])) {
        foreach ($inputs['cv_attachment'] as $attachment) {
          $attachment = getFilePath($attachment);
          if ($attachment) {
            $user->addMedia($attachment)->preservingOriginal()->toMediaCollection('cv_attachment');
          }
        }
        changeImageDirectoryPermission();
      }

      $user->clearMediaCollection('user_signature');
      if (isset($inputs['sign_attachment'])) {
        $attachment = getFilePath($inputs['sign_attachment']);
        if ($attachment) {
          $user->addMedia($attachment)->preservingOriginal()->toMediaCollection('user_signature');
        }
        changeImageDirectoryPermission();
      }

      if (isset($inputs['signed']) && !is_null($inputs['signed'])) {
        $folderPath = public_path('app-assets/server-uploads/sign_pad/');

        if (File::isdirectory($folderPath) == false) {
          File::makeDirectory($folderPath, 0777, true, true);
        }

        $image_parts = explode(';base64,', $inputs['signed']);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);
        $user->clearMediaCollection('user_signature');
        $user->addMedia($file)->preservingOriginal()->toMediaCollection('user_signature');

        changeImageDirectoryPermission();
      }

      foreach ($user->roles as $key => $role) {
        if ($role->is_child == false) {
          $rolename = $role->name . $user->id;
          $newrole = Role::updateOrCreate(['name' => $rolename, 'guard_name' => 'web', 'parent_id' => $role->id, 'is_child' => true]);
          // $user->givePermissionTo($role->permissions);
          $user->assignRole($newrole->id);
          $newrole->givePermissionTo($role->permissions);

          $user->removeRole($role->id);
        }
      }
      // foreach ($customFields as $key => $value) {
      //     $customFieldData = [
      //         'custom_field_id' => $value->id,
      //         'value' => $inputs[$value->name],
      //     ];
      //     $user->CustomFieldValues()->create($customFieldData);
      // }
      foreach ($customFields as $key => $value) {
        $user->CustomFieldValues()->updateOrCreate([
          'custom_field_id' => $value->id,
        ], [
          'value' => isset($inputs[$value->slug]) ? $inputs[$value->slug] : null,
        ]);
      }

      return $user;
    });
  }

  public function getById($site_id, $id)
  {
    if ($id == 0) {
      return $this->getEmptyInstance();
    }

    return $this->model()->find($id);
  }

  public function update($site_id, $id, $inputs, $customFields)
  {
    // dd($inputs);

    DB::transaction(function () use ($site_id, $id, $inputs, $customFields) {
      $data['name'] = $inputs['name'];
      $data['email'] = $inputs['email'];
      $data['mobile_no'] = $inputs['mobile_no'];



      dd($data,$inputs);
      $user = $this->model()->where('id', $id)->update($data);
      $user = $this->model()->find($id);

      foreach ($user->roles as $role) {
        if ($role->is_child == true && in_array($role->parent_id, $inputs['role_id'])) {
          $inputs['role_id'][] = $role->id;
          unset($inputs['role_id'][array_search($role->parent_id, $inputs['role_id'])]);
        }
      }

      $user->syncRoles([$inputs['role_id']]);
      foreach ($user->roles as $key => $role) {
        if ($role->is_child == false) {
          $rolename = $role->name . $user->id;
          $newrole = ModelsRole::updateOrCreate(['name' => $rolename, 'guard_name' => 'web', 'parent_id' => $role->id, 'is_child' => true]);
          // $user->givePermissionTo($role->permissions);
          $user->assignRole($newrole->id);
          $newrole->givePermissionTo($role->permissions);

          $user->removeRole($role->id);
        }
      }
    });
    $user = $this->model()->find($id);

    return $user;
  }

  public function destroySelected($id)
  {
    DB::transaction(function () use ($id) {
      if (!empty($id)) {
        foreach ($id as $data) {
          $user = $this->model()->find($data);
          $user->is_suspended = true;

          $files = FileSignatureConfiguration::where('user_id', $data)->get();
          //payment plan
          foreach ($files as $file) {
            //receipts
            if ($file->file_type == 'receipts_form') {
              $file_type = 'receipts_approval_activity';
            } else {
              $file_type = $file->file_type . '_approval_activity';
            }
            //Booking_form
            if ($file->file_type == 'booking_form') {
              $file_type = 'booking_form_approval_activity';
            } else {
              $file_type = $file->file_type . '_approval_activity';
            }
            //transfer_receipt
            if ($file->file_type == 'transfer_receipt') {
              $file_type = 'transfer_receipt_form';
            } else {
              $file_type = $file->file_type . '_approval_activity';
            }

            $log = auth()->user()->name . ' Suspended ' . $user->name .   'from ' . $file->file_type;
            actionLog(get_class($file), auth()->user(), $file, $log, [
              'attributes' => $file,
            ], $file_type);

            $file->delete();
          }
          $user->save();
        }
        return true;
      }
      return false;
    });
  }

  public function getEmptyInstance()
  {
    $user = [
      'id' => 0,
      'name' => '',
      'email' => '',
      'phone_no' => '',
    ];

    return $user;
  }

  public function UserProfileUpdate($site_id, $id, $inputs)
  {
    DB::transaction(function () use ($site_id, $id, $inputs) {
      $user = User::find($id);
      if ($inputs['selected_tab'] == 'personal') {

        $formData = [
          'name' => $inputs['name'],
          'father_name' => $inputs['father_name'],
          'date_of_birth' => $inputs['date_of_birth'],
          'optional_contact' => $inputs['optional_contact'],
          'office_email' => $inputs['office_email'],
          'email' => $inputs['email'],
          'designation' => $inputs['designation'],
          'contact' => $inputs['contact'],
          'cnic' => $inputs['cnic'],
          'ntn' => $inputs['ntn'],
          'employment_status_id' => $inputs['employment_status_id'],
          'hiring_date' => $inputs['hiring_date'],
          'pay_schedule_id' => $inputs['pay_schedule_id'],

        ];
      } elseif ($inputs['selected_tab'] == 'Address') {
        $formData =
          [
            $residential = $inputs['residential'],
            'residential_address_type' => $residential['address_type'],
            'residential_address' => $residential['address'],
            'residential_country_id' => $residential['country'] > 0 ? $residential['country'] : 167,
            'residential_postal_code' => $residential['postal_code'],
            'residential_state_id' => $residential['state'],
            'residential_city_id' => $residential['city'],
            //mailing address fields
            $mailing = $inputs['mailing'],
            'mailing_address_type' => $mailing['address_type'],
            'mailingAddress' => $mailing['mailingAddress'],
            'mailing_postal_code' => $mailing['postal_code'],
            'mailing_country_id' => $mailing['country'] > 0 ? $mailing['country'] : 167,
            'mailing_state_id' => $mailing['state'],
            'mailing_city_id' => $mailing['city'],
          ];
      } elseif ($inputs['selected_tab'] == 'attachments') {
        // Clear existing media collections
        $user->clearMediaCollection('photo_attachment');
        $user->clearMediaCollection('cv_attachment');
        $user->clearMediaCollection('user_signature');

        // Process photo attachments
        if (isset($inputs['photo_attachment'])) {
          $attachment = getFilePath($inputs['photo_attachment']);
          if ($attachment) {
            $user->addMedia($attachment)->preservingOriginal()->toMediaCollection('photo_attachment');
          }
          changeImageDirectoryPermission();
        }

        // Process CV attachments
        if (isset($inputs['cv_attachment'])) {
          foreach ($inputs['cv_attachment'] as $attachment) {
            $attachment = getFilePath($attachment);
            if ($attachment) {
              $user->addMedia($attachment)->preservingOriginal()->toMediaCollection('cv_attachment');
            }
          }
          changeImageDirectoryPermission();
        }

        // Process user signature attachments
        if (isset($inputs['sign_attachment'])) {
          $attachment = getFilePath($inputs['sign_attachment']);
          if ($attachment) {
            $user->addMedia($attachment)->preservingOriginal()->toMediaCollection('user_signature');
          }
          changeImageDirectoryPermission();
        }
        $user->update();
      } elseif ($inputs['selected_tab'] == 'password') {

        if ($inputs['password'] !== $inputs['password_confirmation']) {
          return response()->json(['error' => 'Passwords do not match.'], 422);
        }

        $formData = [
          'password' =>  $inputs['password'],
        ];
      }
      $formData['site_id'] = $site_id;
      $user->update($formData);
    });
  }
}
