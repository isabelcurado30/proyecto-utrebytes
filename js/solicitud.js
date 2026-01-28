document.addEventListener('DOMContentLoaded', () => {

    const selectServicio = document.getElementById('servicio');
    const form = document.getElementById('formSolicitud');
    const mensaje = document.getElementById('mensaje');
    const telefonoInput = document.getElementById('telefono');

    if (telefonoInput) {
        telefonoInput.addEventListener('input', () => {
            telefonoInput.value = telefonoInput.value
                .replace(/\D/g, '') // Elimina letras y símbolos.
                .slice(0, 9); // Máximo 9 números.
        });
    }


    if (!selectServicio || !form) {
        console.error('Formulario o select no encontrado');
        return;
    }

    // Obtener 'servicio_id' desde la URL.
    const params = new URLSearchParams(window.location.search);
    const servicioSeleccionado = params.get('servicio_id');

    // Cargar servicios en el select.
    fetch('http://localhost/proyecto-utrebytes/api/servicios.php')
        .then(res => res.json())
        .then(servicios => {
            servicios.forEach(servicio => {
                const option = document.createElement('option');
                option.value = servicio.id;
                option.textContent = servicio.nombre;

                if (servicio.id == servicioSeleccionado) {
                    option.selected = true;
                }

                selectServicio.appendChild(option);
            });
        });

    // Enviar formulario.
    form.addEventListener('submit', e => {
        e.preventDefault();

        const empresa = document.getElementById('empresa');
        const email = document.getElementById('email');
        const telefono = document.getElementById('telefono');
        const descripcion = document.getElementById('descripcion');
        const prioridad = document.getElementById('prioridad');

        if (!empresa || !email || !telefono || !descripcion || !prioridad) {
            mensaje.textContent = 'Error: campos no encontrados';
            return;
        }

        if (telefono.value.length !== 9) {
            mensaje.textContent = 'El teléfono debe tener exactamente 9 dígitos';
            return;
        }

        const data = {
            servicio_id: selectServicio.value,
            empresa: empresa.value,
            email: email.value,
            telefono: telefono.value,
            descripcion: descripcion.value,
            prioridad: prioridad.value
        };

        fetch('http://localhost/proyecto-utrebytes/api/solicitudes.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(response => {
            if (response.success) {
                mensaje.textContent = 'Solicitud enviada correctamente';
                form.reset();
            } else {
                mensaje.textContent = response.message;
            }
        })
        .catch(() => {
            mensaje.textContent = 'Error al enviar la solicitud';
        });
    });

});
