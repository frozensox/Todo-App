<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Local Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container-fluid">
    @include('commons.navbar')
  </div>

  <div class="container">
    @yield('content')
  </div>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous" defer></script>
  <!-- Local JS -->
  <script type="text/javascript">
    $(function () {
      $('.onload-focus').each((index, element) => {
        $(element).focus();
        element.setSelectionRange(-1, -1);
      });

      $('textarea').each((index, element) => {
        element.style.height = element.scrollHeight + 'px';
      });
      $('textarea').on('input', e => {
        e.target.style.height = '0';
        e.target.style.height = e.target.scrollHeight + 'px';
      });

      $('.task-menu-popper').click(e => {
        const thisTaskMenu = $(e.target).closest('.task-item').children('.task-menu')[0];
        $(thisTaskMenu).toggleClass('d-none');
        $('.task-menu').each((index, element) => {
          if (element != thisTaskMenu) {
            $(element).addClass('d-none');
          }
        });
        $('.popup-bg-filter').toggleClass('d-none');
      });
      $('.popup-bg-filter').click(e => {
        $('.task-menu').addClass('d-none');
        $('.popup-bg-filter').addClass('d-none');
      });
      $('button:not(.task-menu-popper, .task-menu-button), textarea').focus(e => {
        $('.task-menu').addClass('d-none');
        $('.popup-bg-filter').addClass('d-none');
      })
      $(window).blur(e => {
        $('.task-menu').addClass('d-none');
        $('.popup-bg-filter').addClass('d-none');
      })
    });
  </script>
</body>
</html>
