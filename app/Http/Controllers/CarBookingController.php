<?php

namespace App\Http\Controllers;

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
    return view('CarFrontend.car-single', compact('car' ,'cars'));
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
}
