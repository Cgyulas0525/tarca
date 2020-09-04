<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetermekfocsoportRequest;
use App\Http\Requests\UpdatetermekfocsoportRequest;
use App\Repositories\termekfocsoportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class termekfocsoportController extends AppBaseController
{
    /** @var  termekfocsoportRepository */
    private $termekfocsoportRepository;

    public function __construct(termekfocsoportRepository $termekfocsoportRepo)
    {
        $this->termekfocsoportRepository = $termekfocsoportRepo;
    }

    /**
     * Display a listing of the termekfocsoport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

            $data = DB::table('termekfocsoport')
                        ->join('dictionaries as t1', 't1.id', '=', 'termekfocsoport.tsz')
                        ->select('termekfocsoport.*', 't1.nev as tsz')
                        ->whereNull('termekfocsoport.deleted_at')
                        ->get();

              return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){
                          $btn = '<a href="' . route('termekfocsoports.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                          $btn = $btn.'<a href="' . route('TermekCsoportInsert', [$row->id]) . '"
                                  class="btn btn-warning btn-sm CsoportInsert" title="Költség csoport"><i class="glyphicon glyphicon-list-alt"></i></a>';
    /*                      $btn = $btn.'<a href="' . route('TermekFoCsoportTorles', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';*/
                          return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('termekfocsoports.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new termekfocsoport.
     *
     * @return Response
     */
    public function create()
    {
        return view('termekfocsoports.create');
    }

    /**
     * Store a newly created termekfocsoport in storage.
     *
     * @param CreatetermekfocsoportRequest $request
     *
     * @return Response
     */
    public function store(CreatetermekfocsoportRequest $request)
    {
        $input = $request->all();

        $termekfocsoport = $this->termekfocsoportRepository->create($input);
        return redirect(route('termekfocsoports.create'));
    }

    /**
     * Display the specified termekfocsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $termekfocsoport = $this->termekfocsoportRepository->find($id);

        if (empty($termekfocsoport)) {
            return redirect(route('termekfocsoports.index'));
        }

        return view('termekfocsoports.show')->with('termekfocsoport', $termekfocsoport);
    }

    /**
     * Show the form for editing the specified termekfocsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $termekfocsoport = $this->termekfocsoportRepository->find($id);

        if (empty($termekfocsoport)) {
            return redirect(route('termekfocsoports.index'));
        }

        return view('termekfocsoports.edit')->with('termekfocsoport', $termekfocsoport);
    }

    /**
     * Update the specified termekfocsoport in storage.
     *
     * @param int $id
     * @param UpdatetermekfocsoportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetermekfocsoportRequest $request)
    {
        $termekfocsoport = $this->termekfocsoportRepository->find($id);

        if (empty($termekfocsoport)) {
            return redirect(route('termekfocsoports.index'));
        }

        $termekfocsoport = $this->termekfocsoportRepository->update($request->all(), $id);
        return redirect(route('termekfocsoports.index'));
    }

    /**
     * Remove the specified termekfocsoport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $termekfocsoport = $this->termekfocsoportRepository->find($id);

        if (empty($termekfocsoport)) {
            return redirect(route('termekfocsoports.index'));
        }

        $this->termekfocsoportRepository->delete($id);
        return redirect(route('termekfocsoports.index'));
    }

    public function destroyMe($id)
    {
        $termekfocsoport = $this->termekfocsoportRepository->find($id);

        if (empty($termekfocsoport)) {
            return redirect(route('termekfocsoports.index'));
        }

        $this->termekfocsoportRepository->delete($id);
        return redirect(route('termekfocsoports.index'));
    }

}
