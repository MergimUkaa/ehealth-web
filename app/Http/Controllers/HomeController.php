<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Doctor::with('city')->find(auth()->user()->id);
        return view('pages.doctor-dashboard')->with('user', $user);
    }
}
