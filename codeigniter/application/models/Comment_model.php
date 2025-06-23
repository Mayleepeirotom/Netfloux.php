<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function addComment($tvshowId, $userlogin, $note, $texte)
    {
        $this->db->insert('commentaire', [
            'note'      => $note,
            'texte'     => $texte,
            'userlogin' => $userlogin
        ]);
        $idcom = $this->db->insert_id();

        $this->db->insert('tvshow_com', [
            'tvshowid' => $tvshowId,
            'idcom'    => $idcom
        ]);

        return $idcom;
    }


    public function getCommentsByTvshow($tvshowId)
    {
        $sql = "
            SELECT
                c.idcom,
                c.note,
                c.texte,
                c.userlogin
            FROM commentaire c
            JOIN tvshow_com tc ON tc.idcom = c.idcom
            WHERE tc.tvshowid = ?
            ORDER BY c.idcom DESC
        ";
        $query = $this->db->query($sql, [$tvshowId]);
        return $query->result();
    }

    public function addSeasonComment($seasonId, $userlogin, $note, $texte)
    {
        $this->db->insert('commentaire', [
            'note'      => $note,
            'texte'     => $texte,
            'userlogin' => $userlogin
        ]);
        $idcom = $this->db->insert_id();

        $this->db->insert('season_com', [
            'seasonid' => $seasonId,
            'idcom'    => $idcom
        ]);

        return $idcom;
    }


    public function getCommentsBySeason($seasonId)
    {
        $sql ="
            SELECT c.idcom, c.note, c.texte, c.userlogin
            FROM commentaire c
            JOIN season_com sc ON sc.idcom = c.idcom
            WHERE sc.seasonid = ?
            ORDER BY c.idcom DESC
        ";
        return $this->db->query($sql, [$seasonId])->result();
    }

}
