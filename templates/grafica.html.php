<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<canvas id="graficoLineas" >Datos de crecimiento</canvas>


    <script>
          console.log(Chart.version);
            const datosRef = <?php echo json_encode($data); ?>;
           console.log(datosRef)

           var tituloY = datosRef.medida;

           const  datosControl = <?php echo json_encode($dataCaso); ?>;
           console.log(datosControl)
           
           const  label = <?php echo json_encode($rotulos); ?>;
               
//         function combineAndSortArrays(array1, array2) {
//             const combinedArray = array1.map((value, index) => {
//             if (index < array2.length) {
//                 return array2[index];
//             } else {
//                 return value;
//             }
//             });
//                 combinedArray.sort((a, b) => a - b);
//                 return combinedArray;
// }
function combineAndSortArrays(array1, array2) {
    const combinedArray = array1.map((value, index) => {
        return (typeof array1[index] !== 'undefined') ? array1[index] : array2[index];
    });
    combinedArray.sort((a, b) => a - b);
    return combinedArray;
}
   
  //  const RefControl = combineAndSortArrays(datosRef.edad, datosControl.edad);
    const labels = combineAndSortArrays(datosControl.edad, label)
    console.log(labels);
   

        const chartData = {
        
        //    labels: datosRef.edad,
        labels: labels,
    
            datasets: [
                {
                    label: datosControl.nombre ,
                    data: datosControl.valor.map((valor, i) => ({
                        x: datosControl.edad[i],
                        y: valor,
                    })),
                    borderColor: 'rgba(0, 0, 255, 100)',
                    backgroundColor: 'rgba(0, 0, 255, 100)',
                    borderWidth: 1.6,
                    pointRadius: 1.3,
                },
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
            label: 'datosRecaso',
            data: datosRef.Caso,
            borderColor: 'rgba(0, 0, 255, 100)',
            backgroundColor: 'rgba(0, 0, 255, 100)',
            borderWidth: 1.6,
            pointRadius: 1.3,
        },
               
            ],
        };
       
    

 //const moment = require('moment');

   
var lastYear = -1; // Último año etiquetado
    var chartOptions = {
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
                
            ticks: {
    callback: function(value, index, values) {
        // Convert days to months
        var meses = value / 30.44;
        // Convert days to years
        var años = Math.floor(value / 365);
        // Determine if it's a new year
        var nuevoAño = años !== lastYear;
        // Update the last labeled year
        lastYear = años;
        // Display only one label per month
        if (meses % 12 === 0 || meses === 0 || nuevoAño) {
          // Display the year if it's a new year
          return meses === 0 ? 'Nacimiento' : años + ' años'
        } else {
          // Display the month number
          return meses % 12 === 0 ? '1 mes' : meses % 12 + ' meses'
        }
      } 
    },

};

    // plugins: {
    //     legend: {
    //         display: true,
    //         position: 'right',
    //        // padding: 20,
    //        maxHeight: 10,
    //         itemSpacing: 4,
    //         reverse: true
    //     }
    // }
    
 
    
 
    const ctx = document.getElementById('graficoLineas').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: chartOptions
    })
    myChart.update('x');
</script>
