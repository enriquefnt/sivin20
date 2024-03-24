<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<canvas id="graficoLineas" >Datos de crecimiento</canvas>


    <script>
         
         
          console.log(Chart.version);
            const datosRef = <?php echo json_encode($data); ?>;
          // console.log(datosRef)
           var tituloY = datosRef.medida;
            labels = [];
                // for (let i = 0; i < 1826; i++) {
                // const date = moment().subtract(1826 - i, 'days');
                // labels.push(`${date.format('YYYY')}-${date.format('MM')}`);
                // }
                // labels = datosRef.rotulox;
               // labels=datosRef.edad;
                var edadDias = datosRef.edad;
           console.log(labels);
           console.log(edadDias);
           function calcularRotulo(edadDias) {
  switch (edadDias) {
    case 0:
      return "Nacimiento";
    case 366:
      return "1 año";
    case (edadDias / 365.25) % 1 === 0:
      return `${Math.floor(edadDias / 365.25)} años`;
    case (edadDias / 30.44) % 1 === 0:
      return `${Math.floor(edadDias / 30.44) - Math.floor(edadDias / 365.25) * 12} meses`;
    default:
      return '';
  }
}

        const chartData = {
       //     labels:labels,
      //  labels: datosRef.rotulox,
       //  labels: datosRef.edad,
    
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
            label: datosRef.nombre,
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
    //  labels: datosRef.rotulox,  
   // type: 'category',
   labels: labels,
      min: 0,
      max: Math.max(...datosRef.edad),
      ticks: { callback: function (value, index, values) {
             const days = values[index];
              return calcularRotulo(days); } },
      grid: { display: true },
    
      title: {
        display: true,
        text: 'Edad (meses y años)'
      }
      
    }
  },
  plugins: {
    legend: {
      display: true,
      position: 'top'
    }
  }
};

const ctx = document.getElementById('graficoLineas').getContext('2d');

datosRef.edad.forEach((valor, indice) => {
  chartData.datasets.forEach(dataset => {
    dataset.data[indice] = dataset.data[indice] || 0; // Inicializa el valor si es undefined
  });
});

// const myChart = new Chart(ctx, {
//   type: 'line',
//   data: chartData,
//   options: chartOptions
// });

const chart = new Chart(ctx, {
  type: 'line',
  data: chartData,
  options:chartOptions
});



</script>
<!-- <script> 
 const chart = new Chart(ctx, { 
  type: 'line',
  data: chartData, 
  options: { 
    scales: { 
      x: { 
        type: 'linear', 
        labels: labels, 
        min: 0, 
        title: { 
          display: true, 
          text: 'Edad (meses y años)' }, 
          ticks: { callback: function (value, index, values) {
             const days = values[index];
              return calcularRotulo(days); } } } },
               plugins: { 
                legend: { 
                  display: true, 
                  position: 'right' } 
                  } } });
                   // ... (remaining code) </script> -->