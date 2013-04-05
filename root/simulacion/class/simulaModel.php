<?php

class simulaModel {

    protected $_db;

    public function __construct() {
        $this->_db = new Conectar();
    }

    public function consulta() {

        $result = $this->_db->query("
            SELECT
                *
            FROM
                participantes
            ");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchall();
    }

    public function guardarDados($dado1, $dado2) {
        $this->_db->prepare("
                    INSERT INTO
                            dados
                    VALUES (null, :dado1, :dado2, :estado)")
                ->execute(
                        array(
                            ':dado1' => $dado1,
                            ':dado2' => $dado2,
                            ':estado' => 0
                        )
        );

        $result = $this->_db->query("
            SELECT
                *
            FROM
                dados
            WHERE
                estado = 0;
            ");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchall();
    }

    public function editarDados($dado1, $dado2, $id) {
        //actualizamos los datos en la tabla.
        $sql = "UPDATE
                    dados
                SET
                    dado1=?, dado2=?
                WHERE
                    id=?";
        $q = $this->_db->prepare($sql);
        $q->execute(array($dado1, $dado2, $id));

        //Leemos de nuevo la tabla con los datos actualizados.
        $result = $this->_db->query("
            SELECT
                *
            FROM
                dados
            WHERE
                estado = 0;
            ");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchall();
    }

    public function eliminarDados($id) {
        //actualizamos el estado de los datos en la tabla.
        $sql = "UPDATE
                    dados
                SET
                    estado=?
                WHERE
                    id=?";
        $q = $this->_db->prepare($sql);
        $q->execute(array("1", $id));

        //Leemos de nuevo la tabla con los datos actualizados.
        $result = $this->_db->query("
            SELECT
                *
            FROM
                dados
            WHERE
                estado = 0;
            ");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchall();
    }

    public function mostrarTabla() {
        $result = $this->_db->query("
            SELECT
                *
            FROM
                dados
            WHERE
                estado = 0;
            ");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchall();
    }

    public function borrarTodo() {
        $result = $this->_db->query("
            TRUNCATE TABLE
                dados;
            ");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchall();
    }

}

?>