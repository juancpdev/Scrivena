(function() {
    const grafica = document.querySelector('#inversion-grafica');
    const balanceTotal = document.querySelector('#balance-total');
    if(grafica) {
        obtenerDatos();

        async function obtenerDatos() {
            const url = '/api/contratos';
            const respuesta = await fetch(url);
            const contratos = await respuesta.json();

            const inversiones = contratos.reduce((total, contrato) => total + parseFloat(contrato.inversion), 0);
            const intereses = contratos.reduce((total, contrato) => total + parseFloat(contrato.interes), 0);

            balanceTotal.textContent = `$${inversiones + intereses}`;

            const ctx = document.getElementById('inversion-grafica').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Inversiones', 'Interés'],
                    datasets: [{
                        data: [inversiones, intereses],
                        backgroundColor: [
                            '#123c49',
                            '#30aeb9'
                        ]
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== 'undefined') {
                                        label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed);
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                    
                }
                
            });
        }
    }

    const gaficoTipos = document.querySelector('#tipos-grafica');
    const tiposTotal = document.querySelector('#tipos-total');
    if(gaficoTipos) {
        obtenerDatos();

        async function obtenerDatos() {
            const url = '/api/contratostotal';
            const respuesta = await fetch(url);
            const contratos = await respuesta.json();
            const tipos = [];
            contratos.forEach(contrato => {
                const tipo = contrato.tipo;
                tipos.push(tipo);
            });

            const labels = ['Inversión en Minería', 'Desarrollos Inmobiliarios', 'Fondos de Inversión USA', 'Remates Inmobiliarios'];


            // Crear un objeto para mapear cada tipo de contrato a su índice en el array de labels
            const labelMap = {};
            labels.forEach((label, index) => {
                labelMap[label] = index;
            });
            
            // Inicializar un array de conteo de tipos con ceros
            const conteoTipos = Array(labels.length).fill(0);
            
            // Contar cuántas veces aparece cada tipo en el array 'tipos' y actualizar el array de conteo
            tipos.forEach(tipo => {
                const index = labelMap[tipo];
                if (index !== undefined) {
                    conteoTipos[index]++;
                }
            });

            let totalTipos = 0;

            conteoTipos.forEach(total => {
                totalTipos += total;
            })

            tiposTotal.textContent = totalTipos;

            const ctx = document.getElementById('tipos-grafica').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Inversión en Minería', 'Desarrollos Inmobiliarios', 'Fondos de Inversión USA', 'Remates Inmobiliarios'],
                    datasets: [{
                        data: conteoTipos,
                        backgroundColor: [
                            '#87A09B',
                            '#4D686F',
                            '#6D929B',
                            '#314E52',
                            '#659597',
                            '#A2B3A4',
                            '#566F7E',
                            '#829CA5',
                            '#4E6A71',
                            '#3E5055'
                        ]
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    }

    const gaficoPaises = document.querySelector('#paises-grafica');
    const paisesTotal = document.querySelector('#paises-total');
    if(gaficoPaises) {
        obtenerDatos();

        async function obtenerDatos() {
            const url = '/api/clientes';
            const respuesta = await fetch(url);
            const clientes = await respuesta.json();
            const paises = [];
            const pais = clientes.forEach( cliente => {
                paises.push(cliente.pais);
            });

            // Objeto auxiliar para hacer un seguimiento de los países únicos
            const paisesUnicos = {};

            // Filtrar los elementos duplicados y construir un nuevo arreglo con elementos únicos
            const paisesSinRepetir = paises.filter(pais => {
                // Si el país no ha sido visto antes, marcarlo como visto en el objeto auxiliar y retornar true
                if (!paisesUnicos[pais]) {
                    paisesUnicos[pais] = true;
                    return true;
                }
                // Si el país ya ha sido visto antes, retornar false para filtrarlo
                return false;
            });


            // Objeto auxiliar para contar cuántas veces aparece cada país
            const conteoPaises = {};

            // Contar cuántas veces aparece cada país en el arreglo original
            paises.forEach(pais => {
                conteoPaises[pais] = (conteoPaises[pais] || 0) + 1;
            });

            // Crear el arreglo final con el número de repeticiones de cada país
            const arregloFinal = Object.values(conteoPaises);

            let totalPaises = 0;

            arregloFinal.forEach(total => {
                totalPaises += total;
            })

            paisesTotal.textContent = totalPaises;

            const ctx = document.getElementById('paises-grafica').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: paisesSinRepetir,
                    datasets: [{
                        data: arregloFinal,
                        backgroundColor: [
                            '#123C49',
                            '#22728A',
                            '#63BDD8',
                            '#0C2830',
                            '#32A8CC',      
                            '#245D6D',
                            '#398AA8',
                            '#7AC2E2',
                            '#185E7A',
                            '#2A8DAB',
                            '#124749',
                            '#122649'
                        ]
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    }
})();
