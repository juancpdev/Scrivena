(function() {
    const grafica = document.querySelector('#inversion-grafica');
    if(grafica) {
        obtenerDatos();

        async function obtenerDatos() {
            const url = '/api/contratos';
            const respuesta = await fetch(url);
            const contratos = await respuesta.json();

            const inversiones = contratos.reduce((total, contrato) => total + parseFloat(contrato.inversion), 0);
            let rendimientoTotal = 0;

            contratos.forEach(contrato => {
                const fechaInicio = new Date(contrato.fecha_inicio);
                const fechaFin = new Date(contrato.fecha_fin);
                const rendimiento = parseFloat(contrato.rendimiento);

                // Calcular el primer mes completo después de la fecha de inicio
                const primerMesCompleto = new Date(fechaInicio);
                primerMesCompleto.setMonth(primerMesCompleto.getMonth() + 1);
                primerMesCompleto.setDate(10); // Primer día de pago del siguiente mes

                const fechaActual = new Date();
                while (primerMesCompleto <= fechaFin && primerMesCompleto <= fechaActual) {
                    rendimientoTotal += rendimiento;

                    // Ir al siguiente mes completo
                    primerMesCompleto.setMonth(primerMesCompleto.getMonth() + 1);
                }
            });

            const ctx = document.getElementById('inversion-grafica').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Inversiones', 'Rendimiento'],
                    datasets: [{
                        data: [inversiones, rendimientoTotal],
                        backgroundColor: [
                            '#ea580c',
                            '#84cc16'
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
})();
