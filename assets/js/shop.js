// ===============================
// SHOP AJAX (FIXED VERSION)
// ===============================

function loadProducts(category = '', min = '', max = '') {

    const formData = new FormData();
    formData.append('category', category);
    formData.append('min', min);
    formData.append('max', max);

    fetch('ajax/shop-filter.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('shopProducts').innerHTML = html;
    });
}

/* INITIAL LOAD — READ FROM URL */
document.addEventListener('DOMContentLoaded', () => {

    if (window.SHOP_INITIAL_CATEGORY && window.SHOP_INITIAL_CATEGORY !== '') {
        loadProducts(window.SHOP_INITIAL_CATEGORY);
    } else {
        loadProducts();
    }

});

/* CATEGORY SIDEBAR CLICK */
document.querySelectorAll('#categoryList a').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();

        const category = link.dataset.category || '';
        loadProducts(category);

        // update URL without reload (important)
        const url = category
            ? `shop.php?category=${category}`
            : `shop.php`;
        window.history.pushState({}, '', url);
    });
});

/* PRICE FILTER */
const priceForm = document.getElementById('priceFilter');
if (priceForm) {
    priceForm.addEventListener('submit', e => {
        e.preventDefault();

        const min = document.getElementById('minPrice').value;
        const max = document.getElementById('maxPrice').value;

        loadProducts(window.SHOP_INITIAL_CATEGORY || '', min, max);
    });
}
