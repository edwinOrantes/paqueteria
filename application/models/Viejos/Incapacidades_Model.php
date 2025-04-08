<?php 

class Incapacidades_Model extends CI_Model
{
    

    public function obtenerIncapacidades($area = null){
        $sql = "SELECT 
                e.nombreEmpleado, e.areaEmpleado, i.*
                FROM tbl_incapacidades AS i
                INNER JOIN tbl_empleados AS e ON(i.idEmpleado = e.idEmpleado)
                WHERE e.areaEmpleado = '$area' AND i.estadoIncapacidad = 1";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerIncapacidad($empleado = null){
        $sql = "SELECT 
                e.nombreEmpleado, e.areaEmpleado, i.*
                FROM tbl_incapacidades AS i
                INNER JOIN tbl_empleados AS e ON(i.idEmpleado = e.idEmpleado)
                WHERE e.idEmpleado = '$empleado' AND i.estadoIncapacidad = 1";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function guardarIncapacidad($data = null){
        if($data != null){
            $sql = "INSERT INTO tbl_incapacidades(idEmpleado, deIncapacidad, hastaIncapacidad, diagnosticoIncapacidad, estadoIncapacidad)
                    VALUES(?, ?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                $incapacidad = $this->db->insert_id(); // Id de la transaccion
                return $incapacidad;
            }else{
                return 0;
            }
    
        }else{
            return 0;
        }
    }
    
    public function cancelarIncapacidad($id = null){
        $sql = "UPDATE tbl_incapacidades SET estadoIncapacidad = 0 WHERE idIncapacidad = '$id'";
        if($this->db->query($sql)){
            return true;
        }else{
            return false;
        }
    }

}

?>