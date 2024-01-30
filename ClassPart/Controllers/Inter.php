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
    private $tablaMotIng;  
    private $tablaInsti;
	  private $authentication;

    public function __construct(\ClassGrl\DataTables $tablaInter,
                                \ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaNoti,
                                \ClassGrl\DataTables $tablaMotIng,  
                                 \ClassGrl\DataTables $tablaInsti,
							                	\ClassGrl\Authentication $authentication)
    {
        $this->tablaInter = $tablaInter;
        $this->tablaNinios = $tablaNinios;
        $this->tablaNoti = $tablaNoti;
        $this->tablaMotIng  = $tablaMotIng;
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
       
 //        var_dump($_GET);
 $datosNinio=$this->tablaNinios->findById($_GET['id'])?? '';
 $datosNinio['edad']=$this->calcularEdad($datosNinio['FechaNto'],date('Y-m-d')) ?? ' ';
 $datosNoti=$this->tablaNoti->findLast('NotNinio', ($_GET['id']));
//  var_dump($datosNoti) ;
$datosInter=$this->tablaInter->findLast('IdNotifica',  $datosNoti['NotId']) ?? [] ;
//   var_dump($datosInter) ;




        
        if (isset($_GET['Idint'])) {
 


           
 
          
          $title='Internación';
    
                  return ['template' => 'interna.html.php',
                             'title' => $title ,
                         'variables' => [
                       'data_insti'  =>   $data_insti?? [],
                       'datosNinio'=> $datosNinio?? [],
                       'datosNoti' => $datosNoti  ?? [],
                       'datosInter' => $datosInter ?? []
                                         ]
    
                        ]; }
                        

                    
                        $title = 'Internacion';

                        return ['template' => 'interna.html.php',
                                'title' => $title ,
                                'variables' => [
                                'data_insti'  =>   $data_insti?? [],
                                'datosNinio'=> $datosNinio ?? [],
                                'datosNoti' => $datosNoti  ?? []//,
                               // 'datosInter' => $datosInter ?? []
                                ]
                        ];

                    }   
    
    public function interSubmit() {
         
     
       $datosNinio=$this->tablaNinios->findById($_POST['NOTIINTERNADOS']['IdNinio']) ?? ' ';
       $datosNinio['edad']=$this->calcularEdad($datosNinio['FechaNto'],date('Y-m-d')) ?? ' ';
       $usuario = $this->authentication->getUser();
       $Notificacion=$this->tablaNoti->findLast('NotNinio', ($_POST['NOTIINTERNADOS']['IdNinio']));
      
      $NOTIINTERNADOS = $_POST['NOTIINTERNADOS'];
      //  if (is_null($NOTIINTERNADOS['establecimiento_id'])){
      //    $NOTIINTERNADOS['establecimiento_id']=$this->tablaInter->findLast('IdNotifica',  $Notificacion['NotId'])['IntEfec'] ?? '' ;
      //    } 
      
    //   if (!array_key_exists('establecimiento_id', $NOTIINTERNADOS)) {
    //     $NOTIINTERNADOS['establecimiento_id'] = $this->tablaInter->findLast('IdNotifica', $Notificacion['NotId'])['IntEfec'] ?? '' ;
    // }

       $Internacion=[];
    //   var_dump($NOTIINTERNADOS);
       
      
    
      $Internacion['Idint']=$NOTIINTERNADOS['Idint']??'';
      $Internacion['IdNotifica']=$Notificacion['NotId'] ?? ' ';
      $Internacion['IntFecha']=$NOTIINTERNADOS['IntFecha'];
      $Internacion['IntAo']=$this->tablaInsti->findById($NOTIINTERNADOS['IntEfec'])['AOP'] ?? '';
      $Internacion['IntEfec']=$NOTIINTERNADOS['IntEfec'];
      $Internacion['IntSala']=$NOTIINTERNADOS['IntSala'];
      $Internacion['IntAlta']=isset($NOTIINTERNADOS['IntFechalta']) ? 'SI' : 'NO';
      $Internacion['IntFechalta']=$NOTIINTERNADOS['IntFechalta']?? '';
      $Internacion['IntTipoAlta']=$NOTIINTERNADOS['IntTipoAlta']?? '';
      $Internacion['IntDerivado']='';
      $Internacion['IntObserva']=trim($NOTIINTERNADOS['IntObserva'])?? '';
      $Internacion['IntUsuario']=$usuario['id_usuario'];
      $Internacion['IntFechapc']=new \DateTime();


     $this->tablaInter->save($Internacion);
  



     if (isset($_POST['NOTIINTERNADOS']['diagnosticos'])){
$motivosInter = $_POST['NOTIINTERNADOS']['diagnosticos'];
$motivosInterArray = array_map(function($item) {
  return explode(',', $item);
}, $motivosInter);
foreach ($motivosInterArray as $motivos) {
  foreach ($motivos as $motivo) {
      $motivoInternacion = [
          'MI_Id' => '',
          'MI_IntId' => $this->tablaInter->ultimoReg()['Idint'],
          'MI_Motivo' => trim($motivo)
      ];

      $this->tablaMotIng->save($motivoInternacion);
  }
 }
}

    $datosInter=$this->tablaInter->findLast('IdNotifica',  $Internacion['IdNotifica']);

    $datosInter['Nombre_aop']=$this->tablaInsti->findById($NOTIINTERNADOS['IntEfec'])['Nombre_aop'] ?? '';
    
     switch ($datosInter['IntSala']) {
        case 2:
          $datosInter['Sala'] ='Guardia';
          break;
        case 3:
          $datosInter['Sala'] ='Terapia intensiva';
          break;
        case 9:
          $datosInter['Sala'] ='Internación común';
          break;
          case 10:
            $datosInter['Sala'] ='CRENI';
          break;
          case 10:
            $datosInter['Sala'] ='Recuperación Nutricional';
          break;
        default:
        $datosInter['Sala'] ='Otra';
      }
      
      var_dump($datosInter);
    
      $title='Internación';
     
                  return ['template' => 'ingreSucess.html.php',
                  'title' => $title ,
              'variables' => [
              'datosNinio'=> $datosNinio?? [],
            'datosInter' => $datosInter  ?? []
                              ]

             ]; 
     
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