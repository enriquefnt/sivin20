console.log(Chart.version);
console.log(datosRef)

var tituloY = datosRef.medida;
// var labels = datosRef.edad
const rotulos=datosRef.rotulox ;
//const filteredRotulos = rotulos.filter(label => label !== null);
//console.log(filteredRotulos);


const chartData = {
//    xAxisID: datosRef.edad,
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
            label: '0Z',
            data: datosRef.SD0,
            borderColor: 'rgba(204, 216, 255,100)',
            backgroundColor:'rgba(204, 216, 255,100)', 
            borderWidth: 1.6,
            pointRadius: 0,
            spanGaps: true,
        },

    ]
    
};

const  options = {
 responsive:true,   
 normalized: true,
 animation: false,
 maintainAspectRatio:false ,
 
 
   layout: {           
    padding: 15 
       },
    interaction: {
                mode: 'index'
    },
    grid: {
        color: " rgb(97.0.18)",
        drawTicks: true, 
      },

    scales: {
            x: {
               // type: 'category',
                title: {
                    display: true,
                    text: 'Edad (meses y años)'
                  },
                  min: 0,
                  max: Math.max(...datosRef.edad),
                  borderWidth: 1.2,
                  ticks: {
                    callback: function(value, index, values) {
                      // `value` es el valor de la etiqueta actual (índice en `datosRef.rotulox`)
                      // Aquí debes obtener y devolver el rótulo correspondiente desde `datosRef.rotulox`
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
            align: 'start',
             fontSize: 14
        },
  
    
    
    }
}


 new Chart(
    document.getElementById('graficoLineas'),
    {
      type: 'line',
      data: chartData,
      options: options
    }
  );