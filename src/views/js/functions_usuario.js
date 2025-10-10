async function listarUsuarios() {
    try {
        // Llamada al controlador de usuarios
        let respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let cont = 0;

            datos.forEach(item => {
                let nueva_fila = document.createElement("tr");
                nueva_fila.id = "fila_" + item.id;
                cont += 1;

                // Se llena la fila con los datos del usuario
                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.nombre}</td>
                    <td>${item.rol}</td>
                    <td>${item.options}</td>
                `;

                document.querySelector('#tbl_usuarios').appendChild(nueva_fila);
            });
        }

        console.log(json);
    } catch (error) {
        console.log("Error al listar usuarios: " + error);
    }
}

// Ejecutar solo si existe la tabla
if (document.querySelector('#tbl_usuarios')) {
    listarUsuarios();
}

// ===================== REGISTRAR USUARIO =====================
async function registrar_usuario() {
    // Obtener valores de los inputs
    let nombre = document.querySelector('#nombre').value.trim();
    let contrasena = document.querySelector('#contrasena').value.trim();
    let rol = document.querySelector('#rol').value.trim();

    // Validación básica
    if (nombre === "" || contrasena === "" || rol === "") {
        swal("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    try {
        const datos = new FormData(document.querySelector('#frmRegistrarUsuario'));

        // Enviar al controlador
        let respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=registrar', {
            method: 'POST',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            swal("Registro", json.mensaje, "success");
            document.querySelector('#frmRegistrarUsuario').reset();
        } else {
            swal("Error", json.mensaje, "error");
        }

        console.log(json);
    } catch (e) {
        console.log("Error al registrar usuario: " + e);
    }
}


// ===================== EDITAR USUARIO =====================
async function editar_usuario(id) {
    const formData = new FormData();
    formData.append('id', id);

    try {
        let respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=ver', {
            method: 'POST',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            // Guardar ID y llenar campos
            document.querySelector('#id_usuario').value = json.contenido.id;
            document.querySelector('#nombre').value = json.contenido.nombre;
            document.querySelector('#rol').value = json.contenido.rol;

        } else {
            window.location = base_url + "usuarios";
        }

    } catch (error) {
        console.log("Error al cargar datos del usuario: " + error);
    }
}


// ===================== ACTUALIZAR USUARIO =====================
async function actualizar_usuario() {
    const id = document.querySelector('#id_usuario').value;
    const nombre = document.querySelector('#nombre').value.trim();
    const rol = document.querySelector('#rol').value.trim();

    if (nombre === "" || rol === "") {
        swal("Error", "Por favor completa los campos Nombre y Rol", "error");
        return;
    }

    try {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('nombre', nombre);
        formData.append('rol', rol);

        let respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=editar', {
            method: 'POST',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            swal("Éxito", json.mensaje, "success").then(() => {
                window.location = base_url + "usuario"; // Redirige al listado
            });
        } else {
            swal("Error", json.mensaje, "error");
        }

    } catch (error) {
        console.log("Error al actualizar usuario: " + error);
    }
}


