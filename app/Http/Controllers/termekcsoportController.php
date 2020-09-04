<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetermekcsoportRequest;
use App\Http\Requests\UpdatetermekcsoportRequest;
use App\Repositories\termekcsoportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class termekcsoportController extends AppBaseController
{
    /** @var  termekcsoportRepository */
    private $termekcsoportRepository;

    public function __construct(termekcsoportRepository $termekcsoportRepo)
    {
        $this->termekcsoportRepository = $termekcsoportRepo;
    }

    /**
     * Display a listing of the termekcsoport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

              $data = DB::table('termekcsoport')
                            ->join('termekfocsoport AS p1', 'p1.id', 'termekcsoport.focsoport' )
                            ->select('termekcsoport.*', 'p1.nev as tnev')
                            ->whereNull('termekcsoport.deleted_at')
                            ->get();

              return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){
                          $btn = '<a href="' . route('termekcsoports.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                          $btn = $btn.'<a href="' . route('TermekCsoportTorles', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                          return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('termekcsoports.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new termekcsoport.
     *
     * @return Response
     */
    public function create()
    {
        return view('termekcsoports.create');
    }

    public function createMe($id)
    {
        return view('termekcsoports.createMe')->with('id', $id);
    }

    /**
     * Store a newly created termekcsoport in storage.
     *
     * @param CreatetermekcsoportRequest $request
     *
     * @return Response
     */
    public function store(CreatetermekcsoportRequest $request)
    {
        $input = $request->all();

        $termekcsoport = $this->termekcsoportRepository->create($input);
        return view('termekcsoports.createMe')->with('id', $input['focsoport']);
    }

    /**
     * Display the specified termekcsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekcsoports.index'));
        }

        return view('termekcsoports.show')->with('termekcsoport', $termekcsoport);
    }

    /**
     * Show the form for editing the specified termekcsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekcsoports.index'));
        }

        return view('termekcsoports.edit')->with('termekcsoport', $termekcsoport);
    }

    /**
     * Update the specified termekcsoport in storage.
     *
     * @param int $id
     * @param UpdatetermekcsoportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetermekcsoportRequest $request)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekfocsoports.index'));
        }

        $termekcsoport = $this->termekcsoportRepository->update($request->all(), $id);
        return redirect(route('termekfocsoports.index'));
    }

    /**
     * Remove the specified termekcsoport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekcsoports.index'));
        }

        $this->termekcsoportRepository->delete($id);
        return redirect(route('termekcsoports.index'));
    }

    public function destroyMe($id)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekcsoports.index'));
        }

        $this->termekcsoportRepository->delete($id);
        return redirect(route('termekcsoports.index'));
    }

}
