<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\JudulHalaman;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar link.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $links = Link::where('is_active', true)->latest()->get();
        $activeJudul = JudulHalaman::where('is_active', true)->first();

        $pageTitle = $activeJudul->judul ?? 'Kumpulan Link Website';
        $pageDescription = $activeJudul->deskripsi ?? 'Temukan berbagai link menarik dan bermanfaat di bawah ini!';
        $pageAvatar = $activeJudul->images ?? null;

        return view('public', compact('links', 'pageTitle', 'pageDescription', 'pageAvatar'));
    }
}
