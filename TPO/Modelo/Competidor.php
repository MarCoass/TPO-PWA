<?php
include_once '../Modelo/Conector/BaseDatos.php';
class Competidor
{
    private $legajo;
    private $apellido;
    private $nombre;
    private $du;
    private $fechaNacimiento;
    private $paisOrigen;
    private $graduacion;
    private $rankingNacional;
    private $email;
    private $genero;
    private $mensaje;

    public function __construct()
    {
        $this->nombre = "";
        $this->du = "";
        $this->fechaNacimiento = "";
        $this->paisOrigen = "";
        $this->graduacion = "";
        $this->rankingNacional = "";
        $this->email = "";
        $this->genero = "";
        $this->mensaje = "";
    }

    public function cargar($nombre, $du, $fechaNacimiento, $paisOrigen, $graduacion, $rankingNacional, $email, $genero)
    {
        $this->setNombre($nombre);
        $this->setDu($du);
        $this->setFechaNacimiento($fechaNacimiento);
        $this->setPaisOrigen($paisOrigen);
        $this->setGraduacion($graduacion);
        $this->setRankingNacional($rankingNacional);
        $this->setEmail($email);
        $this->setGenero($genero);
    }

    //Metodos de acceso

    public function getLegajo()
    {
        return $this->legajo;
    }

    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDu()
    {
        return $this->du;
    }

    public function setDu($du)
    {
        $this->du = $du;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }


    public function setPaisOrigen($paisOrigen)
    {
        $this->paisOrigen = $paisOrigen;
    }
    public function getGraduacion()
    {
        return $this->graduacion;
    }

    public function setGraduacion($graduacion)
    {
        $this->graduacion = $graduacion;
    }

    public function getRankingNacional()
    {
        return $this->rankingNacional;
    }

    public function setRankingNacional($rankingNacional)
    {
        $this->rankingNacional = $rankingNacional;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getGenero()
    {
        return $this->genero;
    }


    public function setGenero($genero)
    {
        $this->genero = $genero;
    }
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "nombre: " . $this->getNombre() .
            "\ndu: " . $this->getDu() .
            "\nfechaNacimiento: " . $this->getFechaNacimiento() .
            "\npaisOrigen: " . $this->getPaisOrigen() .
            "\ngraduacion: " . $this->getGraduacion() .
            "\nrankingNacional: " . $this->getRankingNacional() .
            "\nemail: " . $this->getEmail() .
            "\ngenero: " . $this->getGenero();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($du) {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM Competidores WHERE idCompetidor = '" . $du . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row = $base->Registro()) {
                    $this->setLegajo($row['legajo']);
                    $this->setApellido($row['apellido']);
                    $this->setNombre($row['nombre']);
                    $this->setDu($row['du']);
                    $this->setFechaNacimiento($row['fechaNacimiento']);
                    $this->setPaisOrigen($row['paisOrigen']);
                    $this->setGraduacion($row['graduacion']);
                    $this->setRankingNacional($row['rankingNacional']);
                    $this->setEmail($row['email']);
                    $this->setGenero($row['genero']);
    
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
        $sql =  "select * from Competidores";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objCompetidor = new Competidor();
                    $objCompetidor->buscar($row2['du']);
                    $array[] = $objCompetidor;
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
    $legajo = $this->getLegajo();
    $apellido = $this->getApellido();
    $nombre = $this->getNombre();
    $du = $this->getDu();
    $fechaNacimiento = $this->getFechaNacimiento();
    $paisOrigen = $this->getPaisOrigen();
    $graduacion = $this->getGraduacion();
    $rankingNacional = $this->getRankingNacional();
    $email = $this->getEmail();
    $genero = $this->getGenero();
    // Creo la consulta
    $sql = "INSERT INTO Competidor (du, nombre, fecha_nacimiento, pais_origen, graduacion, ranking_nacional, email, genero) 
            VALUES ('{$du}', '{$nombre}', '{$fechaNacimiento}', '{$paisOrigen}', '{$graduacion}', '{$rankingNacional}', '{$email}', '{$genero}')";
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
        $du = $this->getDu();
        $legajo = $this->getLegajo();
        $apellido = $this->getApellido();
        $nombre = $this->getNombre();
        $fechaNacimiento = $this->getFechaNacimiento();
        $paisOrigen = $this->getPaisOrigen();
        $graduacion = $this->getGraduacion();
        $rankingNacional = $this->getRankingNacional();
        $email = $this->getEmail();
        $genero = $this->getGenero();
        
        $sql = "UPDATE Competidores SET legajo = '{$legajo}', apellido = '{$apellido}', nombre = '{$nombre}', fechaNacimiento = '{$fechaNacimiento}', paisOrigen = '{$paisOrigen}', graduacion = '{$graduacion}', rankingNacional = '{$rankingNacional}', email = '{$email}', genero = '{$genero}' WHERE du = '{$du}'";
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
        $consulta = "DELETE FROM Competidores WHERE du = " . $this->getDu();
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
