<?php 

class Moto {
    //ATRIBUTOS 
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porIncrementoAnual; 
    private $activa; //disponible o no (devuelve true o false)

    //CONSTRUCTOR 
    public function __construct($clave, $precio, $anio , $caracteristicas , $porcentajeAnual , $actividad)
    {
        $this-> codigo = $clave;
        $this-> costo = $precio;
        $this-> anioFabricacion = $anio;
        $this->descripcion = $caracteristicas; 
        $this->porIncrementoAnual = $porcentajeAnual; 
        $this->activa = $actividad;
    }

    //GET 
    public function getCodigo () {
        return $this->codigo  ;
    }
    public function getCosto () {
        return $this-> costo ;
    }
    public function getAnioFabricacion () {
        return $this-> anioFabricacion ;
    }
    public function getDescripcion () {
        return $this-> descripcion ;
    }
    public function getPorIncrementoAnual () {
        return $this-> porIncrementoAnual ;
    }
    public function getActiva() {
        return $this-> activa ;
    }

    //SET 
    public function setCodigo ($clave ){
        $this-> codigo = $clave ;
    }
    public function setCosto ($precio ){
        $this-> costo = $precio  ;
    }
    public function setAnioFabricacion ($anio ){
        $this-> anioFabricacion = $anio ;
    }
    public function setDescripcion ($caracteristicas ){
        $this-> descripcion = $caracteristicas ;
    }
    public function setPorIncrementoAnual ($porcentajeAnual ){
        $this-> porIncrementoAnual = $porcentajeAnual ;
    }
    public function setActiva ($actividad ){
        $this-> activa = $actividad  ;
    }

    //__toString
    public function __toString()
    {
        return "Codigo: " . $this->getCodigo() . "\n" . 
        "Costo: " . $this->getCosto() . "\n" . 
        "Año fabricacion: " . $this->getAnioFabricacion() . "\n" . 
        "Descripcion: " . $this->getDescripcion() . "\n" . 
        "Porcentaje de incremento anual: " . $this->getPorIncrementoAnual() . "\n" . 
        "Estado de actividad: " . $this->getActiva() . "\n";
    }

    //calcula el valor por el cual puede ser vendida una moto
    public function darPrecioVenta() {
        $venta = -1;
        if ($this->getActiva() == true){
            $anioActual = date('Y'); //Obtengo el anio actual
            $anio = $anioActual - $this->getAnioFabricacion() ; //Uso el anio actual para calcular los anios transcurridos desde que se fabrico la moto 
            $venta = $this->getCosto() + $this->getCosto() * ($anio * ($this->getPorIncrementoAnual()/100));
        }
        return $venta;
    }

}