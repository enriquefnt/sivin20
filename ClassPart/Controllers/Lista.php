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
 
  $controles = $this->pdoZSCORE->prepare("call saltaped_sivin2.controlesXcaso(6599);");
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



public function graficaprueba(){

  $controles = $this->pdoZSCORE->prepare("call saltaped_sivin2.datosGraficas(6622);");
  $controles->execute([]);
  $datosControl =$controles->fetchAll(\PDO::FETCH_ASSOC);

  foreach($datosControl as $control) {
    $edades[] = $control['EdadDias'];
    $pesos[] = $control['Peso'];
}
  
 

$data = [
    'edades' => $edades,
    'pesos' => $pesos
];
// var_dump($data);
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


 public function tablaZ($id=null){
  $indicador = $_GET['indicador'] ?? '';
  $caso= $_GET['caso'] ?? '';
  $sex= $_GET['sex'];
  $tabla=$indicador . $sex;
//echo($indicador . '   '  .$tabla .'  '. $sex);
/////////////////////datos niño ////////////////////////////////
$controles = $this->pdoZSCORE->prepare("call saltaped_sivin2.datosGraficas($caso);");
  $controles->execute([]);
  $datosControl =$controles->fetchAll(\PDO::FETCH_ASSOC);
 //var_dump($datosControl); 
  
 
  $dataCaso = [
    'edad' => [],
    'valor' =>[]
  ];
  foreach($datosControl as $control) {
    $dataCaso['edad'][] = $control['EdadDias'];

    if ($indicador=='PE'){$dataCaso['valor'][]=$control['Peso'];}
    elseif ($indicador=='TE'){$dataCaso['valor'][]=$control['Talla'];}
    else {$dataCaso['valor'][]=$control['Peso']/($control['Talla']/100)/($control['Talla']/100);}
   }
  



/////var_dump($dataCaso); 
 ///////////////////////////////////////////////////////////////////
///////////////Datos tabla//////////////////////////////////

  $result = $this->tablaZscore->findAll();

  $data = [
      'edad' => [],
      'SD3neg' => [],
      'SD2neg' => [],
      'SD1neg' => [],
      'SD0' => [],
      'SD1' => [],
      'SD2' => [],
      'SD3' => [],
      'medida' => [],
     
  ];

  //$counter = 0;
  foreach ($result as $dias) {
     
   //  $counter++;

     
   //  if ($counter % 30 === 0) {
          $data['edad'][] = $dias['edadDias'];
          $data['SD3neg'][] = $dias['SD3neg' . $tabla];
          $data['SD2neg'][] = $dias['SD2neg' . $tabla];
          $data['SD1neg'][] = $dias['SD1neg' . $tabla];
          $data['SD0'][] = $dias['SD0' . $tabla];
          $data['SD1'][] = $dias['SD1' . $tabla];
          $data['SD2'][] = $dias['SD2' . $tabla];
          $data['SD3'][] = $dias['SD3' . $tabla];
    //            }
           
      
      
      switch ($data['medida'] = $tabla){
        case $tabla=="PEF"||$tabla=="PEM":
          $data['medida'] ='Peso (kg)';
          break;
          case $tabla=="TEF"||$tabla=="TEM":
          $data['medida'] ='Talla (cm)';
          break;
          case $tabla=="IEF"||$tabla=="IEM":
          $data['medida'] ='Indice de masa corporal (kg/m2)';
          break;
         
        default:
        $data['medida']  ='Otra';

      }
}
//////////////////////////////////////////////////////////////////////
  $title = 'Gráfica';
  return [
      'template' => 'tablaZ.html.php',
      'title' => $title,
      'variables' => [
          'data' => $data,
          'dataCaso' =>  $dataCaso
      ]
  ];
}
 
}