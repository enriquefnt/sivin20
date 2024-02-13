

<canvas id="grafico"></canvas>

<script>
var ctx = document.getElementById('grafico').getContext('2d');
datos = <?php echo json_encode($data); ?>;
var miGrafico = new Chart(ctx, {
    type: 'line',
    data: {
        labels: datos.edades.map(String),
        datasets: [{
            label: 'Pesos de los niños',
            data: datos.peso,
            borderColor: 'blue',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                min: 0,
                 max: 10 // Este valor debería ser ajustado según el rango de tus datos de pesos
            }
        }
    }
});
</script>


