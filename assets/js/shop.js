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

/* INITIAL LOAD */
document.addEventListener('DOMContentLoaded', () => {
    loadProducts();
});

/* CATEGORY CLICK */
document.querySelectorAll('#categoryList a').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();
        const category = link.dataset.category;
        loadProducts(category);
    });
});

/* PRICE FILTER */
document.getElementById('priceFilter').addEventListener('submit', e => {
    e.preventDefault();

    const min = document.getElementById('minPrice').value;
    const max = document.getElementById('maxPrice').value;

    loadProducts('', min, max);
});
