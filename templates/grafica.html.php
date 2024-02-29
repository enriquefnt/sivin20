<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<canvas id="graficoLineas" >Datos de crecimiento</canvas>


    <script>
         
         
          console.log(Chart.version);
            const datosRef = <?php echo json_encode($data); ?>;
           console.log(datosRef)
           var tituloY = datosRef.medida;

        const chartData = {
        
           labels: datosRef.edad,
    
            datasets: [
             
              {
                label: '-3Z',
                data: datosRef.SD3neg,
                borderWidth: 1.6, // Grosor de la línea
                borderColor: 'rgba(0, 0, 0, 100)', 
                backgroundColor: 'rgba(0, 0, 0, 100)',
                pointRadius: 0
               },
               {
                label: '-2Z',
                data: datosRef.SD2neg,
                backgroundColor:'rgba(255, 0, 0 ,100)', 
                borderColor: 'rgba(255, 0, 0 ,100)', 
                borderWidth:1.6 ,
                pointRadius: 0
                },
                {
                    label: '-1Z',
                    data: datosRef.SD1neg,
                    borderColor: 'rgba(243, 226, 0,100)',
                    backgroundColor:'rgba(243, 226, 0,100)', 
                    borderWidth: 1.6,
                    pointRadius: 0
                },
                {
            label: '0Z',
            data: datosRef.SD0,
            borderColor: 'rgba(204, 216, 255,100)',
            backgroundColor:'rgba(204, 216, 255,100)', 
            borderWidth: 1.6,
            pointRadius: 0
        },
        {
            label: '1Z',
            data: datosRef.SD1,
            borderColor: 'rgba(243, 226, 0,100)',
            backgroundColor:'rgba(243, 226, 0,100)', 
            borderWidth: 1.6,
            pointRadius: 0
        },
        {
            label: '2Z',
            data: datosRef.SD2,
            backgroundColor:'rgba(255, 0, 0 ,100)', 
            borderColor: 'rgba(255, 0, 0 ,100)', 
            borderWidth: 1.6,
            pointRadius: 0
        },
        {
            label: '3Z',
            data: datosRef.SD3,
            borderWidth: 1.6, 
            borderColor: 'rgba(0, 0, 0, 100)', // Transparente
            backgroundColor: 'rgba(0, 0, 0, 100)',
            pointRadius: 0
        },
        {
            label: 'datosRef.nombre',
            data: datosRef.Caso,
            type: 'line', // <-- Cambiar a "scatter"
            borderColor: 'rgba(0, 0, 255, 100)',
            backgroundColor: 'rgba(0, 0, 255, 100)',
            borderWidth: 1.6,
            pointRadius: 1.3,
        },
               
            ],
        };
       
        var lastYear = -1; // Último año etiquetado
        const chartOptions = {
            responsive: true,
  scales: {
    y: {
      title: {
        display: true,
        text: tituloY   
      }
    },
    x: {
      type: 'linear',
      labels: datosRef.edad,  
      min: 0,
      max: Math.max(...datosRef.edad),
      title: {
        display: true,
        text: 'Edad (meses y años)'
      }
    }
  },
  plugins: {
    legend: {
      display: true,
      position: 'right'
    }
  }
};

const ctx = document.getElementById('graficoLineas').getContext('2d');
const myChart = new Chart(ctx, {
  type: 'line',
  data: chartData,
  options: chartOptions
});
</script>
