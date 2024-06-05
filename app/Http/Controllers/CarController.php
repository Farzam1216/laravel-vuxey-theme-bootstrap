<?php

namespace App\Http\Controllers;

use App\DataTables\CarDatatable;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(CarDatatable $dataTable)
  {
    // dd(Car::find(3)->media);
    $data = [
      'createPermission' =>  Auth::user()->can('cars.create'),
    ];
    return $dataTable->with($data)->render('app.cars.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    if (!request()->ajax()) {
      $data = [
        'categories' => CarCategory::all(),
        'brands' => CarBrand::all(),
        'users' => User::all(),

      ];
      return view('app.cars.create', $data);
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
    // dd($request->all());

    $inputs = $request->all();

    $data = [
      'category_id' => $request->category_id,
      'owner_id' => $request->owner_id,
      'brand_id' => $request->brand_id,
      'name' => $request->name,
      'reg_no' => $request->registration_no,
      'color' => $request->color,
      'model' => $request->model,
      // 'owner_name' => $request->owner_name,
      // 'owner_contact_no' => $request->owner_contact_no,
      // 'owner_email' => $request->owner_email ?? null,

      // 'description' => $,
      'full_day_rate_with_fuel' => $request->full_day_rate_with_fuel,
      'full_day_rate_without_fuel' => $request->full_day_rate_without_fuel,
      // 'full_day_rate_with_driver',
      // 'full_day_rate_without_driver',
      'per_km_rate_with_fuel' => $request->per_km_rate_with_fuel,
      'per_km_rate_without_fuel' => $request->per_km_rate_without_fuel,
      'longitude' => $request->longitude,
      'latitude' => $request->latitude,
      'sale_price' => $request->sale_price,
      'discounted_sale_price' => $request->discounted_sale_price,
      'available_for_sale' => $request->available_for_sale,

    ];

    $car = Car::create($data);


    if (isset($inputs['photo_attachment']) && count($inputs['photo_attachment']) > 0) {
      for ($i = 0; $i < count($inputs['photo_attachment']); $i++) {
        $attachmentPath = getFilePath($inputs['photo_attachment'][$i]);
        if (file_exists($attachmentPath)) {
          $car->addMedia($attachmentPath)->preservingOriginal()->toMediaCollection('photo_attachment');
        }
        changeImageDirectoryPermission();
      }
    }

    if (isset($inputs['other_attachments']) && count($inputs['other_attachments']) > 0) {
      for ($i = 0; $i < count($inputs['other_attachments']); $i++) {
        $attachmentPath = getFilePath($inputs['other_attachments'][$i]);
        if (file_exists($attachmentPath)) {
          $car->addMedia($attachmentPath)->preservingOriginal()->toMediaCollection('other_attachments');
        }
        changeImageDirectoryPermission();
      }
    }

    return redirect()->route('cars.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Car  $car
   * @return \Illuminate\Http\Response
   */
  public function show(Car $car)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Car  $car
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
    $car = Car::find(decryptParams($id));
    $data = [
      'car' => $car,
      'categories' => CarCategory::get(),
      'brands' => CarBrand::get(),
      'users' => User::get(),
    ];
    return view('app.cars.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Car  $car
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $car = Car::find((decryptParams($id)));
    //
    //

    $inputs = $request->all();
    $data = [
      'category_id' => $request->category_id,
      'owner_id' => $request->owner_id,
      'brand_id' => $request->brand_id,
      'name' => $request->name,
      'reg_no' => $request->registration_no,
      'color' => $request->color,
      'model' => $request->model,

      // 'description' => $,
      'full_day_rate_with_fuel' => $request->full_day_rate_with_fuel,
      'full_day_rate_without_fuel' => $request->full_day_rate_without_fuel,
      // 'full_day_rate_with_driver',
      // 'full_day_rate_without_driver',
      'per_km_rate_with_fuel' => $request->per_km_rate_with_fuel,
      'per_km_rate_without_fuel' => $request->per_km_rate_without_fuel,
      'longitude' => $request->longitude,
      'latitude' => $request->latitude,
      'sale_price' => $request->sale_price,
      'discounted_sale_price' => $request->discounted_sale_price,
      'available_for_sale' => $request->available_for_sale,

    ];

    $car->update($data);


    $car->clearMediaCollection('photo_attachment');
    if (isset($inputs['photo_attachment']) && count($inputs['photo_attachment']) > 0) {
      for ($i = 0; $i < count($inputs['photo_attachment']); $i++) {
        $attachmentPath = getFilePath($inputs['photo_attachment'][$i]);
        if (file_exists($attachmentPath)) {
          $car->addMedia($attachmentPath)->preservingOriginal()->toMediaCollection('photo_attachment');
        }
        changeImageDirectoryPermission();
      }
    }

    $car->clearMediaCollection('other_attachments');

    if (isset($inputs['other_attachments']) && count($inputs['other_attachments']) > 0) {
      for ($i = 0; $i < count($inputs['other_attachments']); $i++) {
        $attachmentPath = getFilePath($inputs['other_attachments'][$i]);
        if (file_exists($attachmentPath)) {
          $car->addMedia($attachmentPath)->preservingOriginal()->toMediaCollection('other_attachments');
        }
        changeImageDirectoryPermission();
      }
    }

    return redirect()->route('cars.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Car  $car
   * @return \Illuminate\Http\Response
   */
  public function destroy(Car $car)
  {
    //
  }

  public function menu($id)
  {
    $car = Car::where('id', $id)->first();
    $data = [
      'id' => $car->id,
    ];
    return view('app.cars.actions', $data);
  }

  public function location($id)
  {
    $car = Car::where('id', $id)->first();
    $data = [
      'id' => $car->id,
      'latitude' => $car->latitude,
      'longitude' => $car->longitude,
      'car' => $car,
    ];
    return view('CarFrontend/carLocation', $data);
  }

  public function CarForSale()
  {
    return view('CarFrontend/car-for-sale');
  }
}