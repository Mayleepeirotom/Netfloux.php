<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_tvshow extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	public function getTvshow(){
		$query = $this->db->query("
			SELECT tvshow.name,tvshow.originalName,tvshow.id,jpeg,
           (SELECT COUNT(*) from season
              WHERE season.tvShowId = tvshow.id) as nb
           FROM tvshow
           JOIN poster ON tvshow.posterId = poster.id"
       );
       return $query->result();
   }


    //barre de recherche
   public function getSerieByName($name){
    $query = $this->db->query(
        "SELECT tvshow.name, tvshow.originalName, tvshow.id, jpeg,
        (SELECT COUNT(*) FROM season WHERE season.tvShowId = tvshow.id) as nb
        FROM tvshow
        JOIN poster ON tvshow.posterId = poster.id
        WHERE tvshow.name LIKE ?", array('%' . $name . '%')
    );
    return $query->result();
    
}



    //pour trier dans l'ordre alphabétique ou analphabétique
public function sortSerie($sort){
    $order_by='';
    switch ($sort) {
        case 'name_asc' :
        $order_by = 'tvshow.name ASC';
        break;
        case 'name_desc' :
        $order_by = 'tvshow.name DESC';
        break;
        default :
        $order_by = 'tvshow.year ASC';
    }
    $query = $this->db->query(
        "SELECT tvshow.name, tvshow.originalName, tvshow.id, jpeg,
        (SELECT COUNT(*) FROM season WHERE season.tvShowId = tvshow.id) as nb
        FROM tvshow
        JOIN poster ON tvshow.posterId = poster.id
        ORDER BY $order_by"
    );
    return $query->result();
}



        //affiche la page de détails
public function getSerieById($id) {
    $query = $this->db->query(
        "SELECT tvshow.name, tvshow.originalName, tvshow.id, tvshow.overview, jpeg, 
        GROUP_CONCAT(DISTINCT genre.name SEPARATOR ', ') AS genre,
        (SELECT COUNT(*) FROM season WHERE season.tvShowId = tvshow.id) AS nb
        FROM tvshow
        JOIN poster ON tvshow.posterId = poster.id
        LEFT JOIN tvshow_genre ON tvshow.id = tvshow_genre.tvShowId
        LEFT JOIN genre ON tvshow_genre.genreId = genre.id
        WHERE tvshow.id = ?
        GROUP BY tvshow.id", array($id)
    );
    return $query->row();
}




        // récupère les saisons d'une série
public function getSaisonsBySerieId($id) {
    $query = $this->db->query(
        "SELECT season.id, season.name, season.seasonNumber, poster.jpeg
        FROM season
        LEFT JOIN poster ON season.posterId = poster.id        
        WHERE season.tvShowId = ?
        ORDER BY season.seasonNumber ASC", array($id)
    );
    return $query->result();
}


        // Récupère les informations d'une saison
public function getSaisonById($seasonId) {
    $query = $this->db->query(
        "SELECT season.id, season.name AS season_name, season.seasonNumber, 
        tvshow.name AS serie_name, tvshow.originalName AS serie_originalName,
        GROUP_CONCAT(DISTINCT genre.name SEPARATOR ', ') AS genre, poster.jpeg
        FROM season
        JOIN tvshow ON season.tvShowId = tvshow.id
        LEFT JOIN tvshow_genre ON tvshow.id = tvshow_genre.tvShowId
        LEFT JOIN genre ON tvshow_genre.genreId = genre.id
        JOIN poster ON season.posterId = poster.id
        WHERE season.id = ?
        GROUP BY season.id", array($seasonId)
    );
    return $query->row();
}


public function getEpisodesBySeasonId($seasonId) {
    $query = $this->db->query(
        "SELECT id, name, overview, episodeNumber
        FROM episode
        WHERE seasonId = ?
        ORDER BY episodeNumber ASC", array($seasonId)
    );
    return $query->result();
}


public function getAllGenres() {
    $query = $this->db->query("SELECT * FROM genre ORDER BY name ASC");
    return $query->result();
}

public function getSerieByGenre($genreId) {
    $query = $this->db->query(
        "SELECT DISTINCT tvshow.name, tvshow.originalName, tvshow.id, jpeg,
        (SELECT COUNT(*) FROM season WHERE season.tvShowId = tvshow.id) AS nb
        FROM tvshow
        JOIN poster ON tvshow.posterId = poster.id
        JOIN tvshow_genre ON tvshow.id = tvshow_genre.tvShowId
        WHERE tvshow_genre.genreId = ?
        ORDER BY tvshow.name ASC",
        array($genreId)
    );
    return $query->result();
}

}
