<div class="container mt-4">
  
  <div>
  <table id="example" class="table table-bordered display compact" > 
  <div>
  <legend class="w-80 p-0 h-0 ">Lista Nominal
       </legend>
</div>
   
  <thead >
  <tr class="w3-blue-grey">
    <th class="nosort">Último registro </th>
    <th>Nombre</th>
    <th>Edad (Último control)</th>
    <th>Edad (Hoy)</th>
    <th>Responsable</th>
   <th>Domicilio</th>
    <th>Tipo</th>
    <!-- <th>Motivo de notificación</th> -->
    <th>Z Peso/edad</th>
    <th>Z Talla/edad</th>
    <th>Z IMC/edad</th>
    <th>Clasificacion</th>
    <!--<th>Ver Evolución</th>
     <th>Clasificación</th>
    <th>Control Médico</th>
    <th>Días sin registros</th>
    <th>Vigilante</th>
    <th>Demora en notificar (Días)</th> -->
  </tr>
  </thead>
  <tbody class="table-hover">
  <?php 

  if(isset($casos)){
  foreach ($casos as $caso): ?>
  <tr >
    <td ><?= htmlspecialchars($caso['Fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
   <td><?= htmlspecialchars($caso['Nombre'], ENT_QUOTES, 'UTF-8'); ?></td>
   <td><?= htmlspecialchars($caso['años'] .'A ' . $caso['meses'] .'M ' . $caso['dias'] .'D ', ENT_QUOTES, 'UTF-8'); ?></td>
   <td><?= htmlspecialchars($caso['añosr'] .'A ' . $caso['mesesr'] .'M ' . $caso['diasr'] .'D ', ENT_QUOTES, 'UTF-8'); ?></td>
   <td><?= htmlspecialchars($caso['Responsable'], ENT_QUOTES, 'UTF-8'); ?></td>
   <td><?= htmlspecialchars($caso['Domicilio'], ENT_QUOTES, 'UTF-8'); ?></td>
   <td><?= htmlspecialchars($caso['Tipo'], ENT_QUOTES, 'UTF-8'); ?></td>
   <!-- <td><?= htmlspecialchars($caso['MotNom'], ENT_QUOTES, 'UTF-8'); ?></td> -->
   <td align="center"><?= htmlspecialchars($caso['ZPesoEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
   <td align="center" ><?= htmlspecialchars($caso['ZTallaEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
   <td align="center"><?= htmlspecialchars($caso['ZIMCEdad'], ENT_QUOTES, 'UTF-8'); ?></td>
   <td><?= htmlspecialchars($caso['Clacificación'], ENT_QUOTES, 'UTF-8'); ?></td>
   
   </tr>
  <?php endforeach;  }?>
    
  </tbody>
  </table>
  </div>