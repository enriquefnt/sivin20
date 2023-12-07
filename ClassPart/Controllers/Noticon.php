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
    private $tablaLoc;
    private $tablaResi;
    private $tablaInsti;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaNoti,
                                \ClassGrl\DataTables $tablaControl,
                                \ClassGrl\DataTables $tablaLoc,
                                \ClassGrl\DataTables $tablaResi,
                                \ClassGrl\DataTables $tablaInsti,
                                \ClassGrl\Authentication $authentication)
    {
        $this->tablaNinios = $tablaNinios;
        $this->tablaNoti = $tablaNoti;
        $this->tablaControl = $tablaControl;
        $this->tablaLoc = $tablaLoc;
        $this->tablaResi = $tablaResi;
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

	var_dump($_GET['id']);
				$datosNoti = $this->tablaNoti->findById($_GET['id']);
			var_dump($datosNoti);
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
	
	$Notifica=$_POST['Noticon'];
	var_dump($Notifica);
//	$Noticon['nombre'] =ltrim(ucwords(strtolower($Noticon['nombre'])));
	$Notifica['NotNiño']=$this->tablaNinios->findById($_GET['id']);
	$Notifica['NotUsuario'] = $usuario;
	$Notifica['CtrolFechapc'] = new \DateTime();
	$title = 'notificacion';


	$errors = [];
	/*if ($_SESSION['tipo'] > 2) {
	$errors[] = 'Ud no está habilitado para crear Noticons';
	header('Location:  /benef/home');
	}


	if (empty($Noticon['nombre'])) {
	$errors[] = 'Debe indicar el nombre';
	}

	if (empty($Noticon['apellido'])) {
	$errors[] = 'Debe indicar el Apellido';
	}

	if (filter_var($Noticon['email']) == false) {
	
	$errors[] = 'El formato del correo no es válido';
	}

	if (empty($_GET['id']) && count($this->userTable->find('email', $Noticon['email'])) > 0) {
	$errors[] = 'Un Noticon con este e-mail ya está registrado';
	}

	if (empty($_GET['id']) && count($this->userTable->find('user', $Noticon['user'])) > 0) {
	$errors[] = 'Un Noticon con este nombre de Noticon ya está registrado, carguelo nuevamente con otro nombre de Noticon';
	} 

*/
$errors=[];

if  (empty($errors)) {

$this->tablaNoti->save($Notifica);

header('Location: /ninios/home');
}

else {
	$title = 'Noticons';


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


public function calcularZPeso($peso, $talla) {
    // Utilice la función ZSCORES de MySQL para calcular el Z score del peso
    $z_peso = ZSCORES($peso, $talla, "Peso");
    return $z_peso;
  }

  public function calcularZTalla($talla) {
    // Utilice la función ZSCORES de MySQL para calcular el Z score de la talla
    $z_talla = ZSCORES($talla, "", "Talla");
    return $z_talla;
  }

  public function calcularZIMC($peso, $talla) {
    // Calcule el IMC
    $imc = $peso / pow($talla / 100, 2);

    // Utilice la función ZSCORES de MySQL para calcular el Z score del IMC
    $z_imc = ZSCORES($imc, "", "IMC");
    return $z_imc;
  }
}