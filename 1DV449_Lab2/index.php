<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="ico/favicon.png">

    <title>Närproducerat 2.0 - Logga in</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    
    <link href="css/index.css" rel="stylesheet">
    
    

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="check.php" method="POST">
        <h2 class="form-signin-heading">Logga in
		</h2>
        <input name="username" type="text" class="form-control" placeholder="Användarnamn" required autofocus><!--/////SÄKERHET SKRIVER UT ANAMN BY DEFAULT-->
        <input name="password" type="password" class="form-control" placeholder="Password" required><!--/////SÄKERHET SKRIVER UT LÖSEN BY DEFAULT-->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Logga in</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>

