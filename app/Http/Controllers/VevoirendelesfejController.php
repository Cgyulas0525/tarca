<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVevoirendelesfejRequest;
use App\Http\Requests\UpdateVevoirendelesfejRequest;
use App\Repositories\VevoirendelesfejRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Vevoirendelesfej;
use App\Models\Dictionary;
use App\Models\Partner;
use App\Models\Vevoirendelestetel;
use App\Classes\VevoirendelesClass;

class VevoirendelesfejController extends AppBaseController
{
    /** @var  VevoirendelesfejRepository */
    private $vevoirendelesfejRepository;

    public function __construct(VevoirendelesfejRepository $vevoirendelesfejRepo)
    {
        $this->vevoirendelesfejRepository = $vevoirendelesfejRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
              ->addIndexColumn()

            ->addColumn('pnev', function($data) { return $data->partnernev; })
            ->addColumn('snev', function($data) { return $data->statusznev; })
            ->addColumn('tetelszam', function($data) { return $data->tetelszam; })

            ->addColumn('action', function($row){
                  $btn = '<a href="' . route('vevoirendelesfejs.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                  $btn = $btn.'<a href="' . route('vevoiRendelesTetelInsert', [$row->id]) . '"
                                  class="btn btn-warning btn-sm szamlaFeldolgozas" title="Tételek"><i class="glyphicon glyphicon-list-alt"></i></a>';
                  $btn = $btn.'<a href="' . route('vevoirendelesfejs.destroy', [$row->id]) . '"
                             class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                  $btn = $btn.'<a href="' . route('vevoirendelesKiszallitas', [$row->id]) . '"
                             class="btn btn-info btn-sm deleteProduct" title="Kiszállítás"><i class="glyphicon glyphicon-road"></i></a>';
                  return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }

    public function mindenAdat() {

        return DB::table('vevoirendelesfej')
            ->join('partner', 'partner.id', '=', 'vevoirendelesfej.partner_id')
            ->join('dictionaries', 'dictionaries.id', '=', 'vevoirendelesfej.statusz')
            ->leftJoin('vevoirendelestetel', 'vevoirendelestetel.vevoirendelesfej_id', '=', 'vevoirendelesfej.id')
            ->select( 'vevoirendelesfej.*', 'partner.nev as partnernev', 'dictionaries.nev as statusznev',
                DB::raw("COUNT(vevoirendelestetel.id) as tetelszam"))
            ->whereNull('vevoirendelesfej.deleted_at')
            ->groupBy("vevoirendelesfej.id", 'partner.nev', 'dictionaries.nev')
            ->get();

    }


    /**
     * Display a listing of the Vevoirendelesfej.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->mindenAdat();
                return $this->dwData($data);

            }

            return view('vevoirendelesfejs.index');
        }
    }

    /**
     * Display a listing of the Vevoirendelesfej.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function vevoiRendelesSzurt(Request $request, $statusz)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->mindenAdat();
                return $this->dwData($data->where('statusz', $statusz));

            }

            return view('vevoirendelesfejs.index');
        }
    }

    /**
     * Show the form for creating a new Vevoirendelesfej.
     *
     * @return Response
     */
    public function create()
    {
        return view('vevoirendelesfejs.create');
    }

    /**
     * Store a newly created Vevoirendelesfej in storage.
     *
     * @param CreateVevoirendelesfejRequest $request
     *
     * @return Response
     */
    public function store(CreateVevoirendelesfejRequest $request)
    {
        $input = $request->all();

        if (empty($input['partner_id']) && empty($input['nev'])) {
            Flash::error('Nem adott meg partnert!')->important();
            return back();
        }

        $input['statusz'] = Dictionary::where('tipus', 38)->where('nev', 'Megrendelt')->first()->id;
        $megrendelesSzam = Vevoirendelesfej::max('megrendelesszam');
        if ( !is_null($megrendelesSzam) ) {
            $szam = strval(intval(substr($megrendelesSzam,2)) + 1);
            $input['megrendelesszam'] = 'V-'.str_pad('', 6 - strlen($szam), '0').$szam;

        } else {
            $input['megrendelesszam'] = "V-000001";
        }

        if ( empty($input['partner_id'])) {
            $partner = new Partner;
            $partner->nev = $input['nev'];
            !empty($input['tipus']) ? $partner->tipus = $input['tipus'] : $partner->tipus = 2054;
            $partner->adoszam = $input['adoszam'];
            $partner->bankszamla = $input['bankszamla'];
            !empty($input['isz']) ? $partner->isz = $input['isz'] : $partner->isz = NULL;
            !empty($input['telepules']) ? $partner->telepules = $input['telepules'] : $partner->telepules = NULL;
            $partner->cim = $input['cim'];
            $partner->email = $input['email'];
            $partner->telefonszam = $input['telefonszam'];
            $partner->save();
            $input['partner_id'] = $partner->id;
        }

        $vevoirendelesfej = $this->vevoirendelesfejRepository->create($input);

        return view('vevoirendelestetels.create')->with('id', $vevoirendelesfej['id']);
    }

    /**
     * Display the specified Vevoirendelesfej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vevoirendelesfej = $this->vevoirendelesfejRepository->find($id);

        if (empty($vevoirendelesfej)) {
            return redirect(route('vevoirendelesfejs.index'));
        }

        return view('vevoirendelesfejs.show')->with('vevoirendelesfej', $vevoirendelesfej);
    }

    /**
     * Show the form for editing the specified Vevoirendelesfej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vevoirendelesfej = $this->vevoirendelesfejRepository->find($id);

        if (empty($vevoirendelesfej)) {
            return redirect(route('vevoirendelesfejs.index'));
        }

        return view('vevoirendelesfejs.edit')->with('vevoirendelesfej', $vevoirendelesfej);
    }

    /**
     * Update the specified Vevoirendelesfej in storage.
     *
     * @param int $id
     * @param UpdateVevoirendelesfejRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVevoirendelesfejRequest $request)
    {
        $vevoirendelesfej = $this->vevoirendelesfejRepository->find($id);

        if (empty($vevoirendelesfej)) {
            return redirect(route('vevoirendelesfejs.index'));
        }

        $vevoirendelesfej = $this->vevoirendelesfejRepository->update($request->all(), $id);

        return redirect(route('vevoirendelesfejs.index'));
    }

    /**
     * Remove the specified Vevoirendelesfej from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vevoirendelesfej = $this->vevoirendelesfejRepository->find($id);

        if (empty($vevoirendelesfej)) {
            return redirect(route('vevoirendelesfejs.index'));
        }

        $this->vevoirendelesfejRepository->delete($id);

        return redirect(route('vevoirendelesfejs.index'));
    }

    /**
     * A vevői megrendelés összes tételének kiszállítása, átadott menyyiség állítás
     *
     * @param $id
     *
     * @return Response
     */
    public function kiszallitas($id)
    {
        $vevoirendelesfej = $this->vevoirendelesfejRepository->find($id);

        if (empty($vevoirendelesfej)) {
            return redirect(route('vevoirendelesfejs.index'));
        }

        $vevoirendelestetelek = Vevoirendelestetel::where('vevoirendelesfej_id', $vevoirendelesfej->id)->get();
        if ($vevoirendelestetelek->count() > 0)
        {
            foreach ( $vevoirendelestetelek as $key => $vevoirendelestetel )
            {
                $vevoirendelestetel->atadott = $vevoirendelestetel->mennyiseg;
                $vevoirendelestetel->save();
            }

            $vevoirendelesfej->statusz = 2114;
            $vevoirendelesfej->save();
        }

        return redirect(route('vevoirendelesfejs.index'));

    }

    public function vevoiRendelesNyomtatas()
    {
        $vevoirendelesek = Vevoirendelesfej::where('statusz', 2112)->whereNull('deleted_at')->get();

        if ($vevoirendelesek->count() === 0) {

            Flash::warning('Nincs nyomtatandó tétel!')->important();
            return view('vevoirendelesfejs.index');

        }

        return view('nyomtatas.vevoiRendelesNyomtatas')->with(['vevoirendelesek' => $vevoirendelesek]);

    }

    /**
     * Show the form for creating a new Vevoirendelesfej.
     *
     * @return Response
     */
    public function megrendeltTermek()
    {
        return view('vevoirendelesfejs.megrendelt');
    }

    /**
     * vevői rendelés tétel adatok
     *
     * @param $veg
     *
     * @return Response
     */
    public function megrendeltTermekDarabData($veg) {

        $data = VevoirendelesClass::megrendeltTermekDarab($veg);

        return Datatables::of($data)
        ->addIndexColumn()
        ->make(true);
    }


    /**
     * Vevoirendelestetel a meghatározott napig.
     *
     * @param Request $request
     * @param date $veg
     *
     * @return Response
     */
    public function megrendeltTermekDarab(Request $request, $veg)
    {
        if( Auth::check() ){


            if ($request->ajax()) {

                return $this->megrendeltTermekDarabData($veg);

            }

            return view('vevoirendelesfejs.index');
        }
    }

    /**
     * Vevoirendelestetel a mai napig.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function megrendeltTermekDarabNyito(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $veg = date('Y-m-d', strtotime('today + 10 days'));

                dd($veg);

                $data =  DB::table('vevoirendelesfej as t1')
                    ->join('vevoirendelestetel as t2', 't2.vevoirendelesfej_id', '=', 't1.id' )
                    ->join( 'partner as t3', 't3.id', '=', 't1.partner_id' )
                    ->join( 'termek as t4', 't4.id', '=', 't2.termek_id')
                    ->select(DB::raw('t4.nev as termek, SUM(t2.mennyiseg) as darab'))
                    ->where('t1.mikorra', '<=', $veg)
                    ->whereNull('t1.deleted_at')
                    ->whereNull('t2.deleted_at')
                    ->where('t1.statusz', '!=', 2114)
                    ->groupBy('termek')
                    ->orderBy('termek')
                    ->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);


            }

            return view('vevoirendelesfejs.megrendeltFields');
        }
    }

}
