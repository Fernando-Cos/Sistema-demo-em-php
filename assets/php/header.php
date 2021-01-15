<?php 
require_once 'assets/php/session.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Fernando Amaral Da Costa">
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> | LOGO</title>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <style type="text/css">

    	@import url('https://fonts.googleapis.com/css?family=Maven+Pro:400,500,600,700,800,900display=swap');
    	* {
    		font-family: 'Arial', sans-serif;
    	}
      .circlo {
        border-radius: 50%;
        height: 100px;
        width: 100px;
        border: 1px solid #000000;
        background-color: #343a40;
      }

    </style>
  </head>

  <body>			
  	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  		<!-- Breend -->
  		<a href="navbar-brand" href="index.php"><i class="fas fa-code fa-lg"></i> &nbsp;&nbsp;LOGO</a>
  		<!-- colecions de button -->
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  			<span class="navbar-toggler-icon"></span>
  		</button>
  	<!-- Nav-Bar Link -->
  	<div class="collapse navbar-collapse" id="collapsibleNavbar">
  		<ul class="navbar-nav ml-auto">
  			<li class="nav-item">
  				<a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'home.php')? 'active':''; ?>" href="home.php"><i class=" fas fa-home"></i>&nbsp;Home</a>
  			</li>
  			<li class="nav-item">
  				<a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'profile.php')? 'active':''; ?>" href="profile.php"><i class="fas fa-user-circle"></i>&nbsp;Perfil</a>
  			</li>
  			<li class="nav-item">
  				<a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'feedback.php')? 'active':''; ?>" href="feedback.php"><i class="fas fa-comment-dots "></i>&nbsp;Feedback</a>
  			</li>
  			<li class="nav-item">
  				<a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'notification.php')? 'active':''; ?>" href="notification.php"><i class="fas fa-bell"></i>&nbsp;Notificações</a>
  			</li>
  			<li class="nav-item dropdown">
  				<a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
  					<i class="fas fa-user-cog"></i>&nbsp;Bem Vindo!  <?= $fname; ?>
  				</a>
  				<div class="dropdown-menu">
  					<a href="#" class="dropdown-item"><i class="fas fa-cog"></i>&nbsp;Configurações</a>
  					<a href="assets/php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a>
  				</div>
  			</li>
  		</ul>
  	</div>
  	</nav>