<!doctype html>
<html lang="en">
  <head>
    <title>Actividad de usuarios</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700, 900|Vollkorn:400i" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

  </head>
  <body>

    <div class="jumbotron text-center">
        <h1>Actividad de usuarios</h1>
        <p>Resize this responsive page to see the effect!</p>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">IP</th>
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{$log->created_at}}</td>
                            <td>{{$log->gamer->nick}}</td>
                            <td>{{$log->gamer->ip_address}}</td>
                            <td>{{$log->log_type->type}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </div>



  </div> <!-- .site-wrap -->

  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.js') }}"></script>

  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('js/jquery.sticky.js') }}"></script>
  <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('fontawesome/js/all.js') }}"></script>

  <script src="{{ asset('js/main.js') }}"></script>


  </body>
</html>
