<?php

namespace App\Http\Controllers;

use App\DataTables\CarBookingTable;
use App\Models\Car;
use App\Models\CarBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
    $user = Auth::user();
    $car = Car::find($id);
    $cars = Car::where('id', '!=', $car->id)->with('category')->paginate(3);
    $rentalCount = CarBooking::where('user_id', $user->id)
      ->where('created_at', '>=', Carbon::now()->subMonth())
      ->count();
    return view('CarFrontend.car-single', compact('car', 'cars', 'rentalCount'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'user_id' => 'required|exists:users,id',
      'car_id' => 'required|exists:cars,id',
      'rent_type' => 'required|in:per_day,per_km',
      'total_km' => 'required_if:rent_type,per_km|nullable|numeric|min:1',
      'pick_up_date' => 'required|date|after_or_equal:today',
      'drop_off_date' => 'required|date|after_or_equal:pick_up_date',
      'pickup_location' => 'required|string|max:255',
      'dropoff_location' => 'required|string|max:255',
      // 'pickup_time' => 'required|date_format:H:i',
      'car_rate' => 'required|numeric|min:0',
      'total_fare' => 'required|numeric|min:0',
    ]);

    $data = $request->all();

    // Additional logic for calculating fare and applying discount
    $user = auth()->user();
    $car = Car::findOrFail($data['car_id']);

    if ($data['rent_type'] === 'per_day') {
      $days = (new \DateTime($data['drop_off_date']))->diff(new \DateTime($data['pick_up_date']))->days + 1;
      $data['total_fare'] = $days * $car->full_day_rate_with_fuel;
    } else {
      $data['total_fare'] = $data['total_km'] * $car->rate_per_km;
    }

    // Apply discount if applicable
    $currentMonthRentals = CarBooking::where('user_id', $user->id)
      ->whereMonth('created_at', now()->month)
      ->count();

    if ($currentMonthRentals > 2) {
      $data['total_fare'] *= 0.9; // Apply 10% discount
    }

    // Store the booking
    $booking = CarBooking::create($data);

    return redirect()->route('user-bookings')->with('success', 'Car booking created successfully.');
  }

  // public function index()
  // {
  //     $bookings = CarBooking::where('user_id', auth()->id())->get();
  //     return view('bookings.index', compact('bookings'));
  // }

  public function show($id)
  {
    $booking = CarBooking::where('user_id', auth()->id())->findOrFail($id);
    return view('bookings.show', compact('booking'));
  }

  public function details(CarBookingTable $dataTable)
  {
    $data = [
      'createPermission' => false,
    ];
    return $dataTable->with($data)->render('car-booking', $data);
  }

  public function USerBookings()
  {
    return view('CarFrontend/car-booking-details');
  }
}
