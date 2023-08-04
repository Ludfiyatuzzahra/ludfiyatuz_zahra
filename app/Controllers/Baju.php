<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BajuModel;

class Baju extends BaseController
{
        
    protected $bm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->bm = new BajuModel();
        $this->menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => ''
            ],
            'baju' => [
                'title' => 'Baju',
                'link' => base_url() . '/baju',
                'icon' => 'fa-solid fa-shirt',
                'aktif' => 'active'
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
        $this->rules = [
            'id_baju' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID baju tidak boleh kosong',
                ]
            ],
            'nama' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'ukuran' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ukuran tidak boleh kosong',
                ]
            ],
            'harga'    =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga tidak boleh kosong',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Baju</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">Baju</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Data Baju';

        $query = $this->bm->find();
        $data['data_baju'] = $query;
        return view('baju/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Baju</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/baju">Baju</a></li>
                            <li class="breadcrumb-item active">Input Baju</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Tambah Baju";
        $data['action'] = base_url() . '/baju/simpan';
        return view('baju/input', $data);
    }

    public function simpan()
    {
        if (strtolower($this->request->getMethod()) !== 'post') {

            return redirect()->back()->withInput();
        }
        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        $dt = $this->request->getPost();

        try {
            $simpan = $this->bm->insert($dt);
            return redirect()->to('baju')->with('success', 'Data Baju Tersimpan');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function hapus($id)
    {
        if (empty($id)) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
        try {
            $this->bm->delete($id);
            return redirect()->to('baju')->with('success', 'Data baju dengan kode ' . $id . ' berhasil di hapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('baju')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Baju</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/baju">Baju</a></li>
                            <li class="breadcrumb-item active">Edit Baju</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Edit Baju";
        $data['action'] = base_url() . '/baju/update';
        $data['edit_data'] = $this->bm->find($id);
        return view('baju/input', $data);
    }

    public function update()
    {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['harga']);

        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }

        if (empty($dtEdit['harga'])) {
            unset($dtEdit['harga']);
        }

        try {
            $this->bm->update($param, $dtEdit);
            return redirect()->to('baju')->with('success', 'Data berhasil diperbarui');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
