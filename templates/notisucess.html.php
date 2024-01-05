<div class="modal" id="SucessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Se notifico a <?=$datosNinio['ApeNom'].' - '.$datosNinio['edad'] ;?> </h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Edad: <?=$datosNinio['edad'].' '.$Notificacion['NotZta'];?> </p> 
        <p>Lugar: <?='Localidad: '. $datosDomi['ResiLocal'];?> </p> 
        <p>Peso: <?=$Notificacion['NotPeso'];?> kg 
            Talla: <?=$Notificacion['NotTalla'];?> cm</p>
        <p> ZPE/E=<?=number_format($Notificacion['NotZpe'], 1);?> -
            ZTA/E=<?=number_format($Notificacion['NotZta'], 1);?> -
            ZIMC/E=<?=number_format($Notificacion['NotZimc'], 1);?> </p> 
      </div>
      <!-- <p>
    ZPE/E:
    <span style="color: <?= $this->obtenerColor($Notificacion['NotZpe']); ?>">
        <?= number_format($Notificacion['NotZpe'], 1); ?>
    </span> -

    ZTA/E:
    <span style="color: <?= $this->obtenerColor($Notificacion['NotZta']); ?>">
        <?= number_format($Notificacion['NotZta'], 1); ?>
    </span> -

    ZIMC/E:
    <span style="color: <?= $this->obtenerColor($Notificacion['NotZimc']); ?>">
        <?= number_format($Notificacion['NotZimc'], 1); ?>
    </span>
</p> -->







 <div class="modal-footer">
                <a href="/noticon/noti?id=<?=$Notificacion['NotNinio']?? ''?>"  class="btn btn-primary btn-sm" role="button">Revisar</a>
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

