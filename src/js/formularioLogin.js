const formulario_login = document.getElementById("formulario_login");
const inputs = document.querySelectorAll("#formulario_login input");

const expresiones = {
  correo: /^[a-zA-Z0-9._%+-]{1,30}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
  pass: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/

};

const validarFormulario = (e) => {
  const expresion = expresiones[e.target.name];
  if (expresion) {
    validarCampo(expresion, e.target);
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

formulario_login.addEventListener("submit", (e) => {
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
