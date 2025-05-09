<?php 

class Entregas_Model extends CI_Model{
    
    public function pendientesDeEntrega(){
        $sql = "SELECT 
                o.idOrden, o.codigoOrden, o.creoQR, o.abonoOrden, em.nombreCliente AS emisorOrden, em.direccionCliente AS origenOrden, r.nombreCliente as receptorOrden, 
                o.fechaEnvio, o.fechaLlegada, o.empacadaPor, o.tipoServicio, r.direccionCliente AS destinoOrden, r.strPais, r.strEstado, o.tipoPago, o.estadoPago, 
                o.estadoPago, o.otraDireccionOrden, o.estadoOrden, eo.nombreEstado, o.estadoOrden
                FROM tbl_ordenes AS o
                INNER JOIN tbl_emisores AS em ON(o.emisorOrden = em.idCliente)
                INNER JOIN tbl_receptores AS r ON(o.receptorOrden = r.idCliente)
                INNER JOIN tbl_estado_orden AS eo ON(o.estadoOrden = eo.idEstado)
                WHERE o.estadoOrden > 0";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function paqueteEntregado($data = null){
        if($data != null){
            $sql = "UPDATE tbl_ordenes AS o SET o.estadoOrden = '4' WHERE o.idOrden = ?";
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
