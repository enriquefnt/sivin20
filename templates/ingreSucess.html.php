<div class="modal" id="SucessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Ingreso de Internacion </h5><br>
      <h5 class="modal-title"><?=$datosNinio['ApeNom'];?> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Edad: <b><?=$datosNinio['edad'];?></b> </p> 
      <p>Fecha: <b><?=date('d/m/Y',strtotime($datosInter['IntFecha']));?></b> </p> 
      <p>Institucion: <b><?=$datosInter['Nombre_aop'];?>  </b>
      <p>Sala: <b><?=$datosInter['Sala'];?>  </b>
          
      </div>
  
 <div class="modal-footer">
           
            
            <div class="col-sm-3">		
            <a href="/ninios/home"  class="btn btn-primary " role="button"><i class="fa-solid fa-check"></i></a>
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
