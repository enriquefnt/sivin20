<div class="container">
   <legend class="w-80 p-0 h-0 ">
    <p>Ficha de internación 
    </p>
</legend>
<fieldset class="border p-2">
<legend class="w-80 p-0 h-0 " style="font-size: 0.95rem;font-weight: bold;">  <?=$datosNinio['ApeNom'].' - '. $datosNinio['edad'] ;?>
   </legend>
<form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
		
<input type="hidden"name="NOTIINTERNADOS[Idint]" id="Idint" value=<?=$datosInter['Idint'] ?? ''?> >
<input type="hidden" name="NOTIINTERNADOS[IdNotifica]"  id="IdNotifica"   value=<?=$datosNoti['IdNotifica'] ?? ''?>>
	          
<div class="col-sm-2">	
			<label class="form-label-sm" for="IntFecha">Fecha Ingreso</label>
			<input class="form-control form-control-sm" type="date" name="NOTIINTERNADOS[IntFecha]" id="IntFecha" required="required" value="<?=$datosInter['IntFecha'] ?? ''?>">
</div>


<div class="col-sm-4">	
			<label class="form-label-sm" for="IntEfec">Efector</label>
			<input class="form-control form-control-sm" type="text" name="NOTIINTERNADOS[IntEfec]" id="IntEfec" required="required" value="<?=$datosInter['IntEfec'] ?? ''?>">
			<input type="hidden" name="NOTIINTERNADOS[establecimiento_id]" id="establecimiento_id" value="<?= $data['value'] ?? $datosNoti['establecimiento_id'] ?? '' ?>" />
</div>

<div class="col-sm-3">
  <label class="form-label-sm" for="IntSala">Sala</label>
  <select name="NOTIINTERNADOS[IntSala]" id="IntSala" class="form-control form-control-sm">
  	<option hidden selected><?=$datosInter['IntSala'] ?? '...'?></option>
    	
	<option value=2>Guardia</option>
	<option value=3>Terapia intensiva</option>
	<option value=9>Internacion comun</option>
	<option value=10>CRENI</option>
    <option value=4>Recuperacion nutricional</option>
	</select>
 </div>

 <div class="col-sm-1">
  <label class="form-label-sm" for="IntAlta">Alta</label>
  <select name="NOTIINTERNADOS[IntAlta]" id="IntAlta" class="form-control form-control-sm">
  	<option hidden selected><?=$datosInter['IntAlta'] ?? '...'?></option>
    	<option value=NO>NO</option>
	<option value=SI>SI</option>
		</select>
 </div>
 
 <div class="col-sm-2">	
			<label class="form-label-sm" for="IntFechalta">Fecha Egreso</label>
			<input class="form-control form-control-sm" type="date" name="NOTIINTERNADOS[IntFechalta]" id="IntFechalta" required="required" value="<?=$datosInter['IntFechalta'] ?? ''?>">
</div>

<div class="col-sm-3">
  <label class="form-label-sm" for="IntTipoAlta">Tipo</label>
  <select name="NOTIINTERNADOS[IntTipoAlta]" id="IntTipoAlta" class="form-control form-control-sm">
  	<option hidden selected><?=$datosInter['IntTipoAlta'] ?? '...'?></option>
    	
	<option value=1>Médica</option>
	<option value=2>Derivación</option>
	<option value=3>Voluntaria</option>
	<option value=4>Defuncion</option>
    <option value=5>Migracion</option>
	</select>
 </div>

<div class="form-group">
			<label class="form-label-sm" for="IntObserva">Observaciones</label>
			 <textarea class="form-control" rows="3" id="IntObserva" name="NOTIINTERNADOS[IntObserva]"
			 value="<?=$datosInter['IntObserva'] ?? ''?>">
			</textarea>
         </div>
	</fieldset>

<fieldset class="border p-2">   
<div class="d-flex">  
        <div class="col-sm-3">		
            <a href="/ninios/home"  class="btn btn-primary " role="button">Salir sin cambiar</a>
        </div>
        <div class="col-sm-3">	
            <input type="submit" id="myButton"  name=submit class="btn btn-primary " value="Guardar">
        </div>
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

var auto_complete = new Autocom(document.getElementById('IntEfec'), options);
</script>
