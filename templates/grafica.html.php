<canvas id="graficoLineas" >Datos de crecimiento</canvas>


    <script>
        console.log(Chart.version);
            const datosRef = <?php echo json_encode($data); ?>;
           console.log(datosRef)

           const  datosControl = <?php echo json_encode($dataCaso); ?>;
           console.log(datosControl)
           var tituloY = datosRef.medida;
    
       

        const chartData = {
         labels: datosRef.edad,
        //  labels: datosRef.edad.map(age => age.toString()), 
            datasets: [
                {
                    label: 'Caso control',
                    data: datosControl.valor.map((valor, i) => ({
                        x: datosControl.edad[i],
                        y: valor,
                    })),
                    borderColor:'rgba(0, 0, 255, 100)', 
                    backgroundColor:'rgba(0, 0, 255, 100)', 
                    borderWidth: 1.6,
                    pointRadius: 1.3,
                },
                    {
                    label: '-3Z',
                    data: datosRef.SD3neg,
                    borderWidth: 1.6, // Grosor de la línea
                    borderColor: 'rgba(0, 0, 0, 100)', // Transparente
                    backgroundColor: 'rgba(0, 0, 0, 100)',
                    pointRadius: 0
                },
                    {
                    label: '-2Z',
                    data: datosRef.SD2neg,
                    backgroundColor:'rgba(255, 0, 0 ,100)', 
                    borderColor: 'rgba(255, 0, 0 ,100)', // Color de la línea
                    borderWidth:1.6 ,// Grosor de la línea
                    pointRadius: 0
                },
                {
                    label: '-1Z',
                    data: datosRef.SD1neg,
                    borderColor: 'rgba(243, 226, 0,100)',
                    backgroundColor:'rgba(243, 226, 0,100)', 
                    borderWidth: 1.6,// Grosor de la línea
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
            borderWidth: 1.6,// Grosor de la línea
            pointRadius: 0
        },
        {
            label: '2Z',
            data: datosRef.SD2,
            backgroundColor:'rgba(255, 0, 0 ,100)', 
            borderColor: 'rgba(255, 0, 0 ,100)', // Color de la línea
            borderWidth: 1.6,
            pointRadius: 0
        },
        {
            label: '3Z',
            data: datosRef.SD3,
            borderWidth: 1.6, // Grosor de la línea
            borderColor: 'rgba(0, 0, 0, 100)', // Transparente
            backgroundColor: 'rgba(0, 0, 0, 100)',
            pointRadius: 0
        },
               
            ],
        };
       
    

        const ctx = document.getElementById('graficoLineas').getContext('2d');



     //   var lastYear = -1; // Último año etiquetado
const myChart = new Chart(ctx, {
    type: 'line',
    data: chartData,
    options: {
        scales: {
            y: {
                title: {
                    display: true,
                    text: tituloY,
                },
            },
            x: {
                type: 'linear',
                position: 'bottom',
                min: 0,
             //   max: 1846,
                title: {
                    display: true,
                    text: 'Edad'
                },
                
                ticks: {
                callback: function(value, index, values) {
                    var lastYear = -1; // Último año etiquetado
                    // Convertir días a meses
                    var dias = value;
                    var meses = Math.floor(dias / 30); // Redondea hacia abajo para obtener el número entero de meses
                    // Convertir meses a años
                    var años = Math.floor(meses / 12);
                    
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
                        return meses % 12 === 0 ? '1 año' : meses % 12 + ' meses';
        }
    }
}
        // plugins: {
        //     legend: {
        //         display: true,
        //         position: 'right',
        //     },
        // },
    },
}
    }
});
    </script>