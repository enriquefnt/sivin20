
<canvas id="miGrafico"></canvas>



<script>
  //  import Chart from 'chart.js/auto';
var datos = <?php echo json_encode($data); ?>;
console.log(datos); // Verificar los datos en la consola del navegador
</script>
<script>
var ctx = document.getElementById('miGrafico').getContext('2d');
var miGrafico = new Chart(ctx, {
    type: 'line',
    data: {
        labels: datos.edades.map(Number), // Convertir las etiquetas a números
        datasets: [{
            label: 'Pesos de los niños',
            data: datos.pesos,
            borderColor: 'blue',
            borderWidth: 1
        }]
    },
    options: {
  scales: {
    x: {
      type: 'linear',
      min: Math.min(...datos.edades) - 5 , // Valor mínimo de las edades
      max: Math.max(...datos.edades) +5 , // Valor máximo de las edades
    },
    y: {
      beginAtZero: true
    }
  }
}
});
</script>
