<?php

// ----- CLASSE QUE IRÁ REALIZAR A CONEXÃO COM O BANCO DE DADOS ----- //

class Acesso {


    // ----- FUNÇÃOQUE VAI ABRIR A CONEXÃO COM O BANCO ----- //

    public function Conexao() {

        header('Content-Type: text/html; charset=utf-8');
        $this->cnx = mysqli_connect("127.0.0.1:3306", "root", "", "oep");

        mysqli_query($this->cnx,"SET NAMES 'utf8'");
        mysqli_query($this->cnx,'SET character_set_connection=utf8');
        mysqli_query($this->cnx,'SET character_set_client=utf8');
        mysqli_query($this->cnx,'SET character_set_results=utf8');


        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    // ----- REALIZA A QUERY NO BANCO ----- //

    public function Query($sql) {

        $this->result = mysqli_query($this->cnx,$sql, MYSQLI_STORE_RESULT);
    }

    // ----- FECHA A CONEXÃO COM O BANCO DE DADOS ----- //

    public function __destruct() {
        mysqli_close($this->cnx);
    }

}
?> 

