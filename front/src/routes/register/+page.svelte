<script>
    let username = "";
    let email = "";
    let password = "";
    let password2 = "";

    function submit(){
        if(password != password2) return;

        const create = "http://localhost/my-movie-library/back/create-user.php";
        let data = new FormData();
        data.append("username", username);
        data.append("email", email);
        data.append("password", password);
        fetch(create, {
            method: "POST",
            body: data
        });

        window.location.href = "/login";
    }
</script>

<body>
    <h1>User registration</h1>

    <form on:submit|preventDefault={submit}>
        <input type="text" bind:value={username} placeholder="Username">
        <input type="text" bind:value={email} placeholder="E-mail">
        <input type="password" bind:value={password} placeholder="Password">
        <input type="password" bind:value={password2} placeholder="Password confirmation">
        {#if password != '' && password != password2}
            <div class="danger">Passwords don't match</div>
        {/if}
        <button>Register</button>
    </form>
</body>

<style>
    .danger {
        color: red;
    }
</style>