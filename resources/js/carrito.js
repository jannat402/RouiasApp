document.addEventListener("DOMContentLoaded", () => {

    // Si NO está logueado → usar localStorage
    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

    const actualizarLocalStorage = () => {
        localStorage.setItem("carrito", JSON.stringify(carrito));
    };

    // BOTÓN SUMAR
    document.querySelectorAll(".btn-mas").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;

            if (!window.isLoggedIn) {
                const item = carrito.find(p => p.id == id);
                if (item) item.cantidad++;
                actualizarLocalStorage();
                location.reload();
                return;
            }

            // Si está logueado → Laravel
            fetch('/carrito/agregar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ id })
            }).then(() => location.reload());
        });
    });

    // BOTÓN RESTAR
    document.querySelectorAll(".btn-menos").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;

            if (!window.isLoggedIn) {
                const item = carrito.find(p => p.id == id);
                if (item && item.cantidad > 1) item.cantidad--;
                actualizarLocalStorage();
                location.reload();
                return;
            }

            fetch('/carrito/agregar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ id, restar: true })
            }).then(() => location.reload());
        });
    });

    // BOTÓN ELIMINAR
    document.querySelectorAll(".btn-eliminar").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;

            if (!window.isLoggedIn) {
                carrito = carrito.filter(p => p.id != id);
                actualizarLocalStorage();
                location.reload();
                return;
            }

            fetch('/carrito/eliminar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ id })
            }).then(() => location.reload());
        });
    });
});
