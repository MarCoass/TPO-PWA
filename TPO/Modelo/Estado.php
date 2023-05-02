<?php
class Estado
{
    /* los pase a public para que json_encode me los traduzca */

    public $estadonombre;
    public $objPais;
    public $id;
    public $mensaje;

    public function __construct()
    {
        $this->objPais = "";
        $this->id = "";
        $this->estadonombre = "";
        $this->mensaje = "";
    }

    public function cargar($objPais, $id, $estadonombre)
    {
        $this->setObjPais($objPais);
        $this->setID($id);
        $this->setNombre($estadonombre);
    }

    //Metodos de acceso

    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @return  object
     */
    public function getObjPais()
    {
        return $this->objPais;
    }

    public function setObjPais($objPais)
    {
        $this->objPais = $objPais;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->estadonombre;
    }

    public function setNombre($estadonombre)
    {
        $this->estadonombre = $estadonombre;
    }


    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "ubicacionpaisestado: " . $this->getObjPais()->getID() .
            "\nid: " . $this->getID() .
            "\nestadonombre: " . $this->getNombre();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($id)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM estado WHERE id = '" . $id . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row = $base->Registro()) {

                    $objPais = new Pais();
                    $objPais->buscar($row['ubicacionpaisid']); // CARGAMOS EL OBJETO PAÍS

                    $this->cargar($objPais, $row['id'], $row['estadonombre']); // CARGAMOS EL OBJETO ESTADO
                    $resp = true;
                }
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }


    //LISTAR
    public function listar($condicion = '')
    {
        $array = null;
        $base = new BaseDatos();
        $sql =  "SELECT * FROM estado";
        if ($condicion != '') {
            $sql = $sql . ' WHERE ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objEstado = new Estado();
                    $objEstado->buscar($row2['id']);
                    $array[] = $objEstado;
                }
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }

        return $array;
    }

    //INSERTAR
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        // Asigno los datos a variables
        $ubicacionpaisestado = $this->getObjPais();
        $id = $this->getid();
        $estadonombre = $this->getNombre();

        // Creo la consulta
        $sql = "INSERT INTO estado (id, ubicacionpaisid, estadonombre) 
            VALUES ('{$id}', '{$ubicacionpaisestado}', '{$estadonombre}')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }



    //MODIFICAR
    public function modificar()
    {
        $base = new BaseDatos();
        $resp = false;
        $id = $this->getid();
        $ubicacionpaisestado = $this->getObjPais();
        $estadonombre = $this->getNombre();
        $sql = "UPDATE estado SET ubicacionpaisid = '{$ubicacionpaisestado}', estadonombre = '{$estadonombre}' WHERE id = '{$id}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }


    //ELIMINAR
    public function eliminar()
    {
        $base = new BaseDatos();
        $rta = false;
        $consulta = "DELETE FROM estado WHERE id = " . $this->getid();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $rta;
    }
}
