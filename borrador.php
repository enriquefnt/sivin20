

<div class="col-sm-4">
    <label class="form-label-sm" for="diag_egr">Diagnósticos de egreso</label>
    <input type="text" id="diag_egr" class="form-control form-control-sm" placeholder="Ingrese diagnóstico" /><br>
    <input type="button" value="Agregar diagnóstico" id="agregar-diag_egr" class="btn btn-primary" />
    <ul id="lista-diagnosticos"></ul>
    <input type="hidden" name="NOTIINTERNADOS[diag_egr][]" id="hidden-diag_egr" value="" />
</div>

  <div class="col-sm-4">
  <ul id="lista-diag_egr"></ul> 
  </div> 

  <script>
$(document).ready(function() {
  
    $("#agregar-diag_egr").click(function() {
        var diag_egr = $("#diag_egr").val();
        NOTIINTERNADOS.diag_egr.push(diag_egr);
        $("#lista-diag_egr").append("<li>" + diag_egr + "</li>");
        $("#diag_egr").val("");

        $("#hidden-diag_egr").val(NOTIINTERNADOS.diag_egr.join(','));
    });
});
</script>

<div class="col-sm-4">
    <label class="form-label-sm" for="diag_egr">Diagnósticos de egreso</label>
    <input type="text" id="diag_egr" class="form-control form-control-sm" placeholder="Ingrese diagnóstico" /><br>
    <input type="button" value="Agregar diagnóstico" id="agregar-diag_egr" class="btn btn-primary" />
    <ul id="lista-diagnosticos"></ul>
    <input type="hidden" name="NOTIINTERNADOS[diag_egr][]" id="hidden-diag_egr" value="" />
</div>

  <div class="col-sm-4">
  <ul id="lista-diag_egr"></ul> 
  </div> 

  <script>
$(document).ready(function() {
  
    $("#agregar-diag_egr").click(function() {
        var diag_egr = $("#diag_egr").val();
        NOTIINTERNADOS.diag_egr.push(diag_egr);
        $("#lista-diag_egr").append("<li>" + diag_egr + "</li>");
        $("#diag_egr").val("");

        $("#hidden-diag_egr").val(NOTIINTERNADOS.diag_egr.join(','));
    });
});
</script>

<div class="col-sm-4">
    <label class="form-label-sm" for="diag_egr">Diagnósticos de egreso</label>
    <input type="text" id="diag_egr" class="form-control form-control-sm" placeholder="Ingrese diagnóstico" /><br>
    <input type="button" value="Agregar diagnóstico" id="agregar-diag_egr" class="btn btn-primary" />
    <ul id="lista-diagnosticos"></ul>
    <input type="hidden" name="NOTIINTERNADOS[diag_egr][]" id="hidden-diag_egr" value="" />
</div>

  <div class="col-sm-4">
  <ul id="lista-diag_egr"></ul> 
  </div> 

  <script>
$(document).ready(function() {
  
    $("#agregar-diag_egr").click(function() {
        var diag_egr = $("#diag_egr").val();
        NOTIINTERNADOS.diag_egr.push(diag_egr);
        $("#lista-diag_egr").append("<li>" + diag_egr + "</li>");
        $("#diag_egr").val("");

        $("#hidden-diag_egr").val(NOTIINTERNADOS.diag_egr.join(','));
    });
});
</script>

