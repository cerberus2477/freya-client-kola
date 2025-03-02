<!-- TODO: somehow pass through whether the filters are active and the content of the search field. the goal is to get to e.g /articles-filter/q=searctext&category=recept (if cikk fajtája filter is set to recept) which gets the the articles from 127.0.0.1:8069/api/articles/search?q=searctext&category=recept -->
<!-- each time a filter is set or the search button is clicked, the page should reload with the correct articles showing. -->


@extends('layout')

@section('content')
<header class="header-articles">
    <h1 class="header-title">Összes cikk</h1>
</header>
<main>
    <div class="filters">
        <h2>Szűrők</h2>
        <!-- GET /api/articles/search?q=&deep?&author=&plant=&typeofplant=&category=&before=&after= -->
        <div class="category-container">
            <h3>Szűrés növény alapján</h3>
            <!-- TODO: these should be dropdowns. each plant has a type. only display the plants where the type is matching the növény fajtája. -->
            <button type="submit" class="btn filter-checkbox" id="fbtn1">Növény fajtája</button>
            <!-- GET /types  &typeofplant= -->
            <!-- the user should be able to start typeing the name of the plant with the matching plants being in a dropdown. the user should select one of the plants. -->
            <button type="submit" class="btn filter-checkbox" id="fbtn2">Növény neve </button>
            <!-- GET /plants &plant= -->
        </div>

        <div class="category-container">
            <h3>Többi szűrő</h3>
            <!-- TODO: this should be a date picker (calendar style) -->
            <!-- Cikk dátuma:
            ... -tól -> &after= 
            .... - ig -> &before= -->

            <!-- Cikk fajtája:
            dropdown of GET /categories -> &category= -->

            <!-- maybe author search -->
        </div>
    </div>


    <div class="articles-container">
        <div class="searchbar">
            <input type="text" name="" id="">
            <a href="{{ route('articles.filter') }}" class="btn"><i class="fa-solid fa-search"></i></a>
            <!-- q=searchtext -->
            <!-- <input:checkbox> keresés a tartalomban is -> &deep-->
        </div>

        <div class="results">


            @foreach ($articles as $article)
            <div class="card article-card">
                <p>{{$article->author}}</p>
                <p>{{ $article->modified_at }}</p>
                <h3>{{ $article->title }}</h3>
                <p class="article-description">{{$article->description}}</p>
            </div>
            @endforeach



        </div>

        <!-- TODO -->
        <div class="pages">
            Cikkek száma oldalanként:
            <select>
                <option>10</option>
                <option>15</option>
                <option>20</option>
                <option>25</option>
                <option>50</option>
                <option>összes cikk</option>
            </select>
            <!-- &pageSize=
            or
            ?all
            if ?all or no more pages or on first page, make the corresponding buttons inactive. -->
            x. oldal y-z. cikk
            <a href="{{ route('articles.filter') }}" class="btn"><i class="fa-solid fa-chevron-left"></i></a>
            <!-- &page= -->
            <a href="{{ route('articles.filter') }}" class="btn"><i class="fa-solid fa-chevron-right"></i></a>
        </div>

    </div>
</main>