<?php 

class Ordenes_Model extends CI_Model
{

    public function obtenerDestino(){
        $sql = "SELECT * FROM tbl_destinos";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function estadosOrdenes(){
        $sql = "SELECT * FROM tbl_estado_orden";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerOrdenes(){
        $sql = "SELECT
                o.idOrden, o.codigoOrden, o.creoQR, o.abonoOrden, em.nombreCliente AS emisorOrden, em.direccionCliente AS origenOrden, r.nombreCliente as receptorOrden, o.fechaEnvio, o.fechaLlegada,
                o.empacadaPor, o.tipoServicio, r.direccionCliente AS destinoOrden, r.strPais, r.strEstado, o.tipoPago, o.estadoPago, o.estadoPago, o.otraDireccionOrden, o.estadoOrden, eo.nombreEstado
                FROM tbl_ordenes AS o
                INNER JOIN tbl_emisores AS em ON(o.emisorOrden = em.idCliente)
                INNER JOIN tbl_receptores AS r ON(o.receptorOrden = r.idCliente)
                INNER JOIN tbl_estado_orden AS eo ON(o.estadoOrden = eo.idEstado)";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    public function obtenerOrden($id = null){
        $sql = "SELECT o.idOrden, o.codigoOrden, o.creoQR, o.tipoServicio, o.abonoOrden, o.empacadaPor, em.nombreCliente AS emisorOrden,
                em.strPais AS emPais, em.strEstado AS emEstado, em.direccionCliente AS origenOrden, em.strMunicipio AS emMunicipio,
                r.strPais AS rPais, r.strEstado AS rEstado,r.nombreCliente as receptorOrden, r.strMunicipio AS rMunicipio,
                o.fechaEnvio, o.fechaLlegada, r.strPais, r.strEstado,
                r.direccionCliente AS destinoOrden, o.tipoPago, o.estadoPago, o.estadoPago, o.otraDireccionOrden, o.estadoOrden, o.gestorOrden,
                eo.nombreEstado, em.telefonoCliente AS telefonoEmisor, r.telefonoCliente AS telefonoReceptor 
                FROM tbl_ordenes AS o
                INNER JOIN tbl_emisores AS em ON(o.emisorOrden = em.idCliente)
                INNER JOIN tbl_receptores AS r ON(o.receptorOrden = r.idCliente)
                INNER JOIN tbl_estado_orden AS eo ON(o.estadoOrden = eo.idEstado)
                WHERE o.idOrden = '$id' ";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function obtenerCodigo(){
        $sql = "SELECT codigoOrden as codigo FROM tbl_ordenes WHERE idOrden = (SELECT MAX(idOrden) FROM tbl_ordenes)";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function validarCodigoOrden($codigo){
        $sql = "SELECT COALESCE((SELECT o.codigoOrden FROM tbl_ordenes AS o WHERE o.codigoOrden = '$codigo'), 0) AS codigoOrden;";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function guardarOrden($data = null){
        if($data != null){
            $sql = "INSERT INTO tbl_ordenes(codigoOrden, fechaEnvio, fechaLlegada, emisorOrden, receptorOrden, tipoPago, 
                                estadoPago, tipoServicio, abonoOrden, destinoOrden, observacionesOrden, empacadaPor)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                $orden = $this->db->insert_id(); // Id de la transaccion
                return $orden;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function obtenerDetalleOrden($id = null){
        if($id != null){
            $sql = "SELECT * FROM tbl_detalle_orden WHERE idOrden = '$id' AND eliminadoArticulo = '1' ";
            $datos = $this->db->query($sql);
            return $datos->row();
        }else{
            return false;
        }
    }

    public function guardarDetalleOrden($data = null){
        if($data != null){
            $sql = "INSERT INTO tbl_detalle_orden(contenidoPaquete, pesoPaquete, precioLibra, declaradoPaquete, adicionalesPaquete, ordenPaquete, totalPaquete, idOrden)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function actualizarDetalleOrden($data = null){
        if($data != null){
            $sql = "UPDATE tbl_detalle_orden SET contenidoPaquete = ?, pesoPaquete = ?, precioLibra = ?, declaradoPaquete = ?, adicionalesPaquete = ?, ordenPaquete = ?,
                                                 totalPaquete = ?
                    WHERE idDetalle = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }










    /* public function actualizarDetalleOrden($data = null){
        if($data != null){
            $sql = "UPDATE tbl_detalle_orden SET nombreArticulo = ?, pesoArticulo = ?, precioKilo = ?, totalArticulo = ?, 
                    detalleArticulo = ? WHERE idDetalle = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    } */

    public function eliminarDetalleOrden($data = null){
        if($data != null){
            $sql = "UPDATE tbl_detalle_orden SET eliminadoArticulo = ?  WHERE idDetalle = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function guardarQR($orden = null, $qr = null){
        if($orden != null && $qr != null){
            $sql = "INSERT INTO tbl_orden_qr(idOrden, nombreQr) VALUES('$orden', '$qr')";
            if($this->db->query($sql)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function actualizarEstadoQR($orden = null){
        if($orden != null){
            $sql = "UPDATE tbl_ordenes SET creoQR = '1' WHERE idOrden  = '$orden' ";
            if($this->db->query($sql)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function obtenerQr($orden = null){
        if($orden != null){
            $sql = "SELECT * FROM tbl_orden_qr WHERE idOrden = '$orden' ";
            $datos = $this->db->query($sql);
            return $datos->result();
        }
    }
    
/*

    public function obtenerCliente($id = null){
        $sql = "SELECT * FROM tbl_clientes WHERE idCliente = '$id' ";
        $datos = $this->db->query($sql);
        return $datos->row();
    }
    
    public function actualizarCliente($data = null){
        if($data != null){
            $sql = "UPDATE tbl_clientes SET nombreCliente = ?, documentoCliente = ?, telefonoCliente = ?, direccionCliente = ?
                    WHERE idCliente = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    */

 
}

?>
