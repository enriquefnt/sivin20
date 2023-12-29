<?php
namespace ClassPart;
use \AllowDynamicProperties;
#[AllowDynamicProperties]
class SivinWebsite implements \ClassGrl\Website  {

	private \ClassGrl\DataTables $tablaNinios;
	private \ClassGrl\DataTables $tablaUser;
	private \ClassGrl\DataTables $tablaEtnia;
	private \ClassGrl\DataTables $tablaLoc;
	private \ClassGrl\DataTables $tablaResi;
	private \ClassGrl\DataTables $tablaNoti;
	private \ClassGrl\DataTables $tablaControl;
	private \ClassGrl\Authentication $Authentication;
	private \ClassGrl\DataTables $tablaAntro;
	private $pdoZSCORE;
	
	
public function __construct() {


	$pdo = new \PDO('mysql:host=212.1.210.73;dbname=saltaped_sivin2; charset=utf8mb4', 'saltaped_sivin2', 'i1ZYuur=sO1N');
	$this->tablaNinios = new \ClassGrl\DataTables($pdo,'Ninios', 'IdNinio');	
	$this->tablaUser = new \ClassGrl\DataTables($pdo,'datos_usuarios', 'id_usuario');	
	$this->tablaEtnia = new \ClassGrl\DataTables($pdo,'etnias', 'IdEtnia');
	$this->tablaLoc = new \ClassGrl\DataTables($pdo,'localidades', 'gid');
	$this->tablaInsti = new \ClassGrl\DataTables($pdo,'instituciones', 'codi_esta');
	$this->tablaResi = new \ClassGrl\DataTables($pdo,'NIÑOSRESIDENCIA', 'IdResi');
	$this->tablaNoti = new \ClassGrl\DataTables($pdo,'notificacion', 'NotId');
	$this->tablaControl = new \ClassGrl\DataTables($pdo,'control', 'IdCtrol');
	$this->authentication = new \ClassGrl\Authentication($this->tablaUser,'user', 'password'); 
	$this->tablaAntro = new \ClassGrl\DataTables($pdo,'calc_antro', 'idAnt');
	$this->pdoZSCORE = new \PDO('mysql:host=212.1.210.73;dbname=saltaped_sivin2; charset=utf8mb4', 'saltaped_sivin2', 'i1ZYuur=sO1N'); // Asignar el valor a la variable $pdoZSCORE
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

		$controller = new  \ClassPart\Controllers\Ninios($this->tablaNinios,$this->tablaEtnia,$this->tablaLoc, 
		$this->tablaResi, $this->authentication);

		}
	
		else if ($controllerName === 'noticon') {

			$controller = new  \ClassPart\Controllers\Noticon($this->tablaNinios, $this->tablaNoti, 
			$this->tablaControl, $this->tablaInsti, $this->pdoZSCORE, $this->authentication);
			}


///$controller = new \ClassPart\Controllers\Noticon($this->tablaNinios, $this->tablaNoti, $this->tablaControl, $this->tablaInsti, $this->pdoZSCORE, $this->authentication);

	else if ($controllerName === 'antro') {

				$controller = new \ClassPart\Controllers\Antro($this->tablaAntro, $this->pdoZSCORE);
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

        $restrictedPages = ['ninios/ninios', 'user/user', 'noticon/noticon'];



        if (in_array($uri, $restrictedPages) && !$this->authentication->isLoggedIn()) {

            header('location: /login/login');

            exit();

        }



        return $uri;

    }



}
























