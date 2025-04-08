<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	// Clases para el reporte en excel
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\Helper\Sample;
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\RichText\RichText;
	use PhpOffice\PhpSpreadsheet\Shared\Date;
	use PhpOffice\PhpSpreadsheet\Style\Alignment;
	use PhpOffice\PhpSpreadsheet\Style\Border;
	use PhpOffice\PhpSpreadsheet\Style\Color;
	use PhpOffice\PhpSpreadsheet\Style\Fill;
	use PhpOffice\PhpSpreadsheet\Style\Font;
	use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
	use PhpOffice\PhpSpreadsheet\Style\Protection;
	use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
	use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
	use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
	use PhpOffice\PhpSpreadsheet\Worksheet;

class Empleado extends CI_Controller {

	public function __construct(){
		parent::__construct();
		/* date_default_timezone_set('America/El_Salvador');
		if (!$this->session->has_userdata('valido')){
			$this->session->set_flashdata("error", "Debes iniciar sesión");
			redirect(base_url());
		} */
		$this->load->model("Empleado_Model");
	}

    public function index(){
        $data["cargos"] = $this->Empleado_Model->obtenerCargos();
        $this->load->view("Base/header");
        $this->load->view("Empleado/agregar_empleado", $data);
        $this->load->view("Base/footer");
    }
    
    public function obtener_municipios(){
		if($this->input->is_ajax_request())
		{
			$id =$this->input->get("id");
			$datos = $this->Paciente_Model->obtenerMunicipios($id);
			echo json_encode($datos);
		}
		else
		{
			echo "Error...";
		}
	}

    public function agregar_empleado(){
		$datos = $this->input->post();
		$bool = $this->Empleado_Model->guardarEmpleado($datos);
		if($bool){
			$this->session->set_flashdata("exito","Los datos fueron guardados con exito!");
			redirect(base_url()."Empleado/");
		}else{
			$this->session->set_flashdata("error","Hubo un error al guardar los datos!");
			redirect(base_url()."Empleado/");
		}
        // echo json_encode($datos);
	}

    public function lista_empleados(){
		$this->load->view('Base/header');
		$data["empleados"] = $this->Empleado_Model->obtenerEmpleados();
        $data["cargos"] = $this->Empleado_Model->obtenerCargos();
		$this->load->view('Empleado/lista_empleados', $data);
		$this->load->view('Base/footer');
	}

	public function actualizar_empleado(){
		$datos = $this->input->post();
		$bool = $this->Empleado_Model->actualizarEmpleado($datos);
		if($bool){
			$this->session->set_flashdata("exito","Los datos fueron actualizados con exito!");
			redirect(base_url()."Empleado/lista_empleados");
		}else{
			$this->session->set_flashdata("error","Hubo un error al actualizar los datos!");
			redirect(base_url()."Empleado/lista_empleados");
		}

        // echo json_encode($datos);
		
	}

    public function eliminar_empleado(){
		$datos = $this->input->post();
		$bool = $this->Empleado_Model->eliminarEmpleado($datos);
		if($bool){
			$this->session->set_flashdata("exito","Los datos fueron eliminados con exito!");
			redirect(base_url()."Empleado/lista_empleados");
		}else{
			$this->session->set_flashdata("error","Hubo un error al aliminar los datos!");
			redirect(base_url()."Empleado/lista_empleados");
		}
        // echo json_encode($datos);
	}

    // Funciones para cargos de empleados

    public function cargos_empleados(){
		$cargos = $this->Empleado_Model->obtenerCargos();
		$data = array('cargos' => $cargos);
        $this->load->view("Base/header");
        $this->load->view("Empleado/cargos_empleado", $data);
        $this->load->view("Base/footer");
    }

    public function guardar_cargo(){
        $datos = $this->input->post();
        $bool = $this->Empleado_Model->guardarCargo($datos);
		if($bool){
			$this->session->set_flashdata("exito","Los datos fueron guardados con exito!");
			redirect(base_url()."Empleado/cargos_empleados");
		}else{
			$this->session->set_flashdata("error","Hubo un error al guardar los datos!");
			redirect(base_url()."Empleado/cargos_empleados");
		}
    }

    public function actualizar_cargo(){
        $datos = $this->input->post();
        $bool = $this->Empleado_Model->actualizarCargo($datos);
		if($bool){
			$this->session->set_flashdata("exito","Los datos fueron actualizados con exito!");
			redirect(base_url()."Empleado/cargos_empleados");
		}else{
			$this->session->set_flashdata("error","Hubo un error al actualizar los datos!");
			redirect(base_url()."Empleado/cargos_empleados");
		}
    }

    public function eliminar_cargo(){
        $datos = $this->input->post();
        $bool = $this->Empleado_Model->eliminarCargo($datos);
		if($bool){
			$this->session->set_flashdata("exito","Los datos fueron eliminados con exito!");
			redirect(base_url()."Empleado/cargos_empleados");
		}else{
			$this->session->set_flashdata("error","Hubo un error al eliminar los datos!");
			redirect(base_url()."Empleado/cargos_empleados");
		}
    }

	public function vacaciones_empleados(){
		$this->load->view("Base/header");
        $this->load->view("Empleado/vacaciones");
        $this->load->view("Base/footer");
	}

	function obtenerCumples(){
		$empleados = $this->Empleado_Model->obtenerCumpleaños();
		foreach($empleados->result_array() as $row)
		{
			$vacacioInicio = ($this->anios_entre_fecha($row['nacimientoEmpleado']) + 1 );
			//$vacacioFin = $vacacioInicio + 15;

			$cumple =  date("Y-m-d",strtotime($row['nacimientoEmpleado']."+ $vacacioInicio year"));

			$data[] = array(
				'id'	=>	$row['idEmpleado'],
				'title'	=>	$row['nombreEmpleado'],
				'start'	=>	$cumple,
				//'start'	=>	$vacacioFin
			);

			//echo $vacacioInicio."<br>";
		}
		echo json_encode($data);
		//echo $cumple;
	}

	private function anios_entre_fecha($fecha_nacimiento){
		$nacimiento = new DateTime($fecha_nacimiento);
		$ahora = new DateTime(date("Y-m-d"));
		$diferencia = $ahora->diff($nacimiento);
		return $diferencia->format("%y");
	}
}
