

<div style="padding: 7px;">
<input type="button" class="w3-button w3-ripple w3-grey" value="Volver al listado" onClick="history.go(-1);">
</div>
			<table id="example" class="w3-table-all w3-tiny" >
				
	<thead>
  <tr class="w3-blue-grey">
  	<th class="nosort">Fecha</th> 
    <th>Edad</th> 
     <th>Peso</th> 
      <th>Talla</th> 
    <th>Z Peso/edad</th>
    <th>Z Talla/edad</th>
    <th>Z IMC/edad</th>
     <th>Clasificación</th>
    <th>Control Médico</th>
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
  <tr class="w3-hover-pale-green">
    <td align="center"><?= htmlspecialchars($control['Fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
    
    <td ><?= htmlspecialchars($control['años'] .'A ' . $control['meses'] .'M ' . $control['dias'] .'D ', ENT_QUOTES, 'UTF-8'); ?></td>
       <td align="center"><?= htmlspecialchars($control['Peso'], ENT_QUOTES, 'UTF-8'); ?></td>
       <td align="center"><?= htmlspecialchars($control['Talla'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td align="center"><?= htmlspecialchars($control['ZPesoEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td align="center"><?= htmlspecialchars($control['ZTallaEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td align="center"><?= htmlspecialchars($control['ZIMCEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
     <td align="center"><?= htmlspecialchars($control['Clasificacion'], ENT_QUOTES, 'UTF-8'); ?></td>
     <td align="center"><?= htmlspecialchars($control['Médico'], ENT_QUOTES, 'UTF-8'); ?></td>
  	<td align="center"><?= htmlspecialchars($control['vigilante'], ENT_QUOTES, 'UTF-8'); ?></td>
 
   
    </tr>
  <?php endforeach; ?>
  
  
  <?php endif; ?>
  </tbody>
  <h6 style="padding: 7px;">Historial de controles de: <?= htmlspecialchars($control['Nombre'], ENT_QUOTES, 'UTF-8'); ?>  &nbsp; -  &nbsp; Edad Gestacional: <?=$control['EG']?>   &nbsp; 
    Peso al Nacer: <?=$control['pesonac']?>
    &nbsp; 
    Talla al Nacer: <?=$control['tallanac']?>
  </h6>
</table>
	
	
