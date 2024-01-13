document.addEventListener('DOMContentLoaded', function () {
    menu();
    carrouselInicio();
    añoFooter();
});

function menu() {
    const btnFlotante = document.querySelector('.abrir_menu');
    const menu = document.querySelector('.caja_nav');

    btnFlotante.addEventListener('click', abrirCerrarMenu);

    function abrirCerrarMenu() {
        if (menu.classList.contains('activo')) {
            menu.classList.remove('activo');
            btnFlotante.classList.remove('activo');
        } else {
            menu.classList.add('activo');
            btnFlotante.classList.add('activo');
        }
    }
}

function carrouselInicio() {
    const carrusel = document.querySelector('.carrusel');
    const elementos = document.querySelectorAll('.carrusel .elemento');
    const navContainer = document.querySelector('.carrusel-nav');
    let indiceActual = 0;
    let startX;
    let isDragging = false;

    if(carrusel) {
        // Crear puntos de navegación
    elementos.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('nav-dot');
        if (index === 0) {
            dot.classList.add('active'); // Establecer el primer punto como activo
        }
        dot.addEventListener('click', () => {
            moveToIndex(index);
        });
        navContainer.appendChild(dot);
    });

    // Función para mover el carrusel a un índice específico y actualizar los puntos
    function moveToIndex(index) {
        indiceActual = index;
        actualizarCarrusel();
        actualizarNavDots();
    }

    // Función para actualizar los puntos de navegación
    function actualizarNavDots() {
        navContainer.querySelectorAll('.nav-dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === indiceActual);
        });
    }

    // Funciones para el deslizamiento táctil
    carrusel.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isDragging = true;
    });

    carrusel.addEventListener('touchmove', (e) => {
        if (isDragging) {
            const moveX = e.touches[0].clientX;
            const diffX = moveX - startX;
            if (Math.abs(diffX) > 30) {
                if (diffX > 0) {
                    moverAnterior();
                } else {
                    moverSiguiente();
                }
                startX = moveX;
                isDragging = false;
            }
        }
    });

    carrusel.addEventListener('touchend', () => {
        isDragging = false;
    });

    // Función para mover al siguiente elemento
    function moverSiguiente() {
        if (indiceActual < elementos.length - 1) {
            indiceActual++;
        } else {
            indiceActual = 0;
        }
        actualizarCarrusel();
        actualizarNavDots();
    }

    // Función para mover al elemento anterior
    function moverAnterior() {
        if (indiceActual > 0) {
            indiceActual--;
        } else {
            indiceActual = elementos.length - 1;
        }
        actualizarCarrusel();
        actualizarNavDots();
    }

    // Función para actualizar el carrusel
    function actualizarCarrusel() {
        const offset = -indiceActual * 100;
        elementos.forEach(element => {
            element.style.transform = `translateX(${offset}%)`;
        });
    }

    // Establecer intervalo para cambiar al siguiente elemento cada 4 segundos
    setInterval(moverSiguiente, 5000);
    }

}

function añoFooter() {
    // año copy
    document.getElementById('year').textContent = new Date().getFullYear();
}