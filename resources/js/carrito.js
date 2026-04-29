document.addEventListener("DOMContentLoaded", () => {

    // Cargar carrito desde localStorage
    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

    const actualizarLocalStorage = () => {
        localStorage.setItem("carrito", JSON.stringify(carrito));
    };

    // Botones + y -
    document.querySelectorAll(".btn-mas").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const item = carrito.find(p => p.id == id);
            item.cantidad++;
            actualizarLocalStorage();
            location.reload();
        });
    });

    document.querySelectorAll(".btn-menos").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const item = carrito.find(p => p.id == id);
            if (item.cantidad > 1) item.cantidad--;
            actualizarLocalStorage();
            location.reload();
        });
    });

    // Eliminar producto
    document.querySelectorAll(".btn-eliminar").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            carrito = carrito.filter(p => p.id != id);
            actualizarLocalStorage();
            location.reload();
        });
    });

    // Sincronizar carrito al iniciar sesión
    if (window.isLoggedIn && localStorage.getItem("carrito")) {
        fetch(window.syncCarritoUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.csrfToken
            },
            body: localStorage.getItem("carrito")
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "ok") {
                localStorage.removeItem("carrito");
            }
        });
    }
});
