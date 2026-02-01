document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".toggle-items").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.order;
            const box = document.getElementById("items-" + id);

            if (box.style.display === "block") {
                box.style.display = "none";
                btn.innerHTML = "View Items ⌄";
            } else {
                box.style.display = "block";
                btn.innerHTML = "Hide Items ⌃";
            }
        });
    });
});
