<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class kelasController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 12);
        $kls = $request->input('kls');

        if($id)
        {
            $kelas = Kelas::with(['users'])->find($id);

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

        $kelas = Kelas::query();

        if($kls)
            $kelas->where('kls', 'like', '%' . $kls . '%');
        
        return ResponseFormatter::success(
            $kelas->paginate($limit),
            'Data list kelas berhasil diambil'
        );

    }
}