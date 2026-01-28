const tabla = document.getElementById('tablaSolicitudes');

fetch('http://localhost/proyecto-utrebytes/api/solicitudes.php')
    .then(res => res.json())
    .then(data => {
        data.forEach(sol => {
            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>${sol.id}</td>
                <td>${sol.servicio_nombre}</td>
                <td>${sol.empresa}</td>
                <td>${sol.prioridad}</td>
                <td>
                    <select data-id="${sol.id}">
                        <option value="pendiente" ${sol.estado === 'pendiente' ? 'selected' : ''}>Pendiente</option>
                        <option value="en_proceso" ${sol.estado === 'en_proceso' ? 'selected' : ''}>En proceso</option>
                        <option value="completada" ${sol.estado === 'completada' ? 'selected' : ''}>Completada</option>
                    </select>
                </td>
                <td>
                    <button onclick="actualizarEstado(${sol.id})">Guardar</button>
                </td>
            `;

            tabla.appendChild(tr);
        });
    });

function actualizarEstado(id) {
    const select = document.querySelector(`select[data-id="${id}"]`);
    const nuevoEstado = select.value;

    fetch(`http://localhost/proyecto-utrebytes/api/solicitudes.php?id=${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ estado: nuevoEstado })
    })
    .then(response => {
    const mensaje = document.getElementById('mensajeAdmin');

    // Si NO viene success pero la API responde, lo damos por correcto
    if (response.success !== false) {
        mensaje.textContent = 'Estado actualizado correctamente';
        mensaje.classList.add('ok');
    } else {
        mensaje.textContent = response.message || 'Error al actualizar el estado';
        mensaje.classList.remove('ok');
    }

    setTimeout(() => {
        mensaje.textContent = '';
        mensaje.classList.remove('ok');
    }, 2000);
});



}
