<?php
class Empleado_Model extends CI_Model {

     // Obtener empleados
     public function obtenerEmpleados(){
        $sql = "SELECT * FROM tbl_empleados as e INNER JOIN tbl_cargos as c ON(e.cargoEmpleado = c.idCargo) WHERE estadoEmpleado = '1'";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function empleadosPorCargo($cargo = null){
        $sql = "SELECT * FROM tbl_empleados where cargoEmpleado = '$cargo' ";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    // Guardar un empleados
    public function guardarEmpleado($data = null){
        if ($data != null) {
            $sql = "INSERT INTO tbl_empleados(nombreEmpleado, edadEmpleado, telefonoEmpleado, cargoEmpleado, sexoEmpleado, direccionEmpleado)
                    VALUES(?, ?, ?, ?, ?, ?)";
            if ($this->db->query($sql, $data)) {
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
            $sql = "UPDATE tbl_empleados SET nombreEmpleado = ?, edadEmpleado = ?, telefonoEmpleado = ?,
                        cargoEmpleado = ?, sexoEmpleado = ?, direccionEmpleado = ?
                            WHERE idEmpleado = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function eliminarEmpleado($id){
        $sql = "UPDATE tbl_empleados set estadoEmpleado = 0 WHERE idEmpleado = ?";
        if ($this->db->query($sql, $id)) {
            return true;
        }else{
            return false;
        }
    }

/*
    // Actualizar un empleados

    // Eliminar un empleados

    // Obtener empleados
    public function obtenerHabitaciones(){
        $sql = "SELECT * FROM tbl_habitacion";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerPacientesHabitacion(){
        $sql = "SELECT p.nombrePaciente, p.apellidoPaciente, p.direccionPaciente, h.numeroHabitacion, h.estadoHabitacion, hc.idHoja, hc.fechaHoja FROM tbl_hoja_cobro as hc
                INNER JOIN tbl_pacientes as p ON(hc.idPaciente = p.idPaciente) INNER JOIN tbl_habitacion as h ON(hc.idHabitacion = h.idHabitacion)
                WHERE h.estadoHabitacion = '1'";
        $datos = $this->db->query($sql);
        return $datos->result();

    }*/


    // Funciones para cargos de empleados guardarCargo($datos)
    public function obtenerCargos(){
        $sql = "SELECT * FROM tbl_cargos";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function guardarCargo($data = null){
        if ($data != null) {
            $sql = "INSERT INTO tbl_cargos(nombreCargo)
                    VALUES(?)";
            if ($this->db->query($sql, $data)) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function actualizarCargo($data = null){
        if($data != null){
            $sql = "UPDATE tbl_cargos SET nombreCargo = ? WHERE idCargo = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function eliminarCargo($data = null){
        if($data != null){
            $sql = "DELETE FROM tbl_cargos WHERE idCargo = ? ";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}
?>