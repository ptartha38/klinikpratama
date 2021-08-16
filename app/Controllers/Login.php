<?php

namespace App\Controllers;

use Config\Services;
use App\Models\registeruserModel;

class Login extends BaseController
{
	public function index()
	{
		$session = session();
		$data = [
			'judul' => 'Klinik Pratama Polres Sumbawa',
			'session' => $session,
			'validation' => \Config\Services::validation()
		];
		echo view('login/login_form', $data);
	}

	public function auth()
	{
		if (session()->get('username') != "") {
			return redirect()->to(base_url('/'));
		}
		$session = session();
		$request = Services::request();
		$model = new registeruserModel($request);
		$NIK = $this->request->getVar('NIK_login');
		$password = $this->request->getVar('pass_signin');
		$data = $model->where('NIK', $NIK)->first();
		if ($data) {
			$pass = $data['password'];
			$verify_pass = password_verify($password, $pass);
			if ($verify_pass) {
				$ses_data = [
					'id'       => $data['id'],
					'NIK'       => $data['NIK'],
					'nama_lengkap'     => $data['nama_lengkap'],
					'jk'     => $data['jk'],
					'tempat_lahir'     => $data['tempat_lahir'],
					'tgl_lahir'     => $data['tgl_lahir'],
					'pekerjaan'     => $data['pekerjaan'],
					'agama'     => $data['agama'],
					'alamat'     => $data['alamat'],
					'email'    => $data['email'],
					'foto_ktp'    => $data['foto_ktp'],
					'foto'    => $data['foto'],
					'status_akun'    => $data['status_akun'],
					'logged_in'     => TRUE
				];
				$session->set($ses_data);
				return redirect()->to(base_url() . '/Home');
			} else {
				$session->setFlashdata('login_error', 'Password Salah');
				return redirect()->to(base_url() . '/');
			}
		} else {
			$session->setFlashdata('login_error', 'NIK Tidak Ditemukan');
			return redirect()->to(base_url() . '/');
		}
	}

	public function registrasi()
	{
		helper('form');
		if (!$this->validate([
			'NIK' => [
				'rules' => 'required|min_length[16]|is_unique[registered_user.NIK]',
				'errors' => [
					'required' => 'NIK Harus Diisi',
					'is_unique' => 'NIK Sudah Pernah Di Daftarkan',
					'min_length' => 'NIK harus 16 Digit',
				]
			],
			'nama_lengkap' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama Lengkap Harus Di Isi',
				]
			],
			'email' => [
				'rules' => 'required|valid_email|is_unique[registered_user.email]',
				'errors' => [
					'required' => 'Email Harus Di Isi',
					'is_unique' => 'E-Mail Sudah Pernah Di Daftarkan',
					'valid_email' => 'Masukan E-Mail yang Valid',
				]
			],
			'pass_signup' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password tidak boleh kosong',
				]
			]
		])) {
			return redirect()->to(base_url() . '/login/index')->withInput();
		}
		$request = Services::request();
		$registerModel = new registeruserModel($request);
		$data = [
			'NIK' => $this->request->getVar('NIK'),
			'nama_lengkap' => $this->request->getVar('nama_lengkap'),
			'email' => $this->request->getVar('email'),
			'password' => password_hash($this->request->getVar('pass_signup'), PASSWORD_DEFAULT),
			'status_akun' => "Belum Aktifasi",
		];
		$simpan = $registerModel->register_new_user($data);
		if ($simpan) {
			return redirect()->to(base_url() . '/login')->with('status', 'Berhasil Registrasi, Silahkan Login untuk melengkapi data anda');
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url() . '/');
	}
}
