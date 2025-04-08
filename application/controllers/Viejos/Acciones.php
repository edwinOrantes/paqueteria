<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		$this->load->model("Empleados_Model");
		$this->load->model("Permisos_Model");
		$this->load->model("Acciones_Model");
	}

	public function lista_acciones($flag = null){
        $area = $this->Empleados_Model->obtenerArea($flag);
        $data["area"] = $area;
		$data["acciones"] = $this->Acciones_Model->obtenerAcciones($area->idArea);
		$this->load->view('Base/header');
		$this->load->view('Acciones/lista_acciones', $data);
		$this->load->view('Base/footer');
		// echo json_encode($data);
	}

	public function agregar_accion($flag = null){

		$data["area"] = $this->Empleados_Model->obtenerArea($flag);
        $data["areas"] = $this->Empleados_Model->obtenerAreas();
        $data["empleados"] = $this->Empleados_Model->obtenerEmpleadosXArea($flag);
        $data["tipos"] = $this->Acciones_Model->obtenerTiposAcciones();
		// Obteniendo codigo
			$codigo = $this->Acciones_Model->ultimoCodigo();
			$correlativo = 0;
			if(is_null($codigo)){
				$correlativo = 1;
			}else{
				$correlativo = $codigo->codigo;
				$correlativo++;
			}
		// Obteniendo codigo
		$data["correlativo"] = $correlativo;
		$this->load->view('Base/header');
		$this->load->view('Acciones/agregar_accion', $data);
		$this->load->view('Base/footer');
	}

	public function guardar_accion(){
		$datos = $this->input->post();
		$area = $datos["idArea"];
		unset($datos["idArea"]);
		$resp = $this->Acciones_Model->guardarAccion($datos);
		if ($resp > 0){
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Acciones/accion_pdf/".$resp."/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Acciones/agregar_accion/".$area."/");
		}
		
		// echo json_encode($datos);
	}

	public function eliminar_accion_personal(){
		$datos = $this->input->post();
		$area = $datos["area"];
		unset($datos["area"]);
		$resp = $this->Acciones_Model->eliminarAccion($datos);
		if ($resp > 0){
			$this->session->set_flashdata("exito","La acción de personal fue eliminada con exito!");
			redirect(base_url()."Acciones/lista_acciones/".$area."/");
		}else{
			$this->session->set_flashdata("error","Error al eliminar la acción de personal");
			redirect(base_url()."Acciones/lista_acciones/".$area."/");
		}
		
		// echo json_encode($datos);
	}

	public function accion_pdf($id = null){
		$data["detalle"] = $this->Acciones_Model->obtenerAccion($id);
		$data["acciones"] = $this->Acciones_Model->obtenerTiposAcciones();
		// echo json_encode($data);
		if(is_null($data["detalle"])){
			echo '<script>
					window.close()
				</script>';
		}else{
			// Creando PDF 
				$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
				$mpdf = new \Mpdf\Mpdf([
					'margin_left' => 15,
					'margin_right' => 15,
					'margin_top' => 25,
					'margin_bottom' => 20,
					'margin_header' => 40,
					'margin_footer' => 30
					]);
				//$mpdf->setFooter('');
				//$mpdf->SetProtection(array('print'));
				$mpdf->SetTitle("Hospital Orellana, Usulutan");
				$mpdf->SetAuthor("Edwin Orantes");
				$mpdf->showWatermarkText = false;
				$mpdf->watermark_font = 'DejaVuSansCondensed';
				$mpdf->watermarkTextAlpha = 0.1;
				$mpdf->SetDisplayMode('fullpage');
				// $mpdf->AddPage('L'); //Voltear Hoja
				$html = $this->load->view('Acciones/accion_pdf', $data ,true); // Cargando hoja de estilos
				$mpdf->SetHTMLHeader();
				
						
				// FOOTER MALO EN TEORIA
				$mpdf->SetHTMLFooter('<div>
					<p style="margin-top: 50px; height: 65px"><strong>AUTORIZACIÓN:</strong></p>
					<div style="width: 100%;">
						<table class="tabla_detalle_paciente" style="margin-top: 25px; border-collapse: separate; border-spacing: 30px 0px;">
							<tr>
								<td style="border-bottom: 1px solid #000"> </td>
								<td style="border-bottom: 1px solid #000"> </td>
								<td style="border-bottom: 1px solid #000"> </td>
							</tr>
							<tr>
								<td style="border:none; width: 150px; text-align: center; font-size: 12px"><strong>Empleado</strong></td>
								<td style="border:none; width: 150px; text-align: center; font-size: 12px"><strong>Jefe inmediato</strong></td>
								<td style="border:none; width: 150px; text-align: center; font-size: 12px"><strong>Gerente general</strong></td>
							</tr>
						</table>
					</div>
				</div>');
				$mpdf->WriteHTML($html);
				$mpdf->Output('accion_de_personal.pdf', 'I');
			// Fin del PDF 
		}
		// $this->load->view('Acciones/accion_pdf', $data);
	}
/* 


	public function cancelar_permiso(){
		$datos = $this->input->post();
		$resp = $this->Permisos_Model->cancelarPermiso($datos["idPermiso"]);
		if ($resp){
			$this->Permisos_Model->cancelarEvento($datos["idPermiso"], "P");
			$this->session->set_flashdata("exito","Permiso cancelado con exito");
			redirect(base_url()."Permisos/lista_permisos/".$datos["area"]."/");
		}else{
			$this->session->set_flashdata("error","Error al cancelar el permiso");
			redirect(base_url()."Permisos/lista_permisos/".$datos["area"]."/");
		}
	} */
}

?>