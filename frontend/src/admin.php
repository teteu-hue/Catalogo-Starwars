<?php include_once __DIR__ . "/static/header.php"; 
if(isset($_SESSION['userId'])){
    header('Location: home.view.php');
}
?>

<main class="d-flex justify-content-center py-4 mt-5 form-signin w-full">
  <form id="login-form">
    <h1 class="mb-3 fw-normal text-white text-center">
        Login
    </h1>

    <div class="form-floating">
        <input type="email" class="form-control" id="email" placeholder="name@example.com">
        <label for="email">Digite o email</label>
    </div>
    <div class="form-floating mt-5">
      <input type="password" class="form-control" id="password" placeholder="Digite sua senha">
      <label for="password">Senha</label>
      <span class="text-danger m-2" id="error-submit"></span>
    </div>
    <button class="btn btn-primary w-100 py-2 mt-5" type="submit">Sign in</button>
  </form>
</main>

<script>
    $(document).on('submit', function(e){
        e.preventDefault();

        const email = $("#email").val();
        const password = $("#password").val();
        
        $.ajax({
            url: `${BASE_PATH}/login`,
            method: 'POST',
            crossDomain: true,
            data: {
                email: email,
                senha: password
            },
            error: (err) => {
                $("#error-submit").text(err.responseJSON.data);
            },
            success: (response) => {
                const {userId, token} = response.data;

                $.ajax({
                    url: "./functions/session_handler.php",
                    type: "POST",
                    data: {
                        userId: userId,
                        token: token
                    },
                    success: (response) => {
                        if(response.message != "success"){
                            alert("Erro ao salvar");
                        }
                        alert("Sucesso ao gravar sessao!");
                        window.location.href = "home.view.php";
                    }
                });
            }
            
        });
    });

</script>

<?php include_once __DIR__ . "/static/footer.php";?>