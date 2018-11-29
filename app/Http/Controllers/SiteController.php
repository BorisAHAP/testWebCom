<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private $data = [];

    public function index()
    {
        $this->data['reviews'] = Review::getReviewUserRating();
        $this->data['ratings'] = Rating::all();
        return view('index', $this->data);
    }

}
