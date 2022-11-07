<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class kelasdiaController extends Controller
{
    public function getclass(Request $request)
    {
        $id = $request->input('id');
        $kls = $request->input('kls');

        if($id)
        {
            $matika = Kelas::find($id);

            if($matika)
                return ResponseFormatter::success(
                    $matika,
                    'Data matika berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data kategori matika tidak ada',
                    404
                );
        }

        $matika = Kelas::quaery();

        if($kls)
            $matika->where('kls', 'like', '%' . $kls . '%');

        return ResponseFormatter::success(
            $matika,
            'Data list matika berhasil diambil'
        );

    }
}
