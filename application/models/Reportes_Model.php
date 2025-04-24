<?php 

class Reportes_Model extends CI_Model{


    public function obtenerDestino($destino = null){
        if($destino != null){
            $sql = "SELECT * FROM tbl_destinos AS d WHERE d.idDestino = '$destino' ";
            $datos = $this->db->query($sql);
            return $datos->row();
        }
    }

    public function obtenerOrdenes($data = null){
        if($data != null){
            $sql = "SELECT o.idOrden, o.codigoOrden, o.creoQR, o.tipoServicio, o.abonoOrden, o.empacadaPor, em.nombreCliente AS emisorOrden,
                    DATE(o.creadaOrden) creada, o.abonoOrden, od.totalPaquete, od.pesoPaquete, od.precioLibra, od.declaradoPaquete,
                    em.strPais AS emPais, em.strEstado AS emEstado, em.direccionCliente AS origenOrden, em.strMunicipio AS emMunicipio,
                    r.strPais AS rPais, r.strEstado AS rEstado,r.nombreCliente as receptorOrden, r.strMunicipio AS rMunicipio,
                    o.fechaEnvio, o.fechaLlegada, r.strPais, r.strEstado,
                    r.direccionCliente AS destinoOrden, o.tipoPago, o.estadoPago, o.estadoPago, o.otraDireccionOrden, o.estadoOrden, o.gestorOrden,
                    eo.nombreEstado, em.telefonoCliente AS telefonoEmisor, r.telefonoCliente AS telefonoReceptor 
                    FROM tbl_ordenes AS o
                    INNER JOIN tbl_detalle_orden AS od ON od.idOrden = o.idOrden
                    INNER JOIN tbl_emisores AS em ON(o.emisorOrden = em.idCliente)
                    INNER JOIN tbl_receptores AS r ON(o.receptorOrden = r.idCliente)
                    INNER JOIN tbl_estado_orden AS eo ON(o.estadoOrden = eo.idEstado)
                    WHERE DATE(o.creadaOrden) BETWEEN ? AND ? ";
            $datos = $this->db->query($sql, $data);
            return $datos->result();
        }
    }

    public function obtenerOrdenesRutas($data = null){
        if($data != null){
            $sql = "SELECT o.idOrden, o.codigoOrden, o.creoQR, o.tipoServicio, o.abonoOrden, o.empacadaPor, em.nombreCliente AS emisorOrden,
                    DATE(o.creadaOrden) creada, o.abonoOrden, od.totalPaquete, od.pesoPaquete, od.precioLibra, od.declaradoPaquete,
                    em.strPais AS emPais, em.strEstado AS emEstado, em.direccionCliente AS origenOrden, em.strMunicipio AS emMunicipio,
                    r.strPais AS rPais, r.strEstado AS rEstado,r.nombreCliente as receptorOrden, r.strMunicipio AS rMunicipio,
                    o.fechaEnvio, o.fechaLlegada, r.strPais, r.strEstado,
                    r.direccionCliente AS destinoOrden, o.tipoPago, o.estadoPago, o.estadoPago, o.otraDireccionOrden, o.estadoOrden, o.gestorOrden,
                    eo.nombreEstado, em.telefonoCliente AS telefonoEmisor, r.telefonoCliente AS telefonoReceptor 
                    FROM tbl_ordenes AS o
                    INNER JOIN tbl_detalle_orden AS od ON od.idOrden = o.idOrden
                    INNER JOIN tbl_emisores AS em ON(o.emisorOrden = em.idCliente)
                    INNER JOIN tbl_receptores AS r ON(o.receptorOrden = r.idCliente)
                    INNER JOIN tbl_estado_orden AS eo ON(o.estadoOrden = eo.idEstado)
                    WHERE o.destinoOrden = ? AND DATE(o.creadaOrden) BETWEEN ? AND ? ";
            $datos = $this->db->query($sql, $data);
            return $datos->result();
        }
    }

}

?>
