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
  $sex=substr($this->tablaNinios->findById($_GET['caso'])['Sexo'],0,1) ?? '';
  $nombre=$this->tablaNinios->findById($_GET['caso'])['ApeNom'] ?? '';
   $caso= $_GET['caso'] ?? '';
  $tabla=$indicador . $sex;

///////////////Datos tabla//////////////////////////////////

$result = $this->tablaZscore->findAll();


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
//var_dump($dataCaso);
//////////////////////////////////////datos referencias///////////////////////
//////////////////////////////////////////////////////////crea array para labels////////////////////////////////////
$meses = [];

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
  $meses[] = [
    'mes' => $mes,
    'año' => $año,
    'dia' => $dia,
    'label' => $label

  ];

  $i++;
}

 var_dump($meses);
die;
/////////////////////////////////////////////////////////////





// $meses = [
//   'dia' => [],
// ];

// $nDia = -30;

// for ($i = 0; $i <= 120; $i++) {
//   $nDia = $nDia + 30.44;
//   $dia = floor($nDia);
//   $meses['dia'][] = $dia;
//   $i++;
// }

// foreach ($datosControl as $control) {
//   if ($indicador == 'PE') {
//       $meses['valor'][] = $control['Peso'];
//   } elseif ($indicador == 'TE') {
//       $meses['valor'][] = $control['Talla'];
//   } else {
//       $meses['valor'][] = $control['Peso'] / ($control['Talla'] / 100) / ($control['Talla'] / 100);
//   }
//   // Agrega la edad al mismo array 'dia' dentro del array $meses
//   $meses['dia'][] = $control['EdadDias'];
// }

// // Asegura que los arrays tengan la misma longitud, insertando null para los días sin datos
// $longitud_dias = count($meses['dia']);
// $longitud_valores = count($meses['valor']);
// if ($longitud_dias < $longitud_valores) {
//   for ($i = $longitud_dias; $i < $longitud_valores; $i++) {
//       $meses['dia'][] = null;
//   }
// } elseif ($longitud_dias > $longitud_valores) {
//   for ($i = $longitud_valores; $i < $longitud_dias; $i++) {
//       $meses['valor'][] = null;
//   }
// }
/////////////////////////////////////////////////////////////


// Insertar datos de edad en el array de meses
foreach ($dataCaso['edad'] as $edad) {
   // if ($edad <= $maxDia) {
        foreach ($meses['dia'] as $key => $dia) {
            if ($edad < $dia) {
                array_splice($meses['dia'], $key, 0, $edad);
                break;
            }
   }
}
// Resultado
 $n = count($dataCaso['edad']);//-1;// Número de elementos a eliminar
for ($i = 0; $i < $n; $i++) {
  array_pop($meses['dia']);
 }

echo $n;

//var_dump($meses['dia']); die;



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
  'Caso' => []
];

$diasArray = $meses['dia'];


foreach ($result as $dias) {
   $diaValue = $dias['edadDias'];
   $diaIndex = array_search($diaValue, $diasArray);

   if ($diaIndex !== false) {
      $data1['edad'][] =  $dias['edadDias'];
      $data1['SD3neg'][] = $dias['SD3neg' . $tabla];
      $data1['SD2neg'][] = $dias['SD2neg' . $tabla];
      $data1['SD1neg'][] = $dias['SD1neg' . $tabla];
      $data1['SD0'][] = $dias['SD0' . $tabla];
      $data1['SD1'][] = $dias['SD1' . $tabla];
      $data1['SD2'][] = $dias['SD2' . $tabla];
      $data1['SD3'][] = $dias['SD3' . $tabla];
           foreach ($data1['edad'] as $index => $edad) {
        // Busca la coincidencia entre la edad en $data1 y $dataCaso
        $posicion = array_search($edad, $dataCaso['edad']);
        if ($posicion !== false) {
            // Agrega el valor correspondiente a $data1['Caso'] si se encuentra una coincidencia
            $data1['Caso'][$index] = $dataCaso['valor'][$posicion];
        } else {
            // Si no hay coincidencia, asigna un valor predeterminado (puedes cambiarlo según tu lógica)
            $data1['Caso'][$index] = null;
        }
    }
  
       unset($diasArray[$diaIndex]);
 }
}
// var_dump($data1); die;

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