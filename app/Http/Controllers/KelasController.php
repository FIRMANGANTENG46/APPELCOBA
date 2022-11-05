<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequset;
use App\Models\kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = kelas::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="inline-block px-2 py-1 m-1 text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.kelas.edit', $item->id) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.kelas.destroy', $item->id) . '" method="POST">
                        <button class="px-2 py-1 m-2 text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })

                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Responsee
     */
    public function create()
    {
        return view('pages.dashboard.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(KelasRequset $request)
    {
        $data = $request->all();

        kelas::create($data);

        return redirect()->route('dashboard.kelas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(kelas $kelas)
    {
        return view('pages.dashboard.kelas.edit', [
            'item' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(KelasRequset $request, kelas $kelas)
    {
        $data = $request->all();

        $kelas->update($data);

        return redirect()->route('dashboard.kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('dashboard.kelas.index');
    }
}
