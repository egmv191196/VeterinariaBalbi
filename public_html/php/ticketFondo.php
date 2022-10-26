<?php
require('../fpdf/fpdf.php');
require_once('./Conexion.php'); 
$id_Caja=$_GET['id_Caja'];
//Numero de productos
$consulta = "SELECT caja.Fecha, caja.Hora, caja.Fondo, usuario.Nombre FROM caja JOIN usuario WHERE id_Caja=$id_Caja AND caja.id_User=usuario.id_User";
$res = mysqli_query($conexion,$consulta);
$row = mysqli_fetch_array($res);
$Fecha=$row[0];
$Hora=$row[1];
$Fondo=$row[2];
$Nombre=$row[3];
$pdf = new FPDF('P','mm',array(80,120)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();
$pdf->SetMargins(2, 5, 2);
// CABECERA
$pdf->Image('../img/BALBI-sin-fondo.png',2,8,15);
$pdf->SetFont('Helvetica','',11);
$pdf->Cell(65,4,'Farmacia Veterinaria Balbi',0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(75,4,'RFC: MEML740112FM9',0,1,'C');
$pdf->Cell(75,4,'16 de Septiembre #1512 Int, 2',0,1,'C');
$pdf->Cell(75,4,'C.P.: 74325 Chipilo Pue',0,1,'C');
$pdf->Cell(75,4,'Telefono: 2222830571',0,1,'C');
$pdf->Cell(75,4,'Correo: vetbalbi@hotmail.com',0,1,'C');
 
// DATOS FACTURA        
$pdf->Ln(2);
$pdf->Cell(60,5,'Fecha y hora de asignacion: '.$Fecha.' '.$Hora,0,1,'');
$pdf->Cell(60,5,'Folio de Caja: '.$id_Caja,0,1,'');
$pdf->Cell(60,5,'Empleado: '.$Nombre,0,1,'');
// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(75, 8, 'Asignacion de fondo', 0,1,'C');
$pdf->Cell(75,0,'','T');
$pdf->Ln(1);
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(55, 10, 'Fondo asignado', 0,0,);
$pdf->Cell(20, 10, '$'.number_format($Fondo, 2, '.', '') ,0,1,'L');
$pdf->Ln(15);
$pdf->Cell(15, 0, '', 0,0,);
$pdf->Cell(45, 0, '', 'T');
$pdf->Cell(15, 0, '', 0,1,);
$pdf->Ln(1);
$pdf->Cell(75,10,'Firma del empleado:  '.$Nombre,0,1,'C');
$pdf->Output('Nota'.$id_Caja.'.pdf','i');
?>
