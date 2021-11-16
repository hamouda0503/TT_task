<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Welcome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
</head>

<body style="background-color: #e1f2f1; width: 100%;">
  <div id="email" style="background-color: #e1f2f1; width: 100%;">
    <div class="container" style="background-color: #4e73df; color: #fff; margin: auto; max-width: 650px; padding: 25px; text-align: center;">
      <div class="header">
        <img src="{{ \App\Helpers\Helpers::logoUrlm() }}" alt="tt Logo">
      </div>
      <div class="body">
        <h1 style="color: #fff;">@yield('title')</h1>
        @yield('content')
      </div>
      <div class="footer">
        <p>Copyright {{ date("Y") }} &copy;  <a style="color: #00BCD4" href="#" target="_blank">Tunisie Telecom</a></p>
      </div>
    </div>
  </div>
</body>
</html>