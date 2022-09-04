<?php 
require_once('Estancia.php');
require_once('TipoVehiculo.php');

class Acceso {
  private int $id;
  private string $num_placas;
  private TipoVehiculo $tipo;

  public function __construct() {}

    public function setId(int $id) {
      $this->id = $id;
    }
    
    public function getId() {
      return $this->id;
    }

    public function setNumPlacas(string $num_placas) {
      $this->num_placas = $num_placas;
    }
    
    public function getNumPlacas() {
      return $this->num_placas;
    }


}