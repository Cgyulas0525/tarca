<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUtalvanytetelRequest;
use App\Http\Requests\UpdateUtalvanytetelRequest;
use App\Models\Utalvany;
use App\Repositories\UtalvanytetelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use App\Classes\UtalvanyClass;

use App\Models\Utalvanytetel;

class UtalvanytetelController extends AppBaseController
{
    /** @var  UtalvanytetelRepository */
    private $utalvanytetelRepository;

    public function __construct(UtalvanytetelRepository $utalvanytetelRepo)
    {
        $this->utalvanytetelRepository = $utalvanytetelRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = '<a href="' . route('utalvanytetels.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                  if ( $row->id === UtalvanyClass::utolsoUtalvanyTetel($row->utalvany_id)->id ) {
                      $btn = $btn.'<a href="' . route('utalvanytetels.destroy', [$row->id]) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                  }
                  return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }


    /**
     * Display a listing of the Utalvanytetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Utalvanytetel::all();
                return $this->dwData($data);

            }

            return view('utalvanytetels.index');
        }
    }

    /**
     * Display a listing of the Utalvanytetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function utalvanyTetelIndex(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Utalvanytetel::where('utalvany_id', $id)->get();
                return $this->dwData($data);

            }

            return view('utalvanies.index');

        }
        return view('auth.login');

    }

    /**
     * Show the form for creating a new Utalvanytetel.
     *
     * @return Response
     */
    public function create()
    {
        return view('utalvanytetels.create');
    }

    /**
     * Show the form for creating a new Utalvanytetel.
     *
     * @return Response
     */
    public function createMe($id)
    {
        $utalvany = Utalvany::find($id);
        return view('utalvanytetels.create')->with('utalvany', $utalvany);
    }

    /**
     * Store a newly created Utalvanytetel in storage.
     *
     * @param CreateUtalvanytetelRequest $request
     *
     * @return Response
     */
    public function store(CreateUtalvanytetelRequest $request)
    {
        $input = $request->all();

        $utalvanytetel = $this->utalvanytetelRepository->create($input);

        return redirect(route('utalvanies.edit', $utalvanytetel->utalvany_id));
    }

    /**
     * Display the specified Utalvanytetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $utalvanytetel = $this->utalvanytetelRepository->find($id);

        if (empty($utalvanytetel)) {
            return redirect(route('utalvanytetels.index'));
        }

        return view('utalvanytetels.show')->with('utalvanytetel', $utalvanytetel);
    }

    /**
     * Show the form for editing the specified Utalvanytetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $utalvanytetel = $this->utalvanytetelRepository->find($id);

        if (empty($utalvanytetel)) {
            return redirect(route('utalvanytetels.index'));
        }

        return view('utalvanytetels.edit')->with('utalvanytetel', $utalvanytetel);
    }

    /**
     * Update the specified Utalvanytetel in storage.
     *
     * @param int $id
     * @param UpdateUtalvanytetelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUtalvanytetelRequest $request)
    {
        $utalvanytetel = $this->utalvanytetelRepository->find($id);

        if (empty($utalvanytetel)) {
            return redirect(route('utalvanytetels.index'));
        }

        $utalvanytetel = $this->utalvanytetelRepository->update($request->all(), $id);

        return redirect(route('utalvanies.edit', $utalvanytetel->utalvany_id));
    }

    /**
     * Remove the specified Utalvanytetel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $utalvanytetel = $this->utalvanytetelRepository->find($id);

        if (empty($utalvanytetel)) {
            return redirect(route('utalvanytetels.index'));
        }

        $this->utalvanytetelRepository->delete($id);

        return redirect(route('utalvanytetels.index'));
    }
}
