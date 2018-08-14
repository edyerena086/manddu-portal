<template>
    <form class="static" action="" @submit="checkForm">
        <h3>
            Crea tu cuenta en ReclutaTI
        </h3>

        <p>
            Todos los campos son obligatorios.
        </p>

        <div class="form-group">
            <label for="">Nombre:</label>
            <input type="text" v-model="nombre" name="nombre" class="form-control">
            <span></span>
        </div>

        <div class="form-group">
            <label for="">Apellido Paterno:</label>
            <input type="text" v-model="apellidoPaterno" name="apellidoPaterno" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Correo Electrónico:</label>
            <input type="email" v-model="correoElectronico" name="correoElectronico" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Contraseña:</label>
            <input type="password" v-model="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Confirmar Contraseña:</label>
            <input type="password" v-model="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <p class="alert alert-danger" v-if="errors.length">
            Se han cometido los siguientes errores en el llenado del formulario
            <ul>
                <li v-for="error in errors"> {{ error }}</li>
            </ul>
        </p>

        <p>
            Al dar clic en el botón "Enviar" acepto los <a href="">Términos y condiciones</a> de uso, así como las <a href="">Políticas de privacidad</a>
        </p>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</template>

<script>
    export default {
        data: () => ({
            errors: [],
            nombre: null,
            apellidoPaterno: null,
            correoElectronico: null,
            password: null,
            password_confirmation: null
        }),

        methods: {
            checkForm: function (e) {
                e.preventDefault();

                this.errors = [];

                if (!this.nombre) {
                    this.errors.push('El campo nombre es obligatorio.');
                }

                if (!this.apellidoPaterno) {
                    this.errors.push('El campo apellido paterno es obligatorio.');
                }

                if (!this.correoElectronico) {
                    this.errors.push('El campo correo electronico es obligatorio.');
                }

                if (!this.password) {
                    this.errors.push('El campo contraseña es obligatorio.');
                }

                //Send the form
            }
        }
    }
</script>
