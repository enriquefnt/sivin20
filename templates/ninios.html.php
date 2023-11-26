<!-- <div class="container">
    <form class="row g-4" action="ninio" method="post">
    <div class="col-sm-4">
    <label class="form-label-sm" for="ApeNom">Buscar por nombre</label>
        <input class="form-control form-control-sm" type="text" name="label" id="dName" class="form-control form-control-lg">
        <input type="hidden" name="value" id="dValue" value="">
        <button class="btn btn-primary" type="submit" name="submit">Buscar</button>
    </div>
    </form>
</div> -->


	
<div class="container">
<form onkeydown="return event.key != 'Enter';" class="row g-3"  action=""  onsubmit="myButton.disabled = true; return true;" method="post" autocomplete="off" >
		<h5>Datos personales</h5>
	
	<input type="hidden" name="Ninio[IdNinio]" value="<?=$datosNinio['IdNinio'] ?? ''?>">
        
<div class="col-sm-6">	
			<label class="form-label-sm" for="ApeNom">Apellido y Nombre</label>
			<input class="form-control form-control-sm" type="text" name="Ninio[ApeNom]" id="ApeNom" required="required" value="<?=$datosNinio['ApeNom'] ?? ''?>">
</div>

<div class="col-sm-3">	
			<label class="form-label-sm" for="Dni">DNI</label>
			<input class="form-control form-control-sm" type="number" name="Ninio[Dni]" id="Dni" required="required" value="<?=$datosNinio['Dni'] ?? ''?>">
</div>

<div class="col-sm-3">	
			<label class="form-label-sm" for="FechaNto">Fecha de Nacimiento</label>
			<input class="form-control form-control-sm" type="date" name="Ninio[FechaNto]" id="FechaNto" required="required" value="<?=$datosNinio['FechaNto'] ?? ''?>">
</div>
<div class="col-sm-4">	
			<label class="form-label-sm" for="Sexo">Sexo</label>
			<input class="form-control form-control-sm" type="text" name="Ninio[Sexo]" id="Sexo" required="required" value="<?=$datosNinio['Sexo'] ?? ''?>">
</div>
<div class="col-sm-4">	
			<label class="form-label-sm" for="Sexo">Etnia</label>
			<input class="form-control form-control-sm" type="number" name="Ninio[TpoEtnia]" id="Etnia" required="required" value="<?=$datosNinio['TpoEtnia'] ?? ''?>">
</div>

<button class="btn btn-primary" type="submit" name="submit">Cargar</button>
        
        </form>
   
     


     <script>
    var auto_complete = new Autocom(document.getElementById('dName'), {
        data:<?php echo json_encode($data); ?>,
        maximumItems: 10,
        highlightTyped: true,
        highlightClass: 'fw-bold text-primary'
    });

    document.getElementById('dName').addEventListener('input', function () {
        document.getElementById('dValue').value = ''; // Limpiar el valor al cambiar la entrada
        document.getElementById('loadChildForm').style.display = 'none'; // Ocultar el botón
    });

    document.getElementById('dName').addEventListener('autocom:selected', function (e) {
        document.getElementById('dValue').value = e.detail.value;
        document.getElementById('loadChildForm').style.display = 'block'; // Mostrar el botón
    });

    document.getElementById('loadChildForm').addEventListener('click', function () {
        // Aquí puedes redirigir o realizar otras acciones para cargar la ficha hija.
        // Puedes usar el valor en el campo oculto (IdNiño) para identificar al Ninio.
        alert('Cargar ficha hija para el IdNiño: ' + document.getElementById('dValue').value);
    });
</script>