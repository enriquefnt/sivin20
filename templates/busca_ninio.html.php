<div class="container">

<fieldset class="border p-2">
 <legend class="w-80 p-0 h-0 ">Buscar 
   </legend>


  <div class="container">
  <form onkeydown="return event.key != 'Enter';" class="row g-3"  action="ninios/ninio"  method="get" onsubmit="myButton.disabled = true; return true;"  autocomplete="off" >
        <input type="text" name="ninio" id="ninio" class="form-control form-control-lg">
        <input type="hidden" name="id" id="idNinio" value="">
        <button class="btn btn-primary" type="submit" name="submit">Buscar</button>
    </form>

    <!-- <form onkeydown="return event.key != 'Enter';" class="row g-3" onsubmit="return updateAction();" autocomplete="off">
    <input type="text" name="ninio" id="ninio" class="form-control form-control-lg">
    <input type="hidden" name="id" id="idNinio" value="">
    <button class="btn btn-primary" type="submit" name="submit">Buscar</button>
</form> -->



</div>
</fieldset>

</div>


  
<script>
  /// Busca el caso
var auto_complete = new Autocom(document.getElementById('ninio'), {
  data: <?php echo json_encode($data); ?>,
  maximumItems: 10,
  highlightTyped: true,
  highlightClass: 'fw-bold text-primary',
  onSelectItem: function(selectedItem) {
    document.getElementById('idNinio').value = selectedItem.value; // Asignar el valor del item seleccionado al input hidden
  }
});
</script>
<!-- <script>
    function updateAction() {
        var idValue = encodeURIComponent(document.getElementById('idNinio').value.trim());
        var newAction = "https://sivin20.v.je/ninios/ninios/ninio?id=" + idValue;
        document.forms[0].action = newAction;
        return true;
    }
</script> -->