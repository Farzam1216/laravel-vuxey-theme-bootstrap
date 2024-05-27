<?php

namespace App\Http\Controllers;

use App\DataTables\CarCategoriesDatatable;
use App\Models\CarCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CarCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(CarCategoriesDatatable $dataTable)
  {
    $data = [
      'createPermission' =>  Auth::user()->can('car-categories.create'),
    ];
    return $dataTable->with($data)->render('app.car-categories.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    if (!request()->ajax()) {
      return view('app.car-categories.create');
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
    //
    $data = $request->all();
    $validator = Validator::make($data, [
      'name' => ['required', 'string', 'unique:car_categories']
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = CarCategory::create([
      'name' => $data['name'],
      'slug' => Str::of($data['name'])->slug(),
      'status' => true,
    ]);
    return redirect()->route('car-categories.index')->withSuccess(__('Data saved successfully'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CarCategory  $carCategory
   * @return \Illuminate\Http\Response
   */
  public function show(CarCategory $carCategory)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CarCategory  $carCategory
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
    try {
      $carCategory = (new CarCategory())->find(decryptParams($id));

      $data = [
        'carCategory' => $carCategory,
      ];

      return view('app.car-categories.edit', $data);


      return redirect()->route('car-categories.index')->withWarning(__('lang.commons.data_not_found'));
    } catch (Exception $ex) {
      return redirect()->route('car-categories.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\CarCategory  $carCategory
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
    $id = decryptParams($id);
    $data = $request->all();
    $validator = Validator::make($data, [
      'name' => ['required', 'string', 'unique:car_categories,name,' . $id],
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
      $carCategory = (new CarCategory())->find($id);
      $carCategory->update([
        'name' => $data['name'],
        'slug' => Str::of($data['name'])->slug(),
      ]);
      return redirect()->route('car-categories.index')->withWarning(__('lang.commons.data_not_found'));
    } catch (Exception $ex) {
      return redirect()->route('car-categories.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CarCategory  $carCategory
   * @return \Illuminate\Http\Response
   */
  public function destroy(CarCategory $carCategory)
  {
    //
  }

  public function menu($id)
  {
    $user = CarCategory::where('id', $id)->first();
    $data = [
      'id' => $user->id,
      'editPermission' => Auth::user()->hasPermissionTo('car-categories.edit'),
      // 'is_suspended' => $user->is_suspended,
      // 'edituserPermission' => Auth::user()->hasPermissionTo('users.edit')
    ];
    return view('app.car-categories.actions', $data);
  }
}
