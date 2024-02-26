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

public function grafico($id=null){

  $indicador = $_GET['indicador'] ?? '';
  $sex=substr($this->tablaNinios->findById($_GET['caso'])['Sexo'],0,1) ?? '';
  $tabla=$indicador . $sex;
  $nombre=$this->tablaNinios->findById($_GET['caso'])['ApeNom'] ?? '';
  $caso= $_GET['caso'] ?? '';


  ///////////////////////////////////////datos niño////////////////////////////////////////////////
  $controles = $this->pdoZSCORE->prepare("call saltaped_sivin2.datosGraficas($caso);");
  $controles->execute([]);
  $datosControl =$controles->fetchAll(\PDO::FETCH_ASSOC);

  $dataCaso = [
    'edad' => [],
    'valor' =>[],
     ];
     foreach($datosControl as $control) {
      $dataCaso['edad'][] = $control['EdadDias'];
    
      if ($indicador=='PE'){$dataCaso['valor'][]=$control['Peso'];}
      elseif ($indicador=='TE'){$dataCaso['valor'][]=$control['Talla'];}
      else {$dataCaso['valor'][]=$control['Peso']/($control['Talla']/100)/($control['Talla']/100);}
     }
//     var_dump($dataCaso); die;
 
 
     ///////////////////////////////////datos grafica/////////////////////////////////////////////////////////////////////////
 
  $data = [
    'nombre'=>$nombre,
    'edad' => [],
    'SD3neg' => [],
    'SD2neg' => [],
    'SD1neg' => [],
    'SD0' => [],
    'SD1' => [],
    'SD2' => [],
    'SD3' => [],
    'Caso' => [],
    'rotulox'=> []
  ];
   // data['nombre']
 
  $result = $this->tablaZscore->findAll();
  //var_dump($result);die;
  

  $diasArray = array_column( $result, 'edadDias');
  //var_dump($diasArray);die;
  foreach ($result as $dias) {

    $diaValue = $dias['edadDias'];
    //var_dump($diaValue);
    $diaIndex = array_search($diaValue, $diasArray);
    //var_dump($diaIndex);
    if ($diaIndex !== false) {
      $data['edad'][] =  $dias['edadDias'];
      $data['SD3neg'][] = $dias['SD3neg' . $tabla];
      $data['SD2neg'][] = $dias['SD2neg' . $tabla];
      $data['SD1neg'][] = $dias['SD1neg' . $tabla];
      $data['SD0'][] = $dias['SD0' . $tabla];
      $data['SD1'][] = $dias['SD1' . $tabla];
      $data['SD2'][] = $dias['SD2' . $tabla];
      $data['SD3'][] = $dias['SD3' . $tabla];
      $data['rotulox'][] = $dias['Rotulo'];
      foreach ($data['edad'] as $index => $edad) {
        // Busca la coincidencia entre la edad en $data1 y $dataCaso
        $posicion = array_search($edad, $dataCaso['edad']);
        if ($posicion !== false) {
            // Agrega el valor correspondiente a $data1['Caso'] si se encuentra una coincidencia
            $data['Caso'][$index] = $dataCaso['valor'][$posicion];
        } else {
            // Si no hay coincidencia, asigna un valor predeterminado (puedes cambiarlo según tu lógica)
            $data['Caso'][$index] = null;
        }
  }
  unset($diasArray[$diaIndex]);
}


}


//var_dump($data); die;

        $title='Gráfica';

          return [
              'template' => 'grafica.html.php',
              'title' => $title,
              'variables' => [
                  'data' => $data ?? []
                                ]
          ];

}

}