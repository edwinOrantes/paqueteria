<?php 

class Clientes_Model extends CI_Model
{

    public function obtenerClientes(){
        $sql = "SELECT * FROM tbl_emisores WHERE estadoCliente = 1 ORDER BY idCliente ASC";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerCodigo(){
        $sql = "SELECT codigoCliente as codigo FROM tbl_emisores WHERE idCliente = (SELECT MAX(idCliente) FROM tbl_emisores)";
        $datos = $this->db->query($sql);
        return $datos->row();
    }
    
    public function guardarCliente($data = null){
        if($data != null){
            $sql = "INSERT INTO tbl_emisores(codigoCliente, documentoCliente, nombreCliente, telefonoCliente, correoCliente, 
                                            paisCliente, distritoCliente, municipioCliente, direccionCliente, strPais, strEstado, strMunicipio)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                $cliente = $this->db->insert_id(); // Id de la transaccion
                return $cliente;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function guardarReceptor($data = null){
        if($data != null){
            $sql = "INSERT INTO tbl_receptores(codigoCliente, documentoCliente, nombreCliente, telefonoCliente, correoCliente, 
                                            paisCliente, distritoCliente, municipioCliente, direccionCliente, strPais, strEstado, strMunicipio, pivoteEmisor)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function obtenerCliente($id = null){
        $sql = "SELECT * FROM tbl_emisores WHERE idCliente = '$id' ";
        $datos = $this->db->query($sql);
        return $datos->row();
    }
    
    public function actualizarCliente($data = null){
        if($data != null){
            $sql = "UPDATE tbl_emisores SET documentoCliente = ?, nombreCliente = ?, telefonoCliente = ?, correoCliente = ?, 
                                            paisCliente = ?, distritoCliente = ?, municipioCliente = ?, direccionCliente = ?, strPais = ?, strEstado = ?,
                                            strMunicipio = ?
                    WHERE idCliente = ?";
            $sql2 = "UPDATE tbl_receptores SET documentoCliente = ?, nombreCliente = ?, telefonoCliente = ?, correoCliente = ?, 
                                            paisCliente = ?, distritoCliente = ?, municipioCliente = ?,  direccionCliente = ?, strPais = ?, strEstado = ?,
                                            strMunicipio = ?
                    WHERE pivoteEmisor = ?";
            if($this->db->query($sql, $data)){
                $this->db->query($sql2, $data);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    
    public function eliminarCliente($data = null){
        if($data != null){
            $sql = "UPDATE tbl_emisores SET estadoCliente = ?  WHERE idCliente = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function obtenerEmisores(){
        $sql = "SELECT * FROM tbl_emisores AS e WHERE e.estadoCliente = '1' ";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerReceptores(){
        $sql = "SELECT * FROM tbl_receptores AS r WHERE r.estadoCliente = '1' ";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerPaises($id = null){
        $sql = "SELECT * FROM tbl_pais";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerEstados(){
        $sql = "SELECT * FROM tbl_estados";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerMunicipios(){
        $sql = "SELECT * FROM tbl_municipios_condados";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerEstadosXPais($pais = null){
        $sql = "SELECT * FROM tbl_estados AS e WHERE e.idPais = '$pais' ";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerMunicipiosXDepto($depto = null){
        $sql = "SELECT * FROM tbl_municipios_condados AS mc WHERE mc.idDepartamento = '$depto' ";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function buscarCliente($data = null){
        if($data != null){
            $sql = "SELECT * FROM tbl_emisores AS m WHERE m.documentoCliente =  ? ";
            $datos = $this->db->query($sql, $data);
            return $datos->result();
        }
    }



/*
    public function obtenerArea($id = null){
        $sql = "SELECT * FROM tbl_areas_hospital WHERE idArea = '$id' ";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function obtenerEmpleados(){
        $sql = "SELECT * FROM tbl_empleados";
        $datos = $this->db->query($sql);
        return $datos->result();
    }


    public function obtenerEmpleadosXArea($area = null){
        $sql = "SELECT * FROM tbl_empleados WHERE areaEmpleado = '$area' ";
        $datos = $this->db->query($sql);
        return $datos->result();
    }




    public function validadEmpleado($id = null){
        $sql = "SELECT * FROM tbl_empleados WHERE idEmpleado = '$id'";
        $datos = $this->db->query($sql);
        return $datos->result();
    }


    // Para calendario
    public function obtenerEventos(){
        $sql = "SELECT * FROM tbl_eventos";
        $datos = $this->db->query($sql);
        return $datos->result();
    }
    // Para calendario
*/

}

?>

