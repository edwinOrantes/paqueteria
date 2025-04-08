<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		$this->load->model("Empleados_Model");
		$this->load->model("Permisos_Model");
		$this->load->model("Calendario_Model");
	}

	public function index(){
        $datos = $this->Calendario_Model->obtenerEventos();
		$eventos = array();
		foreach ($datos as $row){
			$eventos[] = array(
            'id' 	=> $row->idEvento, 
            'title' => $row->tituloEvento, 
            'description' => trim($row->descripcionEvento), 
            'start' => date_format( date_create($row->inicioEvento) ,"Y-m-d H:i:s"),
            'end' 	=> date_format( date_create($row->finEvento) ,"Y-m-d H:i:s"),
            'color' => $row->colorEvento,
            'vieneDe' => $row->vieneDe,
            );
		}

		$data['eventos'] = json_encode($eventos);
        // echo json_encode($data['eventos']);
		$this->load->view('Base/header');
		$this->load->view('Eventos/calendario_eventos', $data);
		$this->load->view('Base/footer');
	}

    public function agregar_evento(){
        $datos = $this->input->post();
        $resp = $this->Calendario_Model->guardarEvento($datos, 0);
		if ($resp){
			$this->session->set_flashdata("exito","Datos agregados con exito");
			redirect(base_url()."Calendario/");
		}else{
			$this->session->set_flashdata("error","Error al agregar los datos");
			redirect(base_url()."Calendario/");
		}
    }

    public function actualizar_evento(){
        $datos = $this->input->post();
        $resp = $this->Calendario_Model->actualizarEvento($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos actualizados con exito");
			redirect(base_url()."Calendario/");
		}else{
			$this->session->set_flashdata("error","Error al actualizar los datos");
			redirect(base_url()."Calendario/");
		}
    }

    public function eliminar_evento($evento = null){
        $resp = $this->Calendario_Model->eliminarEvento($evento);
		if ($resp){
			$this->session->set_flashdata("exito","Datos eliminados con exito");
			redirect(base_url()."Calendario/");
		}else{
			$this->session->set_flashdata("error","Error al eliminar los datos");
			redirect(base_url()."Calendario/");
		}
    }


}

?>