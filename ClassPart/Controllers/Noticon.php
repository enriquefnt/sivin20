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
	private $tablaInter;
    private $tablaInsti;
	private $pdoZSCORE;   
	private $tablaResi;
	private $tablEvol;
	private $tablaClin;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaNoti,
                                \ClassGrl\DataTables $tablaControl,
								\ClassGrl\DataTables $tablaInter,
                                \ClassGrl\DataTables $tablaInsti,
								$pdoZSCORE,	
								\ClassGrl\DataTables $tablaResi,
								\ClassGrl\DataTables $tablaEvol,
								\ClassGrl\DataTables $tablaClin,
                                \ClassGrl\Authentication $authentication)
    {
        $this->tablaNinios = $tablaNinios;
        $this->tablaNoti = $tablaNoti;
        $this->tablaControl = $tablaControl;
		$this->tablaInter = $tablaInter;
        $this->tablaInsti = $tablaInsti;
		$this->pdoZSCORE = $pdoZSCORE;
		$this->tablaResi = $tablaResi;
		$this->tablaEvol = $tablaEvol;
		$this->tablaClin =$tablaClin;
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
	$segunevol=$this->tablaEvol->findAll();
	$segunclin=$this->tablaClin->findAll();
    //  var_dump($segunclin);
	$edad=$this->calcularEdad($datosNinio['FechaNto'],date('Y-m-d')) ?? ' ';
	$datosNinio['edad']=$edad ?? ' ';
	
						}
						if ($_GET['tabla']=='notificacion'){
							$title = 'Notificacion';}
							else if ($_GET['tabla']=='control'){
								$title = 'Control';	}
								else if ($_GET['tabla']=='cierrenoti'){
									$title = 'Cierre notificacion';	}	
	if($_GET['tabla']=='notificacion'||$_GET['tabla']=='control')	{				
	

			  return ['template' => 'noticon.html.php',
					     'title' => $title ,
					 'variables' => [
			       'data_insti'  =>   $data_insti,
				   'datosNinio'=> $datosNinio ?? ' ',
				   'datosDomi'=> $datosDomi ?? ' ',
				   'segunevol'=> $segunevol,
				   'segunclin'=> $segunclin,
					 'datosNoti' => $datosNoti  ?? ' '
									 ]

					]; }
	else {
	

		return ['template' => 'cierrenoti.html.php',
				   'title' => $title ,
			   'variables' => [
			 'data_insti'  =>   $data_insti,
			 'datosNinio'=> $datosNinio ?? ' ',
			 'datosDomi'=> $datosDomi ?? ' ',
			 'segunevol'=> $segunevol,
			 'segunclin'=> $segunclin,
			   'datosNoti' => $datosNoti  ?? ' '
							   ]

			  ]; }
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
	$datosDomi = $this->tablaResi->findLast('ResiNinio', ($_GET['id']));

	$usuario = $this->authentication->getUser();
	$Notifica=$_POST['Noticon'];

	$Notificacion=[];
	$Control=[];

	//$Notificacion['NotId']=$Notifica['NotId'];
	
	if ($_GET['tabla']=='notificacion') {
	$Notificacion['NotId']=$Notifica['NotId'];
	$Notificacion['NotNinio']=$datosNinio['IdNinio'];
	$Notificacion['NotFecha']=$Notifica['NotFecha'];
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
	$Notificacion['NotFin'] = $Notifica['NotFin']?? 'NO ';
	$Notificacion['NotFechaSist'] = new \DateTime();
}
	

	else if($_GET['tabla']=='cierrenoti'){
	$Notificacion['NotId']=$this->tablaNoti->findLast('NotNinio', ($_GET['id']))[0] ?? ' ';
	$Notificacion['NotNinio']=$datosNinio['IdNinio'];
	$Notificacion['NotFin'] = $Notifica['NotFin']?? 'SI ';
	$Notificacion['NotFechaFin'] = $Notifica['NotFechaFin']?? ' ';//
	$Notificacion['NotAlta'] = $Notifica['NotAlta']?? ' ';
	$Notificacion['NotObservafin'] = $Notifica['NotObservafin']?? ' ';
	$Notificacion['NotFechaSist'] = new \DateTime();

	}
	/////////////////////////////////////////////////////////////
	else if($_GET['tabla']=='control'){
	$Control['IdCtrol']=$Notifica['IdCtrol'] ?? ' ';
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

	}

	////////////////////////////////////////////////////////

	if ($_GET['tabla']!='cierrenoti'){
	$imc=($Notifica['NotPeso']/(($Notifica['NotTalla']/100)*($Notifica['NotTalla']/100)));
	$Notificacion['NotImc'] = $imc;
	$sexo = ($datosNinio['sexo'] ='Femenino') ? '2' : '1';

////////////////////revisar esto//////////////////////////////////

	$Notificacion['NotZpe']= $this->calcularZScore(
		$sexo  , 
		"p", 
		$Notifica['NotPeso'], 
		$datosNinio['FechaNto'], 
		$Notifica['NotFecha']
		) ;
		$Notificacion['NotZta']= $this->calcularZScore(
			$sexo  , 
		"t", 
		$Notifica['NotTalla'], 
		$datosNinio['FechaNto'], 
		$Notifica['NotFecha']
		) ;
		$Notificacion['NotZimc'] = $this->calcularZScore(
		$sexo , 
		"i", 
		$imc, 
		$datosNinio['FechaNto'], 
		$Notifica['NotFecha']
		) ;   

		
		$Control['CtrolZp']	= $Notificacion['NotZpe'];
		$Control['CtrolZt']	= $Notificacion['NotZta'];
		$Control['CtrolZimc']	= $Notificacion['NotZimc'];
		}		


	/////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////

		if ($_GET['tabla']=='notificacion'){
			$title = 'Notificacion';}
			else if ($_GET['tabla']=='control'){
				$title = 'Control';	}
				else if ($_GET['tabla']=='cierrenoti'){
					$title = 'Cierre notificacion';	}
	
	$errors = [];



if  (empty($errors)) {

if ($_GET['tabla']=='control'){
$this->tablaControl->save($Control);}
else {
$this->tablaNoti->save($Notificacion);
}

//////////////////////para ventanas modales /////////////////////

$Notificacion=$this->tablaNoti->findLast('NotNinio', ($_GET['id']));
$Control=$this->tablaControl->findLast('IdNoti', ($Notificacion['NotId'])) ?? [];
$datosInter= $this->tablaInter->findLast('IdNotifica', ($Notificacion['NotId'])) ?? [];

if ($_GET['tabla']=='notificacion'){


$Notificacion['colorIMC']=$this->getColorClass($Notificacion['NotZimc']);
$Notificacion['colorPE']=$this->getColorClass($Notificacion['NotZpe']);
$Notificacion['colorTA']=$this->getColorClass($Notificacion['NotZta']);

return ['template' => 'notisucess.html.php',
'title' => $title ,
'variables' => [
	'Notificacion' => $Notificacion ?? [],
	'datosNinio'=> $datosNinio ?? [],
	'datosDomi' => $datosDomi
]
];
     }
	 else if ($_GET['tabla']=='control'){
		
	//	var_dump($datosInter);
		$Control['colorIMC']=$this->getColorClass($Control['CtrolZimc']);
		$Control['colorPE']=$this->getColorClass($Control['CtrolZp']);
		$Control['colorTA']=$this->getColorClass($Control['CtrolZt']);
		return ['template' => 'controlsucess.html.php',
		'title' => $title ,
		'variables' => [
			'Control' => $Control ?? ' ',
			'Notificacion' => $Notificacion ?? [],
			'datosNinio'=> $datosNinio ?? [],
			'datosInter' => $datosInter ?? [],
			'datosDomi' => $datosDomi
		]
		];
	 }
	 else if ($_GET['tabla']=='cierrenoti'){
		
		
		
		
		isset($Control[0]) ? $Control['colorIMC']=$this->getColorClass($Control['CtrolZimc']):
		$Notificacion['colorIMC']=$this->getColorClass($Notificacion['NotZimc']);

		isset($Control[0]) ?$Control['colorPE']=$this->getColorClass($Control['CtrolZp']):
		$Notificacion['colorPE']=$this->getColorClass($Notificacion['NotZpe']);

		isset($Control[0]) ?$Control['colorTA']=$this->getColorClass($Control['CtrolZt']):
		$Notificacion['colorTA']=$this->getColorClass($Notificacion['NotZta']);

		
		return ['template' => 'cierreSucess.html.php',
		'title' => 'Cierre noti',
		'variables' => [
			'Notificacion' => $Notificacion ?? [],
			'Control' => $Control ?? [],
			'datosNinio'=> $datosNinio ?? [],
			'datosDomi' => $datosDomi ?? []
		]
		];
	 }

}

else {
	//$title = 'Notificación';


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
  
  public function getColorClass($value) {
    switch (true) {
        case $value > 2:
            return 'red';
        case $value < -2:
            return 'red';
		case ($value >= -1.5 && $value <= 1.5):
			return 'green';		
				case ($value < -1.5 && $value >= -2):
			return 'yellow';	
        default:
            return 'green';
    }
}

public function getAlertClass($value) {
    switch (true) {
        case $value > 2:
            return 'danger';
        case $value < -2:
            return 'danger';
		case ($value >= -1.5 && $value <= 1.5):
			return 'success';		
				case ($value < -1.5 && $value >= -2):
			return 'warning';	
        default:
            return 'primary';
    }
}

}