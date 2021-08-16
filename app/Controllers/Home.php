<?php

namespace App\Controllers;

use Config\Services;
use App\Models\registeruserModel;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->status_akun != "Sudah Aktifasi") {
            $judul = 'Silahkan Lengkapi Biodata Anda';
            $isi = 'Home/biodata.php';
        } else {
            $judul = 'Selamat Datang di Beranda Anda';
            $isi = 'Home/beranda.php';
        }
        $data = [
            'judul' => $judul,
            'isi'   => $isi,
            'session' => $session,
            'validation' => \Config\Services::validation(),
        ];
        echo view('layout/v_wrapper.php', $data);
    }

    public function data_vaksin()
    {
        $session = session();
        if ($session->status_akun != "Sudah Aktifasi") {
            $judul = 'Silahkan Lengkapi Biodata Anda';
            $isi = 'Home/biodata.php';
        } else {
            $judul = 'Data Vaksin';
            $isi = 'Home/data_vaksin.php';
        }
        $data = [
            'judul' => $judul,
            'isi'   => $isi,
            'session' => $session,
            'validation' => \Config\Services::validation(),
        ];
        echo view('layout/v_wrapper.php', $data);
    }

    public function edit_biodata()
    {
        $session = session();
        if ($session->status_akun != "Sudah Aktifasi") {
            $judul = 'Silahkan Lengkapi Biodata Anda';
            $isi = 'Home/biodata.php';
        } else {
            $judul = 'Edit Biodata Anda';
            $isi = 'Home/edit_biodata.php';
        }
        $data = [
            'judul' => $judul,
            'isi'   => $isi,
            'session' => $session,
            'validation' => \Config\Services::validation(),
        ];
        echo view('layout/v_wrapper.php', $data);
    }
    public function biodata()
    {
        $session = session();
        helper('form');
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Tidak Boleh Kosong'
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenis Kelamin'
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi Tempat Lahir Anda'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tentukan Tanggal Lahir Anda'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi Alamat Anda Sesuai KTP'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Isi alamat e-mail anda',
                    'valid_email' => 'Masukan e-mail yang Valid',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Silahkan Buat Password untuk akun anda',
                    'min_length' => 'Password anda terlalu pendek, Minimal 6 Huruf / Angka',
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Silahkan Buat Password untuk akun anda',
                    'matches' => 'Password tidak sama'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar tidak Boleh Lebih dari 1 MB',
                    'is_image' => 'Gambar / Foto Harus Berformat JPG dan PNG',
                    'mime_in' => 'Gambar / Foto Harus Berformat JPG dan PNG',
                ]
            ],
            'foto_ktp' => [
                'rules' => 'max_size[foto_ktp,1048]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Gambar tidak Boleh Lebih dari 1 MB',
                    'is_image' => 'Gambar / Foto KTP Harus Berformat JPG dan PNG',
                    'mime_in' => 'Gambar / Foto KTP Harus Berformat JPG dan PNG',
                ]
            ],
        ])) {
            return redirect()->to(base_url() . '/Home')->withInput();
        }
        helper('filesystem');
        $request = Services::request();
        $registeruserModel = new registeruserModel($request);
        // Foto Profil Section
        $nama_foto_profil = $this->request->getVar('nama_foto_profil');
        $foto_profil = $this->request->getFile('foto');
        if ($nama_foto_profil && $foto_profil != "") {
            if (is_file('assets/img/foto_profil/' . $nama_foto_profil))
                unlink('assets/img/foto_profil/' . $nama_foto_profil);
            $nama_profil_baru = $foto_profil->getRandomName();
            $foto_profil->move('assets/img/foto_profil', $nama_profil_baru);
        } else if ($foto_profil  != "") {
            $nama_profil_baru = $foto_profil->getRandomName();
            $foto_profil->move('assets/img/foto_profil', $nama_profil_baru);
        } else if ($nama_foto_profil != "") {
            $nama_profil_baru = $nama_foto_profil;
        } else {
            $nama_profil_baru = "";
        }

        // Foto KTP Section
        $nama_foto_ktp = $this->request->getVar('nama_foto_ktp');
        $foto_ktp = $this->request->getFile('foto_ktp');
        if ($nama_foto_ktp && $foto_ktp != "") {
            if (is_file('assets/img/foto_ktp/' . $nama_foto_ktp))
                unlink('assets/img/foto_ktp/' . $nama_foto_ktp);
            $nama_ktp_baru = $foto_ktp->getRandomName();
            $foto_ktp->move('assets/img/foto_ktp', $nama_ktp_baru);
        } else if ($foto_ktp  != "") {
            $nama_ktp_baru = $foto_ktp->getRandomName();
            $foto_ktp->move('assets/img/foto_ktp', $nama_ktp_baru);
        } else if ($nama_foto_ktp != "") {
            $nama_ktp_baru = $nama_foto_ktp;
        } else {
            $nama_ktp_baru = "";
        }

        if ($request->getMethod(true) == 'POST') {
            $data = [
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'jk' => $this->request->getVar('jk'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                'pekerjaan' => $this->request->getVar('pekerjaan'),
                'agama' => $this->request->getVar('agama'),
                'alamat' => $this->request->getVar('alamat'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'foto' => $nama_profil_baru,
                'foto_ktp' => $nama_ktp_baru,
                'status_akun' => "Sudah Aktifasi",
            ];
            $NIK = $this->request->getVar('NIK');
            $update = $registeruserModel->update_biodata_user($NIK, $data);
            if ($update) {
                $session->set($data);
                $session->setFlashdata('sukses', 'Biodata Berhasil di Simpan');
                return redirect()->to(base_url() . '/Home');
            }
        }
    }
}
