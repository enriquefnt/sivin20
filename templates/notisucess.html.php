
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

            <p> ZPE/E=<span style="color:<?=$Notificacion['colorPE']; ?>">
            <?= number_format($Notificacion['NotZpe'], 1); ?> </span> - 


            ZTA/E=<span style="color:<?=$Notificacion['colorTA']; ?>">
            <?= number_format($Notificacion['NotZta'], 1); ?> </span> - 

            ZIMC/E= <span style="color:<?=$Notificacion['colorIMC']; ?>">
            <?= number_format($Notificacion['NotZimc'], 1); ?> </span></p>

      </div>
 <div class="modal-footer">
           
 
          <div class="col-sm-3">
            <a href="/interna/inter?id=<?= $datosNinio['IdNinio'] ?? '' ?>&idNoti=<?=$notificacion['IdNotifica'] ?? '' ?>&tabla=ingreso" class="btn btn-primary" role="button">Internación</a>
            </div>	
            <div class="col-sm-3">		
            <a href="/ninios/home"  class="btn btn-primary " role="button">Guardar</a>
            </div>	

      </div> 
    </div>
  </div>
</div>

<script type="text/javascript">

$(document).ready(function() {$('#SucessModal').modal('show');
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});
</script>
