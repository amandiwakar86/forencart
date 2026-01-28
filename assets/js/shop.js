let currentPage = 1;

function loadProducts(page = 1) {

    currentPage = page;

    const category = document.querySelector('[name="category"]')?.value || '';
    const min = document.querySelector('[name="min"]')?.value || '';
    const max = document.querySelector('[name="max"]')?.value || '';

    const formData = new FormData();
    formData.append('category', category);
    formData.append('min', min);
    formData.append('max', max);
    formData.append('page', page);

    fetch('ajax/shop-filter.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('shopProducts').innerHTML = html;
    });
}

// Initial load
document.addEventListener('DOMContentLoaded', () => {
    loadProducts();
});

// Price filter submit
document.querySelector('.price-filter')?.addEventListener('submit', e => {
    e.preventDefault();
    loadProducts(1);
});

// Category click (sidebar)
document.querySelectorAll('.shop-sidebar a').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();

        const url = new URL(link.href);
        const category = url.searchParams.get('category');

        let hidden = document.querySelector('[name="category"]');
        if (!hidden) {
            hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'category';
            document.querySelector('.price-filter').appendChild(hidden);
        }

        hidden.value = category || '';
        loadProducts(1);
    });
});
