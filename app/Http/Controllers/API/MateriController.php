<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class MateriController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 100);
        $name = $request->input('name');
        $show_pertemuan = $request->input('show_pertemuan');

        if($id)
        {
            $materi = Materi::with(['pertemuans'])->find($id);

            if($materi)
                return ResponseFormatter::success(
                    $materi,
                    'Data materi berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data kategori materi tidak ada',
                    404
                );
        }

        $materi = Materi::query();

        if($name)
            $materi->where('name', 'like', '%' . $name . '%');

        if($show_pertemuan)
            $materi->with('pertemuans');

        return ResponseFormatter::success(
            $materi->paginate($limit),
            'Data list materi berhasil diambil'
        );
    }
}
