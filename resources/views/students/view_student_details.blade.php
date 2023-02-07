@extends('main')

@section('heading')
Student Details
@endsection('heading')

@section('sub-heading')
View Student Details
@endsection('sub-heading')


@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">View Student Academic Details</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table 
                class="table table-bordered table-striped table-hover text-nowrap" id="student_academic_details_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Stream</th>
                        <th>
                            Courses</th>
                        

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Stream</th>
                        <th>
                            Courses</th>
                        
                    </tr>
                </tfoot>
                <tbody>
    
                    @if(!empty($student_academic_details)) 
                    
                    @php 
                        $i = 1;
                    @endphp

                    @foreach ($student_academic_details as $post)

                        <tr>
                            <th class="fs-md-15 fs-13" scope="row" style="text-align:center;">
                                <?php echo $i; ?>.
                            </th>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->name ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->courses ?? ''; ?>
                            </td>
                        </tr>
                        
                        @php 
                            $i += 1;
                        @endphp

                    @endforeach
                    
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>


<div class="mt-3 card">
    <div class="card-header">View Student Education Level Information</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="student_education_level_information_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Class level</th>
                        <th>
                            Class</th>
                        <th>
                            School / College Name</th>
                        <th>
                            Course Completion Year</th>
                        <th>
                            Board</th>
                        <th>
                            Marks</th>
                        <th>
                            Stream</th>
                        <th>
                            University Name</th>
                        <th>
                            Degree / Diploma Name</th>
                        <th>
                            Specialization</th>
                        

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Class level</th>
                        <th>
                            Class</th>
                        <th>
                            School / College Name</th>
                        <th>
                            Course Completion Year</th>
                        <th>
                            Board</th>
                        <th>
                            Marks</th>
                        <th>
                            Stream</th>
                        <th>
                            University Name</th>
                        <th>
                            Degree / Diploma Name</th>
                        <th>
                            Specialization</th>
                    </tr>
                </tfoot>
                <tbody>
    
                    @if(!empty($student_education_level_information)) 
                    
                    @php 
                        $i = 1;
                    @endphp

                    @foreach ($student_education_level_information as $post)

                        <tr>
                            <th class="fs-md-15 fs-13" scope="row" style="text-align:center;">
                                <?php echo $i; ?>.
                            </th>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->class_level ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->class ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->school_college_name ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->course_completion_year ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->board ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->marks ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->stream ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->university_name ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->degree_diploma_name ?? ''; ?>
                            </td>
                            <td class="fs-md-15 fs-13" style="text-align:center;">
                                <?php echo $post->specialization ?? ''; ?>
                            </td>
                        </tr>
                        
                        @php 
                            $i += 1;
                        @endphp

                    @endforeach
                    
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    $(document).ready(
        function() {

            $('#student_academic_details_dt').DataTable({
                "dom": 'lBfrtip',
                buttons: [               
                    {
                        extend: 'csvHtml5',
                        text: 'Download EXCEL Data',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });

            $('#student_education_level_information_dt').DataTable({
                "dom": 'lBfrtip',
                buttons: [               
                    {
                        extend: 'csvHtml5',
                        text: 'Download EXCEL Data',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });

        }
    );
</script>

@endsection