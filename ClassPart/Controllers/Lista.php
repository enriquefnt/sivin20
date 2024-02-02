<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Lista
{
    private $tablaNinios;
    private $tablaNoti;
	private $tablaControl;
    private $tablaInter;
    private $tablaInsti;
	private $tablaResi;
    private $authentication;

    public function __construct(\ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaNoti,
                                \ClassGrl\DataTables $tablaControl,
                                \ClassGrl\DataTables $tablaInter,
                                \ClassGrl\DataTables $tablaInsti,
								\ClassGrl\DataTables $tablaResi,
                                \ClassGrl\Authentication $authentication)
    {
        $this->tablaNinios = $tablaNinios;
        $this->tablaNoti = $tablaNoti;
        $this->tablaControl = $tablaControl;
        $this->tablaInter = $tablaInter;
        $this->tablaInsti = $tablaInsti;
		$this->tablaResi = $tablaResi;
        $this->authentication = $authentication;
    }

}