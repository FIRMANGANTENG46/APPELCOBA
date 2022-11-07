<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\kelas;

class kelasdiaController extends Controller
{
    public function getclass(Request $request)
    {
        $id = $request->input('id');
        $kls = $request->input('kls');

        if($id)
        {
            $matika = kelas::find($id);

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

        $matika = kelas::quaery();

        if($kls)
            $matika->where('kls', 'like', '%' . $kls . '%');

        return ResponseFormatter::success(
            $matika,
            'Data list matika berhasil diambil'
        );

    }
}
