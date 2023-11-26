<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Ninios
{
    private $niniosTable;
    private $locTable;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $niniosTable,
                                 \ClassGrl\DataTables $locTable,
                                 \ClassGrl\Authentication $authentication)
    {
        $this->niniosTable = $niniosTable;
        $this->locTable = $locTable;
        $this->authentication = $authentication;
    }


    public function busca()
    {
        $result = $this->niniosTable->findAll();

        foreach ($result as $ninio) {
            $data[] = array(
                'label' => $ninio['ApeNom'],
                'value' => $ninio['IdNiño']
            );
        }

        $title = 'Busca Beneficiario';

        return [
            'template' => 'busca_ninio.html.php',
            'title' => $title,
            'variables' => [
                'data' => $data,
                'result' => $result ?? ' '
            ]
        ];
    }


// -----------------------------------------------------
// Metodo si es GET para beneficiario////// 

public function ninios($id=null) {
	
    $localidades = $this->locTable->findAll();
    foreach($localidades as $localidad)
    {
        $data[] = array(
            'label'     =>  $localidad['nombre_geo'],
            'value'     =>  $localidad['gid']
        );
    }
    
            if (isset($_GET['id'])) {
                    $datosNinio = $this->niniosTable->findById($_GET['id']);
                                        }
    
                $title = 'Caso';
    
            
    
                  return ['template' => 'ninios.html.php',
                             'title' => $title ,
                         'variables' => [
                           'data'  =>   $data,
                         'datosNinio' => $datosNinio  ?? ' '
                                         ]
                        ];
                
    }
    
    /// Metodo si es con post para beneficiario//////   

public function niniosSubmit() {
	
    $localidades = $this->locTable->findAll();
    foreach($localidades as $localidad)
    {
        $data[] = array(
            'label'     =>  $localidad['nombre_geo'],
            'value'     =>  $localidad['gid']
        );
    }
    
        $usuario = $this->authentication->getUser();
    
        $Ninio = $_POST['Ninio'];
    
    	
        //$Ninio['fechaCarga'] = new \DateTime();
        //$Ninioo['id_usuario'] = $usuario['id_usuario'] ?? '00';
    
            
        $errors = [];
    
    
    if ( empty($_GET['id']) && count($this->niniosTable->find('Dni', $Ninio['Dni'])) > 0) {
    
    $errors[] = 'Un beneficiario con este DNI ya está registrado';
    }
    
    if  (empty($errors)) {
        var_dump($Ninio);
    $this->niniosTable->save($Ninio);
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



    public function home()
    {
        $title = 'Instructivo';

        return ['template' => 'home.html.php', 'title' => $title, 'variables' => []];
    }

    public function cargarFichaHija()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Verifica si el IdNiño está presente en el formulario
            $idNino = $_POST['value'];

            if (!empty($idNino)) {
                // Realiza las acciones para cargar la ficha hija, por ejemplo, redirecciona a otra página con el IdNiño
              
				echo 'el id del niño es: ' . $idNino ;
				//  header("Location: Usuarios.php?idNino=$idNino");
                exit();
            }
        }
    }
}
