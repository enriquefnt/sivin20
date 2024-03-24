<canvas id="graficoLineas"></canvas>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script>
console.log(Chart.version);
            const datosRef = <?php echo json_encode($data); ?>;
           console.log(datosRef)
           var tituloY = datosRef.medida;





    const ctx = document.getElementById('graficoLineas').getContext('2d');
    let chart = new Chart(ctx, {
  type: 'bar',
  data: {
    datasets: [{
      yAxisID: 'yAxis'
    }]
  },
  options: {
    scales: {
      xAxis: {
        // The axis for this scale is determined from the first letter of the id as `'x'`
        // It is recommended to specify `position` and / or `axis` explicitly.
        type: 'time',
      }
    }
  }
});
</script>
