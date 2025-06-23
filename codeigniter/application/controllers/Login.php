<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_login');
		$this->load->helper('html');
		$this->load->helper('url');
	}

	public function register()
	{
		if($this->input->post()) // Si le bouton a été pressé on récupère les variables
		{
			$pseudo = $this->input->post('pseudo');
			$mail = $this->input->post('mail');
			$mdp = $this->input->post('password');
			if (empty($pseudo) || empty($mail) || empty($mdp)) 
			{
				$data['error'] = 'Tous les champs sont obligatoires.';
				$this->load->view('layout/header_user');
				$this->load->view('tvshow_register', $data);
				$this->load->view('layout/footer');
				return ;
			} 

			else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) // On vérifie que l'adresse mail est valide
			{
				$data['error'] = 'Adresse mail invalide';
				$this->load->view('layout/header_user');
				$this->load->view('tvshow_register', $data);
				$this->load->view('layout/footer');
				return ;
			} 
			else
			{
				$inscription = $this->Model_login->inscription($pseudo, $mail, $mdp);
				if(!$inscription){
					$data['error'] = 'Un compte existe déjà avec cette adresse mail';
					$this->load->view('layout/header_user');
					$this->load->view('tvshow_register', $data);
					$this->load->view('layout/footer');
					return ;
				}
				redirect('login/login');
				return ;
			}
		}
		$this->load->view('layout/header_user');
		$this->load->view('tvshow_register');
		$this->load->view('layout/footer');
	}

	public function login()
	{
		if($this->input->post()) // Si le bouton a été pressé on récupère les variables
		{
			$login = $this->input->post('login');
			$mdp = $this->input->post('password');
			if (empty($login) || empty($mdp)) 
			{
				$data['error'] = 'Tous les champs sont obligatoires.';
				$this->load->view('layout/header_user');
				$this->load->view('tvshow_login', $data);
				$this->load->view('layout/footer');
			} 
			else
			{
				$user = $this->Model_login->login($login, $mdp);
				if($user)
				{
					session_start([
						'cookie_lifetime' => 1800, // Durée de vie du cookie = 30 minutes
					]);
					$_SESSION['uid'] = $user->uid;
					$_SESSION['username'] = $user->login;
					redirect('tvshow');
				} else
				{
					$data['error'] = 'Pseudo ou mot de passe invalide';
					$this->load->view('layout/header_user');
					$this->load->view('tvshow_login', $data);
					$this->load->view('layout/footer');
				}
				return ;
			}
		}
		$this->load->view('layout/header_user');
		$this->load->view('tvshow_login');
		$this->load->view('layout/footer');
	}

	public function logout()
	{
		session_start();
		session_destroy();
		redirect('tvshow');
	}
}
