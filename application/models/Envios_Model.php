<?php 

class Envios_Model extends CI_Model
{

    public function obtenerCodigo(){
        $sql = "SELECT COALESCE(MAX(e.codigoEnvio), '0') AS codigo FROM tbl_envios AS e;";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function validarCodigo($codigo = null){
        $sql = "SELECT 
                    CASE 
                        WHEN EXISTS (SELECT 1 FROM tbl_envios WHERE codigoEnvio = '$codigo') 
                        THEN (SELECT MAX(codigoEnvio) + 1 FROM tbl_envios)
                        ELSE $codigo
                    END AS codigoFinal;";
        $datos = $this->db->query($sql);
        return $datos->row();
    }

    public function guardarEnvio($data = null){
       if($data != null){
            $sql = "INSERT INTO tbl_envios(codigoEnvio, gestorEnvio, fechaEnvio, destinoOrden)
            VALUES(?, ?, ?, ?)";
            if($this->db->query($sql, $data)){
                $envio = $this->db->insert_id(); // Id de la transaccion
                return $envio;
            }else{
                return 0;
            }
       }else{
            return 0;
       }
    }

    /* // Version anterios
    public function listaEnvios(){
       $sql = "SELECT emp.nombreEmpleado, emp.telefonoEmpleado, d.nombreDestino, e.* FROM tbl_envios AS e
                INNER JOIN tbl_empleados AS emp ON e.gestorEnvio = emp.idEmpleado
                INNER JOIN tbl_destinos AS d ON d.idDestino = e.destinoOrden
                ORDER BY e.idEnvio DESC";
        $datos = $this->db->query($sql);
        return $datos->result();
    } */
    
    public function listaEnvios(){
       $sql = "SELECT d.nombreDestino, e.* FROM tbl_envios AS e
                INNER JOIN tbl_destinos AS d ON d.idDestino = e.destinoOrden
                ORDER BY e.idEnvio DESC";
        $datos = $this->db->query($sql);
        return $datos->result();
    }

    /* public function detalleEnvio($envio = null){
        if($envio != null){
            $sql = "SELECT emp.nombreEmpleado, d.nombreDestino, e.* FROM tbl_envios AS e
                    INNER JOIN tbl_empleados AS emp ON e.gestorEnvio = emp.idEmpleado
                    INNER JOIN tbl_destinos AS d ON d.idDestino = e.destinoOrden
                    WHERE e.idEnvio = '$envio' ";
            $datos = $this->db->query($sql);
            return $datos->row();
        }
    } */

    public function detalleEnvio($envio = null){
        if($envio != null){
            $sql = "SELECT d.nombreDestino, e.* FROM tbl_envios AS e
                    INNER JOIN tbl_destinos AS d ON d.idDestino = e.destinoOrden
                    WHERE e.idEnvio = '$envio' ";
            $datos = $this->db->query($sql);
            return $datos->row();
        }
    }

    public function detalleEnvioAgrupado($idEnvio = null) {
        if($idEnvio != null){
            $sql = "SELECT 
                    e.idEnvio, e.codigoEnvio, e.gestorEnvio, e.fechaEnvio, m.idMaleta, m.codigoMaleta, 
                    m.tipoMaleta, mo.idOrdenMaleta, mo.codigoOrdenMaleta, mo.strDetalle
                    FROM tbl_envios e
                    JOIN  tbl_maletas m ON e.idEnvio = m.idEnvio
                    JOIN  tbl_maleta_ordenes mo ON m.idMaleta = mo.idMaleta
                    WHERE e.idEnvio = ? AND mo.estado = '1' ";
            $resultado = $this->db->query($sql, $idEnvio)->result();
        
            $agrupado = [];
        
            foreach ($resultado as $fila) {
                $idMaleta = $fila->idMaleta;
        
                if (!isset($agrupado[$idMaleta])) {
                    $agrupado[$idMaleta] = [
                        'codigoMaleta' => $fila->codigoMaleta,
                        'tipoMaleta' => $fila->tipoMaleta,
                        'ordenes' => []
                    ];
                }
        
                $agrupado[$idMaleta]['ordenes'][] = [
                    'codigoOrdenMaleta' => $fila->codigoOrdenMaleta,
                    'strDetalle' => $fila->strDetalle
                ];
            }
        
            return $agrupado;
        }
    }

    public function detalleOrden($codigo = null){
        if($codigo != null){
            $sql = "SELECT o.idOrden, o.codigoOrden, od.contenidoPaquete, od.ordenPaquete, od.pesoPaquete, od.precioLibra, od.totalPaquete 
                    FROM tbl_ordenes AS o
                    INNER JOIN tbl_detalle_orden AS od ON od.idOrden = o.idOrden
                    WHERE o.codigoOrden = '$codigo' ";
            $datos = $this->db->query($sql);
            return $datos->row();
        }
    } 

    public function cantidaMaleta($envio = null, $tipo = null){
        if($envio != null){
            $sql = "SELECT COUNT(m.idMaleta) AS cantidad FROM tbl_maletas AS m WHERE m.idEnvio = '$envio' AND m.tipoMaleta = '$tipo' ";
            $datos = $this->db->query($sql);
            return $datos->row();
        }
    } 

    public function detallesCantidadMaleta($envio = null, $tipo = null){
        if($envio != null){
            $sql = "SELECT * FROM tbl_maletas AS m WHERE m.idEnvio = '$envio' AND m.tipoMaleta = '$tipo' ";
            $datos = $this->db->query($sql);
            return $datos->result();
        }
    } 

    
    public function guardarMaleta($data = null){
        if($data != null){
             $sql = "INSERT INTO tbl_maletas(idEnvio, tipoMaleta, codigoMaleta)
             VALUES(?, ?, ?)";
             if($this->db->query($sql, $data)){
                 return true;
             }else{
                 return false;
             }
        }else{
             return false;
        }
    }

    public function guardarOrdenMaleta($data = null){
        if($data != null){
             $sql = "INSERT INTO tbl_maleta_ordenes(idOrden, codigoOrdenMaleta, strDetalle, idMaleta)
             VALUES(?, ?, ?, ?)";
             if($this->db->query($sql, $data)){
                 return true;
             }else{
                 return false;
             }
        }else{
             return false;
        }
    }

    
    public function detalleMaleta($maleta = null){
        if($maleta != null){
            $sql = "SELECT * FROM tbl_maleta_ordenes AS mo WHERE mo.idMaleta = '$maleta' AND mo.estado = '1' ";
            $datos = $this->db->query($sql);
            return $datos->result();
        }
    } 
    
    public function filaDetalleMaleta($fila = null){
        if($fila != null){
            $sql = "SELECT * FROM tbl_maleta_ordenes AS mo WHERE mo.idOrdenMaleta = '$fila' ";
            $datos = $this->db->query($sql);
            return $datos->row();
        }
    } 
    
    public function eliminarDetalleMaleta($data = null){
        if($data != null){
            $sql = "UPDATE tbl_maleta_ordenes AS mo SET mo.estado = '0' WHERE mo.idOrdenMaleta = ? ";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    } 
    
    public function asignarGestor($data = null){
        if($data != null){
            $sql = "UPDATE tbl_envios SET gestorEnvio = ?, strGestor = ? WHERE idEnvio = ?";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
        }
    } 
 
  /*   
    public function agregarEnvio($data = null){
       if($data != null){
            $sql = "INSERT INTO tbl_envios(gestorEnvio, maletaEnvio, paqueteEnvio)
            VALUES(?, ?, ?)";
            if($this->db->query($sql, $data)){
                return true;
            }else{
                return false;
            }
       }else{
            return false;
       }
    } */


 
}

?>
