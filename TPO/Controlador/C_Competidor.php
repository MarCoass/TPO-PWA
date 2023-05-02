<?php
/* include_once '../Modelo/Competidor.php'; */

class C_Competidor
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Competidor
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('du', $param) && array_key_exists('estadoOrigen', $param)) {

            $nombre = $this->modificarString($param['nombre']);
            $apellido = $this->modificarString($param['apellido']);

            $estado = new Estado();
            $estado->buscar($param['estadoOrigen']);

            $obj = new Competidor();
            $obj->cargar(
                $nombre,
                $apellido,
                $param['du'],
                $param['fechaNacimiento'],
                $param['legajo'],
                $estado,
                $param['graduacion'],
                $param['rankingNacional'],
                $param['email'],
                $param['genero']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de 
     * las variables instancias del objeto que son claves
     * @param array $param
     * @return Producto
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['du'])) {
            $obj = new Competidor();
            $obj->cargar($param['du'], null, null, null, null, null, null, null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */


    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['du'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Inserta un objeto
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $obj = $this->cargarObjeto($param);
        if ($obj != null and $obj->insertar()) {
            $resp = true;
        }
        return $resp;
    }


    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            if ($obj != null and $obj->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjeto($param);
            if ($obj != null and $obj->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            $where .= '';
            if (isset($param['du']))
                $where .= " and du ='" . $param['du'] . "'";
            if (isset($param['apellido']))
                $where .= " and apellido ='" . $param['apellido'] . "'";
            if (isset($param['nombre']))
                $where .= " and nombre ='" . $param['nombre'] . "'";
            if (isset($param['fechaNacimiento']))
                $where .= " and fechaNacimiento ='" . $param['fechaNacimiento'] . "'";
            if (isset($param['paisOrigen']))
                $where .= " and paisOrigen ='" . $param['paisOrigen'] . "'";
            if (isset($param['graduacion']))
                $where .= " and graduacion ='" . $param['graduacion'] . "'";
            if (isset($param['rankingNacional']))
                $where .= " and rankingNacional ='" . $param['rankingNacional'] . "'";
            if (isset($param['email']))
                $where .= " and email ='" . $param['email'] . "'";
            if (isset($param['genero']))
                $where .= " and genero ='" . $param['genero'] . "'";
        }
        $obj = new Competidor();
        $arreglo = $obj->listar($where);

        return $arreglo;
    }

    /* RECIBE UN STRING PARA PONER QUE LA PRIMER LETRA DE CADA PALABRA SEA MAYÚSCULA MIENTRAS QUE EL RESTO SON MINÚSCULAS */
    private function modificarString($string)
    {
        $retorno = ucwords(strtolower($string));
        return $retorno;
    }
}
