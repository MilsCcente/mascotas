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
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="editarPerrito(${item.id})">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarPerrito(${item.id})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
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
