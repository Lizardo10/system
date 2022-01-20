<?php
date_default_timezone_set("America/Guatemala");

$nit=substr($customer, strpos($customer, "-")+2);
$customer1=substr($customer,0, strpos($customer, "-")-1);
$objetoXML = new XMLWriter();
 /*
	// Estructura básica del XML
	$objetoXML->openMemory();
	//$objetoXML->openURI("anulacion.xml");
	$objetoXML->setIndent(true);
	$objetoXML->setIndentString("\t");
	$objetoXML->startDocument('1.0', 'utf-8');
	$objetoXML->startElement("dte:GTAnulacionDocumento");
	$objetoXML->writeAttribute("xmlns:dte", "http://www.sat.gob.gt/dte/fel/0.1.0");
    $objetoXML->writeAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
    $objetoXML->writeAttribute("Version", "0.1");
    $objetoXML->startElement("dte:SAT");
    $objetoXML->startElement("dte:AnulacionDTE");
	$objetoXML->writeAttribute("ID", "DatosCertificados");  
	$objetoXML->startElement("dte:DatosGenerales");	  
	$objetoXML->writeAttribute("ID", "DatosAnulacion");
	$objetoXML->writeAttribute("NumeroDocumentoAAnular", $response[Autorizacion]);
	$objetoXML->writeAttribute("NITEmisor", "44653948");
	$objetoXML->writeAttribute("IDReceptor", $nit);	 
	$objetoXML->writeAttribute("FechaEmisionDocumentoAnular", "2020-12-12T08:18:00");
	$objetoXML->writeAttribute("FechaHoraAnulacion", date('Y-m-d').'T'.date('H:m:s'));
	$objetoXML->writeAttribute("MotivoAnulacion", "KICKOFF TEST 09DICIEMBRE2020");
	$objetoXML->endElement();
	$objetoXML->endElement();
	$objetoXML->endElement();
	$objetoXML->endElement();
	$objetoXML->endDocument();
	
	$xml_data = trim($objetoXML->outputMemory());*/
	
	$xml_data = trim('<?xml version="1.0" encoding="utf-8"?>
<dte:GTAnulacionDocumento xmlns:dte="http://www.sat.gob.gt/dte/fel/0.1.0"    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" Version="0.1">
	    <dte:SAT>
			        <dte:AnulacionDTE ID="DatosCertificados">
						            <dte:DatosGenerales ID="DatosAnulacion" NumeroDocumentoAAnular="60B36BB5-0881-4878-B607-00DCC3FB9841" NITEmisor="44653948"
						                 IDReceptor="41325796" FechaEmisionDocumentoAnular="2021-02-19T18:02:38" FechaHoraAnulacion="2021-02-19T18:02:40"
						                  MotivoAnulacion="TEST Noviembre 2020"/>
				    </dte:AnulacionDTE>
		</dte:SAT>
</dte:GTAnulacionDocumento>');
	
	$URL = "https://felgttestaws.digifact.com.gt/felapiv2/api/FelRequest?NIT=000044653948&TIPO=ANULAR_FEL_TOSIGN&FORMAT=HTML";
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
print_r($response);

?>
	
	
	
