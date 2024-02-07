<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Lista
{
    
	private $pdoZSCORE;
    private $tablaResi;
    private $authentication;   
	
    public function __construct(
        $pdoZSCORE,
        \ClassGrl\DataTables $tablaResi,
    \ClassGrl\Authentication $authentication
    
    )
    {
        		$this->pdoZSCORE = $pdoZSCORE;
                $this->tablaResi = $tablaResi;
                $this->authentication = $authentication;
                
		    }


    public function nominal(){
    $casos = $this->pdoZSCORE->prepare("call saltaped_sivin2.nominal();");
    $casos->execute([]);
    $datos = $casos->fetchAll(\PDO::FETCH_ASSOC);
// Verifica si la consulta se ejecutó correctamente
//if ($casos->rowCount() > 0) {
    // Obtiene los datos como un array asociativo
  //  $datos = $casos->fetchAll(\PDO::FETCH_ASSOC);
    // Muestra los datos
   //var_dump($datos);
//} else {
    // La consulta no devolvió datos
//    echo "No se encontraron datos.";
//}
$title='Nominal';
 
              return ['template' => 'nominal.html.php',
                         'title' => $title ,
                    'variables' => [
                   'casos'  =>   $datos ?? []
    
                                     ]

                    ]; 
}


}
