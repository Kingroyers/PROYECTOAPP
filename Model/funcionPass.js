function togglePassword() {
    const input = document.getElementById("contraseña");
    const img = document.getElementById("iconoContraseña");

    if (input.type === "password") {
        input.type = "text";
        img.src = "../src/img/inconos/ojocerrado.png";
    } else {
        input.type = "password";
        img.src = "../src/img/inconos/ojoabierto.png";
    }
}