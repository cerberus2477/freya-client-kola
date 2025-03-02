@extends('layout')

@section('content')
<div class="article-container" id="article-details">
    <h2>Betöltés...</h2>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const articleTitle = "{{ $title }}";

    fetch(`/api/articles/show/${articleTitle}`)
        .then(response => response.json())
        .then(article => {
            if (!article.title) {
                document.getElementById("article-details").innerHTML = `<p>Article not found.</p>`;
                return;
            }

            document.getElementById("article-details").innerHTML = `
                <h2>${article.title}</h2>
                <p><strong>By:</strong> ${article.author}</p>
                <p><strong>Plant Name:</strong> ${article.plant_name}</p>
                <p><strong>Updated:</strong> ${new Date(article.updated_at).toLocaleDateString()}</p>
                <p>${article.content}</p>
            `;
        })
        .catch(error => {
            console.error("Error fetching article:", error);
            document.getElementById("article-details").innerHTML = `<p>Article not found.</p>`;
        });
});
</script>
@endsection