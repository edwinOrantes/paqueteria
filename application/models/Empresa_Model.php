<?php
class Empresa_Model extends CI_Model {
    
    public function obtenerInformacion(){
        $sql = "SELECT * FROM tbl_empresa";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function guardarInformacion($data = null){
        if($data != null){
            $sql = "INSERT INTO tbl_empresa(nombreEmpresa, telefonoEmpresa, direccionEmpresa, logoEmpresa) VALUES(?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return null;
        }
    }

    public function actualizarInformacion($data = null){
        if($data != null){
            $sql = "UPDATE tbl_empresa SET nombreEmpresa = ? , telefonoEmpresa = ? , direccionEmpresa = ? , logoEmpresa = ? WHERE idEmpresa = ? ";
           if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return null;
        }
    }

    public function eliminarUsuario($data = null){
        if($data != null){
            $sql = "UPDATE tbl_usuarios SET estadoUsuario = 0 WHERE idUsuario = ? ";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return null;
        }
    }
    
    
}
?>