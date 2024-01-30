(function() {
    const clientesInput = document.querySelector('#clientes');

    if(clientesInput) {

        obtenerClientes();

        async function obtenerClientes() {
            const url = `/api/clientes`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            formatearClientes(resultado)
        }

        function formatearClientes(arrayClientes = []) {
            clientes = arrayClientes.map( cliente => {
                return {
                    nombre: `${cliente.nombre.trim()} ${cliente.apellido.trim()}`,
                    id: cliente.id
                } 
            })
        }
    }
})();