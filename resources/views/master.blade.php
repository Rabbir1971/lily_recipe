<?php
/**
 * User: MD. Rabbir Hossain
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.header')
</head>
<body>
<header>
    <div class="menu">
        @include('pages.navigation')
    </div>

</header>

<div class="container" style="margin-top: 55px;">
    <div class="content">
        @include('pages.message')
        @yield('content')
    </div>
</div>

<footer>
    @include('pages.footer')
</footer>
<script>
    $('div.alert').not('.alert-danger').delay(5000).slideUp(300);
</script>

</body>
</html>
