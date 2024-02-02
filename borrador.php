<div class="col-sm-2">    
    <label class="form-label-sm" for="FechaNto">Fecha de Nacimiento</label>
    <?php
    // Calcular la fecha correspondiente a 6 años atrás
    $fechaLimite = date('Y-m-d', strtotime('-6 years'));
    ?>
    <input class="form-control form-control-sm" type="date" name="Ninio[FechaNto]" id="FechaNto" required="required" min="<?= $fechaLimite ?>"  max="<?= date('Y-m-d'); ?>"  value="<?= $datosNinio['FechaNto'] ?? '' ?>">
    <span id="fechaError" style="color: red;"></span>
</div>

<script>
document.getElementById('FechaNto').addEventListener('input', function() {
    var inputDate = new Date(this.value);
    var minDate = new Date('<?= $fechaLimite ?>');

    if (inputDate < minDate) {
        document.getElementById('fechaError').textContent = 'La fecha debe ser al menos 6 años atrás.';
    } else {
        document.getElementById('fechaError').textContent = '';
    }
});
</script>
