document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("consultaForm");
    if (!form) return;

    const btn = document.getElementById("btnEnviar");
    const spinner = document.getElementById("spinner");

    const campos = form.querySelectorAll("input, textarea");

    const validar = () => {
        let ok = true;

        campos.forEach(c => {
            const val = c.value.trim();
            if (!val) ok = false;

            if (c.name === "email" && c.type === "email") {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!re.test(val)) ok = false;
            }

            if (!val) {
                c.classList.add("border-red-500");
                c.classList.remove("border-green-500");
            } else {
                c.classList.remove("border-red-500");
                c.classList.add("border-green-500");
            }
        });

        btn.style.display = ok ? "block" : "none";
    };

    campos.forEach(c => c.addEventListener("input", validar));

    form.addEventListener("submit", e => {
        e.preventDefault();
        btn.style.display = "none";
        spinner.classList.remove("hidden");

        setTimeout(() => {
            form.submit();
        }, 1500);
    });
});
