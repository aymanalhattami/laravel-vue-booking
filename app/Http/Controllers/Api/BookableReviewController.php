<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookableIndexResource;
use App\Http\Resources\BookableReviewIndexResource;
use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);

        return BookableReviewIndexResource::collection(
            $bookable->reviews()->latest()->get()
        );
    }
}
