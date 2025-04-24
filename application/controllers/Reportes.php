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

class Reportes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		if (!$this->session->has_userdata('valido')){
			$this->session->set_flashdata("error", "Debes iniciar sesión");
			redirect(base_url());
		}
		$this->load->model("Reportes_Model");
		$this->load->model("Clientes_Model");
		$this->load->model("Empresa_Model");
		$this->load->model("Ordenes_Model");
	}

    public function index(){}


    public function lista_clientes(){
	
		$datos = $this->Clientes_Model->obtenerClientes();

		// echo json_encode($datos);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', '#');
		$sheet->setCellValue('B1', 'Cliente');
		$sheet->setCellValue('C1', 'Teléfono');
		$sheet->setCellValue('D1', 'Documento');
		$sheet->setCellValue('E1', 'Dirección');
			
		$number = 1;
		$flag = 2;
		$tipoEntidad = "";
        $proveedor = "";
		foreach($datos as $d){
			$sheet->setCellValue('A'.$flag, $number);
			$sheet->setCellValue('B'.$flag, str_replace("-", " ", $d->nombreCliente));
			$sheet->setCellValue('C'.$flag, $d->telefonoCliente);
			$sheet->setCellValue('D'.$flag, $d->documentoCliente);
			$sheet->setCellValue('E'.$flag, 
					$d->direccionCliente."; ".$this->formatear_direccion($d->strPais, $d->strEstado, $d->strMunicipio));
	
			$flag = $flag+1;
			$number = $number+1;
		}
		$styleThinBlackBorderOutline = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => Border::BORDER_THIN,
					'color' => ['argb' => 'FF000000'],
				],
			],
		];
		$sheet->getStyle('A1:E1')->getFont()->setBold(true);		
		$sheet->getStyle('A1:E'.$flag)->getFont()->setSize(12);
		$sheet->getStyle('A1:E1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

		$sheet->getStyle('A1:E'.$flag)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			//Custom width for Individual Columns
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$curdate = date('d-m-Y H:i:s');
		$writer = new Xlsx($spreadsheet);
		$filename = 'listado_de_gastos_'.$curdate;
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	
	}

    public function ordenes_por_fecha(){
		$this->load->view('Base/header');
		$this->load->view('Reportes/ordenes_por_fecha');
		$this->load->view('Base/footer');
	}

    public function pivote_ordenes_fecha(){
		$datos = $this->input->post();
		$valido =  $this->validarFechas($datos["fechaInicio"], $datos["fechaFin"]);

		if($valido == 1){
			$params = urlencode(base64_encode(serialize($datos)));
			if ($datos["tipoReporte"] == 1) {
				redirect(base_url()."Reportes/ordenes_por_fecha_excel/".$params);
			}else{
				redirect(base_url()."Reportes/ordenes_por_fecha_pdf/".$params);
			}
		}else{
			$this->session->set_flashdata("error","El rango de fechas es invalido");
			redirect(base_url()."Reportes/ordenes_por_fecha");
		}
		// echo json_encode($datos);
	}

    public function ordenes_por_fecha_pdf($params = null){
		$datos = unserialize(base64_decode(urldecode($params)));
		unset($datos["tipoReporte"]);
		$data["empresa"] = $this->Empresa_Model->obtenerInformacion();
		$data["ordenes"] = $this->Reportes_Model->obtenerOrdenes($datos);
		// echo json_encode($ordenes);

		// Creando PDF 
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
			$mpdf = new \Mpdf\Mpdf([
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 15,
				'margin_bottom' => 10,
				'margin_header' => 10,
				'margin_footer' => 30
				]);
			//$mpdf->setFooter('');
			//$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Encomiendas Campos");
			$mpdf->SetAuthor("Edwin Orantes");
			$mpdf->showWatermarkText = false;
			$mpdf->watermark_font = 'DejaVuSansCondensed';
			$mpdf->watermarkTextAlpha = 0.1;
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->AddPage('L'); //Voltear Hoja
			$html = $this->load->view('Reportes/ordenes_por_fecha_pdf', $data ,true); // Cargando hoja de estilos
			$mpdf->SetHTMLHeader();
			$mpdf->SetHTMLFooter();
			
			$mpdf->WriteHTML($html);
			$mpdf->Output('orden_envio.pdf', 'I');
		// Fin del PDF 

	
	}

    public function ordenes_por_fecha_excel($params = null){
		$datos = unserialize(base64_decode(urldecode($params)));
		unset($datos["tipoReporte"]);
		$ordenes = $this->Reportes_Model->obtenerOrdenes($datos);
		// echo json_encode($ordenes);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', '#');
		$sheet->setCellValue('B1', 'CODIGO');
		$sheet->setCellValue('C1', 'FECHA');
		$sheet->setCellValue('D1', 'EMISOR');
		$sheet->setCellValue('E1', 'RECEPTOR');
		$sheet->setCellValue('F1', 'ESTADO DEL PAGO');
		$sheet->setCellValue('G1', 'ESTADO DEL ENVIO');
		$sheet->setCellValue('H1', 'DIRECCION DE ENTREGA');
		$sheet->setCellValue('I1', 'PESO EN LIBRAS');
		$sheet->setCellValue('J1', 'PRECIO POR LIBRA');
		$sheet->setCellValue('K1', 'TOTAL');
		$sheet->setCellValue('L1', 'ABONADO');
		$sheet->setCellValue('M1', 'PENDIENTE');
			
		$number = 1;
		$flag = 2;
		$tipoEntidad = "";
        $proveedor = "";
		foreach($ordenes as $d){
			$sheet->setCellValue('A'.$flag, $number);
			$sheet->setCellValue('B'.$flag, $d->codigoOrden);
			$sheet->setCellValue('C'.$flag, $d->creada);
			$sheet->setCellValue('D'.$flag, str_replace("-", " ", $d->emisorOrden));
			$sheet->setCellValue('E'.$flag, str_replace("-", " ", $d->receptorOrden));
			$sheet->setCellValue('F'.$flag, $d->estadoPago);
			$sheet->setCellValue('G'.$flag, $d->nombreEstado);
			$sheet->setCellValue('H'.$flag, 
					$d->destinoOrden.", ".$this->formatear_direccion($d->rPais, $d->rEstado, $d->rMunicipio));
			$sheet->setCellValue('I'.$flag, $d->pesoPaquete);
			$sheet->setCellValue('J'.$flag, number_format($d->precioLibra, 2) );

			if($d->estadoPago == "Pagado"){
				$sheet->setCellValue('K'.$flag, number_format($d->totalPaquete, 2) );
				$sheet->setCellValue('L'.$flag, number_format($d->abonoOrden ,2) );
				$sheet->setCellValue('M'.$flag, number_format( 0 ,2) );
			}else{
				$sheet->setCellValue('K'.$flag, number_format($d->totalPaquete, 2) );
				$sheet->setCellValue('L'.$flag, number_format($d->abonoOrden ,2) );
				$sheet->setCellValue('M'.$flag, number_format( ($d->totalPaquete-$d->abonoOrden) ,2) );
			}
	
			$flag = $flag+1;
			$number = $number+1;
		}
			
		$styleThinBlackBorderOutline = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => Border::BORDER_THIN,
					'color' => ['argb' => 'FF000000'],
				],
			],
		];
		$sheet->getStyle('A1:M1')->getFont()->setBold(true);		
		$sheet->getStyle('A1:M'.$flag)->getFont()->setSize(12);
		$sheet->getStyle('A1:M1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

		$sheet->getStyle('A1:M'.$flag)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		//Custom width for Individual Columns
		foreach (range('A', 'M') as $col) {
			$sheet->getColumnDimension($col)->setAutoSize(true);
		}
		$curdate = date('d-m-Y H:i:s');
		$writer = new Xlsx($spreadsheet);
		$filename = 'lista de ordenes_'.$curdate;
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	
	}

	public function ordenes_por_ruta(){
		$data["destinos"] = $this->Ordenes_Model->obtenerDestino();
		$this->load->view('Base/header');
		$this->load->view('Reportes/ordenes_por_ruta', $data);
		$this->load->view('Base/footer');
		// echo json_encode($data);
	}

    public function pivote_ordenes_ruta(){
		$datos = $this->input->post();
		$valido =  $this->validarFechas($datos["fechaInicio"], $datos["fechaFin"]);

		if($valido == 1){
			$params = urlencode(base64_encode(serialize($datos)));
			if ($datos["tipoReporte"] == 1) {
				redirect(base_url()."Reportes/ordenes_por_ruta_excel/".$params);
			}else{
				redirect(base_url()."Reportes/ordenes_por_ruta_pdf/".$params);
			}
		}else{
			$this->session->set_flashdata("error","El rango de fechas es invalido");
			redirect(base_url()."Reportes/ordenes_por_ruta");
		}
		// echo json_encode($valido);
	}

	public function ordenes_por_ruta_excel($params = null){
		$datos = unserialize(base64_decode(urldecode($params)));
		$destino = $this->Reportes_Model->obtenerDestino($datos["rutaReporte"]);
		unset($datos["tipoReporte"]);
		$ordenes = $this->Reportes_Model->obtenerOrdenesRutas($datos);
		
		// Creando excel
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->setCellValue('A1', strtoupper('Detalle de las ordenes con destino a: '.$destino->nombreDestino.", durante las fechas: ".$datos["fechaInicio"]." y ".$datos["fechaFin"]) );
			$sheet->mergeCells('A1:M1');
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('A1')->getFont()->setSize(12); // Cambia el tamaño a 14 (puedes ajustar este número)
			// Alinear el texto al centro (opcional)
			$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

			$sheet->setCellValue('A2', '#');
			$sheet->setCellValue('B2', 'CODIGO');
			$sheet->setCellValue('C2', 'FECHA');
			$sheet->setCellValue('D2', 'EMISOR');
			$sheet->setCellValue('E2', 'RECEPTOR');
			$sheet->setCellValue('F2', 'ESTADO DEL PAGO');
			$sheet->setCellValue('G2', 'ESTADO DEL ENVIO');
			$sheet->setCellValue('H2', 'DIRECCION DE ENTREGA');
			$sheet->setCellValue('I2', 'PESO EN LIBRAS');
			$sheet->setCellValue('J2', 'PRECIO POR LIBRA');
			$sheet->setCellValue('K2', 'TOTAL');
			$sheet->setCellValue('L2', 'ABONADO');
			$sheet->setCellValue('M2', 'PENDIENTE');
				
			$number = 1;
			$flag = 3;
			$tipoEntidad = "";
			$proveedor = "";
			foreach($ordenes as $d){
				$sheet->setCellValue('A'.$flag, $number);
				$sheet->setCellValue('B'.$flag, $d->codigoOrden);
				$sheet->setCellValue('C'.$flag, $d->creada);
				$sheet->setCellValue('D'.$flag, str_replace("-", " ", $d->emisorOrden));
				$sheet->setCellValue('E'.$flag, str_replace("-", " ", $d->receptorOrden));
				$sheet->setCellValue('F'.$flag, $d->estadoPago);
				$sheet->setCellValue('G'.$flag, $d->nombreEstado);
				$sheet->setCellValue('H'.$flag, 
						$d->destinoOrden.", ".$this->formatear_direccion($d->rPais, $d->rEstado, $d->rMunicipio));
				$sheet->setCellValue('I'.$flag, $d->pesoPaquete);
				$sheet->setCellValue('J'.$flag, number_format($d->precioLibra, 2) );

				if($d->estadoPago == "Pagado"){
					$sheet->setCellValue('K'.$flag, number_format($d->totalPaquete, 2) );
					$sheet->setCellValue('L'.$flag, number_format($d->abonoOrden ,2) );
					$sheet->setCellValue('M'.$flag, number_format( 0 ,2) );
				}else{
					$sheet->setCellValue('K'.$flag, number_format($d->totalPaquete, 2) );
					$sheet->setCellValue('L'.$flag, number_format($d->abonoOrden ,2) );
					$sheet->setCellValue('M'.$flag, number_format( ($d->totalPaquete-$d->abonoOrden) ,2) );
				}
		
				$flag = $flag+1;
				$number = $number+1;
			}
				
			$styleThinBlackBorderOutline = [
				'borders' => [
					'allBorders' => [
						'borderStyle' => Border::BORDER_THIN,
						'color' => ['argb' => 'FF000000'],
					],
				],
			];
			$sheet->getStyle('A2:M2')->getFont()->setBold(true);		
			$sheet->getStyle('A2:M'.$flag)->getFont()->setSize(12);
			$sheet->getStyle('A2:M2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

			$sheet->getStyle('A2:M'.$flag)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			//Custom width for Individual Columns
			foreach (range('A', 'M') as $col) {
				$sheet->getColumnDimension($col)->setAutoSize(true);
			}
			$curdate = date('d-m-Y H:i:s');
			$writer = new Xlsx($spreadsheet);
			$filename = 'lista de ordenes_'.$curdate;
			ob_end_clean();
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			header('Cache-Control: max-age=0');
			$writer->save('php://output');
		// Creando excel
	
	}

	
    public function ordenes_por_ruta_pdf($params = null){
		$datos = unserialize(base64_decode(urldecode($params)));
		unset($datos["tipoReporte"]);
		$data["empresa"] = $this->Empresa_Model->obtenerInformacion();
		$data["ordenes"] = $this->Reportes_Model->obtenerOrdenesRutas($datos);
		$data["destino"] = $this->Reportes_Model->obtenerDestino($datos["rutaReporte"]);
		$data["datos"] = $datos;
		// echo json_encode($data);

		// Creando PDF 
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
			$mpdf = new \Mpdf\Mpdf([
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 15,
				'margin_bottom' => 10,
				'margin_header' => 10,
				'margin_footer' => 30
				]);
			//$mpdf->setFooter('');
			//$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Encomiendas Campos");
			$mpdf->SetAuthor("Edwin Orantes");
			$mpdf->showWatermarkText = false;
			$mpdf->watermark_font = 'DejaVuSansCondensed';
			$mpdf->watermarkTextAlpha = 0.1;
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->AddPage('L'); //Voltear Hoja
			$html = $this->load->view('Reportes/ordenes_por_ruta_pdf', $data ,true); // Cargando hoja de estilos
			$mpdf->SetHTMLHeader();
			$mpdf->SetHTMLFooter();
			
			$mpdf->WriteHTML($html);
			$mpdf->Output('orden_envio.pdf', 'I');
		// Fin del PDF 

	
	}

	private function formatear_direccion($pais, $estado, $municipio) {
        // Quitar el número y guion si existen
        $pais = preg_replace('/^\d+\-/', '', trim($pais));
        $estado = preg_replace('/^\d+\-/', '', trim($estado));
        $municipio = preg_replace('/^\d+\-/', '', trim($municipio));

        // Crear un arreglo con los valores no vacíos
        $partes = array_filter([$municipio, $estado, $pais], function($valor) {
            return !empty($valor);
        });

        // Unir con coma y espacio
        return implode(', ', $partes);
    }

	function validarFechas($fechaInicio, $fechaFin) {
		$inicio = DateTime::createFromFormat('Y-m-d', $fechaInicio);
		$fin = DateTime::createFromFormat('Y-m-d', $fechaFin);
	
		if (!$inicio || !$fin) {
			return 0;
		}
	
		if ($inicio > $fin) {
			return 0;
		}
	
		return 1;
	}
	
    
}
