<?php
namespace ClassPart;
use \AllowDynamicProperties;
#[AllowDynamicProperties]
class SivinWebsite implements \ClassGrl\Website  {

	private \ClassGrl\DataTables $tablaNinios;
	private \ClassGrl\DataTables $tablaUser;
	private \ClassGrl\Authentication $Authentication;
	
public function __construct() {


	$pdo = new \PDO('mysql:host=212.1.210.73;dbname=saltaped_sivin2; charset=utf8', 'saltaped_sivin2', 'i1ZYuur=sO1N');
	$this->tablaNinios = new \ClassGrl\DataTables($pdo,'Niños', 'IdNiño');	
	$this->tablaUser = new \ClassGrl\DataTables($pdo,'datos_usuarios', 'id_usuario');	
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

		$controller = new  \ClassPart\Controllers\Ninios($this->tablaNinios, $this->authentication);

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
























