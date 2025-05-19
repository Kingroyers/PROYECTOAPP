  
        function habilitarCampo(id) {
            const campo = document.getElementById(id);
            campo.disabled = false;
            campo.focus();
        }

        const formulario = document.getElementById('formulario_registrar');
        const inputs = formulario.querySelectorAll('.form-control');

        const expresiones = {
            nombre: /^[a-zA-ZÀ-ÿ\s]{3,50}$/,
            apellido: /^[a-zA-ZÀ-ÿ\s]{3,50}$/,
            correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
            password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,50}$/

        };

        const campos = {
            nombre: false,
            apellido: false,
            correo: false,
            password: true // Vacío = válido (no obligatorio)
        };

        function validarCampo(expresion, input, campo) {
            const error = input.parentElement.parentElement.querySelector('.formulario__input-error');
            if (expresion.test(input.value)) {
                error.style.display = 'none';
                campos[campo] = true;
            } else {
                error.style.display = 'block';
                campos[campo] = false;
            }
        }

        function validarFormulario(e) {
            switch (e.target.name) {
                case 'nombre':
                    validarCampo(expresiones.nombre, e.target, 'nombre');
                    break;
                case 'apellido':
                    validarCampo(expresiones.apellido, e.target, 'apellido');
                    break;
                case 'correo':
                    validarCampo(expresiones.correo, e.target, 'correo');
                    break;
                case 'password':
                    if (e.target.value.length === 0) {
                        e.target.parentElement.parentElement.querySelector('.formulario__input-error').style.display = 'none';
                        campos['password'] = true;
                    } else {
                        validarCampo(expresiones.password, e.target, 'password');
                    }
                    break;
            }
        }

        inputs.forEach(input => {
            input.addEventListener('keyup', validarFormulario);
            input.addEventListener('blur', validarFormulario);
        });

        formulario.addEventListener('submit', function(e) {
            // Validar todos los campos al enviar
            inputs.forEach(input => {
                if (input.name in expresiones) {
                    validarFormulario({ target: input });
                }
            });

            if (!(campos.nombre && campos.apellido && campos.correo && campos.password)) {
                e.preventDefault();
                alert('Por favor corrige los errores en el formulario antes de enviar');
            }
        });

        // Al enviar habilitar todos los inputs para que se envíen
        formulario.addEventListener("submit", function() {
            inputs.forEach(input => input.disabled = false);
        });
    