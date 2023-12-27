
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
//var_dump($resiNinio);
?>
<div class="container">

<fieldset class="border p-2">
 <legend class="w-80 p-0 h-0 ">Datos personales 
   </legend>
<form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
		
	
	<input type="hidden" name="Ninio[IdNinio]" value="<?=$datosNinio['IdNinio'] ?? ''?>">
	
          
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
			<input class="form-control form-control-sm" type="number" name="Ninio[Dni]" id="Dni" min="0" max="99999999"  value="<?=$datosNinio['Dni'] ?? ''?>">
</div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="FechaNto">Fecha de Nacimiento</label>
			<input class="form-control form-control-sm" type="date" name="Ninio[FechaNto]" id="FechaNto" required="required" min="2017-01-01"  max="<?=date('Y-m-d');?>"  value="<?=$datosNinio['FechaNto'] ?? ''?>">
</div>

<div class="col-sm-2">
  <label class="form-label-sm" for="tipo">Sexo</label>
  <select name="Ninio[Sexo]" id="Sexo" class="form-control form-control-sm">
  	<option hidden selected><?=$datosNinio['Sexo'] ?? '...'?></option>
  <!--  <option value='1'>Administrador</option> -->
    <option value='Femenino'>Femenino</option>
    <option value='Masculino'>Masculino</option>
    <option value='No determinado'>No determinado</option>
        </select>
 </div>


 <div class="col-sm-2">
 	<label class="form-label-sm" for="IdEtnia">Etnia</label>
  <select name="Ninio[IdEtnia]" required="required"  id="IdEtnia"class="form-control form-control-sm">
  <option hidden selected><?=$datosNinio['NomEtnia'] ?? '...'?></option>
      <?php
  $aop = [];
    foreach ($etnias as $etnia) {
   echo '<option value=' .  $etnia['IdEtnia'].'>' . $etnia['NomEtnia'] .'</option>';
    }
  ?>
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
			<label class="form-label-sm" for="ResiDire">Domicilio</label>
			<input class="form-control form-control-sm" type="text" name="Domicilio[ResiDire]" id="ResiDire" required="required" value="<?=$datosDomi['ResiDire'] ?? ''?>">
</div>

	<div class="col-sm-2">
  <label class="form-label-sm" for="ResiLocal">Localidad</label>
  <input type="text" name="Domicilio[ResiLocal]" id="ResiLocal" class="form-control form-control-sm" autocomplete="off"  value="<?=$datosDomi['ResiLocal'] ?? ''?>" >
   
  <input type="hidden" name="Domicilio[IdResi]" value="<?=$datosDomi['IdResi'] ?? ''?>">
   <input type="hidden" name="Domicilio[Gid]" id="Gid" value="<?= $data['value'] ?? $datosDomi['gid'] ?? '' ?>" />
   
</div>

<div class="col-2">
			<label class="form-label-sm" for="Fono"
			title="Codigo de área (sin 0) - nùmero (sin 15)">Celular</label>
			<input class="form-control form-control-sm"  type="text" id="Fono" name="Ninio[Fono]" placeholder="###-#######" data-llenar-campo="Fono" pattern="[0-9]{3}-[0-9]{7}"  value="<?=$datosNinio['Fono'] ?? ''?>" autocomplete="off" />
	</div>
	</fieldset>
	<fieldset class="border p-2">       
<div class="col-sm-3">
		    
<?php
	if (empty($datosNinio)) : ?>
<input type="submit" id="myButton"  name=submit class="btn btn-primary btn-sm" value="Guardar">

<?php
else: ?>
<!-- <input type="submit" id="myButton"  name=submit class="btn btn-primary btn-sm" value="Guardar cambios"> -->
<input type="submit" id="myButton" name="submit" class="btn btn-primary btn-sm" value="Guardar cambios" onclick="guardarCambios()">
<a href="/noticon/noti?id=<?=$datosNinio['IdNinio']?? ''?>"  class="btn btn-primary btn-sm" role="button">Notificación</a>
<?php
endif;
?>
<a href="/ninios/home"  class="btn btn-primary btn-sm" role="button">Salir sin modificar</a>
</div>
	</fieldset>
 </form>
</div>


<script>
var auto_complete = new Autocom(document.getElementById('ResiLocal'), {
  data: <?php echo json_encode($data); ?>,
  maximumItems: 10,
  highlightTyped: true,
  highlightClass: 'fw-bold text-primary',
  onSelectItem: function(selectedItem) {
    document.getElementById('Gid').value = selectedItem.value; // Asignar el valor del item seleccionado al input hidden
  }
});
</script>
<script>
var auto_complete = new Autocom(document.getElementById('ninio'), {
  data: <?php echo json_encode($dataNinio); ?>,
  maximumItems: 15,
  highlightTyped: true,
  highlightClass: 'fw-bold text-primary',
  onSelectItem: function(selectedItem) {
    document.getElementById('idNinio').value = selectedItem.value; 
  }
});
</script>



<!-- <script>
function guardarCambios() {
  // Obtén el valor del input de texto
  var valorLocalidad = document.getElementById("ResiLocal").value;

  // Busca el código correspondiente al valor del input de texto
  var codigo = $.grep(data, function(item) {
    return item.value === valorLocalidad;
  })[0].first().code;

  // Actualiza el valor del input oculto
  document.getElementById("Gid").value = codigo;
}
</script>
<script>
$(document).ready(function(){
    $("form").on("submit", function(e){
        var gid = $("input[name='Domicilio[Gid]']").val();
        if (Domicilio[Gid] === null || Domicilio[Gid] === '') {
            var resiLocal = $("input[name='Domicilio[ResiLocal]']").val();
            var found = false;
            $.each(data, function(i, obj){
                if (obj.ResiLocal === resiLocal) {
                    gid = obj.Gid;
                    found = true;
                    return false; // break out of $.each loop
                }
            });
            if (found) {
                $("input[name='Domicilio[Gid]']").val(gid);
            } else {
                alert("ResiLocal not found in data.");
                e.preventDefault(); // prevent form submission
            }
        }
    });
});
</script>-->
