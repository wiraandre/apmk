<!DOCTYPE html>
<html>
<head>
          <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link
            rel="stylesheet"
            href="/assets/bootsrap/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        />

        <link
            rel="stylesheet"
            href="/css/signin.css"
            
        />
  <title>APMKP | login</title>
</head>
<body class="bg-dark">

    <form class="form-signin text-white" method="post" action="">
      <img class="mb-4" src="/logolitbang.png" >
      <h1 class="h3 mb-3 font-weight-normal">Silahkan login</h1>

          @if(session('danger'))
                <div class="alert alert-danger">{{ session('danger') }}</div>
          @endif


      <label for="inputEmail" class="sr-only">Alamat Email</label>
      {{ csrf_field() }}
      <input type="email" name="email" class="form-control" placeholder="Alamat Email" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
     <!--  <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div> -->
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019-{{ date('Y') }}</p>
    </form>
</body>
</html>

