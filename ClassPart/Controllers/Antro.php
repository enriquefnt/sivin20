<?php
namespace ClassPart\Controllers;
use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Antro
{
    private $tablaAntro;
    private $pdoZSCORE;
    

    public function __construct(\ClassGrl\DataTables $tablaAntro) //,\ClassPart\Controllers\SivinWebsite $pdoZSCORE )
    {
        $this->tablaAntro = $tablaAntro;
    //    $this->pdoZSCORE = $pdoZSCORE;
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
       
            $Antro=$_POST['Antro'];
         $Antro['ZPE']= $this->calcularZScore(2, "p", 5.5, "2023-01-01", "2023-03-01") ;
          //  $Antro['ZPE']=   $this->sumar(8,9);
            $Antro['sexo'] = ($Antro['sexo'] ='Femenino') ? '2' : '1';
        var_dump($Antro);
        $this->tablaAntro->save($Antro);
        
     //   header('Location: /ninios/home');
       
}
public function calcularZScore($sexo, $bus, $valor, $fechaInicial, $fechaFinal) {
  //  $this->conectar();

    // Preparar la consulta con la llamada a la función ZSCORE
    $query = "SELECT ZSCORE($sexo, '$bus', $valor, '$fechaInicial', '$fechaFinal') AS resultado";

    // Ejecutar la consulta
    $resultado = $this->pdoZSCORE->query($query);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        // Obtener el resultado
        $fila = $resultado->fetch_assoc();
        $resultadoZSCORE = $fila['resultado'];

        // Desconectar de la base de datos
        $this->desconectar();

        return $resultadoZSCORE;
    } else {
        // Manejar errores si la consulta no se ejecuta correctamente
        echo "Error en la consulta: " . $this->conexion->error;
        // Desconectar de la base de datos
    //    $this->desconectar();

        return null;
    }
}

private function sumar($num1, $num2) {
    $suma =$num1+ $num2;
    return $suma ;
}

}

