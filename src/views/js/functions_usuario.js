// src/views/js/functions_token.js
// Funciones para token: listar, registrar, ver, editar, eliminar
const tokenBase = base_url + 'src/controller/token.php?tipo=';

// => Aux: parsear respuesta segura (si viene HTML muestra crudo en consola)
async function safeJsonResponse(response) {
    const text = await response.text();
    try {
        return JSON.parse(text);
    } catch (e) {
        console.error("Respuesta cruda del servidor:", text);
        throw new Error("La respuesta del servidor no es JSON. Revisa la consola (warnings/fatals de PHP).");
    }
}

// Listar tokens y pintar tabla
async function listar_tokens() {
    try {
        const res = await fetch(tokenBase + 'listar');
        const json = await safeJsonResponse(res);
        if (json.status) {
            const tbody = document.querySelector('#tbl_tokens');
            tbody.innerHTML = '';
            let cont = 0;
            json.contenido.forEach(item => {
                cont++;
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${cont}</td>
                    <td>${item.token}</td>
                    <td>${item.cliente_nombre || ''}</td>
                    <td>${item.fecha_registro || ''}</td>
                    <td>${item.estado}</td>
                    <td class="text-center">${item.options}</td>
                `;
                tbody.appendChild(tr);
            });
        } else {
            console.log(json);
        }
    } catch (err) {
        console.error("Error al listar tokens:", err);
    }
}

// Cargar clientes en select (usar controller cliente.php?tipo=listar)
async function cargar_clientes_token() {
    try {
        const resp = await fetch(base_url + 'src/controller/cliente.php?tipo=listar');
        const json = await safeJsonResponse(resp);
        const select = document.querySelectorAll('#id_cliente_api');
        if (!json.status) return;
        select.forEach(s => {
            s.innerHTML = '<option value="">Seleccione un cliente</option>';
            json.contenido.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id;
                opt.textContent = c.nombre_apellidos + ' (' + c.dni + ')';
                s.appendChild(opt);
            });
        });
    } catch (err) {
        console.error("Error al cargar clientes:", err);
    }
}

// Registrar token
async function registrar_token() {
    try {
        const form = document.querySelector('#frmRegistrarToken');
        if (!form) {
            swal("Error", "Formulario no encontrado", "error");
            return;
        }
        const datos = new FormData(form);
        const res = await fetch(tokenBase + 'registrar', { method: 'POST', body: datos });
        const json = await safeJsonResponse(res);
        if (json.status) {
            swal("Éxito", json.mensaje, "success").then(() => {
                form.reset();
                listar_tokens();
                window.location = base_url + 'token';
            });
        } else {
            swal("Error", json.mensaje || 'Error al registrar', "error");
        }
    } catch (err) {
        console.error("Error al registrar token:", err);
        swal("Error", err.message, "error");
    }
}

// Ver y precargar (editar)
async function editar_token(id) {
    try {
        const fd = new FormData();
        fd.append('id', id);
        const res = await fetch(tokenBase + 'ver', { method: 'POST', body: fd });
        const json = await safeJsonResponse(res);
        if (json.status) {
            const data = json.contenido;
            document.querySelector('#id').value = data.id;
            document.querySelector('#token').value = data.token;
            document.querySelector('#id_cliente_api').value = data.id_cliente_api;
            document.querySelector('#estado').value = data.estado;
        } else {
            swal("Error", json.mensaje || 'Token no encontrado', "error");
        }
    } catch (err) {
        console.error("Error al obtener token:", err);
    }
}

// Actualizar token
async function actualizar_token() {
    try {
        const form = document.querySelector('#frmEditarToken');
        if (!form) {
            swal("Error", "Formulario no encontrado", "error");
            return;
        }
        const datos = new FormData(form);
        const res = await fetch(tokenBase + 'editar', { method: 'POST', body: datos });
        const json = await safeJsonResponse(res);
        if (json.status) {
            swal("Éxito", json.mensaje, "success").then(() => {
                window.location = base_url + 'token';
            });
        } else {
            swal("Error", json.mensaje || 'Error al actualizar', "error");
        }
    } catch (err) {
        console.error("Error al actualizar token:", err);
        swal("Error", err.message, "error");
    }
}

// Eliminar token
async function eliminar_token(id) {
    try {
        const will = await swal({
            title: "¿Eliminar token?",
            text: "No podrás revertir esto",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        });
        if (!will) return;

        const fd = new FormData();
        fd.append('id', id);
        const res = await fetch(tokenBase + 'eliminar', { method: 'POST', body: fd });
        const json = await safeJsonResponse(res);
        if (json.status) {
            swal("Éxito", json.message, "success").then(() => listar_tokens());
        } else {
            swal("Error", json.message || 'Error al eliminar', "error");
        }
    } catch (err) {
        console.error("Error al eliminar token:", err);
    }
}
