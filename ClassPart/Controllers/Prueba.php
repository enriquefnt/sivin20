<?php
namespace ClassPart\Controllers;
use \ClassGrl\DataTables;
class Prueba {
private $pruebaTable;



public function __construct(\ClassGrl\DataTables $pruebaTable) {

        $this->pruebaTable = $pruebaTable;
	
    }


public function prueba($id=null){

	
if (isset($_GET['id'])) {
				$datosPrueba = $this->pruebaTable->findById($_GET['id']);
				

									}
			
$title = 'prueba';

		

			  return ['template' => 'carga_prueba.html.php',
					     'title' => $title ,
					 'variables' => [
			      	 'datosPrueba' => $datosPrueba  ?? ' '
									 ]

					];

}



public function pruebaSubmit() {


	$Prueba=$_POST['Prueba'];
	

$this->pruebaTable->save($Prueba);

header('Location: ninios/home');
}



}


