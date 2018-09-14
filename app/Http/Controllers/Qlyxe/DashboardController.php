<?php

namespace App\Http\Controllers\Qlyxe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_data;

    public function index(Request $request){
    	return view('qlyxe.layouts.dashboard');
    }
}
