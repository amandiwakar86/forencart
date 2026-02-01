// ✅ Global function (onclick ke liye)
function addToWishlist(productId) {

    // Safety check
    if (typeof BASE_URL === "undefined") {
        console.error("BASE_URL is not defined");
        alert("Configuration error. Please reload page.");
        return;
    }

    console.log("Adding to wishlist, product:", productId);

    fetch(BASE_URL + 'pages/add-to-wishlist.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'product_id=' + encodeURIComponent(productId)
    })
    .then(res => res.text())
    .then(msg => {
        console.log("Server response:", msg);
        alert(msg);
    })
    .catch(err => {
        console.error("Wishlist error:", err);
        alert("Something went wrong. Try again.");
    });
}
