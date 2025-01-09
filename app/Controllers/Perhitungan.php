<?php

namespace App\Controllers;

use App\Models\BobotModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\AlternativeModel;
use App\Models\SubKriteriaModel;
use App\Controllers\BaseController;

class Perhitungan extends BaseController
{
    protected $bobotModel;
    protected $kriteriaModel;
    protected $subkriteriaModel;
    protected $alternativeModel;
    protected $penilaianModel;

    public function __construct(){
        $this->bobotModel = new BobotModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->subkriteriaModel = new SubKriteriaModel();
        $this->alternativeModel = new AlternativeModel();
        $this->penilaianModel = new PenilaianModel();
    }
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Perhitungan', 'link' => '/perhitungan'],
            ['name' => 'List', 'link' => ''],
        ];

        $kriterias = $this->kriteriaModel->findAll();

        if ($this->request->getVar()) {
            // Validasi input kriteria
            $this->validateKriteria($kriterias);

            // Ambil data alternatif
            $alternatives = $this->alternativeModel->findAll();

            // Proses penghitungan
            $subkriteria_id = $this->getSubkriteriaInput($kriterias);
            $nilai_standar = $this->getNilaiStandar($subkriteria_id);
            $hasil_selisih = $this->calculateSelisih($alternatives, $nilai_standar);
            $nilai_gap = $this->calculateGAP($alternatives, $kriterias, $hasil_selisih);
            $avg_factor = $this->calculateFactors($nilai_gap);
            $final_score = $this->calculateFinalScore($avg_factor, $this->request->getVar('factor'));
            $hasil_akhir = $this->getHasilAkhir($final_score);
            $results = $this->getPenilaianResults($alternatives, $kriterias);
            // dd($nilai_gap);


            // Tampilkan hasil
            return view('pages/perhitungan/index', [
                'active' => 'Perhitungan',
                'title' => 'Proses',
                'breadcrumbs' => $breadcrumbs,
                'kriterias' => $kriterias,
                'sub_kriteria_model' => $this->subkriteriaModel,
                'proses' => true,
                'nilai_standar' => $nilai_standar,
                'core_factor' => $this->request->getVar('factor'),
                'hasil_selisih' => $hasil_selisih,
                'nilai_gap' => $nilai_gap,
                'final_score' => $final_score,
                'hasil_akhir' => $hasil_akhir,
                'results' => $results,
            ]);
        }

        // Jika tidak ada data POST
        return view('pages/perhitungan/index', [
            'active' => 'Perhitungan',
            'title' => 'Proses',
            'breadcrumbs' => $breadcrumbs,
            'kriterias' => $kriterias,
            'sub_kriteria_model' => $this->subkriteriaModel,
            'proses' => false,
        ]);
    }

    private function validateKriteria($kriterias)
    {
        $validasiKriteria = [];
        foreach ($kriterias as $value) {
            $validasiKriteria['kriteria_' . $value['id']] = [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tolong dipilih kriteria ' . $value['nama_kriteria'],
                ],
            ];
        }

        if (!$this->validate($validasiKriteria)) {
            return redirect()->to('/perhitungan')->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    private function getSubkriteriaInput($kriterias)
    {
        $subkriteria_id = [];
        foreach ($kriterias as $kriteria) {
            $subkriteria_id[] = [
                'id' => $this->request->getVar('kriteria_' . $kriteria['id']),
                'jenis' => $kriteria['jenis_kriteria'],
            ];
        }
        return $subkriteria_id;
    }

    private function getNilaiStandar($subkriteria_id)
    {
        $nilai_standar = [];
        foreach ($subkriteria_id as $sub) {
            $nilai_sub_kriteria = $this->subkriteriaModel->find($sub['id']);
            $nilai_standar[] = [
                'subkriteria_id' => $sub['id'],
                'nama_subkriteria' => $nilai_sub_kriteria['nama_subkriteria'],
                'nilai' => $nilai_sub_kriteria['nilai'],
            ];
        }
        return $nilai_standar;
    }

    private function calculateSelisih($alternatives, $nilai_standar)
    {
        $hasil_selisih = [];
        foreach ($alternatives as $alt) {
            $nilai_alternatives = $this->penilaianModel->getPenilaianWithAlternative($alt['id']);
            $selisih = [];
            foreach ($nilai_alternatives as $index => $nilai) {
                if (isset($nilai_standar[$index])) {
                    $selisih[] = $nilai['nilai'] - $nilai_standar[$index]['nilai'];
                }
            }
            $hasil_selisih[] = [
                'alternative_id' => $alt['id'],
                'alternative' => $alt['nama_alternative'],
                'selisih' => $selisih,
            ];
        }
        return $hasil_selisih;
    }

    private function calculateGAP($alternatives, $kriterias, $hasil_selisih)
    {
        $nilai_gap = [];
        foreach ($alternatives as $index => $alternative) {
            $gap = [];
            foreach ($kriterias as $key => $kriteria) {
                $nilai = $this->bobotModel->bobotNilaiWithSelisih($hasil_selisih[$index]['selisih'][$key]);
                $gap[] = [
                    'nilai' => $nilai['nilai'],
                    'jenis_kriteria' => $kriteria['jenis_kriteria'],
                ];
            }
            $nilai_gap[] = [
                'alternative_id' => $alternative['id'],
                'alternative' => $alternative['nama_alternative'],
                'gap' => $gap,
            ];
        }
        return $nilai_gap;
    }

    private function calculateFactors($nilai_gap)
    {
        $avg_factor = [];
        foreach ($nilai_gap as $value) {
            $core_data = [];
            $secondary_data = [];
            foreach ($value['gap'] as $gap_value) {
                if ($gap_value['jenis_kriteria'] === 'Core Factor') {
                    $core_data[] = $gap_value['nilai'];
                }
                if ($gap_value['jenis_kriteria'] === 'Secondary Factor') {
                    $secondary_data[] = $gap_value['nilai'];
                }
            }
            $avg_factor[] = [
                'alternative_id' => $value['alternative_id'],
                'alternative' => $value['alternative'],
                'avg_core' => array_sum($core_data) / count($core_data),
                'avg_secondary' => array_sum($secondary_data) / count($secondary_data),
            ];
        }
        return $avg_factor;
    }

    private function calculateFinalScore($avg_factor, $core_factor_weight)
    {
        $secondary_factor_weight = 100 - $core_factor_weight;
        $final_score = [];
        foreach ($avg_factor as $factor) {
            $score = (($core_factor_weight / 100) * $factor['avg_core']) +
                    (($secondary_factor_weight / 100) * $factor['avg_secondary']);
            $final_score[] = [
                'alternative_id' => $factor['alternative_id'],
                'alternative' => $factor['alternative'],
                'score' => $score,
            ];
        }
        return $final_score;
    }

    private function getHasilAkhir($final_score)
    {
        $max_score = max(array_column($final_score, 'score'));
        return array_filter($final_score, function ($value) use ($max_score) {
            return $value['score'] === $max_score;
        });
    }

    private function getPenilaianResults($alternatives, $kriterias)
    {
        $results = [];
        $penilaian = $this->penilaianModel->getWithAlternatifAndSubKriteria();
        foreach ($alternatives as $alt) {
            $row = ['nama_alternative' => $alt['nama_alternative']];
            foreach ($kriterias as $kri) {
                $nilai = null;
                foreach ($penilaian as $pen) {
                    if ($pen['alternative_id'] == $alt['id'] && $pen['id'] == $kri['id']) {
                        $nilai = $pen['nilai'];
                        break;
                    }
                }
                $row['kriteria_' . $kri['id']] = $nilai ?? '-';
            }
            $results[] = $row;
        }
        return $results;
    }



}