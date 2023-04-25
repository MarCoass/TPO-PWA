<?php
include_once '../Modelo/Conector/BaseDatos.php';
class Estado
{
    private $estadonombre;
    private $ubicacionpaisestado;
    private $id;
    private $mensaje;

    public function __construct()
    {
        $this->ubicacionpaisestado = "";
        $this->id = "";
        $this->estadonombre = "";
        $this->mensaje = "";
    }

    public function cargar($ubicacionpaisestado, $id, $estadonombre)
    {
        $this->setubicacionpaisestado($ubicacionpaisestado);
        $this->setid($id);
        $this->setestadonombre($estadonombre);
       
    }

    //Metodos de acceso

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function getubicacionpaisestado()
    {
        return $this->ubicacionpaisestado;
    }

    public function setubicacionpaisestado($ubicacionpaisestado)
    {
        $this->ubicacionpaisestado = $ubicacionpaisestado;
    }

    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
    }

    public function getestadonombre()
    {
        return $this->estadonombre;
    }

    public function setestadonombre($estadonombre)
    {
        $this->estadonombre = $estadonombre;
    }

   
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "ubicacionpaisestado: " . $this->getubicacionpaisestado() .
            "\nid: " . $this->getid() .
            "\nestadonombre: " . $this->getestadonombre();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($id) {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM estado WHERE id = '" . $id . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row = $base->Registro()) {
                    $this->setubicacionpaisestado($row['ubicacionpaisestado']);
                    $this->setid($row['id']);
                    $this->setestadonombre($row['estadonombre']);
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
        $sql =  "select * from estado";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
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
    $ubicacionpaisestado = $this->getubicacionpaisestado();
    $id = $this->getid();
    $estadonombre = $this->getestadonombre();
    
    // Creo la consulta
    $sql = "INSERT INTO estado (id, ubicacionpaisestado, estadonombre) 
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
        $ubicacionpaisestado = $this->getubicacionpaisestado();
        $estadonombre = $this->getestadonombre();
        $sql = "UPDATE estado SET ubicacionpaisestado = '{$ubicacionpaisestado}', estadonombre = '{$estadonombre}' WHERE id = '{$id}'";
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
