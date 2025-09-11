async function iniciar_sesion() {
    let usuario = document.querySelector('#usuario').value.trim();
    let password = document.querySelector('#password').value.trim();

    if (usuario == "" || password == "") {
        swal("Error", "Los campos no pueden estar vacíos", "warning");
        return;
    }

    try {
        const frmIniciar = document.querySelector('#frmIniciar');
        const datos = new FormData(frmIniciar);

        let respuesta = await fetch(base_url + 'src/controller/login.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            // Redirige siempre a la página principal del panel
            location.replace(base_url+'inicio');
        } else {
            swal("Iniciar Sesión", json.mensaje, "error");
        }

        console.log(json);
    } catch (e) {
        console.log("Ocurrió un error: " + e);
    }
}

if (document.querySelector('#frmIniciar')) {
    const frmIniciar = document.querySelector('#frmIniciar');
    frmIniciar.onsubmit = function(e) {
        e.preventDefault();
        iniciar_sesion();
    }
}

/*async function cerrar_sesion() {
    try {
        let respuesta = await fetch(base_url + 'src/controller/login.php?tipo=cerrar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
        });

        let json = await respuesta.json();

        if (json.status) {
            location.replace(base_url + 'login');
        }
    } catch (e) {
        console.log("Ocurrió un error: " + e);
    }
}*/
