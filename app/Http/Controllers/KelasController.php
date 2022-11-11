<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelans;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Kelans::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.user.show', $item->id) . '">
                            Show
                        </a>
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
     * @return \Illuminate\Http\Response
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
    public function store(Request $request)
    {
        $data = $request->all();

        Kelans::create($data);

        return redirect()->route('dashboard.kelas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelans  $kelans
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Kelans $kelas)
    {
        // $kelas = Kelans::with(['user'])->findOrFail($kelas->id);

        // return view('pages.dashboard.kelas.show', compact('kelas'));

        // if (request()->ajax()) {
        //     $query = Kelans::with('user')->where('id', $kelas->id);

        //     return DataTables::of($query)
        //         ->addColumn('action', function ($item) {
        //             return '
        //                 <a class="inline-block px-2 py-1 m-1 text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
        //                     href="' . route('dashboard.kelas.edit', $item->id) . '">
        //                     Edit
        //                 </a>
        //                 <form class="inline-block" action="' . route('dashboard.kelas.destroy', $item->id) . '" method="POST">
        //                 <button class="px-2 py-1 m-2 text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
        //                     Hapus
        //                 </button>
        //                     ' . method_field('delete') . csrf_field() . '
        //                 </form>';
        //         })
        //         ->editColumn('price', function ($item) {
        //             return number_format($item->price);
        //         })
        //         ->rawColumns(['action'])
        //         ->make();
        // }

        // return view('pages.dashboard.kelas.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelans  $kelans
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function edit($id)
    {
        $item = Kelans::findOrFail($id);

        return view('pages.dashboard.kelas.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelans  $kelans
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Kelans::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard.kelas.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelans  $kelans
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = Kelans::findOrFail($id);

        $item->delete();

        return redirect()->route('dashboard.kelas.index');
    }
}
