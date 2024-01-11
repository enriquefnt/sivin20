<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Inter
{
    private $tablaInter;
    private $tablaNinios;
    private $tablaNoti;
	private $tablaControl;
    private $tablaInsti;
	private $authentication;

    public function __construct(\ClassGrl\DataTables $tablaInter,
                                \ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaNoti,
                                \ClassGrl\DataTables $tablaControl,
                                \ClassGrl\DataTables $tablaInsti,
								\ClassGrl\Authentication $authentication)
    {
        $this->tablaInter = $tablaInter;
        $this->tablaNinios = $tablaNinios;
        $this->tablaNoti = $tablaNoti;
        $this->tablaControl = $tablaControl;
        $this->tablaInsti = $tablaInsti;
		$this->authentication = $authentication;
    }


    public function inter($id=null){

        $instituciones = $this->tablaInsti->findAll();
    
        foreach($instituciones as $institucion)
        {
            $data_insti[] = array(
                'label'     =>  $institucion['Nombre_aop'],
                'value'     =>  $institucion['establecimiento_id']
            );
        }
       
        $datosNinio=$this->tablaNinios->findById($_GET['id'])?? [];
        
        $datosNinio['edad']=$this->calcularEdad($datosNinio['FechaNto'],date('Y-m-d')) ?? ' ';
       


        if (isset($_GET['id'])) {
           
 
          
          $title='Internación';
    
                  return ['template' => 'interna.html.php',
                             'title' => $title ,
                         'variables' => [
                       'data_insti'  =>   $data_insti?? [],
                       'datosNinio'=> $datosNinio?? [],
                       'datosNoti' => $datosNoti  ?? []
                                         ]
    
                        ]; }
                        

                    
                        $title = 'Internacion';

                        return ['template' => 'interna.html.php',
                                'title' => $title ,
                                'variables' => [
                                'data_insti'  =>   $data_insti?? [],
                                'datosNinio'=> $datosNinio ?? [],
                                'datosNoti' => $datosNoti  ?? []
                                ]
                        ];

                    }   
    
    public function interSubmit() {
    
    
       $datosNinio=$this->tablaNinios->findById($_GET['id']);
       $datosNinio['edad']=$this->calcularEdad($datosNinio['FechaNto'],date('Y-m-d')) ?? ' ';
       $usuario = $this->authentication->getUser();
       $Notificacion=$this->tablaNoti->findLast('NotNinio', ($_GET['id']));
       $NOTIINTERNADOS=$_POST['NOTIINTERNADOS'];
       $Internacion=[];
 
    
      $Internacion['Idint']=$NOTIINTERNADOS['Idint'];
      $Internacion['IdNotifica']=$this->tablaNoti->findLast('NotNinio', ($_GET['id']))[0] ?? ' ';
      $Internacion['IntFecha']=$NOTIINTERNADOS['IntFecha'];
      $Internacion['IntEfec']=$NOTIINTERNADOS['establecimiento_id'];
      $Internacion['IntAo']=$this->tablaInsti->findById($Internacion['IntEfec'])['AOP'] ?? '';
      $Internacion['IntAlta']=$NOTIINTERNADOS['IntAlta'];
      $Internacion['IntTipoAlta']=$NOTIINTERNADOS['IntTipoAlta'];
     // $Internacion['IntDerivado']=$NOTIINTERNADOS['IntDerivado'];
      $Internacion['IntObserva']=$NOTIINTERNADOS['IntObserva'];
      $Internacion['Usuario_id']=$usuario['id_usuario'];
      $Internacion['IntFechapc ']=new \DateTime();
        
    //  var_dump($Internacion);
  
    //  echo "tablaInter: ";
    //  print_r($this->tablaInter);
     
     $this->tablaInter->save($Internacion);
    
    
  }
        
    
    
    
    
    public function calcularEdad($fechaNacimiento, $fechaActual) {
        $nacimiento = new \DateTime($fechaNacimiento);
        $actual = new \DateTime($fechaActual);
        $edad = $nacimiento->diff($actual);
            $anios = $edad->y;
            $meses = $edad->m;
            $dias = $edad->d;
     if($anios>0){
        return " $anios a $meses m    ";
    }
    else {
        return "  $meses m $dias d   ";
    }
    }



}