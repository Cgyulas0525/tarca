<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateszamlaRequest;
use App\Http\Requests\UpdateszamlaRequest;
use App\Repositories\szamlaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class szamlaController extends AppBaseController
{
    /** @var  szamlaRepository */
    private $szamlaRepository;

    public function __construct(szamlaRepository $szamlaRepo)
    {
        $this->szamlaRepository = $szamlaRepo;
    }

    /**
     * Display a listing of the szamla.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

            $data = DB::table('szamla')
                        ->join('partner as p1', 'p1.id', '=', 'szamla.partner')
                        ->join('dictionaries as p2', 'p2.id', '=', 'szamla.fizitesimod')
                        ->select('szamla.*', 'p1.nev as pnev', 'p2.nev as fiznev')
                        ->whereNull('szamla.deleted_at')
                        ->get();

              return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){
                          $btn = '<a href="' . route('szamlas.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                          $btn = $btn.'<a href="' . route('SzamlaTetelInsert', [$row->id]) . '"
                                  class="btn btn-warning btn-sm SzamlaTetelInsert" title="Számla tétel"><i class="glyphicon glyphicon-list-alt"></i></a>';
                          $btn = $btn.'<a href="' . route('SzamlaTorles', [$row->id]) . '"
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
     * Show the form for creating a new szamla.
     *
     * @return Response
     */
    public function create()
    {
        return view('szamlas.create');
    }

    /**
     * Store a newly created szamla in storage.
     *
     * @param CreateszamlaRequest $request
     *
     * @return Response
     */
    public function store(CreateszamlaRequest $request)
    {
        $input = $request->all();

        $szamla = $this->szamlaRepository->create($input);
        return redirect(route('szamlas.index'));
    }

    /**
     * Display the specified szamla.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        return view('szamlas.show')->with('szamla', $szamla);
    }

    /**
     * Show the form for editing the specified szamla.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        return view('szamlas.edit')->with('szamla', $szamla);
    }

    /**
     * Update the specified szamla in storage.
     *
     * @param int $id
     * @param UpdateszamlaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateszamlaRequest $request)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        $szamla = $this->szamlaRepository->update($request->all(), $id);
        return redirect(route('szamlas.index'));
    }

    /**
     * Remove the specified szamla from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        $this->szamlaRepository->delete($id);
        return redirect(route('szamlas.index'));
    }

    public function destroyMe($id)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        $this->szamlaRepository->delete($id);
        return redirect(route('szamlas.index'));
    }
}
