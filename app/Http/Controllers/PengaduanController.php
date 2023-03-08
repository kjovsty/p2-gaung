<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pengaduans = Pengaduan::all();
        return view('pengaduan.index', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        return view('pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'isi_laporan' => 'required|min:10',
            'foto'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ],[
            'isi_laporan.required' => 'isi laporan wajib di isi',
            'isi_laporan.min'      => 'isi laporan minimal 10 karakter',
            'foto.required'        => 'foto wajib di isi',
            'foto.image'           => 'wajib foto dengan ekstensi .jpg , .jpeg , .png',
            'foto.max'             => 'maksimal size 2MB'
        ]);
        
        $path = $request->file('foto')->store('public/img');

        //
       Pengaduan::create([
            'user_id'       => Auth::user()->id,
            'tgl_pengaduan' => Carbon::now()->format('Y-m-d'),
            'isi_laporan'   => $request->isi_laporan,
            'foto'          => $path,
            'status'        => '0'
        ]);
        return redirect('/pengaduan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
        $pengaduans = Pengaduan::find($pengaduan->id);
        return view('pengaduan.show', compact('pengaduans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */

     public function edit(Pengaduan $pengaduan)
     {
         //
         $pengaduans = Pengaduan::find($pengaduan->id);
         return view('pengaduan.edit', compact('pengaduans'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
        // $request->validate([
        //     'isi_laporan' => 'reqired|min:10',
        //     'foto'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        // ]);

        $pengaduan->update([
            'isi_laporan' => $request->isi_laporan,
        ]);
        
        return redirect('/pengaduan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
        $pengaduans = Pengaduan::find($pengaduan->id);
        $pengaduan->delete();
        return redirect('/pengaduan');
    }
}