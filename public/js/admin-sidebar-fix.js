document.addEventListener('DOMContentLoaded', () => {
    const activeItem = document.querySelector(
        '.orchid-menu .active, .orchid-menu .menu-item.active'
    );

    if (activeItem) {
        activeItem.scrollIntoView({
            behavior: 'auto',
            block: 'center'
        });
    }
});
