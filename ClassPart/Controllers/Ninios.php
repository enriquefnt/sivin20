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

    public function __construct(\ClassGrl\DataTables $niniosTable)
    {
        $this->niniosTable = $niniosTable;
        // $this->authentication = $authentication;
    }

// -----------------------------------------------------
public function edit($id=null) {
	
    $localidades = $this->locTable->findAll();
    foreach($localidades as $localidad)
    {
        $data[] = array(
            'label'     =>  $localidad['nombre_geo'],
            'value'     =>  $localidad['gid']
        );
    }
    
            if (isset($_GET['id'])) {
                    $datosCaso = $this->benefTable->findById($_GET['id']);
                                        }
    
                $title = ' Ninio';
    
            
    
                  return ['template' => 'edita_benef.html.php',
                             'title' => $title ,
                         'variables' => [
                           'data'  =>   $data,
                         'datosCaso' => $datosCaso  ?? ' '
                                         ]
                        ];
                
    }
    
    /// Metodo si es con post para Ninio//////   
    
    public function editSubmit() {
        
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
    
       
    
     //   $Ninio['fechaCarga'] = new \DateTime();
      //  $Ninio['id_usuario'] = $usuario['id_usuario'] ?? '00';
    
            
        $errors = [];
    
    
    if ( empty($_GET['id']) && count($this->benefTable->find('DNI', $Ninio['DNI'])) > 0) {
    
    $errors[] = 'Un Ninio con este DNI ya está registrado';
    }
    
    if  (empty($errors)) {
    
    $this->benefTable->save($Ninio);
    if (empty($_GET['id'])){
    $datosBenef = $this->benefTable->ultimoReg();
    }
    else{
        $datosBenef = $this->benefTable->findById($_GET['id']);
    }
    
    return ['template' => 'registersuccess.html.php',
                             'title' => 'Carga' ,
                         'variables' => [
                            'datosCaso' => $datosBenef  ?? ' '
                                         ]
                        ];
    
    }
    
    
    
    else {
     return ['template' => 'edita_benef.html.php',
                             'title' => 'Revisar' ,
                         'variables' => [
                               'errors'=> $errors,
                             'data'  =>   $data,
                         'datosCaso' => $Ninio  ?? ' '
                                         ]
                        ];
    }
    
    }










// ----------------------------------------------------------

    public function busca()
    {
        $result = $this->niniosTable->findAll();

        foreach ($result as $ninio) {
            $data[] = array(
                'label' => $ninio['ApeNom'],
                'value' => $ninio['IdNiño']
            );
        }

        $title = 'Busca Ninio';

        return [
            'template' => 'ninio.html.php',
            'title' => $title,
            'variables' => [
                'data' => $data,
                'result' => $result ?? ' '
            ]
        ];
    }

    public function home()
    {
        $title = 'Instructivo';

        return ['template' => 'home.html.php', 'title' => $title, 'variables' => []];
    }

    
}
