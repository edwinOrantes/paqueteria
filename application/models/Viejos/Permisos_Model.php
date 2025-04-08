<?php 

class Permisos_Model extends CI_Model
{
    

    public function obtenerPermisos($area = null){
        $sql = "SELECT 
                e.nombreEmpleado, e.areaEmpleado, mp.nombreMotivoPermiso, p.*
                FROM tbl_permisos AS p
                INNER JOIN tbl_empleados AS e ON(p.empleadoPermiso = e.idEmpleado)
                INNER JOIN tbl_motivo_permiso AS mp ON(p.motivoPermiso = mp.idMotivoPermiso)
                WHERE e.areaEmpleado = '$area' AND p.estadoPermiso = 1";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerPermiso($empleado = null){
        $sql = "SELECT 
                e.nombreEmpleado, e.areaEmpleado, mp.nombreMotivoPermiso, p.*
                FROM tbl_permisos AS p
                INNER JOIN tbl_empleados AS e ON(p.empleadoPermiso = e.idEmpleado)
                INNER JOIN tbl_motivo_permiso AS mp ON(p.motivoPermiso = mp.idMotivoPermiso)
                WHERE e.idEmpleado = '$empleado' ";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerAreas(){
        $sql = "SELECT * FROM tbl_areas_hospital";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerMotivos(){
        $sql = "SELECT * FROM tbl_motivo_permiso";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function guardarPermiso($data = null){
        if($data != null){
            if(isset($data["otroMotivo"])){
                $sql = "INSERT INTO tbl_permisos(empleadoPermiso, efectuoPermiso, motivoPermiso, otroMotivo, horasPermiso, diaPermiso, dePermiso, hastaPermiso, autorizacionPermiso)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            }else{
                $sql = "INSERT INTO tbl_permisos(empleadoPermiso, efectuoPermiso, motivoPermiso, horasPermiso, diaPermiso, dePermiso, hastaPermiso, autorizacionPermiso)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            }
            if($this->db->query($sql, $data)){
                $permiso = $this->db->insert_id(); // Id de la transaccion
                return $permiso;
            }else{
                return 0;
            }

        }else{
            return 0;
        }
    }

    public function cancelarPermiso($id = null){
        $sql = "UPDATE tbl_permisos SET estadoPermiso = 0 WHERE idPermiso = '$id'";
        if($this->db->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function cancelarEvento($id = null, $de = null){
        $sql = "UPDATE tbl_eventos SET estadoEvento = 0 WHERE flagEvento = '$id' AND vieneDe = '$de' ";
        if($this->db->query($sql)){
            return true;
        }else{
            return false;
        }
    }

}

?>