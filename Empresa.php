<?php 

class Empresa {
    //ATRIBUTOS 
    private $denominacion; 
    private $direccion; 
    private $colClientes; 
    private $colMotos; 
    private $colVentas = []; 

    //CONSTRUCTOR 
    public function __construct($designacion, $domicilio,$coleccion_motos,  $coleccion_clientes, $coleccion_ventas)
    {
        $this->denominacion = $designacion ; 
        $this->direccion = $domicilio ; 
        $this->colMotos = $coleccion_motos ; 
        $this->colClientes = $coleccion_clientes;
        $this->colVentas = $coleccion_ventas;
    }

    //GET 
    public function getDenominacion (){
        return $this-> denominacion ;
    }
    public function getDireccion (){
        return $this-> direccion ;
    }
    public function getColClientes (){
        return $this-> colClientes ;
    }
    public function getColMotos (){
        return $this-> colMotos ;
    }
    public function getColVentas (){
        return $this-> colVentas ;
    }

    //SET 
    public function setDenominacion ($designacion){
        $this-> denominacion = $designacion ;
    }
    public function seDireccion ($domicilio){
        $this-> direccion = $domicilio ;
    }
    public function setColClientes ($coleccion_clientes){
        $this-> colClientes = $coleccion_clientes ;
    }
    public function setColMotos ($coleccion_motos){
        $this-> colMotos = $coleccion_motos ;
    }
    public function setColVentas ($coleccion_ventas){
        $this-> colVentas = $coleccion_ventas ;
    }

    //__toString 
    public function __toString()
    {
        return "Denominacion: " . $this->getDenominacion() . "\n" . 
        "Direccion: " . $this->getDireccion() . "\n" . 
        "Coleccion de clientes: " . $this->mostarColCliente() . "\n" . 
        "Coleccion de motos: " . $this->mostrarColMotos() . "\n" . 
        "Coleccion de ventas: " . $this->mostrarColVentas() . "\n";
    }

    //RECORRIDO DE LAS COLECCIONES PARA EL TO STRING 
    public function mostarColCliente(){
        $listaClientes = $this->getColClientes();
        $lista = "\n"; 
        foreach($listaClientes as $cliente){
            $lista = $lista . $cliente->__toString(). "\n";
        }
        return $lista;
    }
    public function mostrarColMotos(){
        $listaMotos = $this->getColMotos();
        $listaM ="\n";
        foreach($listaMotos as $lMoto){
            $listaM = $listaM . $lMoto->__toString() . "\n";
        }
        return $listaM;
    }
    public function mostrarColVentas(){
        $listaVenta = $this->getColVentas();
        $listaV = "\n";
        foreach($listaVenta as $lVenta) {
            $listaV = $listaV . $lVenta->__toString(). "\n";
        }
        return $listaV;
    }

    //METODOS 

    /** recorre la colección de motos de la Empresa y retorna la referencia al objeto
     * moto cuyo código coincide con el recibido por parámetro
     */
    public function retornarMoto($codigoMoto){
        $i = 0 ; 
        $colMoto = $this->getColMotos();
        $count = count($colMoto);
        $conseguidaMoto = false ;
        $moto = null;                      //inicializo moto como null por si no se encuentra niguna moto con el codigo dado
        while ($i< $count && !$conseguidaMoto) {
            $obtengoCodigo = $colMoto[$i]->getCodigo();         //obtengo el codigo de la moto que se esta presentando en el bucle
            if ($obtengoCodigo == $codigoMoto) {
                $moto = $colMoto[$i];                      //se le asigna el objeto moto actual, que tiene que coincidir con el codigo ddo.
                $conseguidaMoto = true;
            }
            $i = $i + 1;
        }
        return $moto; 
    }

    /**
     * recibe por parámetro una colección de códigos de motos, la cual es recorrida, y por cada
     * elemento de la colección se busca el objeto moto correspondiente al código y se incorpora
     * a la colección de motos de la instancia Venta que debe ser creada. Recordar que no todos
     * los clientes ni todas las motos, están disponibles para registrar una venta en un momento
     * determinado. El método debe setear los variables instancias de venta que corresponda y
     * retornar el importe final de la venta
     */
    public function registrarVenta($colCodigosMoto,$objCliente){
        $colMotosVenta = $this->getColVentas();
        $importeFinal = 0;
        foreach($colCodigosMoto as $unCodigo){           //foreach para recorrer todos los codigos dados 
            $motoA = $this->retornarMoto($unCodigo);          //obtengo el objeto moto que coincida con el codigo que se tomo
            if ($motoA && $motoA->getActiva() && $objCliente->getEstadoBaja()==="alta"){
                $colMotosVenta[] = $motoA;
                $importeFinal += $motoA->darPrecioVenta();
            }
        }
        if ($colMotosVenta==null){
            $numeroVenta = count($colMotosVenta) + 1;
            $fecha = date('d-m-Y');               //obtengo la fecha actual a cuando se hizo la venta 
            $ventaNueva = new Venta ($numeroVenta,$fecha, $objCliente,$colMotosVenta,$importeFinal );
            $colMotosVenta[] = $ventaNueva ;
            $this->setColVentas($colMotosVenta);
        }
        return $importeFinal;
    }

    /**
     * recibe por parámetro el tipo y número de documento de un Cliente y retorna una colección
     * con las ventas realizadas al cliente.
     */
    public function retornarVentasXCliente($tipo,$numDoc){
        $coleccionDeClientes = $this->getColClientes(); 
        $countClientes = count($coleccionDeClientes);
        $i = 0;
        $coincide = false; 
        $colVentaXCliente = [];
        while ($i<$countClientes && !$coincide){  //while para que se detenga cuando encuentre al cliente
            $clienteTipoDoc = $coleccionDeClientes[$i]->getTipoDoc();
            $clienteNroDoc = $coleccionDeClientes[$i]->getNroDoc(); 
            if ($clienteTipoDoc === $tipo && $clienteNroDoc == $numDoc){
                $ventas = $this->getColVentas();
                foreach($ventas as $venta) {  //uso el foreach para recorrer todas las ventas, ya que el cliente pudo haber comprado mas de una vez 
                    if($venta->getObjCliente() === $coleccionDeClientes[$i]) {
                        $colVentaXCliente[] = $venta;
                    }
                }
                $coincide = true;
            }
            $i = $i + 1;  //$i++;
        }
        return $colVentaXCliente; 
    }
}