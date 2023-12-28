<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Noticon
{
    private $tablaNinios;
    private $tablaNoti;
	private $tablaControl;
    private $tablaInsti;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaNoti,
                                \ClassGrl\DataTables $tablaControl,
                                \ClassGrl\DataTables $tablaInsti,
                                \ClassGrl\Authentication $authentication)
    {
        $this->tablaNinios = $tablaNinios;
        $this->tablaNoti = $tablaNoti;
        $this->tablaControl = $tablaControl;
        $this->tablaInsti = $tablaInsti;
        $this->authentication = $authentication;
    }



public function noti($id=null){

	$instituciones = $this->tablaInsti->findAll();


	foreach($instituciones as $institucion)
	{
	    $data_insti[] = array(
	        'label'     =>  $institucion['establecimiento_nombre'],
	        'value'     =>  $institucion['codi_esta']
	    );
	}

if (isset($_GET['id'])) {
	
	$datosNinio=$this->tablaNinios->findById($_GET['id']);
	

						}
			
$title = 'Carga Noticons';

		

			  return ['template' => 'noticon.html.php',
					     'title' => $title ,
					 'variables' => [
			       'data_insti'  =>   $data_insti,
					 'datosNoti' => $datosNoti  ?? ' '
									 ]

					];

}



public function notiSubmit() {
$usuario = $this->authentication->getUser();
$instituciones = $this->tablaInsti->findAll();


	foreach($instituciones as $institucion)
	{
	    $data_insti[] = array(
	        'label'     =>  $institucion['establecimiento_nombre'],
	        'value'     =>  $institucion['codi_esta']
	    );
	}

	$datosNinio=$this->tablaNinios->findById($_GET['id']);
	$usuario = $this->authentication->getUser();
	$Notifica=$_POST['Noticon'];

	$Notifica['NotNinio']=$datosNinio['IdNinio'];
	$Notifica['NotUsuario'] = $usuario['id_usuario'];
	$Notifica['NotObserva'] = $Notifica['NotObserva'];
	$Notifica['NotFechaSist'] = new \DateTime();
	
	$title = 'notificacion';
	//var_dump($Notifica);

	$errors = [];



if  (empty($errors)) {


$this->tablaNoti->save($Notifica);

header('Location: /ninios/home');
}

else {
	$title = 'Notificación';


 return ['template' => 'noticon.html.php',
					     'title' => $title ,
					 'variables' => [
					 	'errors' => $errors,
			       'data_insti'  =>   $data_insti,
					 'datosNoti' => $Noticon  ?? ' '
									 ]

					];
}
}

private function calculaEdaddias ($fnac,$fcontrol) {
	
$edadDias = date_diff($fnac, $fcontrol)->days;
return $edadDias;

}


public function calcularZScore($sexo, $bus, $valor, $fecha_nace, $fecha_control) {

    // Prepare the query with the call to the ZSCORE function
    $query = "SELECT ZSCORE($sexo, '$bus', $valor, '$fecha_nace', '$fecha_control') AS resultado";
  
    // Execute the query
    $resultado = $this->pdoZSCORE->query($query);
  //var_dump($resultado);
    // Check if the query was successful
  if ($resultado) {
      // Get the result
      $fila = $resultado->fetchColumn();

      var_dump($fila);  
            $resultadoZSCORE = $fila;
    } else {
      // Handle the case where no data is returned
      $resultadoZSCORE = null;
    }
  
   return $resultadoZSCORE;
  }
  
}