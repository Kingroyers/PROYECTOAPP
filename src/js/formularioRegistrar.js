const formulario_registrar = document.getElementById("formulario_registrar");
const inputs = document.querySelectorAll("#formulario_registrar input");

const expresiones = {
  nombre: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,}$/, // Solo letras y espacios, mínimo 3 caracteres.
  apellido: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,}$/, // Solo letras y espacios, mínimo 3 caracteres.
  id: /^\d{7,10}$/, // Solo números, mínimo 7 y máximo 10 caracteres.
  correo_register: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, // Formato válido de correo electrónico.
  contraseña: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/, // Al menos 8 caracteres, incluyendo una mayúscula, una minúscula, un número y un carácter especial.
};

const validarFormulario = (e) => {
  if (expresiones[e.target.name]) {
    validarCampo(expresiones[e.target.name], e.target);
  }
};

const validarCampo = (expresion, input) => {
  const errorMsg = input.nextElementSibling;

  if (expresion.test(input.value)) {
    input.classList.remove("formulario__grupo-incorrecto");
    input.classList.add("formulario__grupo-correcto");
    errorMsg.classList.remove("formulario__input-error-activo");
  } else {
    input.classList.remove("formulario__grupo-correcto");
    input.classList.add("formulario__grupo-incorrecto");
    errorMsg.classList.add("formulario__input-error-activo");
  }
};

// Escuchar eventos de validación en tiempo real
inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

// Validación final al enviar el formulario
formulario_registrar.addEventListener("submit", (e) => {
  let formularioValido = true;

  inputs.forEach((input) => {
    const expresion = expresiones[input.name];
    if (expresion && !expresion.test(input.value)) {
      validarCampo(expresion, input);
      formularioValido = false;
    }
  });

  if (formularioValido) {
    console.log("Formulario válido. Enviando...");
    formulario_login.submit(); // Envío directo del formulario
  } else {
    console.log("Formulario inválido. Revisa los campos.");
    e.preventDefault(); // Solo previene si hay errores
  }
});
