<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  //
  public function index()
  {
    $cars = Car::with('category')->paginate(9);
    return view('CarFrontend.index', compact('cars'));
  }

  public function dashboard()
  {
    return view('app.dashboard');
  }
}
