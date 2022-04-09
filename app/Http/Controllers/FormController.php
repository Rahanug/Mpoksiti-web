<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\vDataHeader;
use App\Models\Subform;
use Exception;
use Symfony\Component\Console\Input\Input;

class FormController extends Controller
{
    public function index(Request $request, $id_ppk)
    {
        $join = Subform::join('master_subform', 'subform.id_masterSubform', '=', 'master_subform.id_masterSubform')->where('subform.id_ppk', $id_ppk)
            ->get(['master_subform.id_masterSubform', 'master_subform.indikator', 'master_subform.tipe_data', 'subform.id_subform']);
        return view('admin.form_stuffing', [
            "title" => 'Form Hasil Stuffing',
            "data" => $join,
            "ppk" => $id_ppk,
        ]);
    }

    public function storeSubform(Request $request, $id_ppk)
    {
        $join = Subform::join('master_subform', 'subform.id_masterSubform', '=', 'master_subform.id_masterSubform')->where('subform.id_ppk', $id_ppk)
            ->get(['master_subform.id_masterSubform', 'master_subform.indikator', 'master_subform.tipe_data', 'subform.id_subform']);
        try {
            $input = $this->getDataInput($request, $id_ppk) ?? [];
        } catch (Exception $e) {
            return redirect()->back()->with('Error', $e->getMessage())->withInput();
        }
        if (!empty($input)) {
            DB::beginTransaction();
            foreach ($input as $i) {
                Subform::where('id_subform', $i['idsubform'])->update([
                    'value'=>$i['value'],
                    'keterangan'=>$i['keterangan']
                ]);
            }

            DB::commit();
            return redirect('/admin/stuffing')->with('Success', 'Form telah diisi!!!!!!!!!!!');
        }
    }

    private function getDataInput(Request $request, $id_ppk)
    {
        $join = Subform::join('master_subform', 'subform.id_masterSubform', '=', 'master_subform.id_masterSubform')->where('subform.id_ppk', $id_ppk)
            ->get(['master_subform.id_masterSubform', 'master_subform.indikator', 'master_subform.tipe_data', 'subform.id_subform']);
        $input = array();
        foreach ($join as $j) {
            $data['value'] = $request->input("input-$j->id_masterSubform-$j->id_subform");
            $data['keterangan'] = $request->input("keterangan-$j->id_masterSubform-$j->id_subform", null);
            $data['idsubform'] = $j->id_subform;

            if ($j->tipe_data == 'kondisi') {
                if ($data['value'] == 'Tidak Sesuai') {
                    if (!isset($data['keterangan'])) {
                        throw new Exception('Semua Indikator harus diisi');
                        break;
                    }
                }
            } else {
                if (!isset($data['value'])) {
                    throw new Exception('Semua Indikator harus diisi');
                    break;
                }
            }
            $input[] = $data;
        }
        return $input;
    }
    // select leftjoin master m (select urutan id_master from subform where id_ppk = id_ppk) s on m.id_master = s.id_master

}
