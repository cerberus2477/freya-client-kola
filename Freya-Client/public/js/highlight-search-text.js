document.addEventListener('DOMContentLoaded', function () {
    const searchTerm = document.getElementById('search-text').value.trim();
    highlightSearchTermInResults(searchTerm);
});

// Function to highlight the search term
function highlightSearchTermInResults(searchTerm) {
    if (!searchTerm) return;

    // If deepCheckbox is checked, search in '.article-description' as well
    const searchScope = document.getElementById('deep').checked
        ? '.article-description, .article-title, .article-plant'
        : '.article-title, .article-plant';

    const highlightTexts = document.querySelectorAll(searchScope);
    const regex = new RegExp(`(${searchTerm})`, 'gi');

    highlightTexts.forEach(text => {
        text.innerHTML = text.textContent.replace(regex, `<span class="highlight">$1</span>`);
    });
}