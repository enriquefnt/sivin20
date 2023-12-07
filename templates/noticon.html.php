<div class="container">


<fieldset class="border p-2">
 <legend class="w-80 p-0 h-0 ">Notificación:
   </legend>
<form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
		
	
	<input type="hidden" name="Noticon[IdNinio]" value="<?=$datosNinio['IdNinio'] ?? ''?>">
	<!-- <input type="hidden" name="Domicilio[IdResi]" value="<?=$datosDomi['IdResi'] ?? ''?>"> -->
          
<div class="col-sm-2">	
			<label class="form-label-sm" for="Nombre">Fecha</label>
			<input class="form-control form-control-sm" type="date" name="Noticon[NotFecha]" id="Fecha" required="required" value="<?=$datosNoti['NotFecha'] ?? ''?>">
</div>
<div class="col-sm-2">	
			<label class="form-label-sm" for="NotAo">Efector</label>
			<input class="form-control form-control-sm" type="number" name="Noticon[NotAo]" id="NotAo" required="required" value="<?=$datosNoti['NotAo'] ?? ''?>">
</div>

<div class="col-sm-2">
  <label class="form-label-sm" for="MotId">Motivo</label>
  <select name="datosNoti[MotId]" id="MotId" class="form-control form-control-sm">
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
			<label class="form-label-sm" for="NotZpe">Z P/E</label>
			<input class="form-control form-control-sm" type="number" name="Noticon[NotZpe]"
			 id="NotZpe" required="required" value="<?=$datosNoti['NotZpe'] ?? ''?>">
</div>
<div class="col-sm-2">	
			<label class="form-label-sm" for="NotTalla">Talla (cm)</label>
			<input class="form-control form-control-sm" type="number" step="0.1" min="30" max="150" name="Noticon[NotTalla]"
			 id="NotTalla" required="required" value="<?=$datosNoti['NotTalla'] ?? ''?>">
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
</div>








</fieldset>
	<fieldset class="border p-2">       
<div class="col-sm-3">
		    <!-- <button class="btn btn-primary" type="submit" name="submit">Enviar</button> -->

<a href="/ninios/home"  class="btn btn-primary btn-sm" role="button">Salir sin cambiar</a>
<input type="submit" id="myButton"  name=submit class="btn btn-primary btn-sm" value="Guardar">
</div>
	</fieldset>
 </form>
</div>

<script>
  const formulario = new Formulario();

  function calcularZScores() {
    const peso = document.getElementById('NotPeso').value;
    const talla = document.getElementById('NotTalla').value;

    // Calcule los Z scores
    const zPeso = formulario.calcularZPeso(peso, talla);
    const zTalla = formulario.calcularZTalla(talla);
    const zImc = formulario.calcularZIMC(peso, talla);

    // Actualice los campos de Z score
    document.getElementById('NotZpe').value = zPeso.toFixed(2);
    document.getElementById('NotZta').value = zTalla.toFixed(2);
    document.getElementById('NotZimc').value = zImc.toFixed(2);
  }

  // Calcule los Z scores iniciales
  calcularZScores();
</script>