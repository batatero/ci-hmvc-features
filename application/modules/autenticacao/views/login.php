<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CI-HMVC-ThidLayer</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
    <link href="<?php echo base_url('assets/view/autenticacao/css/login.css') ?>" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <div><?php echo $mensagens->mensagens(); ?></div>
      <div class="content">
        <div class="row">
          <div class="login-form">
            <h2>Login</h2>
            <form method="post" action="<?php echo base_url('index.php/autenticacao/autenticar')?>">
              <fieldset>
                <div class="clearfix">
                  <input type="text" placeholder="Login" name="usuario[login]">
                </div>
                <div class="clearfix">
                  <input type="password" placeholder="Password"name="usuario[senha]">
                </div>
                <button class="btn primary" type="submit">Sign in</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>