
<canvas id="graficoZ"></canvas>
<script>
  //  import Chart from 'chart.js/auto';
var datos = <?php echo json_encode($data); ?>;
console.log(datos); // Verificar los datos en la consola del navegador
</script>


<script>
    var chartData = {
    labels: datos.edad, // Edad en días
    datasets: [
        {
            label: '-3Z',
            data: datos.SD3neg,
            borderWidth: 1.6, // Grosor de la línea
            borderColor:'rgba(0, 0, 0, 100)', // Transparente
            backgroundColor:'rgba(0, 0, 0, 100)', 

            pointRadius: 0
           
        },
        {
            label: '-2Z',
            data: datos.SD2neg,
            backgroundColor:'rgba(255, 0, 0 ,100)', 
            borderColor: 'rgba(255, 0, 0 ,100)', // Color de la línea
            borderWidth:1.6 ,// Grosor de la línea
            pointRadius: 0
        },
        {
            label: '-1Z',
            data: datos.SD1neg,
            borderColor: 'rgba(243, 226, 0,100)',
            backgroundColor:'rgba(243, 226, 0,100)', 
            borderWidth: 1.6,// Grosor de la línea
            pointRadius: 0
        },
        {
            label: '0Z',
            data: datos.SD0,
            borderColor: 'rgba(204, 216, 255,100)',
            backgroundColor:'rgba(204, 216, 255,100)', 
            borderWidth: 1.6,
            pointRadius: 0
        },
        {
            label: '1Z',
            data: datos.SD1,
            borderColor: 'rgba(243, 226, 0,100)',
            backgroundColor:'rgba(243, 226, 0,100)', 
            borderWidth: 1.6,// Grosor de la línea
            pointRadius: 0
        },
        {
            label: '2Z',
            data: datos.SD2,
            backgroundColor:'rgba(255, 0, 0 ,100)', 
            borderColor: 'rgba(255, 0, 0 ,100)', // Color de la línea
            borderWidth: 1.6,
            pointRadius: 0
        },
        {
            label: '3Z',
            data: datos.SD3,
            borderColor:'rgba(0, 0, 0, 100)', // Transparente
            backgroundColor:'rgba(0, 0, 0, 100)', 
            borderWidth: 1.6,// Grosor de la línea
            pointRadius: 0
        },
        
    ]
};

var chartOptions = {
    scales: {
        y: {
            title: {
                display: true,
                text: 'Medida' // Título del eje Y
            }
        },
        x: {
            title: {
                display: true,
                text: 'Edad (meses y años)' // Título del eje X
            },
            ticks: {
                callback: function(value, index, values) {
                    // Calcular la edad en meses y años
                    var days = value;
                    var months = Math.floor(days / 30);
                    var years = Math.floor(months / 12);
                    months %= 12;

                    // Devolver el valor formateado
                    if (years > 0) {
                        return years + ' años, ' + months + ' meses';
                    } else if (months > 0) {
                        return months + ' meses';
                    } else {
                        return days + ' días';
                    }
                }
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








// //Configurar opciones de Chart.js
// var chartOptions = {
//     scales: {
//         y: {
//             title: {
//                 display: true,
//                 text: 'Medida' // Título del eje Y
//             }
//         },
//         x: {
//             title: {
//                 display: true,
//                 text: 'Edad (días)' // Título del eje X
//             }
//         }
//     },
//     plugins: {
//         legend: {
//             display: true,
//             position: 'top'
//         }
//     }
// };

// var lastMonth = -1; // Último mes etiquetado

// var chartOptions = {
//     scales: {
//         y: {
//             title: {
//                 display: true,
//                 text: 'Medida' // Título del eje Y
//             }
//         },
//         x: {
//             title: {
//                 display: true,
//                 text: 'Edad (meses)' // Título del eje X
//             },
//             ticks: {
//                 callback: function(value, index, values) {
//                     // Convertir días a meses
//                     var meses = Math.floor(value / 30);
                    
//                     // Determinar si es un nuevo mes
//                     var nuevoMes = meses !== lastMonth;
                    
//                     // Actualizar el último mes etiquetado
//                     lastMonth = meses;
                    
//                     // Mostrar solo un marcador por cada mes
//                     if (nuevoMes) {
//                         // Mostrar solo los meses completos
//                         if (meses % 12 === 0 || meses === 0) {
//                             // Años completos
//                             return meses === 0 ? 'Nacimiento' : meses / 12 + ' años';
//                         } else {
//                             // Meses dentro de un año
//                             return meses % 12 + '';
//                         }
//                     } else {
//                         return ''; // No mostrar el marcador si ya se ha etiquetado este mes
//                     }
//                 }
//             }
//         }
//     },
//     plugins: {
//         legend: {
//             display: true,
//             position: 'top'
//         }
//     }
// };




// Crear el gráfico con Chart.js
var ctx = document.getElementById('graficoZ').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: chartData,
    options: chartOptions
});
</script>