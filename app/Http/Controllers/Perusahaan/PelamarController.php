<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $angkatan = DB::table('angkatan')->paginate(10);
        $pelamar = DB::table('masyarakat')->select()->get();
        return view('perusahaan.pelamar.index', ['pelamar' => $pelamar]);
    }
}
