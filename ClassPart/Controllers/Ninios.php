<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Ninios
{
    private $niniosTable;
    private $locTable;
    private $resiTable;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $niniosTable,
                                \ClassGrl\DataTables $locTable,
                                \ClassGrl\DataTables $resiTable,
                                 \ClassGrl\Authentication $authentication)
    {
        $this->niniosTable = $niniosTable;
        $this->locTable = $locTable;
        $this->resiTable = $resiTable;
        $this->authentication = $authentication;
    }


    public function busca()
    {
        $result = $this->niniosTable->findAll();

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
	
    $localidades = $this->locTable->findAll();
    foreach($localidades as $localidad)
    {
        $data[] = array(
            'label'     =>  $localidad['nombre_geo'],
            'value'     =>  $localidad['gid']
        );
    }
    //var_dump($_GET);
            
        if (isset($_GET['id'])) {

                $datosNinio = $this->niniosTable->findById($_GET['id']);
      
                $apenom = $this->separar_nombres($datosNinio['ApeNom']);
               // var_dump($apenom);
               $datosNinio['Nombre']=$apenom['nombres'];
                $datosNinio['Apellido']=$apenom['apellido'];
         
                $apenomR = $this->separar_nombres($datosNinio['ApeResp']);
                
               $datosNinio['NombreR']=$apenomR['nombres'];
                $datosNinio['ApellidoR']=$apenomR['apellido'];
         
                $resiNinio= $this->resiTable->findById($_GET['id']);
              //  var_dump($resiNinio);
         
                                        }
    
                $title = 'Caso';
    
            
    
                  return ['template' => 'ninios.html.php',
                             'title' => $title ,
                         'variables' => [
                           'data'  =>   $data,
                         'datosNinio' => $datosNinio  ?? ' ',
                         'resiNinio'=> $resiNinio ?? ' '
                                         ]
                        ];
                
    }
    
    /// Metodo si es con post para beneficiario//////   

public function niniosSubmit() {
	$result = $this->niniosTable->findAll();

        foreach ($result as $ninio) {
            $dataNinio[] = array(
                'label' => $ninio['ApeNom'],
                'value' => $ninio['IdNinio']
            );
        }


    $localidades = $this->locTable->findAll();
    foreach($localidades as $localidad)
    {
        $data[] = array(
            'label'     =>  $localidad['nombre_geo'],
            'value'     =>  $localidad['gid']
        );
    }
      


        $usuario = $this->authentication->getUser();
        $Resi=$_POST['Domicilio'];

     //  var_dump($Resi);
        $Caso = $_POST['Ninio'];
        $Ninio =[];
        $Domicilio=[];
       
       ///Datos del niño////
        $Ninio['IdNinio']=$Caso['IdNinio'];
        $Ninio['ApeNom']=strtoupper($Caso['Apellido'].', '.$Caso['Nombre']);
        $Ninio['Dni']=$Caso['Dni'];
        $Ninio['Indocu'] = ($Caso['Dni'] > 0) ? 'NO' : 'SI';
        $Ninio['FechaNto']=$Caso['FechaNto'];
        $Ninio['Sexo']=$Caso['Sexo'];
        $Ninio['Etnia']='Criol/Ori';
        $Ninio['TpoEtnia']=$Caso['TpoEtnia'];
        $Ninio['ApeResp']=strtoupper($Caso['ApellidoR'].', '.$Caso['NombreR']);
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
        $Domicilio['ResiDire']=$Resi['Domicilio'];    
        $Domicilio['ResiLocal']=$Resi['Localidad'];
        $Domicilio['ResiUsu']=$usuario['id_usuario']; 
       $Domicilio['ResiAo']=$this->locTable->findById($Resi['ResiAo'])['aop']; 
       $Ninio['Aoresi']=$this->locTable->findById($Resi['ResiAo'])['aop']; 
        $Domicilio['ResiFecha']=new \DateTime();  
      // var_dump($Domicilio);
        
        $errors = [];
        
    if ( empty($_GET['id']) && count($this->niniosTable->find('Dni', $Ninio['Dni'])) > 0
    && $Ninio['Dni'] > 0) {
    
    $errors[] = 'Un beneficiario con este DNI ya está registrado';
    }
    
    if  (empty($errors)) {
        
    $this->niniosTable->save($Ninio);

    $ultimo = $this->niniosTable->ultimoReg();

     $Domicilio['ResiNinio']=$ultimo['IdNinio'];   
    // var_dump($Domicilio);
     $this->resiTable->save($Domicilio);
    
    if (empty($_GET['id'])){
    $datosNinio = $this->niniosTable->ultimoReg();
    }
    else{
        $datosNinio = $this->niniosTable->findById($_GET['id']);
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
                         'datosCaso' => $datosNinio  ?? ' '
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
