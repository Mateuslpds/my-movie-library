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
    <div class="container">
        <h1>User registration</h1>

        <form on:submit|preventDefault={submit}>
            <input type="text" bind:value={username} placeholder="Username">
            <input type="text" bind:value={email} placeholder="E-mail">
            <br>
            <input type="password" bind:value={password} placeholder="Password">
            <input type="password" bind:value={password2} placeholder="Password confirmation">
            {#if password != '' && password != password2}
                <div class="danger">Passwords don't match</div>
            {/if}
            <br>
            <button>Register</button>
        </form>
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

    input{
        width: 15rem;
        height: 30px;
        margin-right: 0.5rem;
        margin-bottom: 10px;
    }

    button{
        cursor: pointer;
        margin-top: 1rem;
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

    button:hover{
        background-color: #4c70af;
        color: white;
    }

    .danger {
        color: red;
    }
</style>