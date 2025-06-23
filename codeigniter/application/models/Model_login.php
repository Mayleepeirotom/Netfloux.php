<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_login extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

        // Fonction qui permet à un utilisateur qui renseigne son login, mail et mot de passe de s'inscrire.
    public function inscription($login, $mail, $mdp)
    {

        $query = $this->db->query("
            SELECT mail 
            FROM user
            WHERE mail = ?",
            [$mail]
        );


        if ($query->num_rows() > 0) {
        return false; // le mail existe déjà
    }

    $hash = password_hash($mdp, PASSWORD_DEFAULT); 

    $insert = $this->db->query( 
        "INSERT INTO user (
            login,
            mail,
            password) 
        VALUES(?,
            ?,
            ?)",
        [$login, $mail, $hash]
        ); // On fait l'insertion dans la table
    return $insert;
}

        /* Fonction qui permet à un utilisateur de se connecter en renseignant son mail ou son nom d'utilisateur et son mot de passe.
         * 
         * @return l'uid si il la trouve null sinon
         */
        public function login($login, $mdp)
        {
            $query = $this->db->query(
                "SELECT login, mail, password, uid
                FROM user
                WHERE login = ? OR mail = ?", 
                [$login, $login]
            );

            $user = $query->row(); 

            if ($user && password_verify($mdp, $user->password)) {
                return $user;
            } else 
            return false;
        }
    }
