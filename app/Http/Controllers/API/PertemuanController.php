<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 1000);
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $materis = $request->input('materis');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        if ($id) {
            $pertemuan = Pertemuan::with(['materi', 'galleries'])->find($id);

            if ($pertemuan) {
                return ResponseFormatter::success(
                    $pertemuan,
                    'Data produk berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
            }

        }

        $pertemuan = Pertemuan::with(['materi', 'galleries']);

        if ($name) {
            $pertemuan->where('name', 'like', '%' . $name . '%');
        }

        if ($description) {
            $pertemuan->where('description', 'like', '%' . $description . '%');
        }

        if ($tags) {
            $pertemuan->where('tags', 'like', '%' . $tags . '%');
        }

        if ($price_from) {
            $pertemuan->where('price', '>=', $price_from);
        }

        if ($price_to) {
            $pertemuan->where('price', '<=', $price_to);
        }

        if ($materis) {
            $pertemuan->where('categories_id', $materis);
        }

        return ResponseFormatter::success(
            $pertemuan->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }

//limit dihapus krn membatasi
}
