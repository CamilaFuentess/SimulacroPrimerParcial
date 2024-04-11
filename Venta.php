<?php 

class Venta {
    //ATRIBUTOS 
    private $numero;
    private $fecha ; 
    private $objCliente ;  //referencia al cliente
    private $colMotos ;  //referencia a una coleccion de motos 
    private $precioFinal ; 

    //CONSTRUCTOR 
    public function __construct($nro,$data, $objeto_cliente, $coleccion_motos,$costoFinal)
    {
        $this-> numero = $nro;
        $this->fecha = $data; 
        $this->objCliente = $objeto_cliente;
        $this->colMotos = $coleccion_motos;
        $this->precioFinal = $costoFinal;
    }

    //GET 
    public function getNumero () {
        return $this->numero  ; 
    }
    public function getFecha () {
        return $this->fecha  ; 
    }
    public function getObjCliente () {
        return $this-> objCliente ; 
    }
    public function getColMotos () {
        return $this-> colMotos ; 
    }
    public function getPrecioFinal () {
        return $this-> precioFinal ; 
    }

    //SET 
    public function setNumero ($nro ) {
        $this-> numero = $nro  ;
    }
    public function setFecha ($data ) {
        $this-> fecha = $data  ;
    }
    public function setObjCliente ($objeto_cliente ) {
        $this-> objCliente = $objeto_cliente  ;
    }
    public function setColMotos ($coleccion_motos ) {
        $this-> colMotos = $coleccion_motos  ;
    }
    public function setPrecioFinal ($costoFinal ) {
        $this-> precioFinal = $costoFinal  ;
    }

    //__toString 
    public function __toString()
    {
        return "Numero de venta: " . $this->getNumero() . "\n" . 
        "Fecha de venta: " . $this->getFecha() . "\n" . 
        "Cliente: " . $this->getObjCliente() . "\n" . 
        "Coleccion de motos: " . $this->mostrarColMotos() . "\n" . 
        "Precio final: " . $this->getPrecioFinal() . "\n";
    }

    public function mostrarColMotos(){
        $listaMotos = $this->getColMotos();
        $listaM ="\n";
        foreach($listaMotos as $lMoto){
            $listaM = $listaM . $lMoto->__toString() . "\n";
        }
        return $listaM;
    }
    /**
     * Recibe por parametro un objeto moto y lo incorpora a la colecion de motos de la venta
     *  siempre y cuando sea posible la venta. El método cada vez que incorpora una moto a la venta,
     *  debe actualizar la variable instancia precio final de la venta. Utilizar el método que 
     * calcula el precio de venta de la moto donde crea necesario.
     */
    public function incorporarMoto($objMoto) {
  
        $cliente = $this->getObjCliente();
        $colecMotos = $this->getColMotos();
        $ventaPrecioFinal = $this->getPrecioFinal();
        if ($objMoto->getActiva() && $cliente->getEstadoBaja() === "alta" ){
            $colecMotos[] = $objMoto;
            $this->setPrecioFinal($ventaPrecioFinal() + $objMoto->darPrecioVenta());
        }
    }
}