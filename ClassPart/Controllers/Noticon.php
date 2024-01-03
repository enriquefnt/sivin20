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
//var_dump($data_insti);
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
	// var_dump($_POST['Noticon']);
	$Notificacion=[];
	$Control=[];

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
	$Notificacion['NotObserva'] = ltrim($Notifica['NotObserva']);
	$Notificacion['NotObsantro'] = $Notifica['NotObsantro'];
	$Notificacion['NotFechaSist'] = new \DateTime();
	/////////////////////////////////////////////////////////////
	$Control['IdCtrol']=$Notifica['IdCtrol'];
	$Control['IdNoti']=$this->tablaNoti->findLast('NotNinio', ($_GET['id']))[0] ?? ' ';
	$Control['CtrolFecha']=$Notifica['NotFecha'];
	$Control['CtrolUsuario'] = $usuario['id_usuario'];
	$Control['CtrolEfec'] = $Notifica['establecimiento_id'];
	//$Control['NotMotivo'] = $Notifica['NotMotivo'];
	$Control['CtrolPeso'] = $Notifica['NotPeso'];
	$Control['CtrolTalla'] = $Notifica['NotTalla'];
	$Control['CtrolAo'] = $this->tablaInsti->findById($Notifica['establecimiento_id'])['AOP'] ?? '';
	$Control['CtrolEvo'] = $Notifica['NotEvo'];
	$Control['CtrolEtio'] = $Notifica['NotEtio'];
	$Control['CtrolClinica'] = $Notifica['NotClinica'];
    $Control['CtrolObservaNutri'] = ltrim($Notifica['NotObserva']);
	$Control['CtrolObserva'] = $Notifica['NotObsantro'];
	$Control['CtrolFechapc'] = new \DateTime();
	
	


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
		$Control['CtrolZp']	= $Notificacion['NotZpe'];
		$Control['CtrolZt']	= $Notificacion['NotZta'];
		$Control['CtrolZimc']	= $Notificacion['NotZimc'];

	$title = 'notificacion';
	 var_dump($Control);

	$errors = [];



if  (empty($errors)) {

if ($_GET['tabla']=='control'){
$this->tablaControl->save($Control);}
else {
$this->tablaNoti->save($Notificacion);
}

$Notificacion=$this->tablaNoti->findLast('NotNinio', ($_GET['id']));
//var_dump($Notificacion);
return ['template' => 'notisucess.html.php',
'title' => 'Carga' ,
'variables' => [
	'Notificacion' => $Notificacion ?? ' ',
	'datosNinio'=> $datosNinio ?? ' ',

]
];


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

    
    $query = "SELECT ZSCORE($sexo, '$bus', $valor, '$fecha_nace', '$fecha_control') AS resultado";
  
    
    $resultado = $this->pdoZSCORE->query($query);
  
  if ($resultado) {
      
      $fila = $resultado->fetchColumn();

    
            $resultadoZSCORE = $fila;
    } else {
      echo("No se pudo calcular");
      $resultadoZSCORE = null;
    }
  
   return $resultadoZSCORE;
  }
  
}