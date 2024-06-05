<?php

namespace App\Http\Controllers;

use App\DataTables\CarBrandDatatable;
use App\DataTables\CarbrandsDatatable;
use App\Models\CarBrand;
use App\Models\CarCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CarBrandController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(CarBrandDatatable $dataTable)
  {
    $data = [
      'createPermission' =>  Auth::user()->can('car-brands.create'),
    ];
    return $dataTable->with($data)->render('app.car-brands.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    if (!request()->ajax()) {
      return view('app.car-brands.create');
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
      'name' => ['required', 'string', 'unique:car_brands']
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = CarBrand::create([
      'name' => $data['name'],
      'slug' => Str::of($data['name'])->slug(),
      'status' => true,
    ]);
    return redirect()->route('car-brands.index')->withSuccess(__('Data saved successfully'));
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
      $carBrand = (new CarBrand())->find(decryptParams($id));

      $data = [
        'carBrand' => $carBrand,
      ];

      return view('app.car-brands.edit', $data);


      return redirect()->route('car-brands.index')->withWarning(__('lang.commons.data_not_found'));
    } catch (Exception $ex) {
      return redirect()->route('car-brands.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
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
      'name' => ['required', 'string', 'unique:car_brands,name,' . $id],
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
      $carCategory = (new CarBrand())->find($id);
      $carCategory->update([
        'name' => $data['name'],
        'slug' => Str::of($data['name'])->slug(),
      ]);
      return redirect()->route('car-brands.index')->withWarning(__('lang.commons.data_not_found'));
    } catch (Exception $ex) {
      return redirect()->route('car-brands.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
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
    $user = CarBrand::where('id', $id)->first();
    $data = [
      'id' => $user->id,
      'editPermission' => Auth::user()->hasPermissionTo('car-brands.edit'),
      // 'is_suspended' => $user->is_suspended,
      // 'edituserPermission' => Auth::user()->hasPermissionTo('users.edit')
    ];
    return view('app.car-brands.actions', $data);
  }
}
