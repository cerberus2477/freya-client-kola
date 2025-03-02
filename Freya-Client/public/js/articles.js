
//reload page with filter parameters on change
document.addEventListener('DOMContentLoaded', function () {
    const filterForm = document.getElementById('filter-form');
    const searchButton = document.getElementById('search-button');
    const searchText = document.getElementById('search-text');
    const filters = document.querySelectorAll('.filter-dropdown, input');

    function updateURL() {
        filterForm.submit();
    }

    searchButton.addEventListener('click', function (e) {
        e.preventDefault();
        updateURL();
    });

    filters.forEach(filter => {
        filter.addEventListener('change', updateURL);
    });
});