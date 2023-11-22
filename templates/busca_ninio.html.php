


  <div class="container">
    <form class="row g-6" action="" method="post">
        <input type="text" name="label" id="dName" class="form-control form-control-lg">
        <input type="hidden" name="value" id="dValue" value="">
        <button class="btn btn-primary" type="submit" name="submit">Buscar</button>
        <button class="btn btn-success" type="button" id="loadChildForm" style="display:none;">Cargar Ficha Hija</button>
    </form>
</div>

   
 <!-- <script>

var auto_complete = new Autocom(document.getElementById('dName'), {
    data:<?php echo json_encode($data); ?>,
    maximumItems:10,
    highlightTyped:true,
    highlightClass : 'fw-bold text-primary'
}); 

</script>
     -->


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
        // Puedes usar el valor en el campo oculto (IdNiño) para identificar al beneficiario.
        alert('Cargar ficha hija para el IdNiño: ' + document.getElementById('dValue').value);
    });
</script>