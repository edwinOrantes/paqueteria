<?php 

class Acciones_Model extends CI_Model
{
    public function obtenerAcciones($area = null){
        $sql = "SELECT 
                e.nombreEmpleado, e.areaEmpleado, ta.nombreTipoAccion, ap.*
                FROM tbl_acciones_personal AS ap
                INNER JOIN tbl_empleados AS e ON(ap.empleadoAccionPersonal = e.idEmpleado)
                INNER JOIN tbl_tipo_acciones AS ta ON(ap.tipoAccionPersonal = ta.idTipoAccion)
                WHERE e.areaEmpleado = '$area' AND ap.estadoAccionPersonal = 1";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerAccion($accion = null){
        $sql = "SELECT 
                e.nombreEmpleado, e.areaEmpleado, e.cargoEmpleado, ah.nombreArea, ta.nombreTipoAccion, ap.*
                FROM tbl_acciones_personal AS ap
                INNER JOIN tbl_empleados AS e ON(ap.empleadoAccionPersonal = e.idEmpleado)
                INNER JOIN tbl_areas_hospital AS ah ON(e.areaEmpleado = ah.idArea)
                INNER JOIN tbl_tipo_acciones AS ta ON(ap.tipoAccionPersonal = ta.idTipoAccion)
                WHERE ap.idAccionPersonal = '$accion'";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function obtenerTiposAcciones(){
        $sql = "SELECT * FROM tbl_tipo_acciones";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function ultimoCodigo(){
        $sql = "SELECT codigoAccionPersonal AS codigo FROM tbl_acciones_personal WHERE idAccionPersonal = (SELECT MAX(idAccionPersonal) FROM tbl_acciones_personal)";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function guardarAccion($data = null){
        if($data != null){
            $sql = "INSERT INTO tbl_acciones_personal(fechaAccionPersonal, codigoAccionPersonal, empleadoAccionPersonal, tipoAccionPersonal, descripcionAccionPersonal)
                VALUES(?, ?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                $accion = $this->db->insert_id(); // Id de la transaccion
                return $accion;
            }else{
                return 0;
            }

        }else{
            return 0;
        }
    }

    public function eliminarAccion($data = null){
        if($data != null){
            $sql = "UPDATE tbl_acciones_personal SET estadoAccionPersonal = 0 WHERE idAccionPersonal = ? ";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


/* 
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
    } */

}

?>


