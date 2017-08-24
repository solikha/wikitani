<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class pulang_habis extends Print_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('tool_helper');
    }

    public function cetak($posisi = '') {
        $this->load->model('m_pulang_habis', 'mpulang_habis');
        if (isset($_GET['lyn_id'])) {
            $data['posisi'] = $posisi;
            $data['top'] = "height: " . $_GET['top'] . "mm;";
            $data['padding_left'] = "padding-left: " . $_GET['left'] . "mm;";
            $lyn_id = $_GET['lyn_id'];
            $datakbri = $this->ci->config->item('kbri');
            $kotakbri = $datakbri['kota'];
            $datalayanan = $this->mpulang_habis->loadWniLayanan($lyn_id);
            $nama = $this->mpulang_habis->nama($lyn_id);
            $data['datalayanan'] = $datalayanan;
            $data['cetak_kwitansi'] = array(
                "nama_permohonan_data_kwitansi" => "Data Pemohon",
                "kota" => $kotakbri,
                "tanggal_ambil_data_kwitansi" => "2005-05-05",
                "tempat_pembuatan_kwitansi_data_kwitansi" => "Cisaranten",
                "petugas_kbri_data_kwitansi" => ""
            );
            $html = $this->load->view("v_cetak_pulang_habis", $data, true);
            $this->load->library('m_pdf');
            $pdf = $this->m_pdf->load();
            if (isset($nama)) {
                $pemohon = '_' . $nama;
            } else {
                $pemohon = '';
            }
            $pdfFilePath = "pulang_habis" . $pemohon . ".pdf";
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I");
        } else {
            echo "data tidak diketemukan.";
        }
    }

    function getdata($param, $array) {
        if (array_key_exists($param, $array)) {
            $val = $array[$param];
        } else {
            $val = '';
        }
        return $val;
    }

    public function rupiah($angka) {
        $rupiah = number_format($angka, 2, ',', '.');
        return $rupiah;
    }

    public function terbilang($angka) {
        $angka = (float) $angka;
        $bilangan = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');
        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } else if ($angka < 100) {
            $hasil_bagi = (int) ($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) {
            return sprintf('Seratus %s', $this->terbilang($angka - 100));
        } else if ($angka < 1000) {
            $hasil_bagi = (int) ($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
        } else if ($angka < 2000) {
            return trim(sprintf('Seribu %s', $this->terbilang($angka - 1000)));
        } else if ($angka < 1000000) {
            $hasil_bagi = (int) ($angka / 1000);
            $hasil_mod = $angka % 1000;
            return sprintf('%s Ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
        } else if ($angka < 1000000000) {
            $hasil_bagi = (int) ($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s Juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) {
            $hasil_bagi = (int) ($angka / 1000000000);
            $hasil_mod = fmod($angka, 1000000000);
            return trim(sprintf('%s Milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) {
            $hasil_bagi = $angka / 1000000000000;
            $hasil_mod = fmod($angka, 1000000000000);
            return trim(sprintf('%s Triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else {
            return 'Data Salah';
        }
    }

}

?>