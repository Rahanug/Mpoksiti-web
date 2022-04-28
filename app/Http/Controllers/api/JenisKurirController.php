<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\JenisKurir;
use Illuminate\Support\Facades\DB;

class JenisKurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kurirs = DB::table('kurir')
                ->select('*')
                ->where('is_active', 1)
                ->get();

        return response()->json($kurirs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('jpps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /*$request->validate([
            'kodeCounter'=>'required',
            'jenisJasper'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'penanggungJawab'=>'required'
        ]);

        $jpp = new Jpp([
            'kodeCounter'=>$request->get('kodeCounter'),
            'jenisJasper'=>$request->get('jenisJasper'),
            'latitude'=>$request->get('latitude'),
            'longitude'=>$request->get('longitude'),
            'penanggungJawab'=>$request->get('penanggungJawab')
        ]);
        $jpp->save();
        return redirect('/jpps')->with('success', 'JPP saved!');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
