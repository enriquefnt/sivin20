<fieldset class="border p-2">
 <legend class="w-80 p-0 h-0 ">Datos prueba
   </legend>

  <form onkeydown="return event.key != 'Enter';" class="row g-3"  action="" method="post" autocomplete="off" >
  <input type="hidden" name="Prueba[idNinio]" id="idNinio" value=<?=$datosPrueba['idNinio'] ?? ''?> >
       
  <div class="col-sm-6">
  	<label class="form-label-sm" for="columna">Nombres</label>
    <input type="text"  class="form-control form-control-sm" name="Prueba[columna]"  autocomplete="off" value="<?=$datosPrueba['columna'] ?? ''?>">
    </div>

    <div class="col-sm-6">
  	<label class="form-label-sm" for="columna">Dni</label>
    <input type="number"  class="form-control form-control-sm" name="Prueba[Dni]"  autocomplete="off" value="<?=$datosPrueba['Dni'] ?? ''?>">
    </div>
    <div class="col-sm-3">
      <button class="btn btn-primary" type="submit" name="submit">Enviar</button>
  </div>
</fieldset>
  </form>
  