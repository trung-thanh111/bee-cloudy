var switchery = new Switchery('.js-switch', { size: 'small' });

document.getElementById('sortOption').addEventListener('change', function() {
    let sortValue = this.value;
    let currentUrl = window.location.href;
    let newUrl = new URL(currentUrl);
    newUrl.searchParams.set('sort', sortValue); // Thêm tham số sort vào URL
    window.location.href = newUrl.href; // Reload lại trang với URL mới
});
