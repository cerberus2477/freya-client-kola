
//reload page with filter parameters on change
document.addEventListener('DOMContentLoaded', function () {
    const searchButton = document.getElementById('search-button');
    const searchText = document.getElementById('search-text');
    const deepCheckbox = document.getElementById('deep');

    const filterForm = document.getElementById('filter-form');
    const filters = document.querySelectorAll('.filter-dropdown, input');
    const clearFiltersButton = document.getElementById('clear-filters');

    function updateURL() {
        const params = new URLSearchParams(new FormData(filterForm));

        // Ensure 'deep' is only included if checked
        if (!deepCheckbox.checked) {
            params.delete('deep');
        }

        // Remove empty filters
        for (const [key, value] of params.entries()) {
            if (!value.trim()) {
                params.delete(key);
            }
        }

        console.log(`${filterForm.action}?${params.toString()}`);
        window.location.href = `${filterForm.action}?${params.toString()}`;
        // filterForm.submit();
    }

    searchButton.addEventListener('click', function (e) {
        e.preventDefault();
        updateURL();
    });

    filters.forEach(filter => {
        filter.addEventListener('change', updateURL);
    });

    clearFiltersButton.addEventListener('click', function () {
        filterForm.reset();
        updateURL();
    });
});
