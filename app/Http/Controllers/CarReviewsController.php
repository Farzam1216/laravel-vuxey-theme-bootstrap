<?php

namespace App\Http\Controllers;

use App\Models\CarReviews;
use Illuminate\Http\Request;

class CarReviewsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
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
    // Validate the incoming request data
    $request->validate([
      'rating' => 'required|integer|min:1|max:5',
      'comment' => 'required|string|max:255',
    ]);

    // Create a new review instance
    $review = new CarReviews();
    $review->user_id = auth()->user()->id; // Assuming the user is authenticated
    $review->rating = $request->rating;
    $review->car_id = $request->car_id;
    $review->comment = $request->comment;
    $review->save();

    // Optionally, you can redirect the user back with a success message
    return redirect()->back()->with('success', 'Thank you for your review!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CarReviews  $carReviews
   * @return \Illuminate\Http\Response
   */
  public function show(CarReviews $carReviews)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CarReviews  $carReviews
   * @return \Illuminate\Http\Response
   */
  public function edit(CarReviews $carReviews)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\CarReviews  $carReviews
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, CarReviews $carReviews)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CarReviews  $carReviews
   * @return \Illuminate\Http\Response
   */
  public function destroy(CarReviews $carReviews)
  {
    //
  }
}
