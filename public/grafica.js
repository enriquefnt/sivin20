console.log(Chart.version);
console.log(datosRef)

var tituloY = datosRef.medida;



const chartData = {

   labels: datosRef.edad,
    datasets:[
        {
            label:'Caso',
            data: datosRef.Caso,
            borderColor: 'rgba(0, 0, 255, 100)',
            backgroundColor: 'rgba(0, 0, 255, 100)',
            borderWidth: 1.6,
            pointRadius: 1.3,
            spanGaps: true,
            tension: 0.1,
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
            pointRadius: 0,
            spanGaps: true,
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

    ]
    
};

const  options = {
 responsive:true,   
 normalized: true,
 animation: false,
 maintainAspectRatio:false ,
 
 
   layout: {           
    padding: 10 
       },
  

    scales: {
            x: {
                type: 'category',
                title: {
                    display: true,
                    text: 'Edad (meses y años)'
                  },
                  min: 0,
                  //max: Math.max(...datosRef.edad),
                  max: 1828,
                  borderWidth: 1.2,
                  grid: {
                   
                  },
                  ticks: {
                    callback: function(value, index, values) {
                      // `value` es el valor de la etiqueta actual (índice en `datosRef.rotulox`)
                        return datosRef.rotulox[value];
                    
                    }
                  },
                  
            },
            y: {
                type: 'linear',
                min: 0,
                title: {
                    display: true,
                    text: tituloY   
                  },
                  
               }
        },

   plugins:{
            title: {
                display: true,
                text: 'Grafica de ' + datosRef.medida + ' para Edad',
                fontSize: 24
            },
    subtitle: {
    display: true,
    text: datosRef.nombre,
     align: 'center',
     fontSize: 14
        },
        chartAreaBorder: {
            borderColor: 'black',
            borderWidth: 2,
        
          },
          legend: {
            position: 'right',
            display: true,
            reverse: true,
            labels: {
                color: 'rgb(255, 99, 132)'
            }
        }

    
    },
   
};


 new Chart(
    document.getElementById('graficoLineas'),
    {
      type: 'line',
      data: chartData,
      options: options
    }
  );