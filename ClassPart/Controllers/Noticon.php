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
	private $pdoZSCORE;   
	private $tablaResi;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaNoti,
                                \ClassGrl\DataTables $tablaControl,
                                \ClassGrl\DataTables $tablaInsti,
								$pdoZSCORE,	
								\ClassGrl\DataTables $tablaResi,
                                \ClassGrl\Authentication $authentication)
    {
        $this->tablaNinios = $tablaNinios;
        $this->tablaNoti = $tablaNoti;
        $this->tablaControl = $tablaControl;
        $this->tablaInsti = $tablaInsti;
		$this->pdoZSCORE = $pdoZSCORE;
		$this->tablaResi = $tablaResi;
        $this->authentication = $authentication;
    }


public function noti($id=null){

	$instituciones = $this->tablaInsti->findAll();

	foreach($instituciones as $institucion)
	{
	    $data_insti[] = array(
	        'label'     =>  $institucion['Nombre_aop'],
	        'value'     =>  $institucion['establecimiento_id']
	    );
	}

if (isset($_GET['id'])) {
	$datosDomi = $this->tablaResi->findLast('ResiNinio', ($_GET['id']));

	$datosNinio=$this->tablaNinios->findById($_GET['id']);

	$edad=$this->calcularEdad($datosNinio['FechaNto'],date('Y-m-d')) ?? ' ';
	$datosNinio['edad']=$edad;
	
						}
			
$title = 'Carga Notificación';

		

			  return ['template' => 'noticon.html.php',
					     'title' => $title ,
					 'variables' => [
			       'data_insti'  =>   $data_insti,
				   'datosNinio'=> $datosNinio ?? ' ',
				   'datosDomi'=> $datosDomi ?? ' ',
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
	        'label'     =>  $institucion['Nombre_aop'],
	        'value'     =>  $institucion['establecimiento_id']
	    );
	}

	$datosNinio=$this->tablaNinios->findById($_GET['id']);
	$edad=$this->calcularEdad($datosNinio['FechaNto'],date('Y-m-d'));
	$datosNinio['edad']=$edad;
//	var_dump($datosNinio);
	$usuario = $this->authentication->getUser();
	$Notifica=$_POST['Noticon'];
//	var_dump($Notifica);
	$Notificacion=[];

	$Notificacion['NotId']=$Notifica['NotId'];
	$Notificacion['NotFecha']=$Notifica['NotFecha'];
	$Notificacion['NotNinio']=$datosNinio['IdNinio'];
	$Notificacion['NotUsuario'] = $usuario['id_usuario'];
	$Notificacion['NotEfec'] = $Notifica['establecimiento_id'];
	$Notificacion['NotMotivo'] = $Notifica['NotMotivo'];
	$Notificacion['NotPeso'] = $Notifica['NotPeso'];
	$Notificacion['NotTalla'] = $Notifica['NotTalla'];
	$Notificacion['NotAo'] = $this->tablaInsti->findById($Notifica['establecimiento_id'])['AOP'] ?? '';
	$Notificacion['NotEvo'] = $Notifica['NotEvo'];
	$Notificacion['NotEtio'] = $Notifica['NotEtio'];
	$Notificacion['NotClinica'] = $Notifica['NotClinica'];
	$Notificacion['NotObserva'] = $Notifica['NotObserva'];
	$Notificacion['NotObsantro'] = $Notifica['NotObsantro'];
	$Notificacion['NotFechaSist'] = new \DateTime();
	/////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////
	$imc=($Notificacion['NotPeso']/(($Notificacion['NotTalla']/100)*($Notificacion['NotTalla']/100)));
	$Notificacion['NotImc'] = $imc;
	$sexo = ($datosNinio['sexo'] ='Femenino') ? '2' : '1';

	$Notificacion['NotZpe']= $this->calcularZScore(
		$sexo  , 
		"p", 
		$Notificacion['NotPeso'], 
		$datosNinio['FechaNto'], 
		$Notificacion['NotFecha']
		) ;
		$Notificacion['NotZta']= $this->calcularZScore(
			$sexo  , 
		"t", 
		$Notificacion['NotTalla'], 
		$datosNinio['FechaNto'], 
		$Notificacion['NotFecha']
		) ;
		$Notificacion['NotZimc'] = $this->calcularZScore(
		$sexo , 
		"i", 
		$imc, 
		$datosNinio['FechaNto'], 
		$Notificacion['NotFecha']
		) ;   

		/////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////


	$title = 'notificacion';
//	var_dump($Notificacion);

	$errors = [];



if  (empty($errors)) {


$this->tablaNoti->save($Notificacion);

$Notificacion=$this->tablaNoti->findLast('NotNinio', ($_GET['id']));
var_dump($Notificacion);
return ['template' => 'notisucess.html.php',
'title' => 'Carga' ,
'variables' => [
	'Notificacion' => $Notificacion ?? ' ',
	'datosNinio'=> $datosNinio ?? ' ',

]
];








// header('Location: /ninios/home');
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

public function calcularEdad($fechaNacimiento, $fechaActual) {
	$nacimiento = new \DateTime($fechaNacimiento);
	$actual = new \DateTime($fechaActual);
	$edad = $nacimiento->diff($actual);
		$anios = $edad->y;
		$meses = $edad->m;
		$dias = $edad->d;
 if($anios>0){
	return " $anios a $meses m    ";
}
else {
	return "  $meses m $dias d   ";
}
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

    //  var_dump($fila);  
            $resultadoZSCORE = $fila;
    } else {
      // Handle the case where no data is returned
      $resultadoZSCORE = null;
    }
  
   return $resultadoZSCORE;
  }
  
}