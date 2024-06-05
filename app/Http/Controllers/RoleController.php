<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\Http\Requests\roles\storeRequest as roleStoreRequest;
use App\Http\Requests\roles\updateRequest as roleUpdateRequest;
use App\Models\Role;
use App\Services\Roles\RoleInterface;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleController extends Controller
{
    private $RoleTypesInterface;

    public function __construct(RoleInterface $RoleTypesInterface)
    {
        $this->RoleTypesInterface = $RoleTypesInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {
        // sleep(2);
        $roles = (new ModelsRole())->where('is_child', false)->inRandomOrder()->limit(5)->get();

        return $dataTable->render('app.roles.index', ['roles' => $roles]);
    }
    public function roles_menu( $id)
    {
        $role = ModelsRole::where('id', $id)->first();
        $data = [
            'site_id' => 1,
            'id' => $role->id,
        ];
        return view('app.roles.actions', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!request()->ajax()) {

            $data = [
                'roles' => $this->RoleTypesInterface->getAllWithTree(),
            ];

            return view('app.roles.create', $data);
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
    public function store(roleStoreRequest $request)
    {
        try {
            $record = (new ModelsRole())->create([
                'name' => $request->role_name,
                'guard_name' => $request->guard_name,
                'parent_id' => $request->parent_id,
            ]);

            return redirect()->route('roles.index')->withSuccess(__('lang.commons.data_saved'));
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $role = (new ModelsRole())->find(decryptParams($id));

            if ($role && !empty($role)) {
                $data = [
                    'roles' => $this->RoleTypesInterface->getAllWithTree(),
                    'role' => $role,
                ];

                return view('app.roles.edit', $data);
            }

            return redirect()->route('roles.index')->withWarning(__('lang.commons.data_not_found'));
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(roleUpdateRequest $request, $id)
    {
        try {

            $record = (new ModelsRole())->find(decryptParams($id))->update([
                'name' => $request->role_name,
                'guard_name' => $request->guard_name,
                'parent_id' => $request->parent_id,
            ]);

            return redirect()->route('roles.index')->withSuccess(__('lang.commons.data_saved'));
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            if ($request->has('chkRole')) {

                (new ModelsRole())->whereIn('id', $request->chkRole)->get()->each(function ($row) {
                    $row->delete();
                });

                return redirect()->route('roles.index')->withSuccess(__('lang.commons.data_deleted'));
            } else {
                return redirect()->route('roles.index')->withWarning(__('lang.commons.please_select_at_least_one_item'));
            }
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }
}
