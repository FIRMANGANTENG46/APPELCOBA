<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kelans;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class KelasController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $kelas = $request->input('kelas');

        if ($id) {
            $kelas = Kelans::find($id);

            if ($kelas) {
                return ResponseFormatter::success(
                    $kelas,
                    'Data produk berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data kategori produk tidak ada',
                    404
                );
            }

        }

        $kelasdata = Kelans::all();

        return ResponseFormatter::success(
            $kelasdata,
            'Data list kategori produk berhasil diambil'
        );
    }
}
