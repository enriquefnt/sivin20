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

    public function ninios($id=null) {
        $etnias=$this->tablaEtnia->findAll();
        $localidades = $this->tablaLoc->findAll();
        foreach($localidades as $localidad)
        {
            $data[] = array(
                'label'     => $localidad['localidad'],
                'value'     => $localidad['gid']
            );
        }

        if ($_GET['id'] > 0) {

            $datosNinio = $this->tablaNinios->findById($_GET['id']);

            $datosDomi = $this->tablaResi->findLast('ResiNinio', ($_GET['id']));

            $datosDomi['gid']=$this->tablaLoc->find('localidad', $datosDomi['ResiLocal'])[0]['gid'] ?? '' ;

            $apenom = $this->separar_nombres($datosNinio['ApeNom']);

            $datosNinio['Nombre']=$apenom['nombres'];
            $datosNinio['Apellido']=$apenom['apellido'];

            $apenomR = $this->separar_nombres($datosNinio['ApeResp']);

            $datosNinio['NombreR']=$apenomR['nombres'];
            $datosNinio['ApellidoR']=$apenomR['apellido'];
            $datosNinio['NomEtnia']=$this->tablaEtnia->findById($datosNinio['TpoEtnia'])['NomEtnia'];

            $title = 'Ver Caso';

            return ['template' => 'ninios.html.php',
                    'title' => $title ,
                    'variables' => [
                        'data' =>   $data,
                        'datosNinio' => $datosNinio ?? ' ',
                        'datosDomi'=> $datosDomi ?? ' ',
                        'etnias' => $etnias ?? ' '
                    ]
            ];
        }
        elseif ($_GET['id']<1) {
            $title = 'Cargar Caso';

            return ['template' => 'ninios.html.php',
                    'title' => $title ,
                    'variables' => [
                        'etnias' => $etnias ?? ' ',
                        'data' =>   $data
                    ]
            ];
        }
    }

    public function niniosSubmit() {
        $usuario = $this->authentication->getUser();
        $Resi=$_POST['Domicilio'];

        $Caso = $_POST['Ninio'];
        $Ninio =[];
        $Domicilio=[];

        $Ninio['IdNinio']=$Caso['IdNinio'];
        $Ninio['ApeNom']=strtoupper(ltrim($Caso['Apellido']).' '.ltrim($Caso['Nombre']));
        $Ninio['Dni']=$Caso['Dni'];
        $Ninio['Indocu'] = ($Caso['Dni'] > 0) ? 'NO' : 'SI';
        $Ninio['FechaNto']=$Caso['FechaNto'];
        $Ninio['Sexo']=$Caso['Sexo'];
        $Ninio['Etnia']=$Caso['IdEtnia'] > 0 ? 'Originario': 'Criollo';
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

        $resultado = $this->tablaResi->findLast('ResiNinio', $Caso['IdNinio']);

        $ResiDire = $resultado[5];
        $ResiLocal = $resultado[4];

        if ($Resi['ResiDire']!=$ResiDire||
            $Resi['ResiLocal']!=$ResiLocal) {
            $Domicilio['IdResi']='';
        } else {$Domicilio['IdResi']=$Resi['IdResi'];}

        $Domicilio['ResiNinio']=$Caso['IdNinio'];
        $Domicilio['ResiDire']=$Resi['ResiDire'];
        $Domicilio['ResiLocal']=$Resi['ResiLocal'];
        $Domicilio['ResiUsu']=$usuario['id_usuario'];

        $Domicilio['ResiAo']=$this->tablaLoc->findById($Resi['Gid'])['aop'] ?? '';

        $Ninio['Aoresi']=$Domicilio['ResiAo'];
        $Domicilio['ResiFecha']=new \DateTime();

        $errors = [];

        if ( empty($_GET['id']) && count($this->tablaNinios->find('Dni', $Ninio['Dni'])) > 0
            && $Ninio['Dni'] > 0) {

            $errors[] = 'Un niño con este DNI ya está registrado';
        }

        if (empty($errors)) {

            $this->tablaNinios->save($Ninio);

            if (empty($Domicilio['ResiNinio'])) {
                $ultimo = $this->tablaNinios->ultimoReg();
                $Domicilio['ResiNinio']=$ultimo['IdNinio'];
            }

            $this->tablaResi->save($Domicilio);

            if (empty($_GET['id'])) {
                $datosCaso = $this->tablaNinios->ultimoReg();
            }
            else {
                $datosCaso = $this->tablaNinios->findById($_GET['id']);
            }

            return ['template' => 'registersuccess.html.php',
                    'title' => 'Carga' ,
                    'variables' => [
                        'datosCaso' => $datosCaso ?? ' ',
                        'resiNinio'=> $Domicilio ?? ' '
                    ]
            ];

        }

        else {
            $localidades = $this->tablaLoc->findAll();
            foreach($localidades as $localidad)
            {
                $data[] = array(
                    'label'     => $localidad['localidad'],
                    'value'     => $localidad['gid']
                );
            }
            $etnias=$this->tablaEtnia->findAll();
            $apenom = $this->separar_nombres($Ninio['ApeNom']);
            $apenomR = $this->separar_nombres($Ninio['ApeResp']);
            $Ninio['Nombre']=$apenom['nombres'];
            $Ninio['Apellido']=$apenom['apellido'];
            $Ninio['NombreR']=$apenomR['nombres'];

            $Ninio['NomEtnia']=$this->tablaEtnia->findById($Ninio['TpoEtnia'])['NomEtnia'];

            return ['template' => 'ninios.html.php',
                    'title' => 'Revisar' ,
                    'variables' => [
                        'errors'=> $errors,
                        'data' => $data,
                        'datosNinio' => $Ninio ?? ' ',
                        'datosDomi'=> $Domicilio ?? ' ',
                        'etnias' => $etnias ?? ' '
                    ]
            ];
        }

    }

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

    public function mi_error_handler($errno, $errstr, $errfile, $errline) {
        if ($errno == E_USER_ERROR) {
            header("HTTP/1.1 504 Gateway Time-out");
            header("Content-Type: text/html");

            echo "<html><head><title>Error</title></head><body>";
            echo "<h1>La conexión está lenta, por favor, inténtelo de nuevo más tarde</h1>";
            echo "</body></html>";
        }
    }

}