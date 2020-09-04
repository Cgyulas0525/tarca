<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateszamlatetelRequest;
use App\Http\Requests\UpdateszamlatetelRequest;
use App\Repositories\szamlatetelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class szamlatetelController extends AppBaseController
{
    /** @var  szamlatetelRepository */
    private $szamlatetelRepository;

    public function __construct(szamlatetelRepository $szamlatetelRepo)
    {
        $this->szamlatetelRepository = $szamlatetelRepo;
    }

    /**
     * Display a listing of the szamlatetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

            $data = DB::table('szamlatetel')
                        ->join('termek as p1', 'p1.id', '=', 'szamlatetel.termek')
                        ->join('koltsegcsoport as p2', 'p2.id', '=', 'szamlatetel.koltseg')
                        ->join('dictionaries as p3', 'p3.id', '=', 'szamlatetel.afaszaz')
                        ->select('szamlatetel.*', 'p1.nev as tnev', 'p2.nev as knev', 'p3.nev as afanev')
                        ->whereNull('szamlatetel.deleted_at')
                        ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="' . route('szamlatetels.edit', [$row->id]) . '"
                                   class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                        $btn = $btn.'<a href="' . route('SzamlaTetelTorles', [$row->id]) . '"
                                   class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
          }

          return view('szamlas.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new szamlatetel.
     *
     * @return Response
     */
    public function create()
    {
        return view('szamlatetels.create');
    }

    public function createMe($id)
    {
        return view('szamlatetels.createMe')->with('id', $id);
    }

    /**
     * Store a newly created szamlatetel in storage.
     *
     * @param CreateszamlatetelRequest $request
     *
     * @return Response
     */
    public function store(CreateszamlatetelRequest $request)
    {
        $input = $request->all();

        $szamlatetel = $this->szamlatetelRepository->create($input);
        return view('szamlatetels.createMe')->with('id', $input['szamla']);
    }

    /**
     * Display the specified szamlatetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $szamlatetel = $this->szamlatetelRepository->find($id);

        if (empty($szamlatetel)) {
            return redirect(route('szamlatetels.index'));
        }

        return view('szamlatetels.show')->with('szamlatetel', $szamlatetel);
    }

    /**
     * Show the form for editing the specified szamlatetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $szamlatetel = $this->szamlatetelRepository->find($id);

        if (empty($szamlatetel)) {
            return redirect(route('szamlatetels.index'));
        }

        return view('szamlatetels.edit')->with('szamlatetel', $szamlatetel);
    }

    /**
     * Update the specified szamlatetel in storage.
     *
     * @param int $id
     * @param UpdateszamlatetelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateszamlatetelRequest $request)
    {
        $szamlatetel = $this->szamlatetelRepository->find($id);

        if (empty($szamlatetel)) {
            return redirect(route('szamlas.index'));
        }

        $szamlatetel = $this->szamlatetelRepository->update($request->all(), $id);
        return redirect(route('szamlas.index'));
    }

    /**
     * Remove the specified szamlatetel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $szamlatetel = $this->szamlatetelRepository->find($id);

        if (empty($szamlatetel)) {
            return redirect(route('szamlatetels.index'));
        }

        $this->szamlatetelRepository->delete($id);
        return redirect(route('szamlatetels.index'));
    }

    public function destroyMe($id)
    {
        $szamlatetel = $this->szamlatetelRepository->find($id);

        if (empty($szamlatetel)) {
            return redirect(route('szamlatetels.index'));
        }

        $this->szamlatetelRepository->delete($id);
        return redirect(route('szamlatetels.index'));
    }

}
