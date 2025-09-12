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

    .form-column {
        flex: 1;
        min-width: 120px;
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

    small {
        color: #6b21a8;
    }
    .form-buttons {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 20px;
    }

    .button.cancel {
        background:rgb(225, 23, 23); /* gris claro */
        color:rgb(255, 255, 255); /* texto oscuro */
        transition: all 0.3s ease;
    }

    .button.cancel:hover {
        background: #9ca3af; /* gris más oscuro */
    }
</style>

<div class="form-container">
    <form class="form" action="" id="frmRegistrarPerrito">
        <h2>Registrar Perrito</h2>

        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del perrito" required>
        </div>

        <div>
            <label for="raza">Raza</label>
            <input type="text" id="raza" name="raza" placeholder="Ej: Labrador, Bulldog">
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="edad">Edad (meses)</label>
                <input type="number" id="edad" name="edad" placeholder="Ej: 3">
            </div>
            <div class="form-column">
                <label for="peso">Peso (kg)</label>
                <input type="number" step="0.1" id="peso" name="peso" placeholder="Ej: 12.5">
            </div>
        </div>

        <div>
            <label for="color">Color</label>
            <input type="text" id="color" name="color" placeholder="Ej: Marrón, Negro">
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="genero">Género</label>
                <select id="genero" name="genero">
                    <option value="" disabled selected>Selecciona género</option>
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
            </div>
            <div class="form-column">
                <label for="vacunado">Vacunado</label>
                <select id="vacunado" name="vacunado">
                    <option value="0" selected>No</option>
                    <option value="1">Sí</option>
                </select>
            </div>
        </div>

        <div class="form-buttons">
            <button type="button" class="button" onclick="registrarPerrito();">Guardar Perrito</button>
            <button></button>
            <a href="<?php echo BASE_URL; ?>mascotas" class="button cancel">Cancelar</a>
        </div>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </form>
</div>

<script src="<?php echo BASE_URL ?>src/views/js/functions_perrito.js"></script>
