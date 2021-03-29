<?php

require('./includes/conexion.php');
require('./includes/fecha_hora.php');
require('./includes/errors.php');

$paciente = $_GET["id"];

$sql = "SELECT id_paciente FROM paciente WHERE id_paciente = $paciente;";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();
if (count($registro) == 0) {
    Errors::mostrar_error("buscar_paciente_pdf.php", 3);
}

$sql = "SELECT id_historial_general AS id FROM historial_clinico_general WHERE id_paciente = $paciente;";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();
$id = $registro["id"];

$sql = "SELECT *, year(curdate()) - year(fecha_nacimiento) + if (date_format(curdate(), '%m-%d') > date_format(fecha_nacimiento, '%m-%d'), 0, 1) AS edad 
        FROM paciente p 
        JOIN domicilio d ON (p.id_domicilio = d.id_domicilio)
        WHERE p.id_paciente = $paciente";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();

$nombre = $registro["nombre"] . " " . $registro["ap_paterno"] . " " . $registro["ap_materno"];
$fecha_nacimiento = $registro["fecha_nacimiento"];
$edad = $registro["edad"];
$sexo = $registro["sexo"];
$ocupacion = $registro["ocupacion"];
$estado_civil = $registro["estado_civil"];
$telefono = $registro["telefono"];
$correo_electronico = $registro["correo_electronico"];
$hipertension = $registro["hipertension"];
$domicilio = $registro["calle"] . " " . $registro["numero"];
$colonia = $registro["colonia"];
$localidad = $registro["localidad"];
$codigo_postal = $registro["codigo_postal"];
$municipio = $registro["municipio"];
$estado = $registro["estado"];
$id_especialista = $registro["id_especialista"];
$observaciones = $registro["observaciones"];

$sql = "SELECT CONCAT(nombre, ' ', apellidos) AS especialista 
        FROM usuarios_sistema
        WHERE id = $id_especialista;";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();
$especialista = $registro["especialista"];

$sql = "SELECT diagnostico_funcional 
        FROM historial_clinico_general
        WHERE id_paciente = $paciente;";
$resultado = $bd->query($sql);
$registro = $resultado->fetch_array();
$diagnostico_funcional = $registro["diagnostico_funcional"];

$bd->close();

require('./lib/fpdf17/fpdf.php');

function s($s) {
    return utf8_decode($s);
}

class PDF extends FPDF {

    function Header() {
        $this->Image('./img/uaq.png', 15, 15, 25);
        $this->Image('./img/fisioterapia.png', 175, 15, 25);
        $this->Ln(5);
        $this->Cell(82);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 15, s('Centro de Atención en Fisioterapia y Salud Integral'), 0, 0, 'C');
        $this->Ln(8);
        $this->Cell(82);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 15, s('Informe de paciente'), 0, 0, 'C');
        $this->Ln(30);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, s('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

// 185 de width
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->SetTitle("Informe de paciente", true);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(100, 5, "No. de expediente: $id", 0);
$pdf->Cell(85, 5, s("Fecha: " . FechaHora::hoyl()), 0, 0, 'R');
$pdf->Ln(15);
$pdf->Cell(5);
$pdf->Cell(105, 5, s("Paciente: $nombre"), 1);
$pdf->Cell(60, 5, "Fecha de nacimiento: $fecha_nacimiento", 1);
$pdf->Cell(20, 5, "Edad: $edad", 1);
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(35, 5, "Sexo: $sexo", 1);
$pdf->Cell(95, 5, s("Ocupación: $ocupacion"), 1);
$pdf->Cell(55, 5, "Estado civil: $estado_civil", 1);
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(110, 5, s("Domicilio actual: $domicilio"), 1);
$pdf->Cell(75, 5, s("Colonia: $colonia"), 1);
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(85, 5, s("Localidad: $localidad"), 1);
$pdf->Cell(25, 5, "C.P.: $codigo_postal", 1);
$pdf->Cell(75, 5, s("Municipio: $municipio"), 1);
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(70, 5, s("Estado: $municipio"), 1);
$pdf->Cell(55, 5, s("Teléfono: $telefono"), 1);
$pdf->Cell(60, 5, s("E-mail: $correo_electronico"), 1);
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(30, 5, s("Observaciones: "), 1);
$pdf->MultiCell(155, 5, $observaciones, 1);
$pdf->Ln(15);
$pdf->Cell(5);
$pdf->Cell(185, 5, s("Especialista que lo atendió por primera vez: $especialista"), 0);
$pdf->Ln(15);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(185, 5, s("Diagnóstico:"), 0, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(185, 5, $diagnostico_funcional, 1);
$pdf->Output();
?>