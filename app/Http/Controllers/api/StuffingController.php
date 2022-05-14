<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class StuffingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dbView = DB::connection('sqlsrv')->getDatabaseName().'.dbo';
        $viewPpk = DB::connection('sqlsrv2')->table('v_data_header')
            ->leftJoin("$dbView.ppks AS ppks", 'v_data_header.id_ppk', '=', "ppks.id_ppk")
            ->where('v_data_header.kd_kegiatan', 'E')
            ->where("v_data_header.id_trader", $request->id_trader)
            ->where( 'v_data_header.tgl_ppk', '>', Carbon::now()->subDays(4))
            ->select('ppks.*', 'v_data_header.*')
            ->orderBy('v_data_header.tgl_ppk', 'ASC')
            ->get();

        return response()->json($viewPpk );
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
