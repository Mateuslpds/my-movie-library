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
            window.location.href = "/";
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

    const logout = () => {
        const logoutRoute = "http://localhost/my-movie-library/back/logout.php"
        fetch(logoutRoute, {
            credentials: "include"
        });
        localStorage.removeItem("isLogged");
        window.location.href = "/";
    }
</script>

<body>
    <div class="container">
        <h1>Welcome to your personal movie library! <button class="logout-button" on:click={logout}>Logout</button></h1>
        <form on:submit|preventDefault={submit}>
            <input type="text" bind:value={title} placeholder="Title">
            <input type="text" bind:value={director} placeholder="Director">
            <input type="text" bind:value={genre} placeholder="Genre">
            <input type="number" bind:value={release_year} placeholder="Release Year">
            <button class="add-button">Add Movie</button>
        </form>
        {#each movies as movie}
            <div>
                <p>{movie.title} - {movie.director} - {movie.genre} - {movie.release_year} <span on:click={() => deleteMovie(movie.id)}>&times;</span></p>
            </div>
        {/each}
    </div>
</body>

<style>
    body{
        background-color: #14181c;
    }

    .container{
        text-align: center;
    }

    h1{
        margin-top: 15%;
        color: #abc;
        font-size: 3rem;
    }

    .logout-button{
        cursor: pointer;
        margin-left: 1rem;
        margin-right: 1rem;
        padding: 5px;
        font-size: 18px;
        background-color: #567;
        color: #c8d4e0;
        border-radius: 4px;
        border: 2px solid #2b343d;
    }

    .logout-button:hover {
        background-color: #af4c4c;
        color: white;
    }

    .add-button{
        cursor: pointer;
        margin-left: 1rem;
        margin-right: 1rem;
        padding: 8px;
        font-size: 20px;
        background-color: #567;
        color: #c8d4e0;
        border-radius: 5px;
        border: 2px solid #2b343d;
        transition-duration: 0.4s;
    }

    .add-button:hover {
        background-color: #4CAF50;
        color: white;
    }

    input{
        width: 15rem;
        height: 30px;
        margin-right: 0.5rem;
        margin-bottom: 10px;
    }

    p{
        color: #9ab;
        font-size: 1.5rem;
    }
    
    span {
      cursor: pointer;
      color: red;
    }
</style>