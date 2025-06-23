<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) {
            session_start(['cookie_lifetime' => 1800]);
        }
        $this->load->model('Comment_model');
        $this->load->helper('url');
    }

    
    public function add($tvshowId)
    {
        // verifie si on est connecté
        if (empty($_SESSION['username'])) {
            redirect('login/login');
        }

        // 
        $note  = (int) $this->input->post('note', true);
        $texte = trim($this->input->post('texte', true));
        if ($note < 1 || $note > 5 || $texte === '') {
            show_error('Note invalide ou commentaire vide.', 400);
        }

        // 3. Appel au modèle
        $this->Comment_model->addComment($tvshowId, $_SESSION['username'], $note, $texte);

        // 4. Redirection vers la page de détail
        redirect("tvshow/GetTvshowDetails/{$tvshowId}");

    }

    public function addSeason($seasonId)
    {
        if (empty($_SESSION['username'])) {
            redirect('login/login');
        }

        $note  = (int) $this->input->post('note', true);
        $texte = trim($this->input->post('texte', true));
        if ($note < 1 || $note > 5 || $texte === '') {
            show_error('Note invalide ou commentaire vide.', 400);
        }

        $this->Comment_model->addSeasonComment($seasonId, $_SESSION['username'], $note, $texte);
        // Redirige vers le détail de la saison
        redirect("tvshow/GetSeasonDetails/{$seasonId}");
    }

}