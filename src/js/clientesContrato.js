(function () {
    const inputCliente = document.querySelector("#clienteContrato");

    if(inputCliente) {
        let clientes = [];
        let clientesFiltrados = [];

        const inputHiddenCliente = document.querySelector("[name=inversionista_id]");
        const listadoClientes = document.querySelector("#listado-clientes");

        obtenerClientes();
        inputCliente.addEventListener('input', buscarClientes);

        if(inputHiddenCliente.value) {

            async function iniciarApp() {
                const cliente = await obtenerCliente(inputHiddenCliente.value);

                const {nombre, apellido} = cliente;

                const clienteDOM = document.createElement('LI');
                clienteDOM.classList.add("listado-clientes__cliente", "listado-clientes__cliente--seleccionado", "listado-clientes__cliente--con-margen");
                clienteDOM.textContent = `${nombre} ${apellido}`;
                
                listadoClientes.appendChild(clienteDOM);

                // Estilos al label
                labelCliente.classList.add('formulario__label--li');
                inputCliente.addEventListener('input', verificarElementos);
            }

            function verificarElementos() {
                    
                if (listadoClientes.getElementsByTagName('li').length > 0) {
                    labelCliente.classList.add('formulario__label--li');

                } else {
                    labelCliente.classList.remove('formulario__label--li');
                }
            }

            iniciarApp();
            inputCliente.addEventListener('input', iniciarApp);
        }

        async function obtenerClientes() {
            const url = '/api/clientes'
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearClientes(resultado);
        }

        async function obtenerCliente(id) {
            const url = `/api/cliente?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
        
            return resultado;
        }
        
        function formatearClientes(resultado = []) {
            clientes = resultado.map( cliente => {
                return {
                    nombre: `${cliente.nombre.trim()} ${cliente.apellido.trim()}`,
                    id: cliente.id
                }
            });
        }

        // Función para escapar caracteres especiales de una cadena
        function escapeRegExp(str) {
            return str.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
        }

        function buscarClientes(e) {
            const busqueda = e.target.value;
        
            if (busqueda.length > 3) {
                // Utilizar escapeRegExp para tratar la entrada del usuario como literal en la expresión regular
                const expresion = new RegExp(escapeRegExp(busqueda), "i");
        
                clientesFiltrados = clientes.filter(cliente => {
                    // Utilizar normalize para tratar caracteres acentuados
                    const nombreNormalizado = cliente.nombre.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                    
                    if (nombreNormalizado.search(expresion) !== -1) {
                        return cliente;
                    }
                });
            } else {
                clientesFiltrados = [];
            }
        
        mostrarClientes();
        }
        
        function mostrarClientes() {

            // Agrega un evento al input para detectar cambios
            inputCliente.addEventListener("input", function() {
                if (listadoClientes.getElementsByTagName("li").length > 0) {
                    listadoClientes.classList.add("listado-clientes__cliente--con-margen");
                } else {
                    listadoClientes.classList.remove("listado-clientes__cliente--con-margen");
                }
            });

            while(listadoClientes.firstChild) {
                listadoClientes.removeChild(listadoClientes.firstChild)
            }

            if(clientesFiltrados.length > 0) {
                clientesFiltrados.forEach( cliente => {
                    const clienteHTML = document.createElement('LI');
                    clienteHTML.classList.add("listado-clientes__cliente");
                    clienteHTML.textContent = cliente.nombre;
                    clienteHTML.dataset.clienteId = cliente.id;
                    clienteHTML.onclick = seleccionarCliente;
        
                    listadoClientes.appendChild(clienteHTML);
                });
            } else if (inputCliente.value.length > 3) {
                const noResultado = document.createElement('P');
                noResultado.classList.add('listado-clientes__no-resultado');
                noResultado.textContent = 'No hay resultados para tu búsqueda';
                
                listadoClientes.appendChild(noResultado);
            
            }
                
        }

        function seleccionarCliente(e) {
            const cliente = e.target;

            const clientePrevio = document.querySelector(".listado-clientes__cliente--seleccionado");

            if(clientePrevio) {
                clientePrevio.classList.remove("listado-clientes__cliente--seleccionado");
            }

            cliente.classList.add("listado-clientes__cliente--seleccionado");
            
            inputHiddenCliente.value = cliente.dataset.clienteId;
        }
    
    }

})();