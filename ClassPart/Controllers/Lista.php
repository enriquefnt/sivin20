<?php
namespace ClassPart\Controllers;
use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Lista
{
    private $tablaZscore;
	  private $pdoZSCORE;
    
    private $authentication;   
	
    public function __construct(
        $pdoZSCORE,
        \ClassGrl\DataTables $tablaZscore,
       
    \ClassGrl\Authentication $authentication
    
    )
    {
        		$this->pdoZSCORE = $pdoZSCORE;
                $this->tablaZscore = $tablaZscore;     
                $this->authentication = $authentication;
                
		    }


    public function nominal(){
        
    $casos = $this->pdoZSCORE->prepare("call saltaped_sivin2.nominal();");
    $casos->execute([]);
    $datos = $casos->fetchAll(\PDO::FETCH_ASSOC);

  //      var_dump($datos);

$title='Nominal';
 
              return ['template' => 'nominal.html.php',
                         'title' => $title ,
                    'variables' => [
                   'casos'  =>   $datos ?? []
    
                                     ]

                    ]; 
}
 public function porCaso(){
 
  $controles = $this->pdoZSCORE->prepare("call saltaped_sivin2.controlesXcaso(6622);");
    $controles->execute([]);
    $datosControl =$controles->fetchAll(\PDO::FETCH_ASSOC);

    $title='Controles';
 
              return ['template' => 'controles.html.php',
                         'title' => $title ,
                    'variables' => [
                   'datosControl'  =>   $datosControl ?? []
    
                                     ]

                    ]; 

}
// public function grafica(){
//   $controles = $this->pdoZSCORE->prepare("call saltaped_sivin2.datosGraficas(6622);");
//   $controles->execute([]);
//   $datosControl =$controles->fetchAll(\PDO::FETCH_ASSOC);

  
//   foreach($datosControl as $control)
//   {
//       $data[] = array(
//           'edad'     => $control['EdadDias'],
//           'peso'     => $control['Peso'],
//           'talla'   => $control['Talla']
//       );
//   }
//   var_dump($data); die;
//   $title='Gráfica';
 
//   return ['template' => 'grafica.html.php',
//              'title' => $title ,
//         'variables' => [
//        'data'  =>   $data ?? []

//                          ]

//         ]; 


// }



public function grafica(){
  $controles = $this->pdoZSCORE->prepare("call saltaped_sivin2.datosGraficas(6622);");
  $controles->execute([]);
  $datosControl =$controles->fetchAll(\PDO::FETCH_ASSOC);

  // Inicializar arreglos para las edades y pesos
  $edades = [];
  $pesos = [];

  foreach($datosControl as $control) {
      $edades[] = $control['EdadDias'];
      $pesos[] = $control['Peso'];
  }
    var_dump($edades);
    var_dump($pesos); die;



  // Crear un arreglo asociativo con las edades y los pesos
  $data = [
      'edades' => $edades,
      'pesos' => $pesos
  ];
//var_dump($data); die ;
  $title='Gráfica';
  
  return [
      'template' => 'grafica.html.php',
      'title' => $title,
      'variables' => [
          'data' => $data ?? []
      ]
  ];
}
public function graficaprueba(){

  $controles = $this->pdoZSCORE->prepare("call saltaped_sivin2.datosGraficas(6622);");
  $controles->execute([]);
  $datosControl =$controles->fetchAll(\PDO::FETCH_ASSOC);

  foreach($datosControl as $control) {
    $edades[] = $control['EdadDias'];
    $pesos[] = $control['Peso'];
}
  
// Aquí obtienes los datos de tu base de datos, por ejemplo:
// $edades = [1500, 1800, 2400, 27000, 3300];
// $alturas = [110.2, 115.7, 120.9, 125.1, 130.25];




var_dump($edades);
    var_dump($pesos); //die;

// Los conviertes a formato JSON para pasárselos a JavaScript
$data = [
    'edades' => $edades,
    'pesos' => $pesos
];
  
$title='Gráfica';
  
  return [
      'template' => 'graficax.html.php',
      'title' => $title,
      'variables' => [
          'data' => $data ?? []
      ]
  ];




}


public function grafico(){

  $title='Gráfica';
  
  return [
      'template' => 'graficax.html.php',
      'title' => $title,
      'variables' => [
          'data' => $data ?? []
      ]
  ];


}

// public function tablaZ($id=null){
// //var_dump($_GET)  ;
// $tabla=$_GET['tabla'];
//   $result = $this->tablaZscore->findAll();

//   foreach($result as $dias) {

    
//     $data['edad'][] = $dias['edadDias'];
//     $data['SD3neg'][] =$dias['SD3neg' . $tabla];
//     $data['SD2neg'][] = $dias['SD2neg' . $tabla];
//     $data['SD1neg'][] =$dias['SD1neg' . $tabla];
//     $data['SD0'][] = $dias['SD0' . $tabla];
//     $data['SD1'][] = $dias['SD1' . $tabla];
//     $data['SD2'][] = $dias['SD2' . $tabla];
//     $data['SD3'][] = $dias['SD3' . $tabla];
//    }
//   // var_dump($data); die;

// // $data = [
// //   'EdadDias' => $edadDias,
// //   'SD2negPEF' => $SD2negPEF
// // ];



//   //$json_data = json_encode($result);

//    //         return $json_data;
  
  
//    $title='Gráfica';
  
//    return [
//        'template' => 'tablaZ.html.php',
//        'title' => $title,
//        'variables' => [
//            'data' => $data ?? []
//        ]
//    ];
 // }
 public function tablaZ($id=null){
  // Obtener el valor de la tabla desde $_GET
  $tabla = $_GET['tabla'];

  // Obtener todos los datos
  $result = $this->tablaZscore->findAll();

  // Inicializar arrays para los datos agrupados
  $data = [
      'edad' => [],
      'SD3neg' => [],
      'SD2neg' => [],
      'SD1neg' => [],
      'SD0' => [],
      'SD1' => [],
      'SD2' => [],
      'SD3' => []
  ];

  // Contador para rastrear el número de líneas procesadas
  $counter = 0;

  // Iterar sobre los resultados
  foreach ($result as $dias) {
      // Incrementar el contador
     $counter++;

      // Solo agregar valores al array de datos si el contador es divisible por 3
     if ($counter % 30 === 0) {
          $data['edad'][] = $dias['edadDias'];
          $data['SD3neg'][] = $dias['SD3neg' . $tabla];
          $data['SD2neg'][] = $dias['SD2neg' . $tabla];
          $data['SD1neg'][] = $dias['SD1neg' . $tabla];
          $data['SD0'][] = $dias['SD0' . $tabla];
          $data['SD1'][] = $dias['SD1' . $tabla];
          $data['SD2'][] = $dias['SD2' . $tabla];
          $data['SD3'][] = $dias['SD3' . $tabla];
      }
}

  // Devolver los datos agrupados
  $title = 'Gráfica';
  return [
      'template' => 'tablaZ.html.php',
      'title' => $title,
      'variables' => [
          'data' => $data
      ]
  ];
}
 


}