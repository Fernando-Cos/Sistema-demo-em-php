<?php 
session_start();
if (isset($_SESSION['user'])) {
  header('location:home.php');
}
 ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Funcionarios</title>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body class="bg-info">

    <div class="container">
      <!-- Login Form Start -->
      <div class="row justify-content-center wrapper" id="login-box">
        <div class="col-lg-10 my-auto myShadow">
          <div class="row">
            
            <div class="col-lg-7 bg-white p-4">
              <h1 class="text-center font-weight-bold">Acessar Conta</h1>
              <h5 class="text font-weight-bold"> Aqui voce pode estar acessando sua conta para dar entrada no sistema...</h5>
              <hr class="my-2" />
              <form action="#" method="post" class="px-3" id="login-form">
                <div id="loginAlert"></div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="far fa-envelope fa-lg fa-fw"></i></span>
                  </div>
                  <input type="email" id="email" name="email" class="form-control rounded-0" placeholder="E-Mail" required value="<?php if (isset($_COOKIE['email'])) {echo $_COOKIE['email']; } ?>">  
                  <?php ?>
                </div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" id="password" name="password" class="form-control rounded-0" minlength="5" placeholder="Senha" required autocomplete="off" value="<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password']; } ?>"> 
                </div>
                <div class="form-group clearfix">
                  <div class="custom-control custom-checkbox float-left">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="rem" <?php if (isset($_COOKIE['email'])) { ?> checked <?php } ?>>
                    <label class="custom-control-label" for="customCheck">Lembre-se</label>
                  </div>
                  <div class="forgot float-right">
                   <!--  <a href="#" id="forgot-link">Esqueceu Sua Senha?</a> -->
                  </div>
                  
                </div>
                <div class="form-group">
                  <input type="submit" id="login-btn" value="Acessar" class="btn btn-primary btn-lg myBtn" />
                </div>
              </form>
            </div>
            <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
              <h1 class="text-center font-weight-bold text-white">LOGO</h1>
              <hr class="my-3 bg-light myHr" />
              <p class="text-center font-weight-bolder text-light lead">Sistema sistematizado por Fernando Amaral, com o intuito de estudo ha linguagem de programação php!</p>
              <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link">Criar Conta</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Login Form End -->
      
      <!-- Registration Form Start -->
      <div class="row justify-content-center wrapper" id="register-box" style="display: none;">
        <div class="col-lg-10 my-auto myShadow">
          <div class="row">
            <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
              <h1 class="text-center font-weight-bold text-white">LOGO!</h1>
              <hr class="my-4 bg-light myHr" />
              <p class="text-center font-weight-bolder text-light lead">Area destinada a criação de novos usuarios do sistema.</p>
              <button class="btn btn-outline-light btn-lg font-weight-bolder mt-4 align-self-center myLinkBtn" id="login-link">Voltar</button>
            </div>
            <div class="col-lg-7 bg-white p-4">
              <h1 class="text-center font-weight-bold">Nova Conta</h1>
              <hr class="my-3" />
              <form action="#" method="post" class="px-3" id="register-form">
                <div id="regAlert"></div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="far fa-user fa-lg fa-fw"></i></span>
                  </div>
                  <input type="text" id="name" name="name" class="form-control rounded-0" placeholder="Nome Completo" required />
                </div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="far fa-envelope fa-lg fa-fw"></i></span>
                  </div>
                  <input type="email" id="remail" name="email" class="form-control rounded-0" placeholder="E-Mail" required />
                </div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" id="rpassword" name="password" class="form-control rounded-0" minlength="5" placeholder="Password" required />
                </div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" id="cpassword" name="cpassword" class="form-control rounded-0" minlength="5" placeholder="Confirme Password" required />
                </div>
                <div class="form-group">
                  <div id="passError" class="text-danger font-weight-bold"></div>
                </div>
                <div class="form-group">
                  <input type="submit" id="register-btn" value="Criar" class="btn btn-primary btn-lg myBtn" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Registration Form End -->

      <!-- Forgot Password Form Start -->
      <div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
        <div class="col-lg-10 my-auto myShadow">
          <div class="row">
            <div class="col-lg-7 bg-white p-4">
              <h1 class="text-center font-weight-bold text-primary">Esqueceu sua senha?</h1>
              <hr class="my-3" />
              <p class="lead text-center text-secondary">Aqui voce pode estar redefinindo uma nova senha de usuario para voce!</p>
              <form action="#" method="post" class="px-3" id="forgot-form">
                <div id="forgotAlert"></div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="far fa-envelope fa-lg"></i></span>
                  </div>
                  <input type="email" id="femail" name="email" class="form-control rounded-0" placeholder="E-Mail" required />
                </div>
                <div class="form-group">
                  <input type="submit" id="forgot-btn" value="Reset Password" class="btn btn-primary btn-lg btn-block myBtn" />
                </div>
              </form>
            </div>
            <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
              <h1 class="text-center font-weight-bold text-white">LOGO</h1>
              <p class="text-center font-weight-bolder text-light lead">Sistema de login criado por Fernando Amaral, com o objetivo de estudo na linguagem php!</p>
              <hr class="my-4 bg-light myHr" />
              <button class="btn btn-outline-light btn-lg font-weight-bolder myLinkBtn align-self-center" id="back-link">Voltar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Forgot Password Form End -->
    </div>
    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    
  </body>
</html>