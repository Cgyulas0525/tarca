<?php

namespace App\Http\Controllers;

use App\Classes\UtalvanyClass;
use App\Http\Requests\CreateUtalvanyRequest;
use App\Http\Requests\UpdateUtalvanyRequest;
use App\Repositories\UtalvanyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Utalvany;

class UtalvanyController extends AppBaseController
{
    /** @var  UtalvanyRepository */
    private $utalvanyRepository;

    public function __construct(UtalvanyRepository $utalvanyRepo)
    {
        $this->utalvanyRepository = $utalvanyRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row) {
                  $btn = '';
                  if (UtalvanyClass::UtalvanyFelhasznalhato($row->id) > 0) {
                      $btn = '<a href="' . route('utalvanies.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                  }
                  if ( UtalvanyClass::UtalvanyTetelSzam($row->id) == 0) {
                      $btn = $btn.'<a href="' . route('utalvanies.destroy', [$row->id]) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                  }
                  return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }


    /**
     * Display a listing of the Utalvany.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Utalvany::all();
                return $this->dwData($data);

            }

            return view('utalvanies.index');
        }
    }

    /**
     * Show the form for creating a new Utalvany.
     *
     * @return Response
     */
    public function create()
    {
        return view('utalvanies.create');
    }

    /**
     * Store a newly created Utalvany in storage.
     *
     * @param CreateUtalvanyRequest $request
     *
     * @return Response
     */
    public function store(CreateUtalvanyRequest $request)
    {
        $input = $request->all();

        $utalvany = $this->utalvanyRepository->create($input);

        return redirect(route('utalvanies.index'));
    }

    /**
     * Display the specified Utalvany.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $utalvany = $this->utalvanyRepository->find($id);

        if (empty($utalvany)) {
            return redirect(route('utalvanies.index'));
        }

        return view('utalvanies.show')->with('utalvany', $utalvany);
    }

    /**
     * Show the form for editing the specified Utalvany.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $utalvany = $this->utalvanyRepository->find($id);

        if (empty($utalvany)) {
            return redirect(route('utalvanies.index'));
        }

        return view('utalvanies.edit')->with('utalvany', $utalvany);
    }

    /**
     * Update the specified Utalvany in storage.
     *
     * @param int $id
     * @param UpdateUtalvanyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUtalvanyRequest $request)
    {
        $utalvany = $this->utalvanyRepository->find($id);

        if (empty($utalvany)) {
            return redirect(route('utalvanies.index'));
        }

        $utalvany = $this->utalvanyRepository->update($request->all(), $id);

        return redirect(route('utalvanies.index'));
    }

    /**
     * Remove the specified Utalvany from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $utalvany = $this->utalvanyRepository->find($id);

        if (empty($utalvany)) {
            return redirect(route('utalvanies.index'));
        }

        $this->utalvanyRepository->delete($id);

        return redirect(route('utalvanies.index'));
    }
}
