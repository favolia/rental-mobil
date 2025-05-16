<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\Car;

class CarController extends Controller
{
    public function index()
    {
        return view('admin.car_view');
    }
}
