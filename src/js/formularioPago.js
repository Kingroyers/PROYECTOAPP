const formulario_pago = document.getElementById("formulario_pago");
const inputs = document.querySelectorAll("#formulario_pago input");

const expresiones = {
  titular: /^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]{3,50}$/, // Solo letras y espacios, mínimo 3 caracteres
  numero_tarjeta: /^\d{16}$/, // 16 dígitos numéricos
  caducidad: /^\d{4}-(0[1-9]|1[0-2])$/, // Formato YYYY-MM
  codigo_seguridad: /^\d{3}$/, // 3 dígitos numéricos
  identificacion: /^\d{7,10}$/, // Solo números, mínimo 7 y máximo 10 dígitos.
};

const validarFormulario = (e) => {
  if (expresiones[e.target.name]) {
    validarCampo(expresiones[e.target.name], e.target);
  }
};

const validarCampo = (expresion, input) => {
  const errorMsg = input.nextElementSibling;

  if (input.name === "caducidad") {
    const [anio, mes] = input.value.split("-").map(Number);
    const anioMinimo = 2026;
    const mesMinimo = 1;

    if (
      !input.value ||
      anio < anioMinimo ||
      (anio === anioMinimo && mes < mesMinimo)
    ) {
      input.classList.add("formulario__grupo-incorrecto");
      input.classList.remove("formulario__grupo-correcto");
      errorMsg.textContent =
        "La fecha de caducidad debe ser mínimo enero de 2026.";
      errorMsg.classList.add("formulario__input-error-activo");
    } else {
      input.classList.remove("formulario__grupo-incorrecto");
      input.classList.add("formulario__grupo-correcto");
      errorMsg.classList.remove("formulario__input-error-activo");
    }
  } else if (expresion.test(input.value)) {
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

formulario_pago.addEventListener("submit", (e) => {
  e.preventDefault();

  let formularioValido = true;

  inputs.forEach((input) => {
    if (expresiones[input.name] && !expresiones[input.name].test(input.value)) {
      console.log(
        `Campo NO válido: ${input.name} - Valor ingresado: ${input.value}`
      );
      formularioValido = false;
    }
  });

  if (formularioValido) {
    console.log("Formulario válido, enviando...");
    formulario_pago.submit();
  } else {
    console.log("Formulario NO válido, revisa los errores.");
  }
});
