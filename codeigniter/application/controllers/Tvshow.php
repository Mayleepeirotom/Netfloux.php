<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tvshow extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_tvshow');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->genres = $this->Model_tvshow->getAllGenres();
	}

	public function index(){
		$tvshow = $this->Model_tvshow->getTvshow();
		$data['genres'] = $this->genres;
		$this->load->view('layout/header', $data);
		$this->load->view('tvshow_list', ['tvshow' => $tvshow]);
		$this->load->view('layout/footer');
	}	

	public function SearchBySerieName(){
		$search = $this->input->post("name");
		$serie = $this->Model_tvshow->getSerieByName($search);
		$data['genres'] = $this->genres;
		$this->load->view('layout/header_serie', $data);
		$this->load->view('tvshow_list', ['tvshow' => $serie]);
		$this->load->view('layout/footer');
	}

	public function sort(){
		$sort = $this->input->get('sort');
		$serie = $this->Model_tvshow->sortSerie($sort);
		$data['genres'] = $this->genres;
		$this->load->view('layout/header', $data);
		$this->load->view('tvshow_list', ['tvshow' => $serie]);
		$this->load->view('layout/footer');
	}

	public function GetTvshowDetails($id)
{
    $serie   = $this->Model_tvshow->getSerieById($id);
    $saisons = $this->Model_tvshow->getSaisonsBySerieId($id);
    if (! $serie) {
        show_404();
    }

    $this->load->model('Comment_model');
    $comments = $this->Comment_model->getCommentsByTvshow($id);

    $data = [
        'genres'   => $this->genres,
        'serie'    => $serie,
        'saisons'  => $saisons,
        'comments' => $comments
    ];

    $this->load->view('layout/header_serie', $data);
    $this->load->view('tvshow_details',       $data);
    $this->load->view('layout/footer');
}


public function GetSeasonDetails($seasonId) {

    $saison   = $this->Model_tvshow->getSaisonById($seasonId);
    $episodes = $this->Model_tvshow->getEpisodesBySeasonId($seasonId);

    if (! $saison) {
        show_404();
    }

    $this->load->model('Comment_model');


    $comments = $this->Comment_model->getCommentsBySeason($seasonId);

    $data = [
        'genres'   => $this->genres,
        'saison'   => $saison,
        'episodes' => $episodes,
        'comments' => $comments, 
    ];

    $this->load->view('layout/header_serie', $data);
    $this->load->view('season_details',       $data);
    $this->load->view('layout/footer');
}



	public function filterByGenre() {
		$genreId = $this->input->get('genre_id');
		$series = $this->Model_tvshow->getSerieByGenre($genreId);
		$data['genres'] = $this->genres;
		$this->load->view('layout/header', $data);
		$this->load->view('tvshow_list', ['tvshow' => $series]);
		$this->load->view('layout/footer');
	}
}
