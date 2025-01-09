<?php

namespace App\Controllers;

use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    protected $kriteriaModel;

    public function __construct(){
        $this->kriteriaModel = new KriteriaModel();
    }
    public function index(): string
    {

        $breadcrumbs =
        [
            [
                'name' => 'Kriteria',
                'link' => '/kriteria',
            ],
            [
                'name' => 'List',
                'link' => '',
            ],
        ];

        $kriteria = $this->kriteriaModel->findAll();
        
        return view('pages/kriteria/index' ,[
            'active' => 'Kriteria',
            'title' => 'Kriteria',
            'breadcrumbs' => $breadcrumbs,
            'kriteria' => $kriteria
        ]);
    }

    public function add(){
        $breadcrumbs =
        [
            [
                'name' => 'Kriteria',
                'link' => '/kriteria',
            ],
            [
                'name' => 'List',
                'link' => '/kriteria',
            ],
            [
                'name' => 'Add',
                'link' => '',
            ],
        ];

        return view('pages/kriteria/add' ,[
            'active' => 'Kriteria',
            'title' => 'Add Kriteria',
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function store(){
        $validation = $this->validate([
            'nama_kriteria' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Nama Kriteria',
                ]
            ],
            'jenis_kriteria' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Jenis Kriteria',
                ]
            ],
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $this->kriteriaModel->save([
            'nama_kriteria' => $this->request->getVar('nama_kriteria'),
            'jenis_kriteria' => $this->request->getVar('jenis_kriteria')
        ]);
        return redirect()->to('/kriteria')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id){
        $breadcrumbs =
        [
            [
                'name' => 'Kriteria',
                'link' => '/kriteria',
            ],
            [
                'name' => 'List',
                'link' => '/kriteria',
            ],
            [
                'name' => 'Edit',
                'link' => '',
            ],
        ];
        $kriteria = $this->kriteriaModel->find($id);
        return view('pages/kriteria/edit', [
            'active' => 'Kriteria',
            'title' => 'Edit Kriteria',
            'breadcrumbs' => $breadcrumbs,
            'kriteria' => $kriteria
        ]);
    }

    public function update($id){
        $validation = $this->validate([
            'nama_kriteria' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Nama Kriteria',
                ]
            ],
            'jenis_kriteria' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Jenis Kriteria',
                ]
            ],
        ]);
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->kriteriaModel->update($id,[
            'nama_kriteria' => $this->request->getVar('nama_kriteria'),
            'jenis_kriteria' => $this->request->getVar('jenis_kriteria')
        ]);
        return redirect()->to('/kriteria')->with('success', 'Data berhasil diupdate!');
    }

    public function delete()
    {
        $id = $this->request->getPost('id'); // Ambil ID dari form
        if ($id) {
            $model = new KriteriaModel();
            if ($model->delete($id)) {
                return redirect()->to('/kriteria')->with('success', 'Data berhasil dihapus');
            } else {
                return redirect()->to('/kriteria')->with('error', 'Data gagal dihapus');
            }
        }

        return redirect()->to('/kriteria')->with('error', 'ID tidak ditemukan');
    }
}