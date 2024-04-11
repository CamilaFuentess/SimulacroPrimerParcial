<?php 

include 'Empresa.php';
include 'Venta.php';
include 'Cliente.php';
include 'Moto.php';

//CRECACION DE OBJETOS 
$objCliente1 = new Cliente("Geronimo","Perez","baja","dni",123);      // baja = esta dado de baja 
$objCliente2 = new Cliente("Florencia" , "Ahumada" , "alta", "dni", 456);  //alta = no esta dado de baja 
$coleccionClientes = [$objCliente1,$objCliente2];
$objMoto1 = new Moto(11,2230000,2022,"Benelli Imperiale 400" , 85,true);
$objMoto2 = new Moto(12,584000,2021,"Zanella Zr 150 Ohe",70,true);
$objMoto3 = new Moto(13,999900,2023,"Zanella Patagonian Eagle 250",55,false);
$coleccionMotos= [];
$coleccionMotos[0] = $objMoto1;
$coleccionMotos[1] = $objMoto2; 
$coleccionMotos[2] = $objMoto3;
//$coleccionMotos = [$objMoto1,$objMoto2,$objMoto3];
$coleccionVentasRealizadas = [];
$objEmpresa = new Empresa("Alta Gama","Av Argentina 123",$coleccionMotos,$coleccionClientes,$coleccionVentasRealizadas);


//PUNT 5 
/**Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [11,12,13]. Visualizar el resultado obtenido */
echo "Invocamos a registarVenta con referencia al objCliente2 y con la coleccion de motos[11,12,13]:\n";
$colMotoPunto5 = [11,12,13];
$importePunto5 = $objEmpresa->registrarVenta($colMotoPunto5,$objCliente2);
if ($importePunto5 != 0 ){
    echo "Venta registrada\n"; 
    echo "El importe final es de: " . $importePunto5 . "\n";
} else {
    echo "La venta NO pudo ser registrada.\n";
}
foreach($objEmpresa->getColVentas() as $unaVenta){
    echo $unaVenta->__toString()."\n";
}


//PUNTO 6 
/**Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [0]. Visualizar el resultado obtenido */
echo "Invocamos a registarVenta con referencia al objCliente2 y con la coleccion de motos[0]:\n";
$colMotoPunto6 = [0];
$importePunto6 = $objEmpresa->registrarVenta($colMotoPunto6,$objCliente2);
if ($importePunto6 != 0 ){
    echo "Venta registrada\n"; 
    echo "El importe final es de: " . $importePunto6 . "\n";
} else {
    echo "La venta NO pudo ser registrada.\n";
}


//PUNTO 7 
/**nvocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [2]. Visualizar el resultado obtenido */
echo "Invocamos a registarVenta con referencia al objCliente2 y con la coleccion de motos[2]:\n";
$colMotoPunto7 = [2];
$importePunto7 = $objEmpresa->registrarVenta($colMotoPunto7,$objCliente2);
if ($importePunto7 != 0 ){
    echo "Venta registrada\n"; 
    echo "El importe final es de: " . $importePunto7 . "\n";
} else {
    echo "La venta NO pudo ser registrada\n";
}


//PUNTO 8
/**Invocar al método retornarVentasXCliente($tipo,$numDoc) donde el tipo y número de documento se
 *corresponden con el tipo y número de documento del $objCliente1.*/
echo "Invocamos a retornarVentasXCliente tomando en cuenta la informacion del primer cliente \n";
$dni1 = $objCliente1->getTipoDoc();
$numero1 = $objCliente1->getNroDoc();
$colecionVentaCliente1 = $objEmpresa->retornarVentasXCliente($dni1,$numero1);
if ($colecionVentaCliente1 == null){
    echo "No realizo ninguna compra\n"; 
} else {
    print_r($colecionVentaCliente1) . "\n"; 
}



//PUNTO 9
/**Invocar al método retornarVentasXCliente($tipo,$numDoc) donde el tipo y número de documento se
 * corresponden con el tipo y número de documento del $objCliente2.*/
echo "Invocamos a retornarVentasXCliente tomando en cuenta la informacion del segundo cliente \n";
$dni = $objCliente2->getTipoDoc();
$numero = $objCliente2->getNroDoc();
$colecionVentaCliente2 = $objEmpresa->retornarVentasXCliente($dni,$numero);
print_r($colecionVentaCliente2) . "\n";
foreach ($colecionVentaCliente2 as $venta) {
    echo $venta ;
}


//PUNTO 10
//REALIZAR UN ECHO DE LA VARIBALE EMPRESA 
echo "\nDATOS DE LA EMPRES: \n";
echo $objEmpresa->__toString();