<?php

namespace App\Http\Controllers;

use App\Exports\ReviewExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{

    public function allReviews()
    {
        return Excel::download(new ReviewExport,'AllReview.xlsx');
    }

}
