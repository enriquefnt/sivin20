<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Lista
{
    
	private $pdoZSCORE;
    private $authentication;   
	
    public function __construct($pdoZSCORE,
    \ClassGrl\Authentication $authentication
    )
    {
        		$this->pdoZSCORE = $pdoZSCORE;
                $this->authentication = $authentication;
		    }


//  public function nominal(){

//     $query = 'call saltaped_sivin2.nominal();';	
     
//     $casos = $this->pdoZSCORE->query($query);
//   	var_dump($casos);

//       // if (isset($_GET['Idint'])) {
      
      //   $title='Nominal';
 
      //          return ['template' => 'nominal.html.php',
      //                     'title' => $title ,
      //                 'variables' => [
      //               'casos'  =>   $casos?? []
      //               // ,
      //               // 'datosNinio'=> $datosNinio?? [],
      //               // 'datosNoti' => $datosNoti  ?? [],
      //               // 'datosInter' => $datosInter ?? [],
      //               // 'fechaMinima'=>$fechaMinima ?? ''
      //                                 ]
 
      //                ]; }




    
 
    //   public function nominal(){
    //     // Prepara la sentencia SQL para ejecutar el procedimiento almacenado
    //     $casos = $this->pdoZSCORE->prepare("call saltaped_sivin2.nominal();");
    
    //     // Ejecuta la sentencia preparada con los parámetros dados (en este caso, ninguno)
    //     $casos->execute([]); // o $casos->execute(null);
    
    //     // Devuelve el resultado (si lo hubiera)
    //      $casos->fetchAll(\PDO::FETCH_ASSOC);
    //    var_dump($casos);

    //     $title='Nominal';
 
    //               return ['template' => 'nominal.html.php',
    //                          'title' => $title ,
    //                     'variables' => [
    //                    'casos'  =>   $casos ?? []
        
    //                                      ]
   
    //                     ]; 
    // }


    /////////////////////////////////////////////////////////////////
    public function nominal(){
    $casos = $this->pdoZSCORE->prepare("call saltaped_sivin2.nominal();");
$casos->execute([]);

// Verifica si la consulta se ejecutó correctamente
if ($casos->rowCount() > 0) {
    // Obtiene los datos como un array asociativo
    $datos = $casos->fetchAll(\PDO::FETCH_ASSOC);
    // Muestra los datos
   //var_dump($datos);
} else {
    // La consulta no devolvió datos
    echo "No se encontraron datos.";
}
$title='Nominal';
 
              return ['template' => 'nominal.html.php',
                         'title' => $title ,
                    'variables' => [
                   'casos'  =>   $datos ?? []
    
                                     ]

                    ]; 
}


}
