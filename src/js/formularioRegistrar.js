const formulario_registrar = document.getElementById("formulario_registrar");
const inputs = document.querySelectorAll("#formulario_registrar input");

const expresiones = {
  nombre: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,50}$/,
  apellido: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,50}$/,
  id: /^\d{7,10}$/,
  correo_register: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
  contraseña: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/,
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

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

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
    formulario_login.submit();
  } else {
    console.log("Formulario inválido. Revisa los campos.");
    e.preventDefault();
  }
});
