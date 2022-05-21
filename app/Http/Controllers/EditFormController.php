<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subform;
use App\Models\MasterSubform;

use function PHPUnit\Framework\isEmpty;

class EditFormController extends Controller
{
    public function index($id_ppk)
    {
        $select = DB::connection('sqlsrv')->table('subform')
            ->where('id_ppk', $id_ppk)
            ->select("urutan", "id_masterSubform", "id_ppk")
            ->get();
        $join = DB::connection('sqlsrv')->table('master_subform')
            ->leftJoin('subform as subform', 'master_subform.id_masterSubform', '=', 'subform.id_masterSubform')
            ->where('subform.id_ppk', $id_ppk)
            ->get(['master_subform.id_masterSubform', 'master_subform.indikator', 'master_subform.tipe_data', 'subform.id_subform', 'subform.urutan']);

        // $list = DB::connection('sqlsrv')->table("master_subform")
        //     ->leftJoin("subform AS s", function($join){
        //         $join->select("urutan", "id_masterSubform", "id_ppk");
        //         $join->on("master_subform.id_masterSubform", "=", "s.id_masterSubform");
        //     })
        //     ->where('s.id_ppk', $id_ppk)
        //     ->select("master_subform.indikator", "s.urutan", "s.id_ppk", "master_subform.tipe_data")
        //     ->get();

        // $list = DB::table('master_subform')
        // ->select('master_subform.indikator', 's.urutan', 's.id_ppk')
        // ->leftJoin((DB::table('subform')
        //     ->select('urutan', 'id_masterSubform', 'id_ppk')
        //     ->where('id_ppk', '=', $id_ppk)), function($join) {
        //         $join->on('master_subform.id_masterSubform','=','subform.id_masterSubform');
        // })
        // ->get();

        $list = DB::table('master_subform')
            ->select('master_subform.indikator', 'master_subform.id_masterSubform', 's.urutan', 's.id_ppk', 'master_subform.tipe_data')
            ->leftJoin(DB::raw(
                '(SELECT urutan, id_masterSubform, id_ppk FROM subform
            WHERE id_ppk = ' . $id_ppk . ') s'
            ), function ($join) {
                $join->on('master_subform.id_masterSubform', '=', 's.id_masterSubform');
            })
            ->get();

        // $list = DB::connection('sqlsrv')->table('master_subform')
        //         ->leftjoinSub("SELECT 'urutan', 'id_ppk', 'id_masterSubform'
        //         FROM subform", 's', function($join){
        //         $join->on('master_subform.id_masterSubform','=','s.id_masterSubform');
        //     })
        //     ->where('s.id_ppk', $id_ppk)
        //     ->select("master_subform.indikator", "s.urutan", "s.id_ppk", "master_subform.tipe_data")
        //     ->get();
        return view('admin.editForm', [
            "title" => 'Edit Form Stuffing',
            "data" => $list,
            "id_ppk" => $id_ppk
        ]);
    }

    public function simpanUrutan(Request $request)
    {
        $add = $request->input('added', []);
        $update = $request->input('updated', []);
        $remove = $request->input('removed', []);
        $id_ppk = $request->input('id_ppk');
        if (!isset($id_ppk)) {
            return json_encode(['status' => false, 'message' => 'id ppk tidak tersedia']);
        }
        if (empty($add) && empty($update) && !empty($remove)) {
            return json_encode(['status' => false, 'message' => 'form tidak boleh kosong']);
        }
        DB::beginTransaction();

        foreach ($remove as $key) {
            Subform::where('id_masterSubform', $key)->delete();
        }

        // Subform::destroy($remove);

        foreach ($add as $key => $value) {
            Subform::insert([
                'urutan' => ++$key,
                'id_masterSubform' => $value,
                'id_ppk' => $id_ppk,
                'visibility' => 'show',
                'value'=>''
            ]);
        }


        foreach ($update as $key => $value) {
            Subform::where('id_masterSubform', $value)
                ->where('id_ppk', $id_ppk)
                ->update([
                    'urutan' => ++$key,
                ]);
        }

        DB::commit();
        return json_encode(['status' => true, 'redirect_url' => url("admin/stuffing/form/$id_ppk")]);
    }
}
