<?php 

class Calendario_Model extends CI_Model
{

    public function obtenerEventos(){
        $sql = "SELECT * FROM tbl_eventos WHERE estadoEvento = 1";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function guardarEvento($data = null, $flag = 0){
        if($data != null){
            if($flag == 0){
                $sql = "INSERT INTO tbl_eventos(tituloEvento, descripcionEvento, colorEvento, inicioEvento, finEvento) VALUES(?, ?, ?, ?, ?)";
            }else{
                $sql = "INSERT INTO tbl_eventos(tituloEvento, descripcionEvento, colorEvento, inicioEvento, finEvento, flagEvento, vieneDe) VALUES(?, ?, ?, ?, ?, ?, ?)";
            }
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function actualizarEvento($data = null){
        if($data != null){
            $sql = "UPDATE tbl_eventos SET tituloEvento = ?, descripcionEvento = ?, colorEvento = ?, inicioEvento = ?, finEvento = ? WHERE idEvento = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function eliminarEvento($evento = null){
        $sql = "DELETE FROM tbl_eventos  WHERE idEvento = '$evento'";
        if($this->db->query($sql)){
            return true;
        }else{
            return false;
        }
    }

}

?>

