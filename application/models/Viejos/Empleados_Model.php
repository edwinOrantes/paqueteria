<?php 

class Empleados_Model extends CI_Model
{

    public function obtenerAreas(){
        $sql = "SELECT * FROM tbl_areas_hospital";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

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

    public function obtenerEmpleado($id = null){
        $sql = "SELECT ah.nombreArea, e.* FROM tbl_empleados AS e
                INNER JOIN tbl_areas_hospital AS ah ON(e.areaEmpleado = ah.idArea)
                WHERE idEmpleado = '$id' ";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function obtenerEmpleadosXArea($area = null){
        $sql = "SELECT * FROM tbl_empleados WHERE areaEmpleado = '$area' ";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function guardarEmpleado($data = null){
        if($data != null){
            $sql = "INSERT INTO tbl_empleados(nombreEmpleado, telefonoEmpleado, duiEmpleado, correoEmpleado, nacimientoEmpleado, ingresoEmpleado,
                    salarioEmpleado, areaEmpleado, direccionEmpleado) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function actualizarEmpleado($data = null){
        if($data != null){
            $sql = "UPDATE tbl_empleados SET nombreEmpleado = ?, telefonoEmpleado = ?, duiEmpleado = ?, correoEmpleado = ?, nacimientoEmpleado = ?,
                    ingresoEmpleado = ?, salarioEmpleado = ?, areaEmpleado = ?, direccionEmpleado = ? WHERE idEmpleado = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function eliminarEmpleado($data = null){
        if($data != null){
            $sql = "UPDATE tbl_empleados SET estadoEmpleado = ?  WHERE idEmpleado = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
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

}

?>

