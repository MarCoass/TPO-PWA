<?php
/* include_once '../Modelo/Estado.php'; */

class C_Estado
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombre de las variables instancias del objeto
     * @param array $param
     * @return Estado
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('id', $param)) {
            $obj = new Estado();
            $obj->cargar(
                $param['id'],
                $param['ubicacionpaisid'],
                $param['estadonombre'],
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombre de 
     * las variables instancias del objeto que son claves
     * @param array $param
     * @return Proidcto
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['id'])) {
            $obj = new Estado();
            $obj->cargar($param['id'], null, null);
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
        if (isset($param['id'])) {
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
            if (isset($param['id']))
                $where .= " and id ='" . $param['id'] . "'";
            if (isset($param['ubicacionpaisid']))
                $where .= " and ubicacionpaisid ='" . $param['ubicacionpaisid'] . "'";
            if (isset($param['estadonombre']))
                $where .= " and estadonombre ='" . $param['estadonombre'] . "'";
        }
        $obj = new Estado();
        $arreglo = $obj->listar($where);

        return $arreglo;
    }
}
