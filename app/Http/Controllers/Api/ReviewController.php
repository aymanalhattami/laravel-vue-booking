<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show($id){
        return new ReviewResource(Review::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|size:36|unique:reviews',
            'content' => 'required|min:2',
            'rating' => 'required|in:1,2,3,4,5'
        ]);

        $booking = Booking::findByReviewKey($data['id']);

        if($booking === null) {
            return abort(404);
        }

        $booking->review_key = '';
        $booking->save();

        $review = Review::make($data);
        $review->booking_id = $booking->id;
        $review->bookable_id = $booking->bookable_id;
        $review->save();

        return new ReviewResource($review);
    }
}
