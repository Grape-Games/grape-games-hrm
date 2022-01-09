<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivitiesInvokeController extends Controller
{
    public function __invoke()
    {
        return view('pages.activites.index');
    }
}
