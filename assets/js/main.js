document.addEventListener('DOMContentLoaded', function() {
    console.log('Página cargada y lista.');

    // Validación simple del formulario de contacto
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario para demostración
            alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.');
        });
    }

    // Cargar contenido dinámico para el blog (ejemplo simple)
    const blogContainer = document.getElementById('blog-main');
    if (blogContainer) {
        const blogArticles = [
            {
                title: 'Últimas Tendencias en Impresión 3D',
                date: '15 de septiembre de 2024',
                excerpt: 'En este artículo, exploramos las últimas tendencias en la tecnología de impresión 3D y cómo están revolucionando diversas industrias.',
                link: '#'
            },
            {
                title: 'Cómo Elegir el Mejor Material para Impresión 3D',
                date: '8 de septiembre de 2024',
                excerpt: 'Descubre los factores a considerar al seleccionar materiales para tus proyectos de impresión 3D y cómo pueden afectar los resultados finales.',
                link: '#'
            }
        ];

        blogArticles.forEach(article => {
            const articleElement = document.createElement('article');
            articleElement.innerHTML = `
                <h2>${article.title}</h2>
                <p>Publicado el ${article.date}</p>
                <p>${article.excerpt}</p>
                <a href="${article.link}">Leer más</a>
            `;
            blogContainer.appendChild(articleElement);
        });
    }

    // Cambiar el tema según la hora del día
    const hour = new Date().getHours();
    const isDark = hour >= 18 || hour < 6; // De 6 p.m. a 6 a.m. es modo oscuro
    document.body.setAttribute('data-theme', isDark ? 'dark' : 'light');
});
