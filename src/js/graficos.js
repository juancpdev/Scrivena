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
            console.log(tipos);
            

            const ctx = document.getElementById('tipos-grafica').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: tipos,
                    datasets: [{
                        data: [tipos],
                        backgroundColor: [
                            '#123c49'
                        ]
                    }]
                },
                
            });
        }
    }
})();
