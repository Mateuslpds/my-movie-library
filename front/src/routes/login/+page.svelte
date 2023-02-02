<script>
    let email = "";
    let password = "";

    const submit = async () => {
        const login = "http://localhost/my-movie-library/back/login.php";

        const data = new FormData();
        data.append("email", email);
        data.append("password", password);

        const res = await fetch(login, {
            method: "POST",
            body: data,
            credentials: "include"
        });

        if(!res.ok){
            alert("Incorrect e-mail or password");
            return;
        }

        window.location.href = "/library";
    }
</script>

<body>
    <h1>Login</h1>

    <form on:submit|preventDefault={submit}>
        <input type="text" bind:value={email} placeholder="E-mail">
        <input type="text" bind:value={password} placeholder="Password">
        <button>Login</button>
    </form>
</body>