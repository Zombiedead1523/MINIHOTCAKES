// Esperamos a que la página cargue completamente
window.onload = function() {
    // Seleccionamos todas las imágenes
    const images = document.querySelectorAll('.gallery img');
    
    // Función para comprobar si las imágenes están en la vista
    function checkInView() {
      const windowHeight = window.innerHeight;
      images.forEach(image => {
        const imageTop = image.getBoundingClientRect().top;
        if (imageTop < windowHeight) {
          image.classList.add('show'); // Aparece la imagen con animación
        }
      });
    }
  
    // Ejecutamos la función al hacer scroll
    window.addEventListener('scroll', checkInView);
    checkInView(); // Para que también se ejecute al cargar la página
  };

// Función para abrir el lightbox con la imagen seleccionada
function openLightbox(element) {
  var lightbox = document.getElementById('lightbox');
  var lightboxImg = document.getElementById('lightboxImg');
  lightboxImg.src = element.src;  // Establece la fuente de la imagen en el lightbox
  lightbox.style.display = 'flex'; // Muestra el lightbox
}

// Función para cerrar el lightbox
function closeLightbox() {
  var lightbox = document.getElementById('lightbox');
  lightbox.style.display = 'none'; // Oculta el lightbox
}
