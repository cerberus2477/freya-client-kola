// Reload page with filter parameters on change

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

// Click event for search button
searchButton.addEventListener('click', function (e) {
    e.preventDefault();
    updateURL();
    highlightSearchTermInResults(); // Ensure search term is highlighted
});

// Function to highlight the search term
function highlightSearchTermInResults() {
    const searchTerm = searchText.value.trim();
    if (!searchTerm) return;

    // Select all description, title, and plant elements
    const highlightTexts = document.querySelectorAll('.article-description, .article-title, .article-plant');
    const regex = new RegExp(`(${searchTerm})`, 'gi');

    highlightTexts.forEach(text => {
        // Highlight the search term in the text
        text.innerHTML = text.innerHTML.replace(regex, `<span class="highlight">$1</span>`);
    });
}

// Attach change event listener to filters
filters.forEach(filter => {
    filter.addEventListener('change', updateURL);
});

// Clear filters and reset form
clearFiltersButton.addEventListener('click', function () {
    filterForm.reset();
    updateURL();
});
