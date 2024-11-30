<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index()
    {
        return view("customer.checkout");
    }

    public function invoice()
    {
        return view("customer.confirmation");
    }
}
