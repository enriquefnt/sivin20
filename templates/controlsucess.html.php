

<div class="modal" id="SucessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Control de <?=$datosNinio['ApeNom'];?> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Edad: <b><?=$datosNinio['edad'];?></b> </p> 
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
  
 <div class="modal-footer">
           
            <div class="col-sm-3">		
            <a href="/interna/inter?id=<?= $datosNinio['IdNinio'] ?? '' ?>&idNoti=<?=$notificacion['IdNotifica'] ?? '' ?>&tabla=ingreso" class="btn btn-primary" role="button">Internación</a>
            <!-- <a href="/noticon/noti?id=<?= $datosCaso['IdNinio'] ?? '' ?>&tabla=notificacion" class="btn btn-primary" role="button">Notificar</a> -->

            </div>	
            <div class="col-sm-3">		
            <a href="/ninios/home"  class="btn btn-primary " role="button">Salir</a>
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
