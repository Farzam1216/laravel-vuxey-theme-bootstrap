<?php

namespace App\Http\Controllers;

use App\DataTables\CarBookingTable;
use App\Models\Car;
use App\Models\CarBooking;
use Illuminate\Http\Request;

class CarBookingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($id)
  {
    //
    $car = Car::find($id);
    $cars = Car::where('id', '!=', $car->id)->with('category')->paginate(3);
    return view('CarFrontend.car-single', compact('car', 'cars'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
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

    $data = [
      'car_id' => $request->car_id,
      'user_id' => $request->user_id,
      'pick_up_location' => $request->pickup_location,
      'drop_off_location' => $request->dropoff_location,
      'pick_up_date' => $request->pick_up_date,
      'drop_off_date' => $request->dropp_of_date,
      'rate' => $request->car_rate,
      'discount_rate' => $request->car_rate,
      // 'status' => $request->user_id,
      'date' => now(),
    ];

    CarBooking::create($data);

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CarBooking  $carBooking
   * @return \Illuminate\Http\Response
   */
  public function show(CarBooking $carBooking)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CarBooking  $carBooking
   * @return \Illuminate\Http\Response
   */
  public function edit(CarBooking $carBooking)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\CarBooking  $carBooking
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, CarBooking $carBooking)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CarBooking  $carBooking
   * @return \Illuminate\Http\Response
   */
  public function destroy(CarBooking $carBooking)
  {
    //
  }

  public function details(CarBookingTable $dataTable)
  {
    $data = [
      'createPermission' => false,
    ];
    return $dataTable->with($data)->render('car-booking', $data);
  }
}
