<canvas id="graficoZ"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    var datos = <?php echo json_encode($data); ?>;
    // Si los datos de edad están en formato string, convertirlos a número
    //datos.edad = datos.edad.map(Number);
    console.log(datos); // Verificar los datos en la consola del navegador

    var tituloY = datos.medida;
    console.log(tituloY);
</script>

<script>
    var chartData = {
        labels: datos.edad, // Edad en días
        datasets: [
            {
                label: '-3Z',
                data: datos.SD3neg,
                borderWidth: 1.6, // Grosor de la línea
                borderColor: 'rgba(0, 0, 0, 100)', // Transparente
                backgroundColor: 'rgba(0, 0, 0, 100)',

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
var lastYear = -1; // Último año etiquetado
    var chartOptions = {
        scales: {
            y: {
                title: {
                    display: true,
                   // text: String(datos.tabla),
                   // text: obtenerTitulo(),
                    text: tituloY
                    //text: 'Medida' // Título del eje Y
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Edad (meses y años)' // Título del eje X
                },



ticks: {
                callback: function(value, index, values) {
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


            min: 0,
            max: Math.max(...datos.edad)
        }
    
    },

    }



    plugins: {
        legend: {
            display: true
            position: 'top'
        }
    }
       
      
    
    // Crear el gráfico con Chart.js
    var ctx = document.getElementById('graficoZ').getContext('2d')
    var myChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: chartOptions
    })
</script>