<?php
namespace ClassPart\Controllers;
use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Lista
{
  private $tablaNinios;
  private $tablaZscore;
	  private $pdoZSCORE;
    
    private $authentication;   
	
    public function __construct(
      \ClassGrl\DataTables $tablaNinios,
      $pdoZSCORE,
        \ClassGrl\DataTables $tablaZscore,
       
    \ClassGrl\Authentication $authentication
    
    )
    {
                $this->tablaNinios = $tablaNinios;	
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
    'edades' => [],
    'valor' =>[]
  ];
  foreach($datosControl as $control) {
    $dataCaso['edades'][] = $control['EdadDias'];

    if ($indicador=='PE'){$dataCaso['valor'][]=$control['Peso'];}
    elseif ($indicador=='TE'){$dataCaso['valor'][]=$control['Talla'];}
    else {$dataCaso['valor'][]=$control['Peso']/($control['Talla']/100)/($control['Talla']/100);}
   }
  



//var_dump($dataCaso); 
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
      'valorCaso' => [],
      'medida' => []
      
     
  ];

  $counter = 0;
  //$indexToInsert = 0;
  foreach ($result as $dias) {
     
     $counter++;
     
     
     if ($counter % 30 === 0) {
          $edad = $dias['edadDias'];
          $data['edad'][] = $dias['edadDias'];
          $data['SD3neg'][] = $dias['SD3neg' . $tabla];
          $data['SD2neg'][] = $dias['SD2neg' . $tabla];
          $data['SD1neg'][] = $dias['SD1neg' . $tabla];
          $data['SD0'][] = $dias['SD0' . $tabla];
          $data['SD1'][] = $dias['SD1' . $tabla];
          $data['SD2'][] = $dias['SD2' . $tabla];
          $data['SD3'][] = $dias['SD3' . $tabla];
                }
           
      
      
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
 
// if (!in_array(850, $data['edad'])) {
//   $data['edad'][] = 850;}
//   sort($data['edad']);

//var_dump($data['edad']) ; die;

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

public function grafico(){
  $indicador = $_GET['indicador'] ?? '';
  $sex= $_GET['sex'];
  $caso= $_GET['caso'] ?? '';
  $tabla=$indicador . $sex;

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
    'caso' => []
   
];

$counter = 0;
foreach ($result as $dias) {
   
   $counter++;

   
   if ($counter % 31 === 0||$dias['edadDias']=== 0) {
        $data['edad'][] = $dias['edadDias'];
        $data['SD3neg'][] = $dias['SD3neg' . $tabla];
        $data['SD2neg'][] = $dias['SD2neg' . $tabla];
        $data['SD1neg'][] = $dias['SD1neg' . $tabla];
        $data['SD0'][] = $dias['SD0' . $tabla];
        $data['SD1'][] = $dias['SD1' . $tabla];
        $data['SD2'][] = $dias['SD2' . $tabla];
        $data['SD3'][] = $dias['SD3' . $tabla];
              }
         
    
    
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




//var_dump($dataCaso); 
///////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////crea array para labels////////////////////////////////////


// var_dump($meses);
//die;
///////////////////////////////////datos tabla con labels//////////////////////////

$meses = [
  'mes' => [],
  'año' => [],
  'dia' =>[],
  'label' => [],
];

$nMes = -1;
$nDia = -30;
$nAnio = 0;

for ($i = 0; $i <= 120; $i++) {
    
  $nDia = $nDia + 30.44;
  if ($nMes == 12){$nMes = 0;}
  $nMes = $nMes + 1;
  $nAnio = $nDia / 365.25;

  $dia = floor($nDia);
  $mes = floor($nMes);
  //$año = round($nDia / 365.25, 0, PHP_ROUND_HALF_UP);
  $año = floor($nAnio);
  if ($mes % 12 == 0){$label=$año . ' años';} 
  elseif($dia < 1 && $año < 1){$label='Nacimiento';}
  else {$label=strval($mes);}
   if ($label == '0 años') {
    $label = 'Nacimiento';}
    if ($label == '1 años') {
    $label = '1 año';
    }
  $meses['mes'][]= $mes;
  $meses['año'][]= $año;
  $meses['dia'][]= $dia;
  $meses['label'][]= $label;



  $i++;
}

$result = $this->tablaZscore->findAll();


$data1 = [
  'edad' => [],
  'SD3neg' => [],
  'SD2neg' => [],
  'SD1neg' => [],
  'SD0' => [],
  'SD1' => [],
  'SD2' => [],
  'SD3' => [],
];

$diasArray = $meses['dia'];
//  [
//   0, 30, 61, 91, 122, 152, 183, 213, 243,
// ];

foreach ($result as $dias) {
  $diaValue = $dias['edadDias'];
  $diaIndex = array_search($diaValue, $diasArray);

  if ($diaIndex !== false) {
      $data1['edad'][] = $diaValue;
      $data1['SD3neg'][] = $dias['SD3neg' . $tabla];
      $data1['SD2neg'][] = $dias['SD2neg' . $tabla];
      $data1['SD1neg'][] = $dias['SD1neg' . $tabla];
      $data1['SD0'][] = $dias['SD0' . $tabla];
      $data1['SD1'][] = $dias['SD1' . $tabla];
      $data1['SD2'][] = $dias['SD2' . $tabla];
      $data1['SD3'][] = $dias['SD3' . $tabla];

      // Eliminar el valor del array 'dia' después de usarlo
      unset($diasArray[$diaIndex]);
  }
}

//var_dump($data1); var_dump($meses); die;

///////////////////////////////////////////////////////////////////////////








  $title='Gráfica';
  
  return [
      'template' => 'grafica.html.php',
      'title' => $title,
      'variables' => [
          'data' => $data1 ?? [],
          'dataCaso' =>$dataCaso ?? [],
          'rotulos' => $meses ?? []
          
      ]
  ];
}
}