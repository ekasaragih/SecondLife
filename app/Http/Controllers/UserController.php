<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUserProfile($username)
    {
        // Ambil data pengguna berdasarkan username
        $user = User::where('us_name', $username)->firstOrFail();

        // Ambil barang-barang (goods) yang dimiliki oleh pengguna
        $goods = $user->goods;

        // Tampilkan halaman profil pengguna dengan data yang diperlukan
        return view('pages.user.userProfile', ['user' => $user, 'goods' => $goods]);
    }
}

