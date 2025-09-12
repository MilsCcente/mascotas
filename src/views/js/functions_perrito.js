async function listar_perritos() {
    try {
        // Llamada al controlador de perritos
        let respuesta = await fetch(base_url + 'src/controller/mascota.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let cont = 0;

            datos.forEach(item => {
                let nueva_fila = document.createElement("tr");
                nueva_fila.id = "fila_" + item.id;
                cont += 1;

                // Se llena la fila con los datos del perrito
                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.nombre}</td>
                    <td>${item.raza || ''}</td>
                    <td>${item.edad || ''}</td>
                    <td>${item.peso || ''}</td>
                    <td>${item.color || ''}</td>
                    <td>${item.genero || ''}</td>
                    <td>${item.vacunado ? 'Sí' : 'No'}</td>
                    <td>${item.options}</td>
                
                `;

                document.querySelector('#tbl_perritos').appendChild(nueva_fila);
            });
        }

        console.log(json);
    } catch (error) {
        console.log("Oops, salió error: " + error);
    }
}

// Ejecutar solo si existe la tabla
if (document.querySelector('#tbl_perritos')) {
    listar_perritos();
}
async function registrarPerrito() {
    // Obtener valores de los inputs
    let nombre = document.querySelector('#nombre').value.trim();
    let raza = document.querySelector('#raza').value.trim();
    let edad = document.querySelector('#edad').value.trim();
    let peso = document.querySelector('#peso').value.trim();
    let color = document.querySelector('#color').value.trim();
    let genero = document.querySelector('#genero').value;
    let vacunado = document.querySelector('#vacunado').value;

    // Validación básica
    if (nombre === "" || genero === "" || vacunado === "") {
        swal("Error", "Los campos Nombre, Género y Vacunado son obligatorios", "error");
        return;
    }

    try {
        // Capturamos el formulario
        const datos = new FormData(document.querySelector('#frmRegistrarPerrito'));

        // Enviamos al controlador PHP
        let respuesta = await fetch(base_url + 'src/controller/mascota.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            swal("Registro", json.mensaje, "success");
            document.querySelector('#frmRegistrarPerrito').reset(); // limpiar formulario
        } else {
            swal("Registro", json.mensaje, "error");
        }

        console.log(json);
    } catch (e) {
        console.log("Oops ocurrió un error: " + e);
    }
}




// ===================== EDITAR PERRITO =====================
async function editar_perrito(id) {
    const formData = new FormData();
    formData.append('id', id);

    try {
        let respuesta = await fetch(base_url + 'src/controller/mascota.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            // Guardamos el ID en el hidden
            document.querySelector('#id').value = json.contenido.id;

            // Llenamos los campos del formulario
            document.querySelector('#nombre').value = json.contenido.nombre;
            document.querySelector('#raza').value = json.contenido.raza;
            document.querySelector('#edad').value = json.contenido.edad;
            document.querySelector('#peso').value = json.contenido.peso;
            document.querySelector('#color').value = json.contenido.color;
            document.querySelector('#genero').value = json.contenido.genero;
            document.querySelector('#vacunado').value = json.contenido.vacunado;

        } else {
            window.location = base_url + "mascotas";
        }

    } catch (error) {
        console.log("Oops, ocurrió un error: " + error);
    }
}

// ===================== ACTUALIZAR PERRITO =====================
async function actualizar_perrito() {
    const id = document.querySelector('#id').value;
    const nombre = document.querySelector('#nombre').value;
    const raza = document.querySelector('#raza').value;
    const edad = document.querySelector('#edad').value;
    const peso = document.querySelector('#peso').value;
    const color = document.querySelector('#color').value;
    const genero = document.querySelector('#genero').value;
    const vacunado = document.querySelector('#vacunado').value;

    if (!nombre || !genero || vacunado === "") {
        swal("Error", "Por favor completa los campos obligatorios", "error");
        return;
    }

    try {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('nombre', nombre);
        formData.append('raza', raza);
        formData.append('edad', edad);
        formData.append('peso', peso);
        formData.append('color', color);
        formData.append('genero', genero);
        formData.append('vacunado', vacunado);

        let respuesta = await fetch(base_url + 'src/controller/mascota.php?tipo=editar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            swal("Éxito", json.mensaje, "success").then(() => {
                window.location = base_url + "mascotas"; // Redirige al listado
            });
        } else {
            swal("Error", json.mensaje, "error");
        }

        console.log(json);

    } catch (error) {
        console.log("Oops, ocurrió un error: " + error);
    }
}

// ===================== ELIMINAR PERRITO =====================
async function eliminar_perrito(id) {
    swal({
        title: "¿Estás seguro de eliminar este perrito?",
        text: "No podrás recuperarlo",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then(async (willDelete) => {
        if (willDelete) {
            try {
                const formData = new FormData();
                formData.append('id', id);

                const respuesta = await fetch(base_url + 'src/controller/mascota.php?tipo=eliminar', {
                    method: 'POST',
                    body: formData
                });

                const json = await respuesta.json();

                if (json.status) {
                    swal("Éxito", json.message, "success")
                        .then(() => {
                            location.reload(); // recarga el listado
                        });
                } else {
                    swal("Error", json.message, "error");
                }

            } catch (error) {
                console.log("Error al eliminar perrito: " + error);
            }
        }
    });
}
