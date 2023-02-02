<script>
    import { onMount } from "svelte";

    let movies = [];

    let title = "";
    let director = "";
    let genre = "";
    let release_year = "";

    const loadMovies = async () => {
        const load = "http://localhost/my-movie-library/back/get-user-movies.php";
        const res = await fetch(load, {
            credentials: "include"
        });
        if (!res.ok) {
            alert("You're not logged in!");
            return;
        }
        movies = await res.json();
    }

    onMount(() => {
        loadMovies();
    });

    const submit = async () => {
        const create = "http://localhost/my-movie-library/back/create-movie.php";
        const data = new FormData();
        data.append("title", title);
        data.append("director", director);
        data.append("genre", genre);
        data.append("release_year", release_year);
        let res = await fetch(create, {
            method: "POST",
            body: data,
            credentials: "include"
        });
        if(!res.ok){
            alert("Unable to add movie to library");
            return;
        }
        loadMovies();
    }

    const deleteMovie = async(id) => {
        const data = new FormData();
        data.append("id", id);
        const deleteRoute = "http://localhost/my-movie-library/back/delete-movie.php";
        const res = await fetch(deleteRoute, {
            method: "POST",
            body: data,
            credentials: "include"
        });
        if(!res.ok){
            alert("Unable to delete movie");
            return;
        }
        loadMovies();
    }
</script>

<body>
    <form on:submit|preventDefault={submit}>
        <input type="text" bind:value={title} placeholder="Title">
        <input type="text" bind:value={director} placeholder="Director">
        <input type="text" bind:value={genre} placeholder="Genre">
        <input type="number" bind:value={release_year} placeholder="Release Year">
        <button>Add Movie</button>
    </form>
    {#each movies as movie}
        <div>
            {movie.title} - {movie.director} - {movie.genre} - {movie.release_year}
            <span on:click={() => deleteMovie(movie.id)}>&times;</span>
        </div>
    {/each}
</body>

<style>
    div > span {
      cursor: pointer;
      color: red;
    }
  </style>