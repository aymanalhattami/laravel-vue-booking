<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookableIndexResource;
use App\Http\Resources\BookableShowResource;
use Illuminate\Http\Request;
use App\Models\Bookable;

class BookableController extends Controller
{
    public function index(){
        return BookableIndexResource::collection(Bookable::all());
    }

    public function show($bookableId){
        return new BookableShowResource(Bookable::findorFail($bookableId));
    }
}
