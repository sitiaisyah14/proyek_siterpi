<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Farm;
use App\Models\Feed;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $today = Carbon::now()->translatedFormat('l');
        $date = Carbon::now()->format("d F, Y");

        $cowsold = Farm::where('status','Terjual')->count();
        $cownotsold = Farm::where('status','Belum Terjual')->count();

        $feed = Feed::all();
        $medicine = Drug::all();

        $data = [
            'today' => $today,
            'date' => $date,
            'cowsold' => $cowsold,
            'cownotsold' => $cownotsold,
            'feed' => $feed,
            'medicine' => $medicine
        ];

        return view('home', $data);
    }

    public function getFeed($id) {
        $loadData = Feed::find($id);
        return response()->json($loadData);
    }

    public function getMedicine($id) {
        $loadData = Drug::find($id);
        return response()->json($loadData);
    }

}
