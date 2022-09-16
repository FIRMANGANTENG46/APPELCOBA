<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use Illuminate\Http\Request;
use App\Models\PertemuanGallery;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\PertemuanGalleryRequest;

class PertemuanGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pertemuan $pertemuan)
    {
        if (request()->ajax()) {
            $query = PertemuanGallery::where('pertemuans_id', $pertemuan->id);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <form class="inline-block" action="' . route('dashboard.gallery.destroy', $item->id) . '" method="POST">
                        <button class="px-2 py-1 m-2 text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->editColumn('url', function ($item) {
                    return '<img style="max-width: 150px;" src="'. $item->url .'"/>';
                })
                ->editColumn('is_featured', function ($item) {
                    return $item->is_featured ? 'Yes' : 'No';
                })
                ->rawColumns(['action', 'url'])
                ->make();
        }

        return view('pages.dashboard.gallery.index', compact('pertemuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pertemuan $pertemuan)
    {
        return view('pages.dashboard.gallery.create', compact('pertemuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PertemuanGalleryRequest $request, Pertemuan $pertemuan)
    {
        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {
                $path = $file->store('public/gallery');

                PertemuanGallery::create([
                    'pertemuans_id' => $pertemuan->id,
                    'url' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.pertemuan.gallery.index', $pertemuan->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PertemuanGallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(PertemuanGallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PertemuanGallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(PertemuanGallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PertemuanGallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(PertemuanGalleryRequest $request, PertemuanGallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PertemuanGallery  $pertemuanGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(PertemuanGallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('dashboard.pertemuan.gallery.index', $gallery->pertemuans_id);
    }
}
