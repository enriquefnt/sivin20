
<div class="modal" id="SucessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Se ha registrado correctamente el beneficiario </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <p>Seleccione cargar una notificación a <b><?=$datosCaso['nombres'].' '.$datosCaso['apellido']?></b> o salga al inicio.</p> -->
      </div>
 <div class="modal-footer">
                <a href="/noticon/noti?id=<?=$datosCaso['IdNinio']?? ''?>"  class="btn btn-primary btn-sm" role="button">Notificación</a>
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