<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin - SD Task Management</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="StyleSheet" href="css/styles.css" />
</head>

<body class="text-center">
<form class="form-signin" action="login.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">SD Task Management</h1>
    <label for="inputEmail" class="sr-only">User</label>
    <input type="text" id="inputUser" class="form-control"
           placeholder="Username" required autofocus name="user">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control"
           placeholder="Password" required name="pass">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in
    </button>
</form>
</body>
</html>
