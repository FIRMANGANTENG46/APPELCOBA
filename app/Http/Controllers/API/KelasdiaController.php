<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function kelas(Request $request)
    {
        $id = $request->input('id');
        $kls = $request->input('kls');

        if($id)
        {
            $kelas = Kelas::find($id);

            if($kelas)
                return ResponseFormatter::success(
                    $kelas,
                    'Data kelas berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data kategori kelas tidak ada',
                    404
                );
        }

        $kelas = Kelas::quaery();

        if($kls)
            $kelas->where('kls', 'like', '%' . $kls . '%');

        return ResponseFormatter::success(
            $kelas,
            'Data list matika berhasil diambil'
        );

    }
}
