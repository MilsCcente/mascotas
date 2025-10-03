<style>
    .form-container {
        margin: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
        background: linear-gradient(135deg, #c084fc, #7c3aed);
        font-family: 'Poppins', sans-serif;
    }

    .form {
        background-color: #fff;
        margin: 20px;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        width: 600px;
        max-width: 95%;
        transition: all 0.3s ease;
    }

    .form:hover {
        transform: translateY(-5px);
    }

    .form div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #7c3aed;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #c4b5fd;
        border-radius: 8px;
        font-size: 14px;
        background-color: #f9f7ff;
        transition: all 0.3s ease;
    }

    input:focus,
    select:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 5px rgba(124, 58, 237, 0.3);
        outline: none;
        background-color: #f5f3ff;
    }

    .button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #7c3aed, #c084fc);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .button:hover {
        background: linear-gradient(135deg, #6d28d9, #a855f7);
    }

    h2 {
        text-align: center;
        color: #7c3aed;
        font-size: 24px;
        margin-bottom: 25px;
    }

    .form-buttons {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 20px;
    }

    .button.cancel {
        background:rgb(225, 23, 23);
        color:#fff;
        transition: all 0.3s ease;
    }

    .button.cancel:hover {
        background: #9ca3af;
    }
</style>

<div class="form-container">
    <form class="form" action="" id="frmRegistrarToken">
        <h2>Registrar Token</h2>

        <div>
            <label for="id_cliente_api">Cliente API</label>
            
            <select id="id_cliente_api" name="id_cliente_api" required>
    <option value="">-- Seleccione un cliente --</option>
</select>

        </div>

        <div>
            <label for="token">Token</label>
            <div style="display: flex; gap: 10px;">
                <input type="text" id="token" name="token" placeholder="Token generado" required>
                <button type="button" class="button" style="flex: 0.5;" onclick="generarToken();">Generar</button>
            </div>
        </div>

        <div>
            <label for="estado">Estado</label>
            <select id="estado" name="estado" required>
                <option value="activo" selected>Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>

        <div class="form-buttons">
            <button type="button" class="button" onclick="registrar_token();">Guardar Token</button>
            <a href="<?php echo BASE_URL; ?>token" class="button cancel">Cancelar</a>
        </div>
    </form>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL ?>src/views/js/functions_token.js"></script>

<script>
    function generarToken() {
        // Genera un token aleatorio (10 caracteres alfanuméricos)
        const rand = Math.random().toString(36).slice(2, 12).toUpperCase();
        document.querySelector('#token').value = rand;
    }
</script>
