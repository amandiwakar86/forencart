document.querySelector('.mobile-toggle')?.addEventListener('click', () => {
    document.querySelector('.nav-links').classList.toggle('active');
});



    const bottomNav = document.querySelector('.bottom-nav');
    const spacer = document.querySelector('.nav-spacer');
    const stickyPoint = bottomNav.offsetTop;

    window.addEventListener('scroll', () => {
        if (window.scrollY > stickyPoint) {
            bottomNav.classList.add('is-sticky');
            spacer.style.display = 'block';
        } else {
            bottomNav.classList.remove('is-sticky');
            spacer.style.display = 'none';
        }
    });

