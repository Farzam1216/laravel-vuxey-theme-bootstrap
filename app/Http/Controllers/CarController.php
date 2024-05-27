<?php

namespace App\Http\Controllers;

use App\DataTables\CarDatatable;
use App\Models\Car;
use App\Models\CarCategory;
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
      ];
      return view('app.cars.create',$data);
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
  public function edit(Car $car)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Car  $car
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Car $car)
  {
    //
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
    $user = Car::where('id', $id)->first();
    $data = [
      'id' => $user->id,

    ];
    return view('app.cars.actions', $data);
  }
}
