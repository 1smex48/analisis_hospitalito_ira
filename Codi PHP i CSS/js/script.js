document.addEventListener('DOMContentLoaded', () => {
    console.log('Página cargada y lista');

    const header = document.querySelector('.header');
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    // Cambiar el fondo del header a azul y las letras a blanco al cargar la página
    header.style.backgroundColor = '#2196f3';
    header.style.color = '#ffffff';

    sections.forEach(section => {
        const header = section.querySelector('h2');
        const content = section.querySelector('.content');

        // Mostrar el contenido por defecto
        section.classList.add('open');
        content.style.display = 'block';

        header.addEventListener('click', () => {
            section.classList.toggle('open');
            if (section.classList.contains('open')) {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }
        });
    });

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
