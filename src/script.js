document.addEventListener("DOMContentLoaded", function () {
  const navItem = document.getElementById("compania-toggle");
  const subNav = document.getElementById("compania-info");
  const menuToggle = document.querySelector(".menu-toggle");
  const navList = document.querySelector(".nav-list");
  const subNavLinks = subNav.querySelectorAll("a");
  const submenuLinks = document.querySelectorAll("#compania-info a"); // Enlaces del submenú dentro de "Nosotros"

  // Función para mostrar el submenú
  function mostrarSubmenu() {
    subNav.classList.add("show");
  }

  // Función para ocultar el submenú
  function ocultarSubmenu() {
    subNav.classList.remove("show");
  }

  // Mostrar el submenú cuando se pasa el mouse sobre el ítem de navegación (pantallas grandes)
  navItem.addEventListener("mouseenter", () => {
    if (window.innerWidth > 1008) { // Solo en pantallas grandes
      mostrarSubmenu();
      
      
    }
    
    
  });

  // Ocultar el submenú cuando se quita el mouse del ítem de navegación (pantallas grandes)
  navItem.addEventListener("mouseleave", () => {
    if (window.innerWidth > 1008) { // Solo en pantallas grandes
      ocultarSubmenu();
    }
  });

  // Ocultar el submenú cuando el mouse sale del área del submenú (pantallas grandes)
  subNav.addEventListener("mouseleave", () => {
    if (window.innerWidth > 1008) { // Solo en pantallas grandes
      ocultarSubmenu();
    }
  });

  // Mostrar el submenú cuando el mouse entra en el área del submenú (pantallas grandes)
  subNav.addEventListener("mouseenter", () => {
    if (window.innerWidth > 1008) { // Solo en pantallas grandes
      mostrarSubmenu();
    }
  });

  // Alternar la visibilidad del submenú en dispositivos móviles al hacer clic
  navItem.addEventListener("click", (event) => {
    event.stopPropagation();
    if (window.innerWidth <= 1008) { // Solo en pantallas móviles
      mostrarSubmenu();
    }
  });

  // Alternar la visibilidad del menú de navegación en dispositivos móviles
  menuToggle.addEventListener("click", () => {
    if (window.innerWidth <= 1008) {
      navList.classList.toggle("show");
    }
  });

  // Cerrar el submenú si se hace clic fuera de él en dispositivos móviles
  document.addEventListener("click", (event) => {
    if (!navItem.contains(event.target) && !subNav.contains(event.target)) {
      ocultarSubmenu();
    }
  });

  // Manejar clics en los enlaces del submenú tanto en dispositivos móviles como de escritorio
  subNavLinks.forEach(link => {
    link.addEventListener("click", (event) => {
      // Evitar el comportamiento predeterminado del enlace
      event.preventDefault();

      // Navegar a la URL del enlace
      const targetId = link.getAttribute("href").substring(1); // Eliminar el símbolo '#' del href
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        // Desplazar a la sección
        targetElement.scrollIntoView({ behavior: "smooth" });
      }

      // Cerrar el submenú
      ocultarSubmenu();
    });
  });

  // Cerrar el menú de navegación y desplazarse al contenido cuando se haga clic en cualquier enlace del submenú dentro de "Nosotros"
  submenuLinks.forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth <= 1008) { // Solo en pantallas móviles
        navList.classList.remove('show');
      }
      
      // Navegar a la URL del enlace
      const targetId = link.getAttribute("href").substring(1); // Eliminar el símbolo '#' del href
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        // Desplazar a la sección
        targetElement.scrollIntoView({ behavior: "smooth" });
      }
    });
  });
});

// Lógica del carrusel

const slides = document.querySelectorAll('.slide');
// Selecciona todos los elementos con la clase 'dot' y los almacena en la variable 'dots'
const dots = document.querySelectorAll('.dot');
// Inicializa el índice actual en 0 (el primer slide)
let currentIndex = 0;
// Declara una variable 'interval' para almacenar el identificador del intervalo
let interval;

// Función para mostrar la diapositiva actual según el índice
function mostrarSlide(index) {
    // Recorre todos los slides
    slides.forEach((slide, i) => {
        // Muestra el slide correspondiente al índice actual y oculta los demás
        slide.style.display = (i === index) ? 'block' : 'none';
    });
    // Recorre todos los puntos de navegación
    dots.forEach((dot, i) => {
        // Añade o quita la clase 'active' al punto correspondiente al índice actual
        dot.classList.toggle('active', i === index);
    });
}

// Función para avanzar al siguiente slide
function siguienteSlide() {
    // Incrementa el índice actual y utiliza el módulo para volver al inicio si se supera el número de slides
    currentIndex = (currentIndex + 1) % slides.length;
    // Muestra el slide correspondiente al nuevo índice
    mostrarSlide(currentIndex);
}

// Función para configurar la navegación automática del carrusel
function iniciarCarrusel() {
    // Establece un intervalo que llama a 'siguienteSlide' cada 5000 milisegundos (5 segundos)
    interval = setInterval(siguienteSlide, 5000);
}

// Evento para los puntos de navegación
dots.forEach(dot => {
    // Añade un evento de clic a cada punto
    dot.addEventListener('click', () => {
        // Detiene la navegación automática al hacer clic en un punto
        clearInterval(interval);
        // Obtiene el índice del punto clicado y lo convierte a un número entero
        currentIndex = parseInt(dot.getAttribute('data-index'));
        // Muestra el slide correspondiente al índice del punto clicado
        mostrarSlide(currentIndex);
        // Reinicia la navegación automática
        iniciarCarrusel();
    });
});

// Inicia el carrusel mostrando el primer slide
mostrarSlide(currentIndex);
// Comienza la navegación automática
iniciarCarrusel();


//funcion de reproductor de musica
const playButton = document.getElementById('playButton');
const audio = document.getElementById('live-audio');
let isPlaying = false;

playButton.addEventListener('click', () => {
    if (audio.paused) {
        audio.play();
        playButton.classList.add('playing'); // Cambia el icono cuando está reproduciendo
        isPlaying = true;
    } else {
        audio.pause();
        playButton.classList.remove('playing'); // Cambia el icono cuando está en pausa
        isPlaying = false;
    }
});

// Permite arrastrar el botón por la página
playButton.addEventListener('mousedown', function (e) {
    let shiftX = e.clientX - playButton.getBoundingClientRect().left;
    let shiftY = e.clientY - playButton.getBoundingClientRect().top;

    function moveAt(pageX, pageY) {
        playButton.style.left = pageX - shiftX + 'px';
        playButton.style.top = pageY - shiftY + 'px';
    }

    function onMouseMove(event) {
        moveAt(event.pageX, event.pageY);
    }

    document.addEventListener('mousemove', onMouseMove);

    playButton.onmouseup = function () {
        document.removeEventListener('mousemove', onMouseMove);
        playButton.onmouseup = null;
    };
});

playButton.ondragstart = function () {
    return false;
};

// function del banner

  // const banner = document.querySelector(".banner-aniversario");
  // const cerrarBanner = document.querySelector(".close-button"); // Asegúrate de que el botón tenga la clase correcta
  // const overlay = document.querySelector(".overlay");

  // // Mostrar el banner y la superposición después de 1 segundo cuando se carga la página
  // setTimeout(() => {
  //   banner.classList.add("mostrar"); // Añade la clase para mostrar el banner
  //   banner.style.display = "flex"; // Asegura que el banner se vea
  //   overlay.style.display = "block"; // Muestra la superposición
  // }, 1000);

  // // Función para ocultar el banner y la superposición
  // const ocultarBannerYOverlay = () => {
  //   banner.classList.add("ocultar"); // Añade la clase para ocultar con deslizamiento
  //   overlay.style.display = "none"; // Oculta la superposición

  //   setTimeout(() => {
  //     banner.style.display = "none"; // Después de la animación, esconde completamente el banner
  //   }, 500); // El tiempo debe coincidir con la duración de la transición en el CSS
  // };

  // // Ocultar el banner al hacer clic en el botón de cerrar
  // cerrarBanner.addEventListener("click", ocultarBannerYOverlay);

  // // Ocultar el banner al hacer clic en la superposición
  // overlay.addEventListener("click", ocultarBannerYOverlay);

