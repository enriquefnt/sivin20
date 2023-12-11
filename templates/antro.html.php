

<div class="container">


<fieldset class="border p-2">
 <legend class="w-80 p-0 h-0 ">Notificación:
   </legend>
<form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
		
<input type="hidden"name="Antro[idAnt]" id="idAnt" value=<?=$datosNinio['idAnt'] ?? ''?> >
	<input type="hidden" name="Antro[idNoti]"  id="idNoti"   value=<?=$datosNinio['idNoti'] ?? ''?>>
	

    <div class="col-sm-4">
 <label class="form-label-sm" for="nombre">Nombre</label>
 <input class="form-control form-control-sm" type="text" name="Antro[nombre]" id="nombre" required="required" value="<?=$datosNinio['nombre'] ?? ''?>">
</div>
    <div class="col-sm-2">	
			<label class="form-label-sm" for="fecnac">Fecha de Nacimiento</label>
			<input class="form-control form-control-sm" type="date" name="Antro[fecnac]" id="fecnac" required="required" min="2017-01-01"  max="<?=date('Y-m-d');?>"  value="<?=$datosNinio['fecnac'] ?? ''?>">
</div>

<div class="col-sm-2">
  <label class="form-label-sm" for="tipo">Sexo</label>
  <select name="Antro[sexo]" id="Sexo" class="form-control form-control-sm">
  	<option hidden selected><?=$datosNinio['exo'] ?? '...'?></option>
  <!--  <option value='1'>Administrador</option> -->
    <option value='Femenino'>Femenino</option>
    <option value='Masculino'>Masculino</option>
    <option value='No determinado'>No determinado</option>
        </select>
 </div>

<div class="col-sm-2">	
			<label class="form-label-sm" for="fecha">Fecha</label>
			<input class="form-control form-control-sm" type="date" name="Antro[fecha]" id="Fecha" required="required" value="<?=$datosNinio['fecha'] ?? ''?>">
</div>

<div class="col-sm-2">    
    <label class="form-label-sm" for="Peso">Peso (kg)</label>
    <input class="form-control form-control-sm peso-input" type="number" step="0.01" min="1" max="60" name="Antro[Peso]"
         id="NotPeso" required="required" value="<?=$datosNinio['Peso'] ?? ''?>">
</div>

<div class="col-sm-2">    
    <label class="form-label-sm" for="Talla">Talla (cm)</label>
    <input class="form-control form-control-sm talla-input" type="number" step="0.1" min="30" max="150" name="Antro[Talla]"
         id="NotTalla" required="required" value="<?=$datosNinio['Talla'] ?? ''?>">
</div>
<div class="col-sm-2">    
    <label class="form-label-sm" for="ZPE">Z P/E</label>
    <input class="form-control form-control-sm zpe-result" type="number" name="Antro[ZPE]"
         id="ZPE" readonly>
</div>
<div class="col-sm-2">    
    <label class="form-label-sm" for="ZTE">Z T/E</label>
    <input class="form-control form-control-sm zte-result" type="number" name="Antro[ZTE]"
         id="ZTE" readonly>
</div>
<div class="col-sm-2">    
    <label class="form-label-sm" for="ZIMCE">Z IMC/E</label>
    <input class="form-control form-control-sm zimce-result" type="number" name="Antro[ZIMCE]"
         id="ZIMCE" readonly>
</div>

<div class="col-sm-12">
    <button class="btn btn-primary" type="submit" id="myButton" name="myButton" value="submit">Guardar</button>
 </div>
 </form>
 </fieldset>
 </div>

 <script>
$(document).ready(function() {
    // Manejar el cambio en el campo de Peso
    $('.peso-input').on('input', function() {
        actualizarResultados();
    });

    // Manejar el cambio en el campo de Talla
    $('.talla-input').on('input', function() {
        actualizarResultados();
    });

    function actualizarResultados() {
        var peso = $('.peso-input').val();
        var talla = $('.talla-input').val();

        // Realizar la solicitud AJAX al servidor
        $.ajax({
            type: 'POST',
            url: '../ClassPart/Controllers/antro.php', // Reemplaza esto con la ruta correcta a tu controlador
            data: {
                Peso: peso,
                Talla: talla
            },
            success: function(response) {
                // Actualizar los campos de resultado con los valores devueltos por el servidor
                $('#ZPE').val(response.ZPE);
                $('#ZTE').val(response.ZTE);
                $('#ZIMCE').val(response.ZIMCE);
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX', error);
            }
        });
    }
});
</script>