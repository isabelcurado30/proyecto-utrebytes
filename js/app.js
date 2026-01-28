const container = document.getElementById ('servicios');

function obtenerIcono(categoria) {
    switch (categoria) {
        case 'Desarrollo Web':
            return '💻';
        case 'IA':
            return '🤖';
        case 'Ciberseguridad':
            return '🔐';
        case 'Cloud':
            return '☁️';
        case 'Consultoría':
            return '📊';
        default:
            return '🛠️';
    }
}

fetch ('http://localhost/proyecto-utrebytes/api/servicios.php')
    . then (response => response.json())
    . then (data => {
        data.forEach (servicio => {
            const card = document.createElement ('div');
            card.classList.add ('card');

            card.innerHTML = `
                <div class="icono">${obtenerIcono(servicio.categoria)}</div>
                <span>${servicio.categoria}</span>
                <h3>${servicio.nombre}</h3>
                <p>${servicio.descripcion}</p>
                <button onclick = "irASolicitud (${servicio.id})">
                    Solicitar Servicio
                </button>
            `;

            container.appendChild (card);
        });
    })
    .catch (error => {
        container.innerHTML = '<p>Error al cargar los servicios.</p>';
        console.error (error);
    });

function irASolicitud (servicioId) {
    window.location.href = `solicitud.html?servicio_id=${servicioId}`;
}