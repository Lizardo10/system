<?php
date_default_timezone_set("America/Guatemala");
$xml_data = '<?xml version="1.0" encoding="UTF-8"?><dte:GTDocumento Version="0.1" xmlns:dte="http://www.sat.gob.gt/dte/fel/0.2.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <dte:SAT ClaseDocumento="dte">
        <dte:DTE ID="DatosCertificados">
            <dte:DatosEmision ID="DatosEmision">
                <dte:DatosGenerales Tipo="FACT" FechaHoraEmision="'.date('Y-m-d').'T'.date('H:m:s').'" CodigoMoneda="GTQ" />
                <dte:Emisor NITEmisor="44653948" NombreEmisor="TEST" CodigoEstablecimiento="1" NombreComercial="TEST" AfiliacionIVA="GEN">
                    <dte:DireccionEmisor>
                        <dte:Direccion>CALLE 101 CALLE</dte:Direccion>
                        <dte:CodigoPostal>01001</dte:CodigoPostal>
                        <dte:Municipio>TEST</dte:Municipio>
                        <dte:Departamento>TEST</dte:Departamento>
                        <dte:Pais>GT</dte:Pais>
                    </dte:DireccionEmisor>
                </dte:Emisor>
                <dte:Receptor NombreReceptor="JONATHAN JUAREZ" IDReceptor="44515243">
                    <dte:DireccionReceptor>
                        <dte:Direccion>4av 5-80 z21</dte:Direccion>
                        <dte:CodigoPostal>010001</dte:CodigoPostal>
                        <dte:Municipio>Guatemala</dte:Municipio>
                        <dte:Departamento>Guatemala</dte:Departamento>
                        <dte:Pais>GT</dte:Pais>
                    </dte:DireccionReceptor>
                </dte:Receptor>
                <dte:Frases>
                    <dte:Frase TipoFrase="1" CodigoEscenario="1" />
                </dte:Frases>
                <dte:Items>
                    <dte:Item NumeroLinea="1" BienOServicio="B">
                        <dte:Cantidad>1.0000</dte:Cantidad>
                        <dte:UnidadMedida>CA</dte:UnidadMedida>
                        <dte:Descripcion>item</dte:Descripcion>
                        <dte:PrecioUnitario>25.000000</dte:PrecioUnitario>
                        <dte:Precio>25.000000</dte:Precio>
                        <dte:Descuento>0</dte:Descuento>
                        <dte:Impuestos>
                            <dte:Impuesto>
                                <dte:NombreCorto>IVA</dte:NombreCorto>
                                <dte:CodigoUnidadGravable>1</dte:CodigoUnidadGravable>
                                <dte:MontoGravable>22.321429</dte:MontoGravable>
                                <dte:MontoImpuesto>2.678571</dte:MontoImpuesto>
                            </dte:Impuesto>
                        </dte:Impuestos>
                        <dte:Total>25.000000</dte:Total>
                    </dte:Item>
                </dte:Items>
                <dte:Totales>
                    <dte:TotalImpuestos>
                        <dte:TotalImpuesto NombreCorto="IVA" TotalMontoImpuesto="2.678571" />
                    </dte:TotalImpuestos>
                    <dte:GranTotal>25.000000</dte:GranTotal>
                </dte:Totales>
            </dte:DatosEmision>
        </dte:DTE>
    </dte:SAT>
</dte:GTDocumento>';
$URL = "https://felgttestaws.digifact.com.gt/felapiv2/api/FelRequest?NIT=000044653948&TIPO=CERTIFICATE_DTE_XML_TOSIGN&FORMAT=HTML";
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
