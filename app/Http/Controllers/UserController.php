<?php

namespace App\Http\Controllers;

ini_set('memory_limit', '3000M');
ini_set('max_execution_time', 500);

use App\DataTables\UserDataTable;
use App\Http\Requests\users\storeRequest as userStoreRequest;
use App\Http\Requests\users\updateRequest as userUpdateRequest;
use App\Mail\RegisterUserPasswordMail;
use App\Models\User;
use App\Services\User\Interface\UserInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Mail;
use Log;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  private $userInterface;

  private $customFieldInterface;

  public function __construct(UserInterface $userInterface)
  {
    $this->userInterface = $userInterface;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(UserDataTable $dataTable)
  {
    $data = [
      'createPermission' =>  Auth::user()->can('users.create'),
      'selectedDeletePermission' => Auth::user()->can('users.destroy-selected'),
    ];

    // dd($data);

    return $dataTable->with($data)->render('app.users.index', $data);
  }

  public function users_menu($id)
  {
    $user = User::where('id', $id)->first();
    $data = [
      'id' => $user->id,
      'edituser' => Auth::user()->hasPermissionTo('users.edit'),
      'is_suspended' => $user->is_suspended,
      // 'edituserPermission' => Auth::user()->hasPermissionTo('users.edit')
    ];
    return view('app.users.actions', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {

    if (!request()->ajax()) {

      $role = Role::where('is_child', false)->get();

      $data = [
        'role' => $role,
      ];
      return view('app.users.create', $data);
    } else {
      abort(403);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {


    $data = $request->all();
    $validator = Validator::make($data, [
      'name' => ['required', 'string'],
      'mobile_no' => ['required'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      // 'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    try {
      if (!request()->ajax()) {
        $inputs = $request->all();

        $password = Str::random(8);
        $user = User::create([
          'name' => $inputs['name'],
          'email' => $inputs['email'],
          'mobile_no' => $inputs['mobile_no'],
          'password' => Hash::make($password),
        ]);

        Mail::to($user->email)->send(new RegisterUserPasswordMail($user, $password));
        // $user->assignRole([$inputs['role_id']]);

        // Process roles
        foreach ($user->roles as $role) {
          if ($role->is_child && in_array($role->parent_id, $inputs['role_id'])) {
            $inputs['role_id'][] = $role->id;
            unset($inputs['role_id'][array_search($role->parent_id, $inputs['role_id'])]);
          }
        }

        // Get role names instead of IDs for syncing
        $roleNames = Role::whereIn('id', $inputs['role_id'])->pluck('name')->toArray();
        $user->syncRoles($roleNames);

        foreach ($user->roles as $role) {
          if (!$role->is_child) {
            $rolename = $role->name . $user->id;
            $newrole = Role::updateOrCreate([
              'name' => $rolename,
              'guard_name' => 'web',
              'parent_id' => $role->id,
              'is_child' => true
            ]);

            // Assign the new role to the user
            $user->assignRole($newrole);

            // Transfer permissions from parent role to new role
            $newrole->syncPermissions($role->permissions);

            // Remove the original parent role from the user
            $user->removeRole($role);
          }
        }


        return redirect()->route('users.index')->withSuccess(__('lang.commons.data_saved'));
      } else {
        abort(403);
      }
    } catch (Exception $ex) {
      FacadesLog::error($ex);
      return redirect()->route('users.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id)
  {
    $site_id = decryptParams($site_id);
    $id = decryptParams($id);
    $roles = Role::where('is_child', false)->get();

    $user = $this->userInterface->getById($site_id, $id);

    $parentRoles = $user->roles;
    $Selectedroles = [];
    foreach ($parentRoles as $role) {
      if ($role['is_child'] == true) {
        $Selectedroles[] = getRoleParentByParentId($role['parent_id']);
      } else {
        $Selectedroles[] = $role->name;
      }
    }
    if ($user && !empty($user)) {
      $images = $user->getMedia('user_signature');
      $cv = $user->getMedia('cv_attachment');
      $photo = $user->getFirstMediaUrl('photo_attachment');
      // dd($images);
      $data = [
        'site_id' => $site_id,
        'id' => $id,
        'user' => $user,
        'images' => $images,
        'cv' => $cv,
        'photo' => $photo,
        'Selectedroles' => $Selectedroles,
        'roles' => $roles,
        'city' => [],
        'state' => [],
      ];

      return view('app.users.preview', $data);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, $id)
  {

    $site_id = 1;
    $id = decryptParams($id);
    try {
      $roles = Role::where('is_child', false)->get();

      $user = User::find($id);

      $parentRoles = $user->roles;

      $Selectedroles = [];
      foreach ($parentRoles as $role) {
        if ($role['is_child'] == true) {
          $Selectedroles[] = getRoleParentByParentId($role['parent_id']);
        } else {
          $Selectedroles[] = $role->name;
        }
      }
      // dd($images);
      $data = [
        'site_id' => $site_id,
        'id' => $id,
        'user' => $user,
        'Selectedroles' => $Selectedroles,
        'roles' => $roles,
        'customFields' => null,
        'city' => [],
        'state' => [],
      ];
      return view('app.users.edit', $data);
    } catch (Exception $ex) {
      return redirect()->route('users.index', ['site_id' => encryptParams($site_id)])->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
    }
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'name' => ['required', 'string'],
      'mobile_no' => ['required'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
      // 'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    $id = decryptParams($id);
    try {
      if (!request()->ajax()) {
        $inputs = $request->all();
        $data['name'] = $inputs['name'];
        $data['email'] = $inputs['email'];
        $data['mobile_no'] = $inputs['mobile_no'];
        User::where('id', $id)->update($data);
        $user = User::find($id);

        // Process roles
        foreach ($user->roles as $role) {
          if ($role->is_child && in_array($role->parent_id, $inputs['role_id'])) {
            $inputs['role_id'][] = $role->id;
            unset($inputs['role_id'][array_search($role->parent_id, $inputs['role_id'])]);
          }
        }

        // Get role names instead of IDs for syncing
        $roleNames = Role::whereIn('id', $inputs['role_id'])->pluck('name')->toArray();
        $user->syncRoles($roleNames);

        foreach ($user->roles as $role) {
          if (!$role->is_child) {
            $rolename = $role->name . $user->id;
            $newrole = Role::updateOrCreate([
              'name' => $rolename,
              'guard_name' => 'web',
              'parent_id' => $role->id,
              'is_child' => true
            ]);

            // Assign the new role to the user
            $user->assignRole($newrole);

            // Transfer permissions from parent role to new role
            $newrole->syncPermissions($role->permissions);

            // Remove the original parent role from the user
            $user->removeRole($role);
          }
        }
        return redirect()->route('users.index',)->withSuccess(__('Data updated'));
      } else {
        abort(403);
      }
    } catch (Exception $ex) {
      return redirect()->route('users.index',)->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
    }
  }

  public function editPermissions(Request $request, $id)
  {
    $site_id = decryptParams($site_id);
    $id = decryptParams($id);
    try {
      $user = $this->userInterface->getById($site_id, $id);
      $roles = $user->roles;

      $directPermissions = ModelsPermission::where('is_custom', true)->orderBy('show_name')->get();
      if ($user && !empty($user)) {
        $data = [
          'site_id' => $site_id,
          'id' => $id,
          'user' => $user,
          'directPermissions' => $directPermissions,
        ];

        return view('app.users.editPermisssions', $data);
      }

      return redirect()->route('users.index', ['site_id' => encryptParams($site_id)])->withWarning(__('lang.commons.data_not_found'));
    } catch (Exception $ex) {
      return redirect()->route('users.index', ['site_id' => encryptParams($site_id)])->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function destroySelected(Request $request)
  {
    try {
      $site_id = decryptParams($site_id);
      if ($request->has('chkUsers')) {
        $ids = $request->get('chkUsers');
        $this->userInterface->destroySelected($ids);
        return redirect()->route('users.index', ['site_id' => encryptParams($site_id)])->withSuccess('User Suspended Successfully');
      } else {
        return redirect()->route('users.index', ['site_id' => encryptParams($site_id)])->withWarning(__('lang.commons.please_select_at_least_one_item'));
      }
    } catch (Exception $ex) {
      return redirect()->route('users.index', ['site_id' => encryptParams($site_id)])->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
    }
  }

  public function makeActive(Request $request, $id)
  {
    try {
      $site_id = decryptParams($site_id);
      $id = decryptParams($id);
      User::find($id)->update(['is_suspended' => false]);

      return redirect()->route('users.index', ['site_id' => encryptParams($site_id)])->withSuccess('User Activated Successfully');
    } catch (Exception $ex) {
      return redirect()->route('users.index', ['site_id' => encryptParams($site_id)])->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
    }
  }

  public function getRoleUser(Request $request)
  {
    if ($request->ajax()) {
      $role_id = $request->get('role_id');
      $roles = Role::where('parent_id', $role_id)->where('is_child', true)->with('users', 'users.media')->get();
      $users = [];
      foreach ($roles as $role) {
        if (count($role->users) > 0) {
          $usr = $role->users->where('is_suspended', false)->first();
          if ($usr) {
            $users[] = [
              'id' => $usr->id,
              'name' => $usr->name,
              'signImage' => Str::length($usr->getFirstMediaUrl('user_signature')) > 0 ? true : false,
              'signUrl' => $usr->getFirstMediaUrl('user_signature'),
            ];
          }
        }
      }
      $data = [
        'users' => $users,
      ];

      return response()->json($data);
    } else {
      abort(403);
    }
  }
}
