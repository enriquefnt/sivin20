<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Lista
{
    
	private $pdoZSCORE;
    private $authentication;   
	
    public function __construct($pdoZSCORE,
    \ClassGrl\Authentication $authentication
    )
    {
        		$this->pdoZSCORE = $pdoZSCORE;
                $this->authentication = $authentication;
		    }


    public function nominal(){
    $casos = $this->pdoZSCORE->prepare("call saltaped_sivin2.nominal();");
    $casos->execute([]);
    $datos = $casos->fetchAll(\PDO::FETCH_ASSOC);

$title='Nominal';
 
              return ['template' => 'nominal.html.php',
                         'title' => $title ,
                    'variables' => [
                   'casos'  =>   $datos ?? []
    
                                     ]

                    ]; 
}


}
