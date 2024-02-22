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

 
public function grafico(){
  $indicador = $_GET['indicador'] ?? '';
  $sex=substr($this->tablaNinios->findById($_GET['caso'])['Sexo'],0,1);
  $nombre=$this->tablaNinios->findById($_GET['caso'])['ApeNom'];
 // $sex= $_GET['sex'];
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
  'valor' =>[],
  'nombre' =>[]
];
$dataCaso['nombre']=$nombre;
foreach($datosControl as $control) {
  $dataCaso['edad'][] = $control['EdadDias'];

  if ($indicador=='PE'){$dataCaso['valor'][]=$control['Peso'];}
  elseif ($indicador=='TE'){$dataCaso['valor'][]=$control['Talla'];}
  else {$dataCaso['valor'][]=$control['Peso']/($control['Talla']/100)/($control['Talla']/100);}
 }

//////////////////////////////////////datos referencias///////////////////////

$meses = [
   'dia' =>[],
 
];

$nDia = -30;

for ($i = 0; $i <= 120; $i++) {
    
  $nDia = $nDia + 30.44;
 
  $dia = floor($nDia);
  
  $meses['dia'][]= $dia;
 



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

  
      unset($diasArray[$diaIndex]);
  }
}


  $title='Gráfica';
  
  return [
      'template' => 'grafica.html.php',
      'title' => $title,
      'variables' => [
          'data' => $data1 ?? [],
          'dataCaso' =>$dataCaso ?? []
         
          
      ]
  ];
}
}