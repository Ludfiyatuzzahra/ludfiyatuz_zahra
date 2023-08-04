<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => 'active'
            ],
            'baju' => [
                'title' => 'Baju',
                'link' => base_url() . '/baju',
                'icon' => 'fa-solid fa-shirt',
                'aktif' => ''
            ],
            'karyawan' => [
                'title' => 'Karyawan',
                'link' => base_url() . '/karyawan',
                'icon' => 'fa-solid fa-users',
                'aktif' => ''
            ],
            'pembeli' => [
                'title' => 'Pembeli',
                'link' => base_url() . '/pembeli',
                'icon' => 'fa-solid fa-person',
                'aktif' => ''
            ],
        ];
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Selamat Datang di My Website";
        $data['selamat_datang'] = "Aplikasikan fitur dengan baik";
        return view('template/content', $data);
    }
}
