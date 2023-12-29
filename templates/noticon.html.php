<div class="container">


<fieldset class="border p-2">
 <legend class="w-80 p-0 h-0 ">Notificación:
   </legend>
<form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
		
<input type="hidden"name="Noticon[NotId]" id="NotId" value=<?=$datosNoti['NotId'] ?? ''?> >
	<input type="hidden" name="Noticon[NotNinio]"  id="NotNinio"   value=<?=$datosNinio['IdNinio'] ?? ''?>>
	
          
<div class="col-sm-2">	
			<label class="form-label-sm" for="Nombre">Fecha</label>
			<input class="form-control form-control-sm" type="date" name="Noticon[NotFecha]" id="Fecha" required="required" value="<?=$datosNoti['NotFecha'] ?? ''?>">
</div>
<div class="col-sm-2">	
			<label class="form-label-sm" for="NotEfec">Efector</label>
			<input class="form-control form-control-sm" type="text" name="Noticon[NotEfec]" id="NotEfec" required="required" value="<?=$datosNoti['NotEfec'] ?? ''?>">
			<input type="hidden" name="Noticon[establecimiento_id]" id="establecimiento_id" value="<?= $data['value'] ?? $datosNoti['establecimiento_id'] ?? '' ?>" />
</div>

<div class="col-sm-2">
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
<!-- <div class="col-sm-2">	
			<label class="form-label-sm" for="NotZpe">Z P/E</label>
			<input class="form-control form-control-sm" type="number" name="Noticon[NotZpe]"
			 id="NotZpe" required="required" value="<?=$datosNoti['NotZpe'] ?? 'ZSCORE(2, "p", 5.5, "2023-01-01", "2023-03-01");'?>">
</div>
<div class="col-sm-2">	
			<label class="form-label-sm" for="NotZta">Z T/E</label>
			<input class="form-control form-control-sm" type="number" name="Noticon[NotZta]"
			 id="NotZtao" required="required" value="<?=$datosNoti['NotZta'] ?? ''?>">
</div>
<div class="col-sm-2">	
			<label class="form-label-sm" for="NotZimc">Z IMC/E</label>
			<input class="form-control form-control-sm" type="number" name="Noticon[NotZimc]"
			 id="NotZimc" required="required" value="<?=$datosNoti['NotZimc'] ?? ''?>">
</div> -->
<div class="form-group">
			<label class="form-label-sm" for="NotObserva">Observaciones</label>
			 <textarea class="form-control" rows="5" id="NotObserva" name="Noticon[NotObserva]"
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
var auto_complete = new Autocom(document.getElementById('NotEfec'), {
  data: <?php echo json_encode($data_insti); ?>,
  maximumItems: 10,
  highlightTyped: true,
  highlightClass: 'fw-bold text-primary',
  onSelectItem: function(selectedItem) {
    document.getElementById('establecimiento_id').value = selectedItem.value; // Asignar el valor del item seleccionado al input hidden
  }
});
</script>