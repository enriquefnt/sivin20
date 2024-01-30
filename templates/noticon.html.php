

<div class="container">
   <legend class="w-80 p-0 h-0 ">
    <p>Carga de  <?php echo $_GET['tabla']=='notificacion' ? 'Notificación' : 'Control'; ?>
    </p>
</legend>
<fieldset class="border p-2">
<legend class="w-80 p-0 h-0 " style="font-size: 0.95rem;font-weight: bold;">  <?=$datosNinio['ApeNom'].' - '.$datosNinio['edad'].' - '. $datosDomi['ResiLocal'] ;?>
   </legend>
<form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
		
<input type="hidden"name="Noticon[NotId]" id="NotId" value=<?=$datosNoti['NotId'] ?? ''?> >
	<input type="hidden" name="Noticon[NotNinio]"  id="NotNinio"   value=<?=$datosNinio['IdNinio'] ?? ''?>>
	<input type="hidden" name="Noticon[IdCtrol]"  id="IdCtrol"   value=<?=$datosNinio['IdCtrol'] ?? ''?>>
          
<div class="col-sm-2">	
			<label class="form-label-sm" for="NotFecha">Fecha</label>
			<input class="form-control form-control-sm" type="date" name="Noticon[NotFecha]" id="NotFecha" required="required" value="<?=$datosNoti['NotFecha'] ?? ''?>">
</div>
<div class="col-sm-3">	
			<label class="form-label-sm" for="NotEfec">Efector</label>
			<input class="form-control form-control-sm" type="text" name="Noticon[NotEfec]" id="NotEfec" required="required" value="<?=$datosNoti['NotEfec'] ?? ''?>">
			<input type="hidden" name="Noticon[establecimiento_id]" id="establecimiento_id" value="<?= $data['value'] ?? $datosNoti['establecimiento_id'] ?? '' ?>" />
</div>

<div class="col-sm-3">
  <label class="form-label-sm" for="MotId">Motivo</label>
  <select name="Noticon[NotMotivo]" id="MotId" class="form-control form-control-sm">
  	<option hidden selected><?=$datosNoti['MotId'] ?? '...'?></option>
    	<option value=1>Z score de P/E menor de -2</option>
	<option value=2>Curva de crecimiento anormal</option>
	<option value=3>Edema</option>
	<option value=4>Palidez intensa</option>
	<option value=8>Perdida de pautas desarrollo</option>
	</select>
 </div>
<div class="col-sm-2">	
			<label class="form-label-sm" for="NotPeso">Peso (kg)</label>
			<input class="form-control form-control-sm" type="number" step="0.01" min="1" max="60" name="Noticon[NotPeso]"
			 id="NotPeso" required="required" value="<?=$datosNoti['NotPeso'] ?? ''?>">
</div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="NotTalla">Talla (cm)</label>
			<input class="form-control form-control-sm" type="number" step="0.1" min="30" max="150" name="Noticon[NotTalla]"
			 id="NotTalla" required="required" value="<?=$datosNoti['NotTalla'] ?? ''?>">
</div>

	<!-- <div class="col-sm-3">
	<label class="form-label-sm" for="NotEvo">Evolucion</label>
	<select name="Noticon[NotEvo]" id="NotEvo" class="form-control form-control-sm">
		<option hidden selected><?=$datosNoti['NotEvo'] ?? '...'?></option>
		<option value=1>Agudo</option>
		<option value=2>Crónico</option>
		<option value=3>Crónico agudizado</option>
		<option value=4>En estudio</option>
		<option value=9>Sin determinar</option>
		</select>
	</div> -->

	<div class="col-sm-3">
	<label class="form-label-sm" for="NotEvo">Evolucion</label>
	<select name="Noticon[NotEvo]" id="NotEvo" class="form-control form-control-sm">
		<option hidden selected><?=$datosNoti['NotEvo'] ?? '...'?></option>
			<?php
			$sEvo = [];
			foreach ($segunevol as $sEvo) {
			echo '<option value=' .  $sEvo['SevoId'].'>' . $sEvo['SevoNom'] .'</option>';
			}
			?>
		</select>
	</div>



	
	<div class="col-sm-3">
	<label class="form-label-sm" for="NotClinica">Gravedad</label>
	<select name="Noticon[NotClinica]" id="NotClinica" class="form-control form-control-sm">
		<option hidden selected><?=$datosNoti['NotClinica'] ?? '...'?></option>
		<?php
			$sCli = [];
			foreach ($segunclin as $sCli) {
			echo '<option value=' .  $sCli['SclinId'].'>' . $sCli['SclinNom'] .'</option>';
			}
			?>
		</select>
	</div>
	<div class="col-sm-3">
	<label class="form-label-sm" for="NotEtio">Etiología</label>
	<select name="Noticon[NotEtio]" id="NotEtio" class="form-control form-control-sm">
		<option hidden selected><?=$datosNoti['NotEtio'] ?? '...'?></option>
		<option value=1>Primaria</option>
		<option value=2>Perinatal</option>
		<option value=3>Congénita</option>
		<option value=4>Infecciosa</option>
		<option value=5>Gastrointestinal</option>
		<option value=6>Neurológica</option>
		<option value=7>Cardiovaslcular</option>
		<option value=8>Respiratoria</option>
		<option value=9>Otras (indicar en observaciones)</option>
		<option value=10>En estudio</option>

		</select>
	</div>

 <div class="col-sm-3">
	<label class="form-label-sm" for="NotObsantro">Acciones</label>
	<select name="Noticon[NotObsantro]" id="NotObsantro" class="form-control form-control-sm">
		<option hidden selected><?=$datosNoti['NotObsantro'] ?? '...'?></option>
		<option value=1>Derivacion a equipo multidisciplinario</option>
		<option value=2>CRENA</option>
		<option value=3>CRENA con ATLU</option>
		<option value=4>CRENI</option>
		<option value=4>Internación por patologia</option>
		<option value=5>Pendientes Estudios para diagnóstico etiológico</option>
		<option value=6>Tratamiento etiológico</option>
		<option value=7>Controles antropométricos</option>
		<option value=8>Articulación</option>
		<option value=9>Asistencia alimentaria</option>
		<option value=10>Sin seguimiento específico</option>
		<option value=11>Otras (indicar en observaciones)</option>

		</select>
	</div>



<div class="form-group">
			<label class="form-label-sm" for="NotObserva">Observaciones</label>
			 <textarea class="form-control" rows="3" id="NotObserva" name="Noticon[NotObserva]"
			 value="<?=$datosNoti['NotObserva'] ?? ''?>">
			</textarea>
</div> 


</fieldset>
	<fieldset class="border p-2">       
<div class="col-sm-3">
		    

<a href="/ninios/home"  class="btn btn-primary btn-sm" role="button">Salir sin cambiar</a>
<input type="submit" id="myButton"  name=submit class="btn btn-primary btn-sm" value="Guardar">
</div>
	</fieldset>
 </form>
</div>


<script>
var options = {
 data: <?php echo json_encode($data_insti); ?>,
 maximumItems: 10,
 highlightTyped: true,
 highlightClass: 'fw-bold text-primary',
 onSelectItem: function(selectedItem) {
    document.getElementById('establecimiento_id').value = parseInt(selectedItem.value); // Asignar el valor del item seleccionado al input hidden
 }
};

var auto_complete = new Autocom(document.getElementById('NotEfec'), options);
</script>

