<?php
namespace ClassPart\Controllers;
use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Antro
{
    private $tablaAntro;
    private $pdoZSCORE;   


    public function __construct(\ClassGrl\DataTables $tablaAntro, $pdoZSCORE) 
    {
        $this->tablaAntro = $tablaAntro;
        $this->pdoZSCORE = $pdoZSCORE;
    }



    public function antro($id=null){

        
    
    if (isset($_GET['id'])) {
        
        $datosNinio=$this->tablaAntro->findById($_GET['id']);
        
    
                            }
                
    $title = 'Carga Antro';
    
            
    
                  return ['template' => 'antro.html.php',
                             'title' => $title ,
                         'variables' => [
                         'datosNinio' =>$datosNinio  ?? ' '
                                         ]
    
                        ];
    
    }


    public function antroSubmit() {
       
            $datosNinio=$_POST['Antro'];
            $datos=[]; 
            $imc=($datosNinio['Peso']/(($datosNinio['Talla']/100)*($datosNinio['Talla']/100)));
            $datos['idAnt'] = $datosNinio['idAnt'];
            $datos['idNoti'] = $datosNinio['idNoti'];
            $datos['nombre'] = $datosNinio['nombre'];
            $datos['fecnac'] = $datosNinio['fecnac'];
            $datos['sexo'] = ($datosNinio['sexo'] ='Femenino') ? '2' : '1';
            $datos['fecha'] = $datosNinio['fecha'];
            $datos['Peso'] = $datosNinio['Peso'];
            $datos['Talla'] = $datosNinio['Talla'];
            $datos['ZPE']= $this->calcularZScore(
                                                    $datos['sexo']  , 
                                                    "p", 
                                                    $datosNinio['Peso'], 
                                                    $datosNinio['fecnac'], 
                                                    $datosNinio['fecha']
                                                    ) ;
            $datos['ZTE']= $this->calcularZScore(
                                                    $datos['sexo']  , 
                                                    "t", 
                                                    $datosNinio['Talla'], 
                                                    $datosNinio['fecnac'], 
                                                    $datosNinio['fecha']
                                                    ) ;
            $datos['ZIMCE'] = $this->calcularZScore(
                                                    $datos['sexo']  , 
                                                    "i", 
                                                    $imc, 
                                                    $datosNinio['fecnac'], 
                                                    $datosNinio['fecha']
                                                    ) ;
    //  var_dump($datos);
       
      
     // `idAnt`,`idNoti`,`nombre`,`fecnac`,`Sexo`,`fecha`,`Peso`,`ZPE`,`Talla`,`ZTE`,`ZIMCE`,`sexo`
      
      
      
      
      
      
      $this->tablaAntro->save($datos);
        
       header('Location: /ninios/home');
       
}
public function calcularZScore($sexo, $bus, $valor, $fechaInicial, $fechaFinal) {

    // Prepare the query with the call to the ZSCORE function
    $query = "SELECT ZSCORE($sexo, '$bus', $valor, '$fechaInicial', '$fechaFinal') AS resultado";
  
    // Execute the query
    $resultado = $this->pdoZSCORE->query($query);
  //var_dump($resultado);
    // Check if the query was successful
  if ($resultado) {
      // Get the result
      $fila = $resultado->fetchColumn();

  //    var_dump($fila);  
            $resultadoZSCORE = $fila;
    } else {
      // Handle the case where no data is returned
      $resultadoZSCORE = null;
    }
  
   return $resultadoZSCORE;
  }
  

private function sumar($num1, $num2) {
    $suma =$num1+ $num2;
    return $suma ;
}

}

