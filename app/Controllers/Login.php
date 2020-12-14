<?php namespace App\Controllers;

class Login extends BaseController
{

	public function index()
	{
		helper('form');
		echo view('templates/header');
		echo view('login/index');
		echo view('templates/footer');
	}

	public function login()
	{
		$session = \Config\Services::session();
		$username = $this->request->getPost('login-username');
		$password = $this->request->getPost('login-password');
	    $result = model('Login')->login($username, $password);
	    if ($result) {
	    	$session->set([
	    		'user_id' => $result->user_id,
	    		'username' => $result->username,
	    		'name' => $result->name,
	    		'logged_in' => TRUE
	    	]);
   			return redirect()->to(base_url().'/Home');
	    }else{
	    	$session->setFlashdata('login', 'failed');
			return redirect()->to(base_url().'/Login');
	    }
	}

	public function register()
	{
		$session = \Config\Services::session();
		$dataRegister = [
			'name' => $this->request->getPost('register-name'),
			'username' => $this->request->getPost('register-username'),
			'password' => $this->request->getPost('register-password')
	    ];
		if (model('Login')->register($dataRegister)) $session->setFlashdata('register', 'success');
		else $session->setFlashdata('register', 'failed');
		return redirect()->to(base_url().'/Login');

	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url().'/Login');
	}

	//--------------------------------------------------------------------

}
