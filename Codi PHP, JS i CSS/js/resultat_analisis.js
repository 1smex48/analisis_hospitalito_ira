document.addEventListener('DOMContentLoaded', () => {
    console.log('Página cargada y lista');

    const header = document.querySelector('.header');
    const navLinks = document.querySelectorAll('.nav-link');
    const valueCells = document.querySelectorAll('.result-table td.value');

    // Cambiar el fondo del header a azul y las letras a blanco al cargar la página
    header.style.backgroundColor = '#2196f3';
    header.style.color = '#ffffff';

    // Añadir animación al hacer clic en los enlaces de navegación
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetUrl = link.getAttribute('href');
            
            document.body.style.transition = 'opacity 0.5s';
            document.body.style.opacity = '0';

            setTimeout(() => {
                window.location.href = targetUrl;
            }, 500); // Tiempo para la animación
        });
    });
});
