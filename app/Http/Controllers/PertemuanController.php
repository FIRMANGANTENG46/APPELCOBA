<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use Illuminate\Support\Str;
use App\Http\Requests\PertemuanRequest;
use App\Models\Materi;
use App\Models\PertemuanGallery;
use Yajra\DataTables\Facades\DataTables;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Pertemuan::with('materi');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="inline-block px-2 py-1 m-1 text-white transition duration-500 bg-blue-700 border border-blue-700 rounded-md select-none ease hover:bg-blue-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.pertemuan.gallery.index', $item->id) . '">
                            Gallery
                        </a>
                        <a class="inline-block px-2 py-1 m-1 text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.pertemuan.edit', $item->id) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.pertemuan.destroy', $item->id) . '" method="POST">
                        <button class="px-2 py-1 m-2 text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->editColumn('price', function ($item) {
                    return number_format($item->price);
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.pertemuan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materis = Materi::all();
        return view('pages.dashboard.pertemuan.create', compact('materis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PertemuanRequest $request)
    {
        $data = $request->all();

        Pertemuan::create($data);

        return redirect()->route('dashboard.pertemuan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pertemuan  $pertemuan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Pertemuan $pertemuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pertemuan  $pertemuan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Pertemuan $pertemuan)
    {
        $materis = Materi::all();
        return view('pages.dashboard.pertemuan.edit',[
            'item' => $pertemuan,
            'materis' => $materis
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pertemuan  $pertemuan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PertemuanRequest $request, Pertemuan $pertemuan)
    {
        $data = $request->all();

        $pertemuan->update($data);

        return redirect()->route('dashboard.pertemuan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pertemuan  $pertemuan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pertemuan $pertemuan)
    {
        $pertemuan->delete();

        return redirect()->route('dashboard.pertemuan.index');
    }
}
