<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;

class SubKriteria extends BaseController
{
    protected $subkriteriaModel;
    protected $kriteriaModel;

    public function __construct(){
        $this->subkriteriaModel = new SubKriteriaModel();
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
                'name' => 'Subkriteria',
                'link' => '/sub-kriteria',
            ],
            [
                'name' => 'List',
                'link' => '',
            ],
        ];

        $subkriteria = $this->subkriteriaModel->getWithKriteria();
        // dd($subkriteria);
        
        return view('pages/subkriteria/index' ,[
            'active' => 'SubKriteria',
            'title' => 'SubKriteria',
            'breadcrumbs' => $breadcrumbs,
            'subkriteria' => $subkriteria
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
                'name' => 'SubKriteria',
                'link' => '/sub-kriteria',
            ],
            [
                'name' => 'List',
                'link' => '/sub-kriteria',
            ],
            [
                'name' => 'Add',
                'link' => '',
            ],
        ];
        $kriteria = $this->kriteriaModel->findAll();
        return view('pages/subkriteria/add' ,[
            'active' => 'SubKriteria',
            'title' => 'Add SubKriteria',
            'breadcrumbs' => $breadcrumbs,
            'kriteria' => $kriteria,
        ]);
    }

    public function store(){
        $validation = $this->validate([
            'kriteria_id' => [
                'rules' =>'required',
                'errors' => [
                   'required' => '{field} Tolong dipilih Kriteria',
                ]
            ],
            'nama_subkriteria' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Nama SubKriteria',
                ]
            ],
            'nilai' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Nilai',
                ]
            ],
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $this->subkriteriaModel->save([
            'kriteria_id' => $this->request->getVar('kriteria_id'),
            'nama_subkriteria' => $this->request->getVar('nama_subkriteria'),
            'nilai' => $this->request->getVar('nilai'),
        ]);
        return redirect()->to('/sub-kriteria')->with('success', 'Data berhasil disimpan!');
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
        $subkriteria = $this->subkriteriaModel->getWithKriteriaById($id);
        $kriteria = $this->kriteriaModel->findAll();
        return view('pages/subkriteria/edit', [
            'active' => 'Kriteria',
            'title' => 'Edit Kriteria',
            'breadcrumbs' => $breadcrumbs,
            'subkriteria' => $subkriteria,
            'kriteria' => $kriteria,
        ]);
    }

    public function update($id){
        $validation = $this->validate([
            'kriteria_id' => [
                'rules' =>'required',
                'errors' => [
                   'required' => '{field} Tolong dipilih Kriteria',
                ]
            ],
            'nama_subkriteria' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Nama SubKriteria',
                ]
            ],
            'nilai' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Nilai',
                ]
            ],
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->subkriteriaModel->update($id,[
            'kriteria_id' => $this->request->getVar('kriteria_id'),
            'nama_subkriteria' => $this->request->getVar('nama_subkriteria'),
            'nilai' => $this->request->getVar('nilai'),
        ]);
        return redirect()->to('/sub-kriteria')->with('success', 'Data berhasil diupdate!');
    }

    public function delete()
    {
        $id = $this->request->getPost('id'); // Ambil ID dari form
        if ($id) {
            $model = new SubKriteriaModel();
            if ($model->delete($id)) {
                return redirect()->to('/sub-kriteria')->with('success', 'Data berhasil dihapus');
            } else {
                return redirect()->to('/sub-kriteria')->with('error', 'Data gagal dihapus');
            }
        }

        return redirect()->to('/sub-kriteria')->with('error', 'ID tidak ditemukan');
    }
}