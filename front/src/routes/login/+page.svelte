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

        localStorage.setItem("isLogged", "true");
        window.location.href = "/library";
    }
</script>

<body>
    <div class="container">
        <h1>Login</h1>

        <form on:submit|preventDefault={submit}>
            <input type="text" bind:value={email} placeholder="E-mail">
            <br>
            <input type="password" bind:value={password} placeholder="Password">
            <br>
            <button>Login</button>
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
        width: 20rem;
        height: 30px;
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
</style>