<?php

namespace App\Controllers;

use App\Models\BobotModel;

class Bobot extends BaseController
{
    protected $bobotModel;

    public function __construct(){
        $this->bobotModel = new BobotModel();
    }
    public function index(): string
    {

        $breadcrumbs =
        [
            [
                'name' => 'Gap',
                'link' => '/bobot',
            ],
            [
                'name' => 'List',
                'link' => '',
            ],
        ];

        $bobot = $this->bobotModel->findAll();
        
        return view('pages/bobot/index' ,[
            'active' => 'Bobot',
            'title' => 'Gap',
            'breadcrumbs' => $breadcrumbs,
            'bobot' => $bobot
        ]);
    }

    public function add(){
        $breadcrumbs =
        [
            [
                'name' => 'Gap',
                'link' => '/bobot',
            ],
            [
                'name' => 'List',
                'link' => '/bobot',
            ],
            [
                'name' => 'Add',
                'link' => '',
            ],
        ];

        return view('pages/bobot/add' ,[
            'active' => 'Bobot',
            'title' => 'Add Gap',
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function store(){
        $validation = $this->validate([
            'selisih' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tolong isi Selisih',
                ]
            ],
            'nilai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tolong isi Nilai',
                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} Tolong isi Nilai',
                    'min_length' => '{field} minimal 5 karakter'
                ]
            ],
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $this->bobotModel->save([
            'selisih' => $this->request->getVar('selisih'),
            'nilai' => $this->request->getVar('nilai'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);
        return redirect()->to('/bobot')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id){
        $breadcrumbs =
        [
            [
                'name' => 'Gap',
                'link' => '/bobot',
            ],
            [
                'name' => 'List',
                'link' => '/bobot',
            ],
            [
                'name' => 'Edit',
                'link' => '',
            ],
        ];
        $bobot = $this->bobotModel->find($id);
        return view('pages/bobot/edit', [
            'active' => 'Bobot',
            'title' => 'Edit Gap',
            'breadcrumbs' => $breadcrumbs,
            'bobot' => $bobot
        ]);
    }

    public function update($id){
        $validation = $this->validate([
            'selisih' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tolong isi Selisih',
                ]
            ],
            'nilai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tolong isi Nilai',
                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} Tolong isi Nilai',
                    'min_length' => '{field} minimal 5 karakter'
                ]
            ],
        ]);
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->bobotModel->update($id,[
            'selisih' => $this->request->getVar('selisih'),
            'nilai' => $this->request->getVar('nilai'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);
        return redirect()->to('/bobot')->with('success', 'Data berhasil diupdate!');
    }

    public function delete()
    {
        $id = $this->request->getPost('id'); // Ambil ID dari form
        if ($id) {
            $model = new BobotModel();
            if ($model->delete($id)) {
                return redirect()->to('/bobot')->with('success', 'Data berhasil dihapus');
            } else {
                return redirect()->to('/bobot')->with('error', 'Data gagal dihapus');
            }
        }

        return redirect()->to('/bobot')->with('error', 'ID tidak ditemukan');
    }
}