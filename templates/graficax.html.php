<canvas id="graficoLineas" width="400" height="100">
    <p>Datos de crecimiento</p>
</canvas>

<!-- <div class="chart-container" style="position: relative; height:40vh; width:80vw">
    <canvas id="graficoLineas">
    <p>Datos de crecimiento</p>
    </canvas>
</div> -->



<script>
const datosRef = <?php echo json_encode($data); ?>;
        //   console.log(datosRef)

</script>

<script type="module" src="\grafica.js"></script>

