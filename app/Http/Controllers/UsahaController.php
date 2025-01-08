<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use App\Http\Requests\StoreUsahaRequest;
use App\Http\Requests\UpdateUsahaRequest;

class UsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    public function index()
    {
        // Ambil data dengan pagination
        $usahas = Usaha::latest()->paginate(8);

        // Hitung total usaha
        $totalUsaha = Usaha::count();

        // Kembalikan response dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'List of Usahas',
            'data' => [
                'usahas' => $usahas,
                'totalUsaha' => $totalUsaha
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUsahaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsahaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function show(Usaha $usaha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function edit(Usaha $usaha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsahaRequest  $request
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsahaRequest $request, Usaha $usaha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usaha  $usaha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usaha $usaha)
    {
        //
    }
}
