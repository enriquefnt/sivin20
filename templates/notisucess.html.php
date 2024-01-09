
<div class="modal" id="SucessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Se notifico a <?=$datosNinio['ApeNom'];?> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Edad: <?=$datosNinio['edad'];?> </p> 
        <p>Lugar: <?='Localidad: '. $datosDomi['ResiLocal'];?> </p> 
        <p>Peso: <?=$Notificacion['NotPeso'];?> kg 
            Talla: <?=$Notificacion['NotTalla'];?> cm</p>
        <p> ZPE/E=<?=number_format($Notificacion['NotZpe'], 1) ??'';?> -
            ZTA/E=<?=number_format($Notificacion['NotZta'], 1);?> -
            ZIMC/E=<?=number_format($Notificacion['NotZimc'], 1);?> </p> 
        <!-- <p>    <span style="color: <?=$Notificacion['colorIMC']; ?>"> -->
        <p>    <span style="color:<?=$Notificacion['colorIMC']; ?>">
        <?= number_format($Notificacion['NotZimc'], 1); ?> </span></p>
    
      </div>
 <div class="modal-footer">
           
           
            <a href="/ninios/home"  class="btn btn-primary btn-sm" role="button">Salir</a>
      </div> 
    </div>
  </div>
</div>
<?=$Notificacion['colorIMC']; ?>
<script type="text/javascript">

$(document).ready(function() {$('#SucessModal').modal('show');
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});
</script>
