<?php
namespace ClassPart\Controllers;
use \ClassGrl\DataTables;
class Usuarios {
private $userTable;
private $tablaInsti;
private $userTableSivin;


public function __construct(\ClassGrl\DataTables $userTable,
							\ClassGrl\DataTables $tablaInsti,
							\ClassGrl\DataTables $userTableSivin,
							) {

        $this->userTable = $userTable;
		$this->tablaInsti = $tablaInsti;
		$this->userTableSivin = $userTableSivin;
    }


public function user($id=null){

	$instituciones = $this->tablaInsti->findAll();


	foreach($instituciones as $institucion)
	{
	    $data_insti[] = array(
	        'label'     =>  $institucion['Nombre_aop'],
	        'value'     =>  $institucion['establecimiento_id']
	    );
	}

if (isset($_GET['id'])) {
				$datosUser = $this->userTable->findById($_GET['id']);
				$datosUser['pasword']='xxxxxxx' ;

									}
			
$title = 'Carga Usuarios';

		

			  return ['template' => 'carga_user.html.php',
					     'title' => $title ,
					 'variables' => [
			       'data_insti'  =>   $data_insti,
					 'datosUser' => $datosUser  ?? ' '
									 ]

					];

}



public function userSubmit() {

$instituciones = $this->tablaInsti->findAll();


	foreach($instituciones as $institucion)
	{
	    $data_insti[] = array(
			'label'     =>  $institucion['Nombre_aop'],
	        'value'     =>  $institucion['establecimiento_id']
	    );
	}

	
	
	$Usuario=$_POST['Usuario'];
	$Usuario['nombre'] =ltrim(ucwords(strtolower($Usuario['nombre'])));
	$Usuario['apellido'] =ltrim(ucwords(strtolower($Usuario['apellido'])));
	$Usuario['email'] = ltrim(strtolower($Usuario['email']));
	$user=$this->userTable->findById($Usuario['id_usuario'])?? '';
	if (empty($user['password'])) {
	$Usuario['password'] = ltrim(password_hash($Usuario['password'], PASSWORD_DEFAULT));
	}
	$Usuario['fechaCarga'] = new \DateTime();
	$title = 'Carga Usuarios';


	$errors = [];
	if ($_SESSION['tipo'] > 2) {
	$errors[] = 'Ud no está habilitado para crear usuarios';
	header('Location:  /benef/home');
	}


	if (empty($Usuario['nombre'])) {
	$errors[] = 'Debe indicar el nombre';
	}

	if (empty($Usuario['apellido'])) {
	$errors[] = 'Debe indicar el Apellido';
	}

	if (filter_var($Usuario['email']) == false) {
	
	$errors[] = 'El formato del correo no es válido';
	}

	if (empty($_GET['id']) && count($this->userTable->find('email', $Usuario['email'])) > 0) {
	$errors[] = 'Un usuario con este e-mail ya está registrado';
	}

	if (empty($_GET['id']) && count($this->userTable->find('user', $Usuario['user'])) > 0) {
	$errors[] = 'Un usuario con este nombre de usuario ya está registrado, carguelo nuevamente con otro nombre de usuario';
	} 




if  (empty($errors)) {

$this->userTable->save($Usuario);

header('Location: /user/listar');
}

else {
	$title = 'Usuarios';


 return ['template' => 'carga_user.html.php',
					     'title' => $title ,
					 'variables' => [
					 	'errors' => $errors,
			       'data_insti'  =>   $data_insti,
					 'datosUser' => $Usuario  ?? ' '
									 ]

					];
}



}
public function listar(){
          
	$result = $this->userTable->findAll();
 
		$usuario = [];
		foreach ($result as $usuario) {
			
			$usuarios[] = [
				'id_usuario' => $usuario['id_usuario'],
				'nombres' => $usuario['nombre']. ' '.$usuario['apellido'],
				'establecimiento_nombre' => $usuario['establecimiento_nombre']?? '',
				'celular' => $usuario['celular'] ?? ''
									];
				}
	  
		$title = 'Lista Usuarios';

	   

		return ['template' => 'listausuarios.html.php',
				'title' => $title,
				'variables' => [
				'usuarios' => $usuarios,
			 ]
			];
	}

public function success() {
return ['template' => 'registersuccess.html.php',
'title' => 'Registro OK'];
}

public function import(){


$resultV = $this->userTableSivin->findAll();
$usuarioV = [];
foreach ($resultV as $usuarioV) {
	
	$usuariosV[] = [
		'id_usuario' => $usuarioV['Idusuario'],
		'nombres' => $usuarioV['Nom']. ' '.$usuarioV['Ape'],
		'establecimiento_nombre' => $usuarioV['Cargo']?? '',
		'celular' => $usuarioV['Dni'] ?? ''
							];
		}

// $title = 'Lista Usuarios';



// return ['template' => 'listausuarios.html.php',
// 		'title' => $title,
// 		'variables' => [
// 		'usuarios' => $usuariosV,
// 	 ]
// 	];
}






}




