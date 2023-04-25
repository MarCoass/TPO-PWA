<?php
include_once '../Modelo/Conector/BaseDatos.php';
class Estado
{
    private $nombreestado;
    private $ubicacionpaisestado;
    private $id;
    private $mensaje;

    public function __construct()
    {
        $this->ubicacionpaisestado = "";
        $this->id = "";
        $this->nombreestado = "";
        $this->mensaje = "";
    }

    public function cargar($ubicacionpaisestado, $id, $nombreestado)
    {
        $this->setubicacionpaisestado($ubicacionpaisestado);
        $this->setid($id);
        $this->setnombreestado($nombreestado);
       
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

    public function getnombreestado()
    {
        return $this->nombreestado;
    }

    public function setnombreestado($nombreestado)
    {
        $this->nombreestado = $nombreestado;
    }

   
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "ubicacionpaisestado: " . $this->getubicacionpaisestado() .
            "\nid: " . $this->getid() .
            "\nnombreestado: " . $this->getnombreestado();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($id) {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM Estados WHERE id = '" . $id . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row = $base->Registro()) {
                    $this->setubicacionpaisestado($row['ubicacionpaisestado']);
                    $this->setid($row['id']);
                    $this->setnombreestado($row['nombreestado']);
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
        $sql =  "select * from Estados";
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
    $nombreestado = $this->getnombreestado();
    
    // Creo la consulta
    $sql = "INSERT INTO Estado (id, ubicacionpaisestado, nombreestado) 
            VALUES ('{$id}', '{$ubicacionpaisestado}', '{$nombreestado}')";
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
        $nombreestado = $this->getnombreestado();
        $sql = "UPDATE Estados SET ubicacionpaisestado = '{$ubicacionpaisestado}', nombreestado = '{$nombreestado}' WHERE id = '{$id}'";
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
        $consulta = "DELETE FROM Estados WHERE id = " . $this->getid();
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
