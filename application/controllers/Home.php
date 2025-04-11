<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		$this->load->model("Usuarios_Model");
		//$this->load->model("Incapacidades_Model");
		//$this->load->model("Permisos_Model");
	}

	public function index(){

		$this->load->view('Base/header_login');
		$this->load->view('Base/login');
		$this->load->view('Base/footer_login');

	}

	public function validar_usuario(){
		$inputs = $this->input->post();
		$params = array('nombreUsuario' => $inputs['nombreUsuario'], 'psUsuario' => md5($inputs['psUsuario']));
		$datos = $this->Usuarios_Model->validarUsuario($params);
		
		if ($datos->estadoUsuario == 1) {
			
			$userName = explode(" ", $datos->nombreEmpleado);
			$ses = array(
				'usuario_h'=> $datos->nombreUsuario,
				'id_usuario_h'=> $datos->idUsuario,
				'id_empleado_h'=> $datos->idEmpleado,
				'acceso_h'=> $datos->idAcceso,
				'empleado_h'=> $userName[0]." ".$userName[2], 	
				'acceso_nombre'=> $datos->nombreAcceso,
				'valido'=> TRUE,
				'verificacion'=> $datos->codigoVerificacion,
				'nivel'=> $datos->nivelUsuario,
				'global'=> $datos->pivoteUsuario,
				'nombreEmpleado'=> $datos->nombreEmpleado,
				'duiEmpleado'=> $datos->duiEmpleado
			);

			$this->session->set_userdata($ses);
			$this->session->set_flashdata("exito", "Bienvenido nuevamente: ".$this->session->userdata('empleado_h')."");
			/* // Agregando evento a bitacora
				$data["idUsuario"] = $this->session->userdata('id_usuario_h');
				$data["descripcionBitacora"] = "El usuario: ".$this->session->userdata('usuario_h')." Ha iniciado sesión";
				$this->Usuarios_Model->insertarBitacora($data);
			// Mandando a cada usuario a su respectivo lugar */
			switch ($datos->idAcceso) {
				case 1:
					// redirect(base_url()."Medicamento/");
					redirect(base_url()."Clientes/");
					break;

				default:
					// redirect(base_url()."Ventas/");
					redirect(base_url()."Clientes/");
					break;
			}

			// echo json_encode($datos);
		}
		else{
			$this->session->set_flashdata("error", "Los datos ingresados son incorrectos");
			redirect(base_url());
		} 


		// echo json_encode($datos);
	}
}
