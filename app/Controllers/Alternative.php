<?php

namespace App\Controllers;

use App\Models\AlternativeModel;

class Alternative extends BaseController
{
    protected $alternativeModel;

    public function __construct(){
        $this->alternativeModel = new AlternativeModel();
    }
    public function index(): string
    {

        $breadcrumbs =
        [
            [
                'name' => 'Alternative',
                'link' => '/alternative',
            ],
            [
                'name' => 'List',
                'link' => '',
            ],
        ];

        $alternative = $this->alternativeModel->findAll();
        
        return view('pages/alternative/index' ,[
            'active' => 'Alternative',
            'title' => 'Alternative',
            'breadcrumbs' => $breadcrumbs,
            'alternative' => $alternative
        ]);
    }

    public function add(){
        $breadcrumbs =
        [
            [
                'name' => 'Alternative',
                'link' => '/alterative',
            ],
            [
                'name' => 'List',
                'link' => '/alternative',
            ],
            [
                'name' => 'Add',
                'link' => '',
            ],
        ];

        return view('pages/alternative/add' ,[
            'active' => 'Alternative',
            'title' => 'Add Alternative',
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function store(){
       
        $validation = $this->validate([
            'nama_alternative' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Nama Alternative',
                ]
            ],
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $this->alternativeModel->save([
            'nama_alternative' => $this->request->getVar('nama_alternative'),
        ]);
        return redirect()->to('/alternative')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id){
        $breadcrumbs =
        [
            [
                'name' => 'Alternative',
                'link' => '/alternative',
            ],
            [
                'name' => 'List',
                'link' => '/alternative',
            ],
            [
                'name' => 'Edit',
                'link' => '',
            ],
        ];
        $alternative = $this->alternativeModel->find($id);
        return view('pages/alternative/edit', [
            'active' => 'alternative',
            'title' => 'Edit alternative',
            'breadcrumbs' => $breadcrumbs,
            'alternative' => $alternative
        ]);
    }

    public function update($id){
        $validation = $this->validate([
            'nama_alternative' => [
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} Tolong isi Nama Alternative',
                ]
            ],
        ]);
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->alternativeModel->update($id,[
            'nama_alternative' => $this->request->getVar('nama_alternative'),
        ]);
        return redirect()->to('/alternative')->with('success', 'Data berhasil diupdate!');
    }

    public function delete()
    {
        $id = $this->request->getPost('id'); // Ambil ID dari form
        if ($id) {
            $model = new AlternativeModel();
            if ($model->delete($id)) {
                return redirect()->to('/alternative')->with('success', 'Data berhasil dihapus');
            } else {
                return redirect()->to('/alternative')->with('error', 'Data gagal dihapus');
            }
        }

        return redirect()->to('/alternative')->with('error', 'ID tidak ditemukan');
    }
}