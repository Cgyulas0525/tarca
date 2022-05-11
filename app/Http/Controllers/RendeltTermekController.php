<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Classes\VevoirendelesClass;

class RendeltTermekController extends Controller
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

    public function dwData($veg)
    {
        return  VevoirendelesClass::megrendeltTermekDarab($veg);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $veg = date('Y-m-d', strtotime('today + 10 days'));
                $data = $this->dwData($veg);

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);

            }

            return view('vevoirendelesfejs.megrendelt');
        }
    }

    public function rendeltTermekNyomtatas($veg)
    {
        $termekek = $this->dwData($veg);

        if ($termekek->count() === 0) {

            Flash::warning('Nincs nyomtatandó tétel!')->important();
            return view('rendelttermek');

        }

        return view('nyomtatas.rendeltTermekNyomtatas')->with(['termekek' => $termekek,
                                                                    'mikorra' => $veg]);

    }

}
