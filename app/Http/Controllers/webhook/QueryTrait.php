<?php

namespace App\Http\Controllers\webhook;

use Illuminate\Support\Facades\DB;

trait QueryTrait
{

    public function selectPPK($pesan)
    {
        // return FlowguideModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->first();
    }

    // NO IJIN/NO SERTIFIKAT

    public function selectIDPPK($no_aju, $idUrut)
    {
        // return FlowguideModel::select('id_ppk')
        return DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('id_ppk')
            ->where('no_aju_ppk', $no_aju)
            ->where(
                'id_urut',
                $idUrut
            )
            ->first();
    }

    public function selectNoSertif($pesan)
    {
        // return RPTHarianModel::select('no_sertifikat')
        return DB::connection('sqlsrv2')
            ->table('v_rpt_ops_harian')
            ->select('no_sertifikat')
            ->where(
                'id_ppk',
                $pesan
            )
            ->first();
    }

    public function getNoIjin($no_aju)
    {
        // $idUrut = FlowguideModel::select('id_urut')
        $idUrut = DB::connection('sqlsrv2')
            ->table('v_for_flowguide')
            ->select('id_urut')

            // == BAHAYA ==
            // ->where('nm_dok', 'Single Certificate')
            // == BAHAYA ==

            ->where('no_aju_ppk', $no_aju)
            ->first();


        $IDPPK = $this->selectIDPPK($no_aju, $idUrut->id_urut);
        if (isset($IDPPK->id_ppk)) {
            return $this->selectNoSertif($IDPPK->id_ppk);
        } else {
            return false;
        }
    }

    // PNBP HARIAN
    public function selectIDPPKPNBP($no_aju)
    {
        // return RPTPNBPHarianModel::select('id_ppk')
        return DB::connection('sqlsrv2')
            ->table('tr_mst_pelaporan')
            ->select('id_ppk')
            ->where('no_aju_ppk', $no_aju)
            ->first();
    }

    public function selectTarif($no_aju)
    {
        $idPPK = $this->selectIDPPKPNBP($no_aju);
        // return RPTPNBPHarianModel::select('kel_tarif', 'total')
        return DB::connection('sqlsrv2')
            ->table('v_rpt_pnbp_harian_new')
            ->select('kel_tarif', 'total')
            ->where(
                'id_ppk',
                $idPPK->id_ppk
            )
            ->get();
    }

    public function selectPPKPNBP($pesan)
    {
        // return RPTPNBPHarianModel::select('no_aju_ppk')
        return DB::connection('sqlsrv2')
            ->table('tr_mst_pelaporan')
            ->select('no_aju_ppk')
            ->where('no_aju_ppk', $pesan)
            ->first();
    }
}