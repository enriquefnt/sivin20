<?php /*
namespace ClassPart\Controllers;
use \ClassGrl\DataTables;
use \AllowDynamicProperties;
#[AllowDynamicProperties]
class Ninios {
private $niniosTable;
private $authentication;


public function __construct(\ClassGrl\DataTables $niniosTable) 
{

        $this->niniosTable = $niniosTable;
	//	$this->authentication = $authentication;
    }


	public function busca() {

		$result = $this->niniosTable->findAll();
		
		
		foreach($result as $ninio)
		{
			$data[] = array(
				'label'     =>   $ninio['ApeNom']   ,
				'value'     =>  $ninio['IdNiño']
			);
		}
		
		$title = 'Busca Beneficiario';
		
			
		
				  return ['template' => 'busca_ninio.html.php',
							 'title' => $title ,
						 'variables' => [
							 'data'  =>   $data,
							'result' => $result  ?? ' '
											 ]
		
							];
		}


public function home() {
		$title = 'Instructivo';

return ['template' => 'home.html.php', 'title' =>$title,'variables' => [] ];
		
	}


}

*/


namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Ninios
{
    private $niniosTable;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $niniosTable)
    {
        $this->niniosTable = $niniosTable;
        // $this->authentication = $authentication;
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
