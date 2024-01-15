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
        $datosNoti=$this->tablaNoti->findLast('NotNinio', ($_GET['id']));


        if (isset($_GET['id'])) {
           
 
          
          $title='Internación';
    
                  return ['template' => 'interna.html.php',
                             'title' => $title ,
                         'variables' => [
                       'data_insti'  =>   $data_insti?? [],
                       'datosNinio'=> $datosNinio?? []
                     ,
                       'datosNoti' => $datosNoti  ?? []
                                         ]
    
                        ]; }
                        

                    
                        $title = 'Internacion';

                        return ['template' => 'interna.html.php',
                                'title' => $title ,
                                'variables' => [
                                'data_insti'  =>   $data_insti?? [],
                                'datosNinio'=> $datosNinio ?? []
                               ,
                                'datosNoti' => $datosNoti  ?? []
                                ]
                        ];

                    }   
    
    public function interSubmit() {

       // var_dump($_POST['NOTIINTERNADOS']);

        $instituciones = $this->tablaInsti->findAll();
    
        foreach($instituciones as $institucion)
        {
            $data_insti[] = array(
                'label'     =>  $institucion['Nombre_aop'],
                'value'     =>  $institucion['establecimiento_id']
            );
        }

      var_dump($_POST['valores']); 
      echo($_POST['valores']);
       $datosNinio=$this->tablaNinios->findById($_POST['NOTIINTERNADOS']['IdNinio']) ?? ' ';
       $datosNinio['edad']=$this->calcularEdad($datosNinio['FechaNto'],date('Y-m-d')) ?? ' ';
       $usuario = $this->authentication->getUser();
       $Notificacion=$this->tablaNoti->findLast('NotNinio', ($_POST['NOTIINTERNADOS']['IdNinio']));

      
      $valores = $_POST['valores'];
       $NOTIINTERNADOS = $_POST['NOTIINTERNADOS'];
       var_dump($valores);
       $Internacion=[];
       $MotivoInter=[];
       
      
    
      $Internacion['Idint']=$NOTIINTERNADOS['Idint']??'';
      $Internacion['IdNotifica']=$Notificacion['NotId'] ?? ' ';
      $Internacion['IntFecha']=$NOTIINTERNADOS['IntFecha'];
      $Internacion['IntAo']=$this->tablaInsti->findById($NOTIINTERNADOS['establecimiento_id'])['AOP'] ?? '';
      $Internacion['IntEfec']=$NOTIINTERNADOS['establecimiento_id'];
      $Internacion['IntSala']=$NOTIINTERNADOS['IntSala'];
      $Internacion['IntAlta']=$NOTIINTERNADOS['IntAlta']??'NO';
      $Internacion['IntFechalta']=$NOTIINTERNADOS['IntFechalta']?? '';
      $Internacion['IntTipoAlta']=$NOTIINTERNADOS['IntTipoAlta']?? '';
      $Internacion['IntDerivado']='';
      $Internacion['IntObserva']=trim($NOTIINTERNADOS['IntObserva'])?? '';
      $Internacion['IntUsuario']=$usuario['id_usuario'];
      $Internacion['IntFechapc']=new \DateTime();
     //var_dump($Internacion);
     // $MotivoInter['MA_Motivo']=$valores ?? '';;
     // var_dump($MotivoInter);
     $this->tablaInter->save($Internacion);

     $Internacion['Nombre_aop']=$this->tablaInsti->findById($NOTIINTERNADOS['establecimiento_id'])['Nombre_aop'] ?? '';
     switch ($Internacion['IntSala']) {
        case 2:
            $Internacion['Sala'] ='Guardia';
          break;
        case 3:
            $Internacion['Sala'] ='Terapia intensiva';
          break;
        case 9:
            $Internacion['Sala'] ='Internación común';
          break;
          case 10:
            $Internacion['Sala'] ='CRENI';
          break;
          case 10:
            $Internacion['Sala'] ='Recuperación Nutricional';
          break;
        default:
        $Internacion['Sala'] ='Otra';
      }
      
        $datosInter=$Internacion;
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