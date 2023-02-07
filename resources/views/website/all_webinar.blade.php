@include('website/layouts/header')

<style>
    .sessions-schedule .date-tab .nav-link.active {
        color: #ffffff !important;
    }
    .sessions-schedule .date-tab{
        display: flex;
        flex-wrap: nowrap;
        overflow: auto;
    }
    .sessions-schedule .hrs-border {
        border-right: 3px solid #ccc;
    }

    .sessions-schedule .text-balance {
        color: #4e82b2;
    }

    .sessions-schedule .bg-sechdule {
        background-color: #e5f3ff;
    }

    .sessions-schedule .th-text {
        position: absolute;
        top: 4px;
        left: 38px;
    }

    @media (max-width:767px){
        .sessions-schedule .hrs-border{
            border: 0;
        }
    }
</style>

<main id="main">

    <section class="container-fluid sessions-schedule">
        <div class="container">
            <div class="row">
                <div class="col-12 text-md-left text-center">
                    <span class="fw-800 fs-md-40 fs-sm-30 fs-25 schedule-heading font-weight-bold">Free Open Sessions - Schedule</span>
                </div>
                <div class="col-12">
                    <div>

                        @if( !empty( $webinar->toArray() ) )
                        <ul class="nav nav-pills mb-3 row pt-3 date-tab pb-3" id="pills-tab" role="tablist">
                        
                            @php
                                $webinar_index = 0;
                            @endphp

                            @foreach($webinar as $webinar_date => $webinars)
                            <li class="nav-item col-auto" role="presentation">
                                <button class="nav-link 
                                    @if($webinar_index == 0)
                                        active
                                    @endif
                                fs-md-19 fs-15 border-0 rounded-0 text-muted position-relative" id="pills-home{{$webinar_index}}-tab" data-toggle="pill" data-target="#pills-home{{$webinar_index}}" type="button" role="tab" aria-controls="pills-home{{$webinar_index}}" 
                                    @if($webinar_index == 0)
                                        aria-selected="true"
                                    @endif
                                >
                                   {{date('d', strtotime($webinar_date) )}}   
                                <span class="fs-14 th-text ">
                                    
                                    @php

                                        $date = date('d', strtotime($webinar_date) );
                                        
                                        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                                        
                                        if (($date %100) >= 11 && ($date%100) <= 13)
                                            $abbreviation = 'th';
                                        else
                                            $abbreviation = $ends[$date % 10];
                                    
                                    @endphp

                                    {{ $abbreviation }}
                                </span> 
                                <span class="pl-3">
                                    {{date('M', strtotime($webinar_date) )}}   
                                </span> </button>
                            </li> 
                            
                            @php
                                $webinar_index += 1;
                            @endphp

                            @endforeach                           
                        </ul>
                        @endif

                        @if( !empty( $webinar->toArray() ) )
                        <div class="tab-content pt-md-4 pt-0" id="pills-tabContent">
                            
                            @if( !empty($webinar) )
                            
                                @php
                                    $webinar_index = 0;
                                @endphp

                                @foreach($webinar as $webinar_date => $webinars)

                                    <div 
                                        class="tab-pane fade show 
                                            @if($webinar_index == 0)
                                                active
                                            @endif
                                        " id="pills-home{{$webinar_index}}" role="tabpanel" aria-labelledby="pills-home{{$webinar_index}}-tab">
                                        <div class="row">

                                            <div class="col-12 bg-sechdule p-md-5 p-4">
                                                        
                                                @if( !empty($webinars) )

                                                    @foreach($webinars as $index => $webinar_single)

                                                        @php
                                                            $webinar_single_slug = str_replace(' ', '-', $webinar_single->title);
                                                        @endphp
                                                        <div class="row align-items-center border-bottom pb-3">
                                                            <div class="col-md-auto col-12">
                                                                <div class="d-flex align-items-center hrs-border pr-5">
                                                                    <span class="fs-md-30 fs-20 text-muted pr-4"><i class="fal fa-clock"></i></span>
                                                                    <span class="text-muted fs-md-18 fs-16">
                                                                    {{date('h:i a', strtotime($webinar_single->time) )}} 
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7 col-12">
                                                                <div class="fs-md-19 fs-15">
                                                                    <a class="pr-3 pl-md-4 pl-0 text-balance" href="">
                                                                    <i class="fal fa-chalkboard-teacher"></i></a>
                                                                    <a class="text-balance" 
                                                                        @if($webinar_single->type == 'url')
                                                                            href="{{$webinar_single->url}}"
                                                                        @else 
                                                                            href="{{ action('Website\WebinarController@webinar', $webinar_single_slug) }}"
                                                                        @endif

                                                                        target="_blank"
                                                                    >
                                                                        {{ $webinar_single->title }}   
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md col-12 pt-md-0 pt-2">
                                                                <div class="text-left pl-md-3 pl-0">
                                                                    <span class="text-balance fs-md-20 fs-15"><i class="fal fa-user"></i></span>
                                                                    <span class="pl-md-2 pl-3 text-muted fs-md-17 fs-15">
                                                                        {{ $webinar_single->author }}   
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                    @endforeach  
                                                                    
                                                @endif
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    @php
                                        $webinar_index += 1;
                                    @endphp

                                @endforeach     
                            @endif
                            
                        </div>
                        @endif

                        @if( empty( $webinar->toArray() ) )
                            <h3 class="text-danger mt-3">No Webinars Available</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@include('website/layouts/footer')