document.addEventListener("DOMContentLoaded", function () {
  menu();
  carrouselInicio();
  idiomas();
  alertaFormulario();
});

function menu() {
  const btnFlotante = document.querySelector(".abrir_menu");
  const menu = document.querySelector(".caja_nav");

  if(btnFlotante) {
    btnFlotante.addEventListener("click", abrirCerrarMenu);

    function abrirCerrarMenu() {
      if (menu.classList.contains("activo")) {
        menu.classList.remove("activo");
        btnFlotante.classList.remove("activo");
      } else {
        menu.classList.add("activo");
        btnFlotante.classList.add("activo");
      }
    }
  }
}

function carrouselInicio() {
  const carrusel = document.querySelector(".carrusel");
  const elementos = document.querySelectorAll(".carrusel .elemento");
  const navContainer = document.querySelector(".carrusel-nav");
  let indiceActual = 0;
  let startX;
  let isDragging = false;

  if (carrusel) {
    // Crear puntos de navegación
    elementos.forEach((_, index) => {
      const dot = document.createElement("div");
      dot.classList.add("nav-dot");
      if (index === 0) {
        dot.classList.add("active"); // Establecer el primer punto como activo
      }
      dot.addEventListener("click", () => {
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
      navContainer.querySelectorAll(".nav-dot").forEach((dot, index) => {
        dot.classList.toggle("active", index === indiceActual);
      });
    }

    // Funciones para el deslizamiento táctil
    carrusel.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX;
      isDragging = true;
    });

    carrusel.addEventListener("touchmove", (e) => {
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

    carrusel.addEventListener("touchend", () => {
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
      elementos.forEach((element) => {
        element.style.transform = `translateX(${offset}%)`;
      });
    }

    // Establecer intervalo para cambiar al siguiente elemento cada 4 segundos
    setInterval(moverSiguiente, 5000);
  }
}

function idiomas() {
  const languageToggle = document.querySelector(".language-toggle");
  const circle = document.querySelector(".circle");

  if (languageToggle) {
    // Obtener el parámetro de idioma actual de la URL
    const urlSearchParams = new URLSearchParams(window.location.search);

    // Función para actualizar la posición del círculo según el idioma
    function updateCirclePosition() {
      const langParam = urlSearchParams.get("lang");

      if (langParam === "es") {
        circle.style.transform = "translate(0, -50%)";
      } else if (langParam === "en") {
        circle.style.transform = "translate(100%, -50%)";
      }
    }

    // Toggle del botón y actualización de la posición del círculo al hacer clic
    languageToggle.addEventListener("click", function () {
      languageToggle.classList.toggle("active");

      // Obtener el parámetro de idioma actual de la URL
      const currentLang = urlSearchParams.get("lang");

      // Cambiar el parámetro de idioma entre 'es' y 'en'
      const newLang = currentLang === "es" ? "en" : "es";

      // Actualizar la URL con el nuevo parámetro de idioma
      urlSearchParams.set("lang", newLang);
      const newUrl = `${window.location.origin}${window.location.pathname}?${urlSearchParams.toString()}`;

      // Actualizar la posición del círculo después de un pequeño retraso
      setTimeout(() => {
        updateCirclePosition();
      }, 300); // Ajusta el valor del retraso según sea necesario

      // Actualizar la URL sin recargar completamente la página
      setTimeout(() => {
        window.location.href = newUrl;
      }, 600);
    });

    
    updateCirclePosition();
  }
}

// Alerta Formulario
function alertaFormulario() {
  const alerta = document.querySelector(".alerta-correcto");

  if(alerta) {
      setTimeout(() => {
        alerta.remove();
    }, 4000);
  }
}

// ChatBot
(function(d, w, c) {
  w.BrevoConversationsID = '65aad6e5e1f72d4bfd439584';
  w[c] = w[c] || function() {
      (w[c].q = w[c].q || []).push(arguments);
  };
  var s = d.createElement('script');
  s.async = true;
  s.src = 'https://conversations-widget.brevo.com/brevo-conversations.js';
  if (d.head) d.head.appendChild(s);
})(document, window, 'BrevoConversations');