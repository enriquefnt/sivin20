<canvas id="graficoLineas" ></canvas>


    <script>
            const datosRef = <?php echo json_encode($data); ?>;
           console.log(datosRef)

           const  datosControl = <?php echo json_encode($dataCaso); ?>;
           console.log(datosControl)
         
    
        // const datosControl = {
        //     edad: [330 ,402.5, 815,950],
        //     valor: [8,9.6, 12.5, 13.8],
        // };

        const chartData = {
            labels: datosRef.edad,
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

        const chartOptions = {
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Peso (kg)',
                    },
                },
                x: {
                type: 'linear', // Configurar la escala x como lineal
                position: 'bottom', // Posicionar la escala en la parte inferior
                title: {
                    display: true,
                    text: 'Edades'
                }
            },
        },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
            },
        };
    

        const ctx = document.getElementById('graficoLineas').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: chartOptions,
        });
    </script>