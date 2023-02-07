<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    use App\Helpers\Helpers;
    ?>

    <!-- Page expire error -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="IMG Global Infotech" />
    <meta name="author" content="IMG Global Infotech" />
    <title>Dashboard - {{ Helpers::settings()->project_name ?? '' }}</title>

    <!-- multi select input -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    

    <link href="{{ asset('public/css/bootstrap.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('public/favicon.png') }}" />
    <link href="{{ asset('public/css/bijarniadream.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/css/theme1.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/css/jquery.datetimepicker.css') }}" rel="stylesheet" />
    <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.6/dist/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.6/dist/sweetalert2.css" />


    <!-- ckeditor -->
    <script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
        
    <!-- download or export btn in datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>

    <!-- download or export btn in datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css">

    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <style>
        /*--------------------------------------------------------------
    # preloader_admin
    --------------------------------------------------------------*/
        #preloader_admin {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
            overflow: hidden;
            background: #FAFAFA;
            display: block;
        }

        main {
            position: relative;
        }

        #preloader_admin:before {
            content: "";
            position: fixed;
            top: calc(50% - 30px);
            left: calc(50% - 30px);
            border: 6px solid #106eea;
            border-top-color: #e2eefd;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            -webkit-animation: animate-preloader_admin 1s linear infinite;
            animation: animate-preloader_admin 1s linear infinite;
        }

        @-webkit-keyframes animate-preloader_admin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes animate-preloader_admin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #pdf-eye {
            margin: 0;
            margin-right: 30px;
            margin-top: 3px;
        }
    </style>

    @include('css_color')


    <!-- tags -->
    <link rel="stylesheet" href="{{ asset('public/fastselect-master/dist/fastselect.min.css') }}">
    <script src="{{ asset('public/fastselect-master/dist/fastselect.standalone.js') }}"></script>
    
    <style>
    .dt-buttons {
      margin: 10px
    }
    </style>

</head>

<body class="nav-fixed">

    <div id="preloader_admin">
    </div>

    <?php

    #User subadmin Permissions - date: 27 dec

    $r1 = Route::getCurrentRoute()->getAction();
    $r2 = Route::currentRouteAction();
    $r3 = Route::currentRouteName();

    $r4 = explode('@', $r2);

    $permissions_string = Auth::user()->permissions;
    $permissions_array = explode(',', $permissions_string);

    #end subadmin Permissions work
    ?>

    <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
        <a class="navbar-brand" href="{{ asset('/coaching_admin')}}">

            @if(empty(Helpers::settings()->project_name_or_logo) or Helpers::settings()->project_name_or_logo == 'logo' or Helpers::settings()->project_name_or_logo == 'both')
            <span>
                <img class="img-fluid h-50px d-none d-sm-inline-block" src="{{ asset('public/website/assets/img/site_logo1.png') }}" onerror="this.src=`{{ asset('public/website/assets/img/site_logo1.png')}}`" />
                <img class="img-fluid h-50px d-inline-block d-sm-none" src="{{ asset('public/website/assets/img/site_logo1.png') }}" onerror="this.src=`{{ asset('public/website/assets/img/site_logo1.png')}}`" />
            </span>
            @endif

            @if(empty(Helpers::settings()->project_name_or_logo) or Helpers::settings()->project_name_or_logo == 'project_name' or Helpers::settings()->project_name_or_logo == 'both')
            <span class="ml-1 d-none d-sm-inline-block">
                {{ Helpers::settings()->project_name ?? '' }}
            </span>
            <span class="ml-1 d-inline-block d-sm-none">
                {{ Helpers::settings()->short_name ?? '' }}
                @endif

            </span>

        </a>

        <button class="btn btn-sm btn-icon order-1 order-lg-0 mr-lg-2" id="sidebarToggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="18" viewBox="0 0 27.623 18" class="injectable">
                <g transform="translate(-599 -99)">
                    <path d="M624.811,134.423h-24A1.817,1.817,0,0,1,599,132.611h0a1.817,1.817,0,0,1,1.811-1.811h24a1.817,1.817,0,0,1,1.811,1.811h0A1.817,1.817,0,0,1,624.811,134.423Z" transform="translate(0 -24.6)" fill="#134ee6"></path>
                    <path d="M618.019,166.123H600.811A1.817,1.817,0,0,1,599,164.311h0a1.817,1.817,0,0,1,1.811-1.811h17.208a1.817,1.817,0,0,1,1.811,1.811h0A1.817,1.817,0,0,1,618.019,166.123Z" transform="translate(0 -49.123)" fill="#134ee6"></path>
                    <path d="M613.491,102.623H600.811A1.817,1.817,0,0,1,599,100.811h0A1.817,1.817,0,0,1,600.811,99h12.679a1.817,1.817,0,0,1,1.811,1.811h0A1.817,1.817,0,0,1,613.491,102.623Z" fill="#134ee6"></path>
                </g>
            </svg>
        </button>
        <ul class="navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown no-caret mr-3 dropdown-user">
                <a class="btn btn-sm btn-icon btn-sm btn-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="" onerror="this.src=`{{ asset('public/logo.png')}}`" /></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="" onerror="this.src=`{{ asset('public/logo.png')}}`">
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?php echo auth()->user()->name; ?></div>
                            <div class="dropdown-user-details-email"><?php echo auth()->user()->email; ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{action('AdminController@admin_profile')}}">
                        <div class="dropdown-item-icon"><i class="fad fa-user"></i></div>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout').submit()">
                        <div class="dropdown-item-icon"><i class="fad fa-sign-out-alt"></i></div>
                        Logout
                    </a>
                    <form action="{{route('logout')}}" method="post" id="logout">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">

                    <div class="nav accordion pt-2" id="accordionSidenav">
                        <!-- <div class="sidenav-menu-heading"></div> -->
                        <a class="nav-link" href="{{ asset('/coaching_admin') }}">
                            <div class="nav-link-icon"><i class="fad fa-home-heart"></i></div> Dashboard
                        </a>

                        <div class="sidenav-menu-heading">Modules</div>

                        @if( 
                            preg_match('/StreamsController/', $permissions_string) ||
                            preg_match('/CoursesController/', $permissions_string) ||
                            preg_match('/FacilityController/', $permissions_string) ||
                            Auth::user()->role == '1' || $permissions_string == '*'
                        )
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-ui-settings" aria-expanded="false" aria-controls="collapse-ui-settings">
                            <div class="nav-link-icon"><i class="fad fa-university"></i></div>
                            Streams, Courses, Facilities 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-ui-settings" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("StreamsController@add_stream" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('StreamsController@add_stream')}}">Add Stream</a>
                                @endif

                                @if( in_array("StreamsController@view_stream" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('StreamsController@view_stream')}}">View Streams</a>
                                @endif

                                @if( in_array("CoursesController@add_course" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('CoursesController@add_course')}}">Add Course</a>
                                @endif
                            
                                @if( in_array("CoursesController@view_course" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('CoursesController@view_course')}}">View Course</a>
                                @endif

                                @if( in_array("FacilityController@add_facility" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('FacilityController@add_facility')}}">Add Facilities</a>
                                @endif

                                @if( in_array("FacilityController@view_facility" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('FacilityController@view_facility')}}">View Facilities</a>
                                @endif
                            </nav>
                        </div>
                        @endif
                        
                        @if( 
                            preg_match('/BlogsCategoryController/', $permissions_string) ||
                            preg_match('/BlogsController/', $permissions_string) ||
                            Auth::user()->role == '1' || $permissions_string == '*'
                        )
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-blog" aria-expanded="false" aria-controls="collapse-blog">
                            <div class="nav-link-icon"><i class="fas fa-users"></i></div>
                            Blogs  
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-blog" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                <div class="nav accordion pt-0 pr-3" id="accordionSidenavchild">
                                        
                                    @if( preg_match('/BlogsCategoryController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-blog-category" aria-expanded="false" aria-controls="collapse-blog-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Categories
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-blog-category" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("BlogsCategoryController@add_blog_category" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('BlogsCategoryController@add_blog_category')}}">Add </a>
                                            @endif

                                            @if( in_array("BlogsCategoryController@view_blog_category" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('BlogsCategoryController@view_blog_category')}}">View </a>
                                            @endif
                                        </nav>
                                    </div>
                                    @endif

                                    @if( preg_match('/BlogsController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-blog-category1" aria-expanded="false" aria-controls="collapse-blog-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Blogs
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-blog-category1" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("BlogsController@add_blog" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('BlogsController@add_blog')}}">Add</a>
                                            @endif

                                            @if( in_array("BlogsController@view_blog" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('BlogsController@view_blog')}}">View</a>
                                            @endif
                                        </nav>
                                    </div>
                                    @endif
                                </div>
                            </nav>
                        </div>  
                        @endif                      

                        @if( preg_match('/StudentQuestionsAnswersController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-student-questions-answers" aria-expanded="false" aria-controls="collapse-student-questions-answers">
                            <div class="nav-link-icon"><i class="fad fa-newspaper"></i></div>
                            Questions & Answers (Q&A) 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-student-questions-answers" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("StudentQuestionsAnswersController@view_student_questions" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('StudentQuestionsAnswersController@view_student_questions')}}">View </a>
                                @endif
                            </nav>
                        </div>
                        @endif   

                        @if( preg_match('/TrendingTodayController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-trending-today" aria-expanded="false" aria-controls="collapse-trending-today">
                            <div class="nav-link-icon"><i class="fad fa-newspaper"></i></div>
                             Trending Today
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-trending-today" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("TrendingTodayController@add_trending_today" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('TrendingTodayController@add_trending_today')}}">Add </a>
                                @endif

                                @if( in_array("TrendingTodayController@view_trending_today" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('TrendingTodayController@view_trending_today')}}">View </a>
                                @endif
                            </nav>
                        </div>
                        @endif
                        
                        @if( preg_match('/AdvertisementController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-advertisement" aria-expanded="false" aria-controls="collapse-advertisement">
                            <div class="nav-link-icon">
                            <i class="fas fa-ad"></i>
                            </div>
                           Advertisements 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-advertisement" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("AdvertisementController@advertisement" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('AdvertisementController@advertisement')}}">Add</a>
                                @endif

                                @if( in_array("AdvertisementController@view_advertisement" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('AdvertisementController@view_advertisement')}}">View</a>
                                @endif
                            </nav>
                        </div>
                        @endif

                        @if( 
                            preg_match('/CoachingController/', $permissions_string) ||
                            preg_match('/OrderController/', $permissions_string) ||
                            Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" 
                        data-toggle="collapse" data-target="#collapse-coachings" aria-expanded="false" aria-controls="collapse-coachings">
                            <div class="nav-link-icon"><i class="fas fa-users"></i></div>
                            Coachings  
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-coachings" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                <div class="nav accordion pt-0 pr-3" id="accordionSidenavchild">
                                    
                                    @if( preg_match('/CoachingController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-Coachings-category" aria-expanded="false" aria-controls="collapse-Coachings-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                       Coachings
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-Coachings-category" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("CoachingController@add_coaching" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CoachingController@add_coaching')}}">Add</a>
                                            @endif

                                            @if( in_array("CoachingController@view_coaching" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CoachingController@view_coaching')}}">View</a>
                                            @endif
                                        </nav>
                                    </div>
                                    @endif

                                    @if( preg_match('/OrderController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-Buyed" aria-expanded="false" aria-controls="collapse-Buyed">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Course Buyed
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-Buyed" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("OrderController@view_orders" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('OrderController@view_orders')}}">View 
                                            </a>
                                            @endif

                                        </nav>
                                    </div>
                                    @endif
                                </div>
                            </nav>
                        </div>  
                        @endif

                        @if( 
                            preg_match('/CollegeCategoryController/', $permissions_string) ||
                            preg_match('/CollegeController/', $permissions_string) ||
                            Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" 
                        data-toggle="collapse" data-target="#collapse-Colleges" aria-expanded="false" aria-controls="collapse-Colleges">
                            <div class="nav-link-icon"><i class="fas fa-users"></i></div>
                            Colleges  
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-Colleges" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                <div class="nav accordion pt-0 pr-3" id="accordionSidenavchild">
                                    
                                    @if( preg_match('/CollegeCategoryController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-Categories-category" aria-expanded="false" aria-controls="collapse-Categories-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Categories 
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-Categories-category" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("CollegeCategoryController@add_college_category" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CollegeCategoryController@add_college_category')}}">Add</a>
                                            @endif
                                            
                                            @if( in_array("CollegeCategoryController@view_college_category" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CollegeCategoryController@view_college_category')}}">View</a>
                                            @endif
                                        </nav>
                                    </div>
                                    @endif

                                    @if( preg_match('/CollegeController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-Colleges-category1" aria-expanded="false" aria-controls="collapse-Colleges-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Colleges
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-Colleges-category1" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("CollegeController@add_college" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CollegeController@add_college')}}">Add</a>
                                            @endif
                                            
                                            @if( in_array("CollegeController@view_college" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CollegeController@view_college')}}">View</a>
                                            @endif
                                        </nav>
                                    </div>
                                    @endif
                                </div>
                            </nav>
                        </div> 
                        @endif
                        
                        @if( preg_match('/ExamsController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-exam" aria-expanded="false" aria-controls="collapse-exam">
                            <div class="nav-link-icon"><i class="fad fa-trophy"></i></div>
                            Exams 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-exam" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("ExamsController@add_exam" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('ExamsController@add_exam')}}">Add</a>
                                @endif

                                @if( in_array("ExamsController@view_exam" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('ExamsController@view_exam')}}">View</a>
                                @endif
                            </nav>
                        </div>
                        @endif

                        @if( preg_match('/FreePreparationToolController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-question" aria-expanded="false" aria-controls="collapse-question">
                            <div class="nav-link-icon"><i class="fad fa-question-circle"></i></div>
                            Study Material 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-question" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("FreePreparationToolController@add_question_paper_subjects" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('FreePreparationToolController@add_question_paper_subjects')}}">Add Paper </a>
                                @endif

                                @if( in_array("FreePreparationToolController@view_question_paper_subjects" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('FreePreparationToolController@view_question_paper_subjects')}}">View Paper</a>
                                @endif
                            </nav>
                        </div>
                        @endif
                        
                        @if( preg_match('/TestimonialsController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-testy" aria-expanded="false" aria-controls="collapse-testy">
                            <div class="nav-link-icon"><i class="fad fa-star"></i></div>
                            Testimonials 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-testy" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("TestimonialsController@add_testimonial" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('TestimonialsController@add_testimonial')}}">Add</a>
                                @endif

                                @if( in_array("TestimonialsController@view_testimonial" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('TestimonialsController@view_testimonial')}}">View</a>
                                @endif
                            </nav>
                        </div>
                        @endif

                        @if( preg_match('/StatecityController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-state" aria-expanded="false" aria-controls="collapse-state">
                            <div class="nav-link-icon"><i class="fad fa-layer-group"></i></div>
                            States & Cities 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-state" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("StatecityController@get_states" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('StatecityController@get_states')}}">View States </a>
                                @endif

                                @if( in_array("StatecityController@get_city" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('StatecityController@get_city')}}">View Cities </a>
                                @endif
                            </nav>
                        </div>
                        @endif

                        @if( 
                            preg_match('/CounsellingController/', $permissions_string) ||
                            preg_match('/CounsellingTestimonialsController/', $permissions_string) ||
                            preg_match('/CounsellingFaqController/', $permissions_string) ||
                            Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" 
                        href="javascript:void(0);" data-toggle="collapse" 
                        data-target="#collapse-counse" aria-expanded="false" aria-controls="collapse-counse">
                            <div class="nav-link-icon"><i class="fas fa-users"></i></div>
                            Career Counselling  
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-counse" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                <div class="nav accordion pt-0 pr-3" id="accordionSidenavchild">
                                    
                                    @if( preg_match('/CounsellingController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-counsellingsss" aria-expanded="false" aria-controls="collapse-counsellingsss">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Counsellings  
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-counsellingsss" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("CounsellingController@counselling" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CounsellingController@counselling')}}">Add</a>
                                            @endif
                                            
                                            @if( in_array("CounsellingController@view_counselling" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CounsellingController@view_counselling')}}">View</a>
                                            @endif

                                        </nav>
                                    </div>
                                    @endif

                                    @if( preg_match('/OrderController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-Buyed-counselling" aria-expanded="false" aria-controls="collapse-Buyed-counselling">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Counselling Buyed
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-Buyed-counselling" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("OrderController@view_orders_counselling" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('OrderController@view_orders_counselling')}}">View 
                                            </a>
                                            @endif

                                        </nav>
                                    </div>
                                    @endif

                                    @if( preg_match('/CounsellingTestimonialsController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-tessstttt" aria-expanded="false" aria-controls="collapse-blog-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Testimonials 
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-tessstttt" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("CounsellingTestimonialsController@add_counselling_testimonial" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CounsellingTestimonialsController@add_counselling_testimonial')}}">Add </a>
                                            @endif
                                            
                                            @if( in_array("CounsellingTestimonialsController@view_counselling_testimonial" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CounsellingTestimonialsController@view_counselling_testimonial')}}">View </a>
                                            @endif
                                        </nav>
                                    </div>
                                    @endif

                                    @if( preg_match('/CounsellingFaqController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-couns-faqss" aria-expanded="false" aria-controls="collapse-blog-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        FAQs  
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-couns-faqss" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("CounsellingFaqController@counselling_faq" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CounsellingFaqController@counselling_faq')}}">Add </a>
                                            @endif

                                            @if( in_array("CounsellingFaqController@view_counselling_faq" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('CounsellingFaqController@view_counselling_faq')}}">View </a>
                                            @endif
                                        </nav>
                                    </div>
                                    @endif
                                </div>
                            </nav>
                        </div> 
                        @endif
                        
                        @if( preg_match('/OffersController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-offer" aria-expanded="false" aria-controls="collapse-series">
                            <div class="nav-link-icon"><i class="fad fa-dollar-sign"></i></div>
                            Offers 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-offer" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                
                                @if( in_array("OffersController@addOffer" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="<?php echo action('OffersController@addOffer')?>">Add</a>
                                @endif

                                @if( in_array("OffersController@getOffers" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="<?php echo action('OffersController@getOffers')?>">View</a>
                                @endif
                            </nav>
                        </div>
                        @endif
                        
                        @if( preg_match('/StudentController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-student" aria-expanded="false" aria-controls="collapse-student">
                            <div class="nav-link-icon"><i class="fad fa-user"></i></div>
                            Student Details 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-student" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("StudentController@view_students" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('StudentController@view_students')}}">View</a>
                                @endif
                            </nav>
                        </div>
                        @endif
                        
                        @if( 
                            preg_match('/EnterpriseController/', $permissions_string) ||
                            preg_match('/PlanController/', $permissions_string) ||
                            Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" 
                        data-toggle="collapse" data-target="#collapse-entersprisess" aria-expanded="false" aria-controls="collapse-entersprisess">
                            <div class="nav-link-icon"><i class="fas fa-users"></i></div>
                            Enterprise Details  
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-entersprisess" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                <div class="nav accordion pt-0 pr-3" id="accordionSidenavchild">
                                    
                                    @if( preg_match('/EnterpriseController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-de-enterprisesss" aria-expanded="false" aria-controls="collapse-de-enterprisesss">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Details   
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-de-enterprisesss" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("EnterpriseController@view_enterprise" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('EnterpriseController@view_enterprise')}}">View </a>
                                            @endif

                                        </nav>
                                    </div>
                                    @endif

                                    @if( preg_match('/PlanController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-plansss-new" aria-expanded="false" aria-controls="collapse-blog-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Plans  
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-plansss-new" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("PlanController@plan" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('PlanController@plan')}}">Add</a>
                                            @endif

                                            @if( in_array("PlanController@view_plan" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('PlanController@view_plan')}}">View</a>
                                            @endif
                                        </nav>
                                    </div>
                                    @endif

                                    @if( preg_match('/PlanController@view_plan_request/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                                    <a class="nav-link collapsed fs-13" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-plan-requests-sss" aria-expanded="false" aria-controls="collapse-blog-category">
                                        <div class="nav-link-icon"><i class="fas fa-circle fs-10"></i></div>
                                        Plan Requests  
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapse-plan-requests-sss" data-parent="#accordionSidenavchild">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                            @if( in_array("PlanController@view_plan_request" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                            <a class="nav-link" href="{{action('PlanController@view_plan_request')}}">View </a>
                                            @endif

                                        </nav>
                                    </div>
                                    @endif
                                </div>
                            </nav>
                        </div> 
                        @endif

                        @if( preg_match('/GeneralController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-blog-general" aria-expanded="false" aria-controls="collapse-blog-general">
                            <div class="nav-link-icon"><i class="fas fa-users"></i></div>
                            Generals 
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-blog-general" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("GeneralController@view_contact_us" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('GeneralController@view_contact_us')}}">Contact Us</a>   
                                @endif
                                
                                @if( in_array("GeneralController@view_requestcallback" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('GeneralController@view_requestcallback')}}">Callback Request</a>
                                @endif

                                @if( in_array("GeneralController@view_requestcallback_purchase" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('GeneralController@view_requestcallback_purchase')}}">
                                    View Purchase Lead
                                </a>
                                @endif
                                
                                @if( in_array("GeneralController@view_search_lead" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('GeneralController@view_search_lead')}}">
                                    View Search Lead
                                </a>
                                @endif

                            </nav>
                        </div>
                        @endif

                        @if( preg_match('/SubAdminController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-SubAdmin-manager" aria-expanded="false" aria-controls="collapse-SubAdmin-manager">
                            <div class="nav-link-icon"><i class="fad fa-user"></i></div>
                            Sub Admin Manager
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-SubAdmin-manager" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                
                                @if( in_array("SubAdminController@add_sub_admin" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="<?php echo action('SubAdminController@add_sub_admin')?>">Add Sub Admin</a>
                                @endif

                                @if( in_array("SubAdminController@view_sub_admin" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="<?php echo action('SubAdminController@view_sub_admin')?>">View Sub Admin</a>
                                @endif
                            </nav>
                        </div>
                        @endif

                        @if( preg_match('/TrendingTodayDirectController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-trending-today-direct" aria-expanded="false" aria-controls="collapse-trending-today-direct">
                            <div class="nav-link-icon"><i class="fad fa-newspaper"></i></div>
                             Trending Today Direct
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-trending-today-direct" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("TrendingTodayDirectController@add_trending_today_direct" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('TrendingTodayDirectController@add_trending_today_direct')}}">Add </a>
                                @endif

                                @if( in_array("TrendingTodayDirectController@view_trending_today_direct" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('TrendingTodayDirectController@view_trending_today_direct')}}">View </a>
                                @endif
                            </nav>
                        </div>
                        @endif

                        @if( preg_match('/WebinarController/', $permissions_string) || Auth::user()->role == '1' || $permissions_string == '*')
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapse-webinar" aria-expanded="false" aria-controls="collapse-webinar">
                            <div class="nav-link-icon"><i class="fad fa-newspaper"></i></div>
                             Webinar
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapse-webinar" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                @if( in_array("WebinarController@add_webinar" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('WebinarController@add_webinar')}}">Add </a>
                                @endif

                                @if( in_array("WebinarController@view_webinar" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
                                <a class="nav-link" href="{{action('WebinarController@view_webinar')}}">View </a>
                                @endif
                            </nav>
                        </div>
                        @endif
                    </div>

                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content w-100">

                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title">
                            {{
                                auth()->user()->name
                            }}
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="page-header-content">
                                    <h1 class="page-header-title fs-md-35 fs-20">

                                        <div class="page-header-icon"><i class="fad fa-at text-white"></i></div>
                                        <span class=" text-capitalize">
                                            @yield('heading')
                                        </span>
                                    </h1>
                                    <div class="page-header-subtitle fs-md-19 fs-14 text-capitalize">
                                        @yield('sub-heading')
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mb-md-0 mb-3">
                                @yield('card-heading-btn')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-n10">
                    @yield('content')
                </div>



                <!-- Modal -->
                <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <iframe src="#" frameborder="0" class="w-100" 
                                id="embed"
                                style="height: calc(100vh - 232px);">
                                </iframe>
                                <div id="thumb-output"></div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModal1Label">Preview</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <embed src="{{ asset('public/pdf.pdf')}}" frameborder="0" class="w-100" 
                                id="embed1"
                                style="height: calc(100vh - 232px);">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>




            </main>


            <footer class="footer mt-auto footer-light">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &#xA9; Admin {{ date('Y') }}</div>
                        <div class="col-md-6 text-md-right small">
                            <a href="javascript:void(0);">Privacy Policy</a> &#xB7;
                            <a href="javascript:void(0);">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- tags input -->

    <script>
        $('.tagsInput').fastselect();
    </script>
    <!-- tags input -->

    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/scripts.js') }}"></script>
    <script src="{{ asset('public/js/jquery.datetimepicker.full.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('public/js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('public/js/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('public/js/demo/datatables-demo.js') }}"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
    
    <script>
        $(function() {
        $('body').on('keydown', '#firstspaceremove', function(e) {
            console.log(this.value);
            if (e.which === 32 &&  e.target.selectionStart === 0) {
            return false;
            }  
        });
        });
    </script>    

    <!-- restrict special characters from name becoz of slug -->
    <script>
        $(document).on('change input','input', function () {

            if( 
                window.location.href.toString().includes('plan') 
                ||
                window.location.href.toString().includes('counselling') 
                ||
                window.location.href.toString().includes('add_videos') 
                ||
                window.location.href.toString().includes('view_coaching_videos') 
            ) {

            } else {
                if( ( this.name.includes('name') 
                    || this.name.includes('title') ) 
                    && ! (this.name.includes('faq'))
                    && ! (this.name.includes('metatitle'))
                ) {
                    if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                        this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
                    }
                } 
            }

        });
    </script>

    <!-- restrict only spaces in input -->
    <script>
        $(document).on('change','input', function () {

            if($(this).val().trim() === "" || $(this).val() === null){
                this.value = '';
                $(this).val('');
            }

        });
    </script>

        
    <script>
        $('.datetimepickerget').attr('autocomplete','off');
    </script>

    <!-- remove btn hide initially -->
    <script>
        $(document).ready(
            function() {

                if( 
                    window.location.href.toString().includes('edit') 
                ) {
                } else {
                    $('#removeButton').hide();
                }
            }
        );

        $("#addButton").click(function() {
                
                $('#removeButton').show();
        });

        $("#removeButton").click(function() {

            if ($('.form-horizontal .control-group').length == 2) {
                
                $('#removeButton').hide();
            }
        });
    </script>

    <script>

        $(document).on("submit", "form", function(e) {
            
                if($('.required', this).length == 1) {
                    
                    var instance = CKEDITOR.instances['description'];
                    
                    if(instance)
                    {
                        var messageLength = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
                        if( ! messageLength ) {
                            
                            var h6 = $("<h6 id='error_message'>");
                            h6.html('Description is required');
                            h6.addClass("text-danger");
            
                            $('#description', this)
                            .parent()
                            .find('.control-label')
                            .next('h6#error_message').remove();

                            $('#description', this)
                            .parent()
                            .find('.control-label')
                            .after(h6);
                                                                            
                            return false;
                        }

                    }
                }
        });

    </script>

    <!-- send callback mail -->
    
    <!-- Modal -->
    <div class="modal fade" id="contactmodel1" role="dialog">
        <div class="modal-dialog" style="width: 400px;">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Write Message</h4>
            </div>
            <div class="modal-body">
                <form action="{{asset('coaching_admin/contact_mail')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="" id="id">
                    <input type="hidden" name="email" value="" id="email">
                    <textarea name="message" placeholder="Write Message" required style="width: 100%;height: 140px;"></textarea><br>
                    <button type="submit" class="btn btn-primary float-right">Send</button>
                </form>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        
        </div>
    </div>
    <script type="text/javascript"> 
        function showcontactus1(id, email) {
            $('#contactmodel1 #id').val(id);
            $('#contactmodel1 #email').val(email);

            $('#contactmodel1').modal('show');
        }

        $('#preloader_admin').hide();
    </script>

    @include('other_js_scripts')
    
</body>

</html>