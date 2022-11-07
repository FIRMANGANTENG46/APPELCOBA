<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function getclass()
    {
        $kelas = Kelas::all();
        return ResponseFormatter::success(
            $kelas,
            'Data Kelas Berhasil Diambil'
        );
    }
}
