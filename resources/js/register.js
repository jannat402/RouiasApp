document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("registerForm");
    const inputs = document.querySelectorAll(".input-field");
    const submitBtn = form.querySelector("button");

    const validarNom = val => /^[A-Za-zÀ-ÿ]{2,}( [A-Za-zÀ-ÿ]{2,}){1,3}$/.test(val);
    const validarEdat = val => {
        const data = new Date(val);
        const avui = new Date();
        const edat = avui.getFullYear() - data.getFullYear();
        return edat >= 18 && edat <= 100;
    };
    const validarTelefon = val => /^\+\d{2,3} \d{6,12}$/.test(val);
    const validarEmail = val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);

    const validar = () => {
        let ok = true;

        inputs.forEach(input => {
            const val = input.value.trim();
            let valid = true;

            if (input.name === "name") valid = validarNom(val);
            if (input.name === "fecha_nacimiento") valid = validarEdat(val);
            if (input.name === "telefono") valid = validarTelefon(val);
            if (input.name === "email") valid = validarEmail(val);

            if (!valid) {
                ok = false;
                input.classList.add("border-red-500");
            } else {
                input.classList.remove("border-red-500");
                input.classList.add("border-green-500");
            }
        });

        submitBtn.disabled = !ok;
    };

    inputs.forEach(i => i.addEventListener("input", validar));

    // Copiar dirección
    document.getElementById("copiarDireccion").addEventListener("change", e => {
        if (e.target.checked) {
            document.querySelector("input[name='direccion_facturacion']").value =
                document.querySelector("input[name='direccion_envio']").value;
        }
    });

    // Medidor de contraseña
    const password = document.getElementById("password");
    const meter = document.getElementById("passwordMeter");
    const strengthText = document.getElementById("passwordStrength");

    password.addEventListener("input", () => {
        const val = password.value;
        let score = 0;

        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        meter.value = score;

        const levels = ["Muy débil", "Débil", "Media", "Fuerte", "Muy fuerte"];
        const colors = ["red", "orange", "yellow", "green", "green"];

        strengthText.textContent = levels[score];
        strengthText.style.color = colors[score];

        validar();
    });

});
