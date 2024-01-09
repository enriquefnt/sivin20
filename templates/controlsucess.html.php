<div class="modal" id="SucessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Control de <?=$datosNinio['ApeNom'];?> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Edad: <?=$datosNinio['edad'];?> </p> 
        <p>Lugar: <b><?= $datosDomi['ResiLocal'];?></b> </p> 
        <p>Fecha: <b><?=date('d/m/Y',strtotime($Control['CtrolFecha']));?></b> </p> 
               <p>Peso: <b><?=$Control['CtrolPeso'];?> kg </b>
            Talla: <b><?=$Control['CtrolTalla'];?> cm</b></p>

            <p> ZPE/E=<span style="color:<?=$Control['colorPE']; ?>">
            <?= number_format($Control['CtrolZp'], 1); ?> </span> - 


            ZTA/E=<span style="color:<?=$Control['colorTA']; ?>">
            <?= number_format($Control['CtrolZt'], 1); ?> </span> - 

            ZIMC/E= <span style="color:<?=$Control['colorIMC']; ?>">
            <?= number_format($Control['CtrolZimc'], 1); ?> </span></p>
</div>
      </div>
 <div class="modal-footer">
           
           
            <a href="/ninios/home"  class="btn btn-primary btn-sm" role="button">Salir</a>
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
