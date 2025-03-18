document.addEventListener('DOMContentLoaded', function () {
    const searchTerm = document.getElementById('search-text').value.trim();
    highlightSearchTermInResults(searchTerm);
});

function highlightSearchTermInResults(searchTerm) {
    if (!searchTerm) return;

    // If deepCheckbox is checked, search in '.article-description' as well
    const searchScope = document.getElementById('deep').checked
        ? '.article-description, .article-title a, .article-plant'
        : '.article-title a, .article-plant';

    const highlightTexts = document.querySelectorAll(searchScope);
    const regex = new RegExp(`(${searchTerm})`, 'gi');

    // put a highlight span around the results
    highlightTexts.forEach(text => {
        text.innerHTML = text.textContent.replace(regex, `<span class="highlight">$1</span>`);
    });
}


document.addEventListener("DOMContentLoaded", () => {
    const filterToggleBtn = document.getElementById("filter-toggle-btn");
    const filters = document.getElementById("filters");

    filterToggleBtn.addEventListener("click", () => {
        filters.classList.toggle("active");
    });
});