<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Ninios
{
    private $tablaNinios;
    private $tablaEtnia;
    private $tablaLoc;
    private $tablaResi;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaEtnia,       
                                \ClassGrl\DataTables $tablaLoc,
                                \ClassGrl\DataTables $tablaResi,
                                 \ClassGrl\Authentication $authentication)
    {
        $this->tablaNinios = $tablaNinios;
        $this->tablaEtnia = $tablaEtnia;
        $this->tablaLoc = $tablaLoc;
        $this->tablaResi = $tablaResi;
        $this->authentication = $authentication;
    }


    public function busca()
    {
        $result = $this->tablaNinios->findAll();

        foreach ($result as $ninio) {
            $dataNinio[] = array(
                'label' => $ninio['ApeNom'],
                'value' => $ninio['IdNinio']
            );
        }
        
        $title = 'Busca Niño';

        return [
            'template' => 'busca_ninio.html.php',
            'title' => $title,
            'variables' => [
                'data' => $dataNinio
              
            ]
        ];
    }





// -----------------------------------------------------
// Metodo si es GET ////// 

public function ninios($id=null) {
	$etnias=$this->tablaEtnia->findAll();
    $localidades = $this->tablaLoc->findAll();
    foreach($localidades as $localidad)
    {
        $data[] = array(
            'label'     =>  $localidad['nombre_geo'],
            'value'     =>  $localidad['gid']
        );
    }
    //var_dump($_GET);
            
        if ($_GET['id'] > 0) {

                $datosNinio = $this->tablaNinios->findById($_GET['id']);
      
                $apenom = $this->separar_nombres($datosNinio['ApeNom']);
               // var_dump($apenom);
               $datosNinio['Nombre']=$apenom['nombres'];
                $datosNinio['Apellido']=$apenom['apellido'];
         
                $apenomR = $this->separar_nombres($datosNinio['ApeResp']);
                
               $datosNinio['NombreR']=$apenomR['nombres'];
                $datosNinio['ApellidoR']=$apenomR['apellido'];
                $datosNinio['NomEtnia']=$this->tablaEtnia->findById($datosNinio['TpoEtnia'])['NomEtnia'];

             //   var_dump($datosNinio);
                $resiNinio= $this->tablaResi->findLast('ResiNinio',$datosNinio['IdNinio']);
         //  var_dump($resiNinio);

                $title = 'Ver Caso';
                   
                  return ['template' => 'ninios.html.php',
                             'title' => $title ,
                         'variables' => [
                           'data'  =>   $data,
                         'datosNinio' => $datosNinio  ?? ' ',
                         'resiNinio'=> $resiNinio ?? ' ',
                         'etnias' => $etnias  ?? ' '
                                         ]
                        ];
                    }
        elseif ($_GET['id']<1) {
                $title = 'Cargar Caso';
            
                  return ['template' => 'ninios.html.php',
                             'title' => $title ,
                         'variables' => [
                            'etnias' => $etnias  ?? ' ',
                           'data'  =>   $data
                                        ]
                        ];
        }        
               
    }
    
    /// Metodo si es con post para beneficiario//////   

public function niniosSubmit() {
	$result = $this->tablaNinios->findAll();

        foreach ($result as $ninio) {
            $dataNinio[] = array(
                'label' => $ninio['ApeNom'],
                'value' => $ninio['IdNinio']
            );
        }


    $localidades = $this->tablaLoc->findAll();
    foreach($localidades as $localidad)
    {
        $data[] = array(
            'label'     =>  $localidad['nombre_geo'],
            'value'     =>  $localidad['gid']
        );
    }
      
        $etnias=$this->tablaEtnia->findAll();

        $usuario = $this->authentication->getUser();
        $Resi=$_POST['Domicilio'];

     //  var_dump($Resi);
        $Caso = $_POST['Ninio'];
        $Ninio =[];
        $Domicilio=[];
     //   var_dump($Caso);
       ///Datos del niño////
        $Ninio['IdNinio']=$Caso['IdNinio'];
        $Ninio['ApeNom']=strtoupper(ltrim($Caso['Apellido']).' '.ltrim($Caso['Nombre']));
        $Ninio['Dni']=$Caso['Dni'];
        $Ninio['Indocu'] = ($Caso['Dni'] > 0) ? 'NO' : 'SI';
        $Ninio['FechaNto']=$Caso['FechaNto'];
        $Ninio['Sexo']=$Caso['Sexo'];
        $Ninio['Etnia']='Criol/Ori';
        $Ninio['TpoEtnia']=$Caso['IdEtnia'];
        $Ninio['ApeResp']=strtoupper(ltrim($Caso['ApellidoR']).' '.ltrim($Caso['NombreR']));
        $Ninio['DniResp']=$Caso['DniResp'];
        $Ninio['Indocures']=($Caso['DniResp'] > 0) ? 'NO' : 'SI';
        $Ninio['AlfaResp']='DESC';
        $Ninio['Fono']=$Caso['Fono'];
        $Ninio['ObraSocial']='DESC';
        $Ninio['Peso']=$Caso['Peso'];
        $Ninio['Semanas']=$Caso['Semanas'];
        $Ninio['Talla']=$Caso['Talla'];
        $Ninio['Obito']='NO';
        $Ninio['PSumar']='NO';
        $Ninio['UsuId']=$usuario['id_usuario'];
        $Ninio['FechaCapta'] = new \DateTime();
        
////Datos domicilio ////

        $Domicilio['IdResi']=$Resi['IdResi'];  
     //   $Domicilio['ResiNinio']=$Caso['IdNinio'];
        $Domicilio['ResiNinio']=$Caso['IdNinio'];
        $Domicilio['ResiDire']=$Resi['ResiDire'];    
        $Domicilio['ResiLocal']=$Resi['ResiLocal'];
        $Domicilio['ResiUsu']=$usuario['id_usuario']; 
       $Domicilio['ResiAo']=$this->tablaLoc->findById($Resi['ResiAo'])['aop'] ?? ''; 
       $Ninio['Aoresi']=$this->tablaLoc->findById($Resi['ResiAo'])['aop'] ?? ''; 
        $Domicilio['ResiFecha']=new \DateTime();  
      // var_dump($Domicilio);
        
        $errors = [];
        
    if ( empty($_GET['id']) && count($this->tablaNinios->find('Dni', $Ninio['Dni'])) > 0
    && $Ninio['Dni'] > 0) {
    
    $errors[] = 'Un niño con este DNI ya está registrado';
    }
    
    if  (empty($errors)) {
        
    $this->tablaNinios->save($Ninio);

    $ultimo = $this->tablaNinios->ultimoReg();

    $Domicilio['ResiNinio']=$ultimo['IdNinio'];   
   // var_dump($Domicilio);
     $this->tablaResi->save($Domicilio);
    
    if (empty($_GET['id'])){
    $datosNinio = $this->tablaNinios->ultimoReg();
    }
    else{
        $datosNinio = $this->tablaNinios->findById($_GET['id']);
    }
    
    return ['template' => 'registersuccess.html.php',
                             'title' => 'Carga' ,
                         'variables' => [
                            'datosCaso' => $datosNinio  ?? ' '
                                         ]
                        ];
    
    }
       
    
    else {
     return ['template' => 'ninios.html.php',
                             'title' => 'Revisar' ,
                         'variables' => [
                               'errors'=> $errors,
                             'data'  =>   $data,
                         'datosCaso' => $datosNinio  ?? ' ',
                         'etnias' => $etnias  ?? ' '
                                         ]
                        ];
    }
    




    
    }
    
// ----------------------------------------------------------
    private function separar_nombres($cadena) {
                $apenom_array = explode(" ", $cadena);
                $nombres = array_slice($apenom_array, 1);
                $nombre = implode(" ", $nombres);
                return [
                "apellido" => $apenom_array[0],
                "nombres" => $nombre,
                ];
            }


    public function home()
    {
        $title = 'Instructivo';

        return ['template' => 'home.html.php', 'title' => $title, 'variables' => []];
    }

   
}
