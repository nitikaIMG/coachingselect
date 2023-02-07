
<?php
    if( preg_match('/coaching_admin/', url()->current()) ) {
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/website/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<main class="py-4">
<?php
    } else {
?>
    @include('website/layouts/header')
        
    <main id="main">
    
<?php
    }
?>


<link rel="stylesheet" href="{{ asset('/public/website/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('/public/website/assets/css/responsive.css')}}">

<style>
    body {
        padding-top: 0;
    }
</style>


<div id="layoutError">
    <div id="layoutError_content" class="row h-100 align-items-center">
        <main class="col-12">
            <div class="container vh-md-100 pt-md-0 pt-5">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-auto p-md-5 py-5">
                        <div class="text-center mt-md-4 mt-5 pt-md-0 pt-5">

                            <h1 class="text-center fs-lg-35 fs-md-30 fs-22 text-white">We're sorry, we can't find the page you're searching for.</h1>
                            <p class="lead fs-lg-17 fs-md-15 fs-14 text-center text-white my-md-4 my-2">While we look into it, perhaps, one of the links below will help.</p>
                            <div class="row mx-0 my-3 justify-content-center">
                                <div class="see_all col-md-6 text-center">
                                    
                                <?php
                                    if( preg_match('/coaching_admin/', url()->current()) ) {
                                ?>
                                    <a class="btn btn-sm btn-primary rounded-0 d-inline-flex align-items-center px-md-5 px-4 h-md-40px h-38px justify-content-center width_brochure_btn" 
                                    href="{{ asset('/coaching_admin')}}">
                                        <span> Home</span>
                                    </a>
                                
                                <?php 
                                    } else {
                                ?>
                                    
                                    <a class="btn btn-sm btn-primary rounded-0 d-inline-flex align-items-center px-md-5 px-4 h-md-40px h-38px justify-content-center width_brochure_btn" 
                                    href="{{ asset('/')}}">
                                        <span> Home</span>
                                    </a>
                                <?php 
                                    } 
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php
    if( preg_match('/coaching_admin/', url()->current()) ) {
?>

   
<?php
    } else {
?>

</main>
    @include('website/layouts/footer')
<?php
    }
?>