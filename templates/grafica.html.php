<canvas id="graficoLineas" >Datos de crecimiento</canvas>


    <script>
          console.log(Chart.version);
            const datosRef = <?php echo json_encode($data); ?>;
         //  console.log(datosRef)

           const  datosControl = <?php echo json_encode($dataCaso); ?>;
           console.log(datosControl)
           var tituloY = datosRef.medida;

               
        function combineAndSortArrays(array1, array2) {
            const combinedArray = array1.map((value, index) => {
            if (index < array2.length) {
                return array2[index];
            } else {
                return value;
            }
            });
                combinedArray.sort((a, b) => a - b);
                return combinedArray;
}
// function combineAndSortArrays(array1, array2) {
//     const combinedArray = array1.map((value, index) => {
//         return (typeof array1[index] !== 'undefined') ? array1[index] : array2[index];
//     });
//     combinedArray.sort((a, b) => a - b);
//     return combinedArray;
// }
   
    const labels = combineAndSortArrays(datosRef.edad, datosControl.edad);
    console.log(labels);
   

        const chartData = {
        
         //  labels: labels,
    
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
               
            ],
        };
       
    

 
   
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
                type: 'category',
              labels: labels,
           
                min: 0,
                max: Math.max(...datosRef.edad),
                          
                title: {
                    display: true,
                    text: 'Edad (meses y años)' 
                },


ticks: {
    
    callback: function(value, index, values) {
        //mes= labels/30.44;
        // Convertir días a meses
        var meses = value;
        
        // Convertir dias a años
        var años = Math.floor(value/ 12);
        
        // Determinar si es un nuevo año
        var nuevoAño = años !== lastYear;
        
        // Actualizar el último año etiquetado
        lastYear = años;
        
        // Mostrar solo un marcador por cada mes
        if (meses % 12 === 0 || meses === 0 || nuevoAño) {
          // Años completos
          return meses === 0 ? 'Nacimiento' : años + ' años';
        } else {
          // Meses dentro de un año
          return meses % 12 === 0 ? '1 año' : meses % 12;
        }
      }
            },          
        }
    
    },

   

    plugins: {
        legend: {
            display: true,
            position: 'right',
           // padding: 20,
           maxHeight: 10,
            itemSpacing: 4,
            reverse: true
        }
    }
    
    };
    
 
    const ctx = document.getElementById('graficoLineas').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: chartOptions
    })
    myChart.update('x');
</script>
