<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Jpp;
use Illuminate\Support\Facades\DB;

class JPPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jpps = DB::table('jpps')
                ->select('id', 'kode_counter', 'nama_counter', 'latitude', 'longitude', 'penanggungJawab', 'id_kurir')
                ->get();

        return response()->json($jpps);
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
            'kode_counter'=>'required',
            'jenisJasper'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'penanggungJawab'=>'required'
        ]);

        $jpp = new Jpp([
            'kode_counter'=>$request->get('kode_counter'),
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
