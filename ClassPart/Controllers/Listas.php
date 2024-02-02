<?php
namespace ClassPart\Controllers;

use \ClassGrl\DataTables;
use \AllowDynamicProperties;

#[AllowDynamicProperties]
class Listas
{
    private $tablaNinios;
    private $tablaNoti;
	private $tablaControl;
    private $tablaInter;
    private $tablaInsti;
	private $tablaResi;
    private $tablaMotIng;  
    private $authentication;
    private $pdoProc;

    public function __construct(\ClassGrl\DataTables $tablaNinios,
                                \ClassGrl\DataTables $tablaNoti,
                                \ClassGrl\DataTables $tablaControl,
                                \ClassGrl\DataTables $tablaInter,
                                \ClassGrl\DataTables $tablaInsti,
								\ClassGrl\DataTables $tablaResi,
                                \ClassGrl\DataTables $tablaMotIng,
                                \ClassGrl\Authentication $authentication,
                                $pdoProc	)
    {
        $this->tablaNinios = $tablaNinios;
        $this->tablaNoti = $tablaNoti;
        $this->tablaControl = $tablaControl;
        $this->tablaInter = $tablaInter;
        $this->tablaInsti = $tablaInsti;
		$this->tablaResi = $tablaResi;
        $this->authentication = $authentication;
        $this->pdoProc = $pdoProc;
    }


public function nominal($aop){
    
}
public function ejecutarProcedimientoAlmacenado($procedimiento, $parametros = [])
    {
        // Prepara la sentencia SQL para ejecutar el procedimiento almacenado
        $sentencia = $this->pdoProc->prepare("CALL $procedimiento(?)");

        // Ejecuta la sentencia preparada con los parámetros dados
        $sentencia->execute($parametros);

        // Devuelve el resultado (si lo hubiera)
        return $sentencia->fetchAll();
    }
}
}