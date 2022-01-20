<?php
date_default_timezone_set("America/Guatemala");

$nit=substr($customer, strpos($customer, "-")+2);
$customer1=substr($customer,0, strpos($customer, "-")-1);
$objetoXML = new XMLWriter();
 
	// Estructura básica del XML
	$objetoXML->openMemory();
	//$objetoXML->openURI("factura.xml");
	$objetoXML->setIndent(true);
	$objetoXML->setIndentString("\t");
	$objetoXML->startDocument('1.0', 'utf-8');

	// Inicio del nodo raíz
	$objetoXML->startElement("dte:GTDocumento");
	$objetoXML->writeAttribute("Version", "0.1");
	$objetoXML->writeAttribute("xmlns:dte", "http://www.sat.gob.gt/dte/fel/0.2.0");
	$objetoXML->writeAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
	$objetoXML->startElement("dte:SAT");
	$objetoXML->writeAttribute("ClaseDocumento", "dte");
	$objetoXML->startElement("dte:DTE");
	$objetoXML->writeAttribute("ID", "DatosCertificados");
	$objetoXML->startElement("dte:DatosEmision");
	$objetoXML->writeAttribute("ID", "DatosEmision");
	$objetoXML->startElement("dte:DatosGenerales");
	$objetoXML->writeAttribute("Tipo", "FACT");
	$objetoXML->writeAttribute("FechaHoraEmision", date('Y-m-d').'T'.date('H:m:s'));
	$objetoXML->writeAttribute("CodigoMoneda", "GTQ");
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Emisor");
	$objetoXML->writeAttribute("NITEmisor", "44653948");
	$objetoXML->writeAttribute("NombreEmisor", "TEST_APEX");
	$objetoXML->writeAttribute("CodigoEstablecimiento", "1");
	$objetoXML->writeAttribute("NombreComercial", "TEST");
	$objetoXML->writeAttribute("AfiliacionIVA", "GEN");
	$objetoXML->startElement("dte:DireccionEmisor");
	$objetoXML->startElement("dte:Direccion");
	$objetoXML->text("CALLE 101 CALLE");
	$objetoXML->endElement();
	$objetoXML->startElement("dte:CodigoPostal");
	$objetoXML->text("20001");
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Municipio");
	$objetoXML->text("Chiquimula");
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Departamento");
	$objetoXML->text("Chiquimula");
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Pais");
	$objetoXML->text("GT");
	$objetoXML->endElement();
	$objetoXML->endElement();
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Receptor");
	$objetoXML->writeAttribute("NombreReceptor", $customer1);
	$objetoXML->writeAttribute("IDReceptor", $nit);
	$objetoXML->startElement("dte:DireccionReceptor");
	$objetoXML->startElement("dte:Direccion");
	$objetoXML->text($customer_address_1." ".$customer_address_2);
	$objetoXML->endElement();
	$objetoXML->startElement("dte:CodigoPostal");
	$objetoXML->text("$customer_zip");
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Municipio");
	$objetoXML->text($customer_city);
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Departamento");
	$objetoXML->text($customer_state);
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Pais");
	$objetoXML->text("GT");
	$objetoXML->endElement();
	$objetoXML->endElement();
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Frases");
	$objetoXML->startElement("dte:Frase");
	$objetoXML->writeAttribute("TipoFrase", "1");
	$objetoXML->writeAttribute("CodigoEscenario", "1");
	$objetoXML->endElement();
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Items");
    foreach(array_reverse($cart_items, true) as $line=>$item){
        $BienoServicio="B";
        if ($item->is_service==1){$BienoServicio="S";}
	$objetoXML->startElement("dte:Item");
	$objetoXML->writeAttribute("NumeroLinea", $line+1);
	$objetoXML->writeAttribute("BienOServicio", $BienoServicio);
	$objetoXML->startElement("dte:Cantidad");
	$objetoXML->text($item->quantity);
	$objetoXML->endElement();
	$objetoXML->startElement("dte:UnidadMedida");
	$objetoXML->text("PZA");
	$objetoXML->endElement();
	$objetoXML->startElement("dte:Descripcion");
	$objetoXML->text($item->name);
	$objetoXML->endElement();
	$preciounitario=round(($item->unit_price),2);
	$preciounitarioconiva=round(($item->unit_price)+($item->unit_price*.12),2);
	$precio=round($preciounitario*$item->quantity,2);
	$precioconiva=round($preciounitarioconiva*$item->quantity,2);
	$objetoXML->startElement("dte:PrecioUnitario");
	$objetoXML->text($preciounitarioconiva);
	$objetoXML->endElement();
    $objetoXML->startElement("dte:Precio");
    $objetoXML->text($precioconiva);
	$objetoXML->endElement();
    $objetoXML->startElement("dte:Descuento");
    $descuento=$precioconiva*$item->discount/100;
	$objetoXML->text($descuento);
	$objetoXML->endElement(); 
	//foreach ($taxes as $impuest){
    $objetoXML->startElement("dte:Impuestos");
	$objetoXML->startElement("dte:Impuesto");                   
    $objetoXML->startElement("dte:NombreCorto");
	$objetoXML->text("IVA");
	$objetoXML->endElement();                    
    $objetoXML->startElement("dte:CodigoUnidadGravable");
	$objetoXML->text("1");
	$objetoXML->endElement();                    
    $objetoXML->startElement("dte:MontoGravable");
    $precio_con_descuento=round($precioconiva-$descuento,2);
    $monto_gravable=round($precio_con_descuento/1.12,2);
	$objetoXML->text(round($monto_gravable,2));
	$objetoXML->endElement();          
    $objetoXML->startElement("dte:MontoImpuesto");
    $monto_impuesto=round($monto_gravable*0.12,2);
	$objetoXML->text(round($monto_impuesto,2));
	$objetoXML->endElement();                                
    $objetoXML->endElement(); 
	$objetoXML->endElement(); 
    $objetoXML->startElement("dte:Total");
	$objetoXML->text($monto_gravable+$monto_impuesto);
	$objetoXML->endElement();                                      
    $objetoXML->endElement();} 
    $objetoXML->endElement(); 
    $objetoXML->startElement("dte:Totales");
    $objetoXML->startElement("dte:TotalImpuestos");
    $objetoXML->startElement("dte:TotalImpuesto");
	$objetoXML->writeAttribute("NombreCorto", "IVA");
	$objetoXML->writeAttribute("TotalMontoImpuesto", round($total-$total/1.12,2));                           
    $objetoXML->endElement(); 
    $objetoXML->endElement();
    $objetoXML->startElement("dte:GranTotal");
	$objetoXML->text($total);
	$objetoXML->endElement(); 
	$objetoXML->endElement(); 	
	$objetoXML->endElement(); 
	$objetoXML->endElement(); 
	$objetoXML->endElement(); 
	$objetoXML->endElement();                              
    $objetoXML->endDocument(); 
	
	
$xml_data = trim($objetoXML->outputMemory());


$URL = "https://felgttestaws.digifact.com.gt/felapiv2/api/FelRequest?NIT=000044653948&TIPO=CERTIFICATE_DTE_XML_TOSIGN&FORMAT=XML,HTML,PDF";
$ch = curl_init($URL);
//curl_setopt($ch, CURLOPT_MUTE, 2);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml','Authorization: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IkdULjAwMDA0NDY1Mzk0OC5BUEVYX1RFU1QiLCJuYmYiOjE2MDY0NDIyMDQsImV4cCI6MTYzNzU0NjIwNCwiaWF0IjoxNjA2NDQyMjA0LCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjQ5MjIwIiwiYXVkIjoiaHR0cDovL2xvY2FsaG9zdDo0OTIyMCJ9.dp4NRMWq535-RnADr1AIf2IXbfKs2Ec305ZWcowebL4'));
curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$response = json_decode($output, true);
//print_r($response[Mensaje]);
if ($response[Codigo] == '1'){

echo'<script type="text/javascript">
    show_feedback("success","'.$response[Mensaje].'","'.$response[Autorizacion].'")</script>';

header('Location:'.site_url('sales/receipt/'.$sale_id_raw)); 
}
else{
    echo'<script type="text/javascript">
    show_feedback("success","'.$response[Mensaje].'","'.$response[Autorizacion].'")</script>';
}
?>
