
<?php
	if (!empty($errors)) :
?>
	<div class="alert alert-warning" role="alert">

				<p>Controle los siguiente:</p>
		<ul>
	<?php
	foreach ($errors as $error) :
	?>
			<li><?= $error ?></li>
	<?php
	endforeach; ?>
		</ul>
	</div>
<?php
endif;
?>

<?php
	if(1===1) :
?>
<!-- <div class="container">

<fieldset class="border p-2">
 <legend class="w-80 p-0 h-0 ">Buscar 
   </legend>


  <div class="container">
  <form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
        <input type="text" name="ninio" id="ninio" class="form-control form-control-lg">
        <input type="hidden" name="idNinio" id="idNinio" value="">
        <button class="btn btn-primary" type="submit" name="submit">Buscar</button>
    </form>
</div>
</fieldset>

</div> -->

<?php
endif;
?>	
<div class="container">

<fieldset class="border p-2">
 <legend class="w-80 p-0 h-0 ">Datos personales 
   </legend>
<form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
		
	
	<input type="hidden" name="Ninio[IdNinio]" value="<?=$datosNinio['IdNinio'] ?? ''?>">
	<input type="hidden" name="Domicilio[IdResi]" value="<?=$datosDomi['IdResi'] ?? ''?>">
          
<div class="col-sm-2">	
			<label class="form-label-sm" for="Nombre">Nombre</label>
			<input class="form-control form-control-sm" type="text" name="Ninio[Nombre]" id="Nombre" required="required" value="<?=$datosNinio['Nombre'] ?? ''?>">
</div>
<div class="col-sm-2">	
			<label class="form-label-sm" for="Apellido">Apellido</label>
			<input class="form-control form-control-sm" type="text" name="Ninio[Apellido]" id="Apellido" required="required" value="<?=$datosNinio['Apellido'] ?? ''?>">
</div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="Dni">DNI</label>
			<input class="form-control form-control-sm" type="number" name="Ninio[Dni]" id="Dni" min="1000000" max="99000000"  value="<?=$datosNinio['Dni'] ?? ''?>">
</div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="FechaNto">Fecha de Nacimiento</label>
			<input class="form-control form-control-sm" type="date" name="Ninio[FechaNto]" id="FechaNto" required="required" min="2017-01-01"  max="<?=date('Y-m-d');?>"  value="<?=$datosNinio['FechaNto'] ?? ''?>">
</div>

<div class="col-sm-2">
  <label class="form-label-sm" for="tipo">Sexo</label>
  <select name="Ninio[Sexo]" id="Sexo" class="form-control form-control-sm">
  	<option hidden selected><?=$datosUser['Sexo'] ?? '...'?></option>
  <!--  <option value='1'>Administrador</option> -->
    <option value='Femenino'>Femenino</option>
    <option value='Masculino'>Masculino</option>
    <option value='No determinado'>No determinado</option>
        </select>
 </div>


 <div class="col-sm-2">
  <label class="form-label-sm" for="tipo">Etnia</label>
  <select name="Ninio[TpoEtnia]" id="TpoEtnia" class="form-control form-control-sm">
  	<option hidden selected><?=$datosUser['TpoEtnia'] ?? '...'?></option>
  <!--  <option value='1'>Administrador</option> -->
  	<option value=0>Criollo</option>
	<option value=16>Wichis</option>
	<option value=13>Toba</option>
	<option value=1>Ava-guaraní</option>
	<option value=2>Chané</option>
	<option value=3>Chorotes</option>
	<option value=4>Chulupí</option>
	<option value=8>Kolla</option>
	<option value=5>Diaguita calchaquí</option>
	<option value=6>Guaraní</option>
	<option value=7>Iogys (wichí)</option>
	<option value=9>Lule</option>
	<option value=10>Mocoví</option>
	<option value=11>Tapieté</option>
	<option value=12>Tastil</option>
	<option value=14>Tupí guaraní</option>
	<option value=15>Whenhayes (wichí)</option>
	<option value=99>No determinada</option> 
        </select>
 </div>


<div class="col-sm-2">	
			<label class="form-label-sm" for="Peso">Peso al nacer (gr)</label>
			<input class="form-control form-control-sm" type="number" name="Ninio[Peso]" id="Peso" min="500" max="6000" value="<?=$datosNinio['Peso'] ?? ''?>">
</div>	

<div class="col-sm-2">	
			<label class="form-label-sm" for="Peso">Talla al nacer (cm)</label>
			<input class="form-control form-control-sm" type="number" name="Ninio[Talla]" id="Talla" min="30" max="60" value="<?=$datosNinio['Talla'] ?? ''?>">
</div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="Peso">Edad Gestacional (Sem.)</label>
			<input class="form-control form-control-sm" type="number" name="Ninio[Semanas]" id="Semanas" min="20" max="44" value="<?=$datosNinio['Semanas'] ?? ''?>">
</div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="NombreR">Nombre Responsable</label>
			<input class="form-control form-control-sm" type="text" name="Ninio[NombreR]" id="NombreR" required="required" value="<?=$datosNinio['NombreR'] ?? ''?>">
</div>
<div class="col-sm-2">	
			<label class="form-label-sm" for="ApellidoR">Apellido Responsable</label>
			<input class="form-control form-control-sm" type="text" name="Ninio[ApellidoR]" id="ApellidoR" required="required" value="<?=$datosNinio['ApellidoR'] ?? ''?>">
</div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="Dni">DNI Responsable</label>
			<input class="form-control form-control-sm" type="number" name="Ninio[DniResp]" id="DniResp" required="required" value="<?=$datosNinio['DniResp'] ?? ''?>">
</div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="Domicilio">Domicilio</label>
			<input class="form-control form-control-sm" type="text" name="Domicilio[Domicilio]" id="Domicilio" required="required" value="<?=$resiNinio['ResiDire'] ?? ''?>">
</div>

	<div class="col-sm-2">
  <label class="form-label-sm" for="Localidad">Localidad</label>
  <input type="text" name="Domicilio[Localidad]" id="Localidad" class="form-control form-control-sm" value="<?=$resiNinio['ResiLocal'] ?? ''?>" autocomplete="off" />
  <input type="hidden" name="Domicilio[ResiAo]" id="ResiAo" value="<?=isset($data['value']) ? $data['value'] : ''?>" />
</div>

<div class="col-2">
			<label class="form-label-sm" for="Fono"
			title="Codigo de área (sin 0) - nùmero (sin 15)">Celular</label>
			<input class="form-control form-control-sm"  type="text" id="Fono" name="Ninio[Fono]" placeholder="###-#######" data-llenar-campo="Fono" pattern="[0-9]{3}-[0-9]{7}"  value="<?=$datosCaso['Fono'] ?? ''?>" autocomplete="off" />
	</div>
        
<div class="col-sm-3">
		    <button class="btn btn-primary" type="submit" name="submit">Enviar</button>
</div>

	</fieldset>
 </form>
</div>


<script>
var auto_complete = new Autocom(document.getElementById('Localidad'), {
  data: <?php echo json_encode($data); ?>,
  maximumItems: 10,
  highlightTyped: true,
  highlightClass: 'fw-bold text-primary',
  onSelectItem: function(selectedItem) {
    document.getElementById('ResiAo').value = selectedItem.value; // Asignar el valor del item seleccionado al input hidden
  }
});
</script>
<script>
var auto_complete = new Autocom(document.getElementById('ninio'), {
  data: <?php echo json_encode($dataNinio); ?>,
  maximumItems: 10,
  highlightTyped: true,
  highlightClass: 'fw-bold text-primary',
  onSelectItem: function(selectedItem) {
    document.getElementById('idNinio').value = selectedItem.value; 
  }
});
</script>