<?php
/* include_once '../Modelo/Conector/BaseDatos.php'; */
class Pais
{

    /* los pase a public para que json_encode me los traduzca */
    public $paisnombre;
    public $id;
    public $mensaje;

    public function __construct()
    {
        $this->id = "";
        $this->paisnombre = "";
        $this->mensaje = "";
    }

    public function cargar($id, $paisnombre)
    {
        $this->setid($id);
        $this->setpaisnombre($paisnombre);
       
    }

    //Metodos de acceso

    public function getMensaje()
    {
        return $this->mensaje;
    }


    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
    }

    public function getpaisnombre()
    {
        return $this->paisnombre;
    }

    public function setpaisnombre($paisnombre)
    {
        $this->paisnombre = $paisnombre;
    }

   
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "id: " . $this->getid() .
            "\npaisnombre: " . $this->getpaisnombre();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($id) {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM pais WHERE id = '" . $id . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row = $base->Registro()) {
                    $this->setid($row['id']);
                    $this->setpaisnombre($row['paisnombre']);
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
        $sql =  "select * from pais";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objPais = new Pais();
                    $objPais->buscar($row2['id']);
                    $array[] = $objPais;
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
    $id = $this->getid();
    $paisnombre = $this->getpaisnombre();
    
    // Creo la consulta
    $sql = "INSERT INTO pais (id, paisnombre) 
            VALUES ('{$id}', '{$paisnombre}')";
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
        $paisnombre = $this->getpaisnombre();
        $sql = "UPDATE pais SET paisnombre = '{$paisnombre}' WHERE id = '{$id}'";
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
        $consulta = "DELETE FROM pais WHERE id = " . $this->getid();
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
/* para testear consulta a bd
$neu = new Pais;

print_r($neu->listar()); */