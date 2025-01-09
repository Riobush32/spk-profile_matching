<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\AlternativeModel;
use App\Models\SubKriteriaModel;

class Penilaian extends BaseController
{
    protected $subkriteriaModel;
    protected $alternativeModel;
    protected $penilaianModel;
    protected $kriteriaModel;

    public function __construct(){
        $this->subkriteriaModel = new SubKriteriaModel();
        $this->alternativeModel = new AlternativeModel();
        $this->penilaianModel = new PenilaianModel();
        $this->kriteriaModel = new KriteriaModel();
    }

    public function index(){
        $breadcrumbs =
        [
            [
                'name' => 'Penilaian',
                'link' => '/penilaian',
            ],
            [
                'name' => 'List',
                'link' => '',
            ],
        ];

        $alternative = $this->alternativeModel->findAll();
        $subKriteria = $this->subkriteriaModel->getWithKriteria();
        $penilaian = $this->penilaianModel->getWithAlternatifAndSubKriteria();
        $kriteria = $this->kriteriaModel->findAll();

        // Susun data
        $results = [];
        foreach ($alternative as $alt) {
            $row = ['nama_alternative' => $alt['nama_alternative']];
            $hasSubkriteria = false; // Menandai apakah ada subkriteria yang terisi untuk alternatif ini

            foreach ($kriteria as $kri) {
                $nilai = null;
                foreach ($penilaian as $pen) {
                    if ($pen['alternative_id'] == $alt['id'] && $pen['id'] == $kri['id']) {
                        $nilai = $pen['nilai'];
                        break;
                    }
                }

                $row['kriteria_' . $kri['id']] = $nilai ?? '-';
                
                // Jika ada nilai subkriteria, tandai hasSubkriteria menjadi true
                if ($nilai !== null) {
                    $hasSubkriteria = true;
                }
            }

            // Jika ada setidaknya satu subkriteria yang terisi, tambahkan baris ke $results
            if ($hasSubkriteria) {
                $row['actions'] = '<a href="/penilaian/edit/' . $alt['id'] . '" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center "><i class="fa-solid fa-pen-to-square "></i></a>
                                <button  data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-id="' . $alt['id'] . '" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5"><i class="fa-solid fa-trash"></i></button>';
                $results[] = $row;
            }
        }


        
        // dd($results);
        return view('pages/penilaian/index' ,[
            'active' => 'Penilaian',
            'title' => 'Penilaian',
            'breadcrumbs' => $breadcrumbs,
            'results' => $results,
            'kriteria' => $kriteria
        ]);
    }

    public function add(){
        $breadcrumbs =
        [
            [
                'name' => 'Penilaian',
                'link' => '/penilian',
            ],
            [
                'name' => 'List',
                'link' => '/penilaian',
            ],
            [
                'name' => 'Add',
                'link' => '',
            ],
        ];

        $kriteria = $this->kriteriaModel->findAll();
        $subkriteria = $this->subkriteriaModel->getWithKriteria();
        $alternative = $this->alternativeModel->findAll();
        // dd($this->subkriteriaModel);
        
        return view('pages/penilaian/add' ,[
            'active' => 'Penilaian',
            'title' => 'Add Penilaian',
            'breadcrumbs' => $breadcrumbs,
            'alternative' => $alternative,
            'sub_kriteria' => $subkriteria,
            'sub_kriteria_model' => $this->subkriteriaModel,
            'kriteria' => $kriteria
        ]);
    }

    public function store(){
        $kriteria = $this->kriteriaModel->findAll();
        $validasiKriteria = [];

        // Tambahkan validasi untuk setiap subkriteria
        foreach ($kriteria as $value) {
            $validasiKriteria['subkriteria_' . $value['id']] = [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tolong dipilih subkriteria ' . $value['nama_kriteria'],
                ],
            ];
        }

        // Tambahkan validasi untuk alternatif
        $validasiKriteria['alternative'] = [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tolong dipilih Kriteria',
            ],
        ];

        // Gunakan validasi
        if (!$this->validate($validasiKriteria)) {
            // Tangani kesalahan validasi
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // dd($this->request->getVar());
        foreach($kriteria as $key =>$value){
            $this->penilaianModel->save([
                'alternative_id' =>$this->request->getVar('alternative'),
                'sub_kriteria_id' => $this->request->getVar('subkriteria_'.$value['id'])
            ]);
        }
        return redirect()->to('/penilaian')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id){
        $breadcrumbs =
        [
            [
                'name' => 'Penilaian',
                'link' => '/penilian',
            ],
            [
                'name' => 'List',
                'link' => '/penilaian',
            ],
            [
                'name' => 'Edit',
                'link' => '',
            ],
        ];
        $penilaian = $this->penilaianModel->getPenilaianWithAlternative($id);
        $kriteria = $this->kriteriaModel->findAll();
        $subkriteria = $this->subkriteriaModel->getWithKriteria();
        $alternative = $this->alternativeModel->findAll();        
        
        return view('pages/penilaian/edit', [
            'active' => 'Penilaian',
            'title' => 'Edit Penilaian',
            'breadcrumbs' => $breadcrumbs,
            'penilaian' => $penilaian,
            'alternative' => $alternative,
            'sub_kriteria' => $subkriteria,
            'sub_kriteria_model' => $this->subkriteriaModel,
            'kriteria' => $kriteria,
        ]);
    }

    public function update($id){
        $penilaian = $this->penilaianModel->getPenilaianWithAlternative($id);
        $kriteria = $this->kriteriaModel->findAll();
        $validasiKriteria = [];

        // Tambahkan validasi untuk setiap subkriteria
        foreach ($kriteria as $value) {
            $validasiKriteria['subkriteria_' . $value['id']] = [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tolong dipilih subkriteria ' . $value['nama_kriteria'],
                ],
            ];
        }

        // Tambahkan validasi untuk alternatif
        $validasiKriteria['alternative'] = [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tolong dipilih Kriteria',
            ],
        ];
        
        // Gunakan validasi
        if (!$this->validate($validasiKriteria)) {
            // Tangani kesalahan validasi
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        foreach($penilaian as $key =>$value){
            $this->penilaianModel->update($value['id'],[
                'alternative_id' =>$this->request->getVar('alternative'),
                'sub_kriteria_id' => $this->request->getVar('subkriteria_'.$value['id'])
            ]);
        }
        return redirect()->to('/penilaian')->with('success', 'Data berhasil disimpan!');
    }

    public function delete() {
        $alternative_id = $this->request->getPost('id'); // Ambil ID dari form
        // dd($alternative_id);
        if ($alternative_id) {
            $model = new PenilaianModel();
            if ($model->where('alternative_id', $alternative_id)->delete()) {
                return redirect()->to('/penilaian')->with('success', 'Data berhasil dihapus');
            } else {
                return redirect()->to('/penilaian')->with('error', 'Data gagal dihapus');
            }
        }

        return redirect()->to('/penilaian')->with('error', 'ID tidak ditemukan');
    }
}