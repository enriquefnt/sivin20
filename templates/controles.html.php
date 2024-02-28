
<div class="container mt-4">
<div style="padding: 7px;">
<input type="button" class="w3-button w3-ripple w3-grey" value="Volver al listado" onClick="history.go(-1);">
<!-- <input type="button" class="w3-button w3-ripple w3-grey" href="/lista/grafico?indicador=PE&caso="<?= $datosNinio['IdNinio']; ?> value="Peso/Edad"> -->
<input type="button" class="w3-button w3-ripple w3-grey" onclick="location.href='/lista/grafico?indicador=PE&caso=<?= $datosNinio['IdNinio']; ?>';" value="Peso/Edad">
</div>
<table id="example" class="table table-striped table-sm text-xs table-condensed small" data-searchbuilder="true" style="width:100%">
				
	<thead>
  <tr>
  	<th class="nosort">Fecha</th> 
    <th>Edad</th> 
     <th>Peso</th> 
      <th>Talla</th> 
    <th>Z Peso/edad</th>
    <th>Z Talla/edad</th>
    <th>Z IMC/edad</th>
     <th>Clasificación</th>
        <th>Vigilante</th>
  </tr>
  </thead>
  <tbody>
  <?php if (isset($error)): ?>

			<p>
				<?php echo $error; ?>
			</p>

		<?php else: ?>
		
			
	<?php foreach ($datosControl as $control): ?>
  <tr>
    <td align="center"><?= htmlspecialchars($control['Fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
    
    <td ><?= htmlspecialchars($control['años'] .'A ' . $control['meses'] .'M ' . $control['dias'] .'D ', ENT_QUOTES, 'UTF-8'); ?></td>
       <td align="center"><?= htmlspecialchars($control['Peso'], ENT_QUOTES, 'UTF-8'); ?></td>
       <td align="center"><?= htmlspecialchars($control['Talla'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td align="center"><?= htmlspecialchars($control['ZPesoEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td align="center"><?= htmlspecialchars($control['ZTallaEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td align="center"><?= htmlspecialchars($control['ZIMCEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
     <td align="center"><?= htmlspecialchars($control['Clasificacion'], ENT_QUOTES, 'UTF-8'); ?></td>
     	<td align="center"><?= htmlspecialchars($control['vigilante'], ENT_QUOTES, 'UTF-8'); ?></td>
 
   
    </tr>
  <?php endforeach; ?>
  
  
  <?php endif; ?>
  </tbody>
  <h6 style="padding: 4px;">Historial de controles de: <?= htmlspecialchars($control['Nombre'], ENT_QUOTES, 'UTF-8'); ?>  &nbsp; -  &nbsp; Edad Gestacional: <?=$control['EG']?>   &nbsp; 
    Peso al Nacer: <?=$control['pesonac']?>
    &nbsp; 
    Talla al Nacer: <?=$control['tallanac']?>
    &nbsp; 
  </h6>
  
</table>
</div>
	
