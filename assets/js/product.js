// Change main image when thumbnail clicked
function changeImage(element) {
    const mainImage = document.getElementById("mainProductImage");
    mainImage.src = element.src;

    // active thumbnail effect
    document.querySelectorAll(".thumbnail").forEach(img => {
        img.classList.remove("active-thumb");
    });

    element.classList.add("active-thumb");
}


// Quantity Increase / Decrease
function changeQty(value) {
    const qtyInput = document.getElementById("qty");
    let current = parseInt(qtyInput.value);

    if (current + value >= 1) {
        qtyInput.value = current + value;
    }
}


// Simple star rating selection (for review form)
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("ratingValue");

    if (stars.length > 0) {
        stars.forEach((star, index) => {
            star.addEventListener("click", function() {
                ratingInput.value = index + 1;

                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add("selected");
                    } else {
                        s.classList.remove("selected");
                    }
                });
            });
        });
    }
});


document.getElementById("mainProductImage").addEventListener("click", function(){
    const lightbox = document.getElementById("lightbox");
    const img = document.getElementById("lightbox-img");

    img.src = this.src;
    lightbox.style.display = "flex";
});

document.getElementById("lightbox").addEventListener("click", function(){
    this.style.display = "none";
});
