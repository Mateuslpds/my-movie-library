<script>
    import { onMount } from "svelte";

    let isLogged = "";

    onMount(() => {
        isLogged = localStorage.getItem('isLogged');
    });
</script>

<body>
    <div class="container">
        <h1>Create your own movie library!</h1>

        {#if isLogged != "true"}
        <a href="/login">Login</a>
        <a href="/register">Register</a>
        {:else}
        <a href="/library">My Library</a>
        {/if}
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
        font-size: 5rem;
    }

    a{
        margin-left: 2rem;
        margin-right: 2rem;
        color: #def;
        font-size: 2rem;
        text-decoration: none;
    }
</style>