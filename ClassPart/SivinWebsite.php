<?php
namespace ClassPart;
use \AllowDynamicProperties;
#[AllowDynamicProperties]
class SivinWebsite implements \ClassGrl\Website  {

	private \ClassGrl\DataTables $tablaNinios;
	private \ClassGrl\DataTables $tablaUser;
	private \ClassGrl\DataTables $tablaLoc;
	private \ClassGrl\DataTables $tablaPrueba;
	private \ClassGrl\DataTables $tablaResi;
	private \ClassGrl\DataTables $tablaNoti;
	private \ClassGrl\DataTables $tablaControl;
	private \ClassGrl\Authentication $Authentication;
	
public function __construct() {


	$pdo = new \PDO('mysql:host=212.1.210.73;dbname=saltaped_sivin2; charset=utf8mb4', 'saltaped_sivin2', 'i1ZYuur=sO1N');
	$this->tablaNinios = new \ClassGrl\DataTables($pdo,'Ninios', 'IdNinio');	
	$this->tablaUser = new \ClassGrl\DataTables($pdo,'datos_usuarios', 'id_usuario');	
	$this->tablaLoc = new \ClassGrl\DataTables($pdo,'Localidades', 'gid');
	$this->tablaInsti = new \ClassGrl\DataTables($pdo,'instituciones', 'codi_esta');
	$this->tablaResi = new \ClassGrl\DataTables($pdo,'NIÑOSRESIDENCIA', 'IdResi');
	$this->tablaNoti = new \ClassGrl\DataTables($pdo,'notificacion', 'NotId');
	$this->tablaControl = new \ClassGrl\DataTables($pdo,'control', 'IdCtrol');
	$this->authentication = new \ClassGrl\Authentication($this->tablaUser,'user', 'password'); 
	}



	public function getLayoutVariables(): array {

	return [

	'loggedIn' => $this->authentication->isLoggedIn()

	];

}


public function getDefaultRoute(): string {

	return 'ninios/home';

	}

public function getController(string $controllerName): ?object {	

	

    if ($controllerName === 'user') {

		$controller = new \ClassPart\Controllers\Usuarios($this->tablaUser,$this->tablaInsti);

		}

	else if ($controllerName === 'ninios') {

		$controller = new  \ClassPart\Controllers\Ninios($this->tablaNinios,$this->tablaLoc, 
		$this->tablaResi, $this->authentication);

		}
	
		else if ($controllerName === 'noticon') {

			$controller = new  \ClassPart\Controllers\Noticon($this->tablaNinios,$this->tablaLoc, 
			$this->tablaNoti, $this->tablaControl, $this->tablaResi, $this->tablaInsti, $this->authentication);
	
			}
	

	else if ($controllerName == 'login') {

		$controller = new \ClassPart\Controllers\Login($this->authentication);

		}	



 else {

            $controller = null;

        }

		

	return $controller;



  }







public function checkLogin(string $uri): ?string {

        $restrictedPages = ['benef/edit', 'user/user', 'benef/listar'];



        if (in_array($uri, $restrictedPages) && !$this->authentication->isLoggedIn()) {

            header('location: /login/login');

            exit();

        }



        return $uri;

    }



}
























