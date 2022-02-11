@extends('layouts.app')

@section('content')
    <script src="{{ asset('property_inventory_theme/html/assets/js/ckeditor.js') }}" type="text/javascript"></script>
  
    
    <div class="page-head">
      <h2 class="page-head-title">Evaluation</h2>
    </div>
    <div class="main-content container-fluid">
      
    <form action="submit_evaluation" method="post">
    {{ csrf_field() }}
<center>PRACTICUM/OJT PERFORMANCE EVALUATION</center>

<center>NAME OF THE STUDENT:
<select name="name" id="name" required>
        <option value="">Select Student</option>
        @foreach($users as $user)
                <option value="{{$user->name}}">{{$user->name}}</option>
        @endforeach
</select>
<center>COMPANY/INSTITUTION/AGENCY: 
<input name="company" required>
<center>CCSE DEPARTMENT <br>
<label for="BSIT"> IT</label>
<input type="radio" id="IT" name="department" value="IT">
<label for="BSIT"> COE</label>
<input type="radio" id="COE" name="department" value="COE">
<label for="BSIT"> CS</label>
<input type="radio" id="CS" name="department" value="CS">
<center>ADDRESS: 
<input name="address" required>
</center>





<br>
<br>
<br>
<br>
<center> PERFORMANCE RATING:</center>
<style>
p.dotted {border-style: dotted;}
p.double {border-style: double;}
div {
  text-align: justify;
  text-justify: inter-word;
}
</style>

<div class="container">
  <h2>PRACTICUM/OJT PERFORMANCE EVALUATION</h2>
             
  <table class="table table-bordered">
    <thead>
      <tr>
        
        <th></th>
        <th>(5) 
Outstanding</th>
        <th>(4)
Exceeded 
Expectations
</th>
        <th>(3) Satisfactory</th></th>
        <th>(2)
Needs
Improvement</th>
        <th>(1)
Unsatisfactory</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>JOB SKILLS/
KNOWLEDGE </b> 
Consider the knowledge 
of job and the
supervision required.</td>
        <td>Shows exceptional
skills and knowledge on 
the job. Has strong
understanding of all
aspects of the
department.</td>
        <td>Produces results
that exceed
requirements.
Seldom
necessary to
check work.</td>
        <td>Has a good
understanding of all
aspects of job.
Requires standard
supervision.
</td>
        <td>Quality of work
sometimes below
standards.
Requires
frequent review.</td>
        <td>Unacceptable job
knowledge. Requires
maximum supervision in
most or all areas of job
responsibilities.</td>

      </tr>
      <tr>
        <td><b>Rating</b></td>
        <td> <center> <input type="radio" id="5" name="jobskill" value="5"> </center> </td>
        <td> <center> <input type="radio" id="4" name="jobskill" value="4"> </center> </td>
        <td> <center> <input type="radio" id="3" name="jobskill" value="3"> </center> </td>
        <td> <center> <input type="radio" id="2" name="jobskill" value="2"> </center> </td>
        <td> <center> <input type="radio" id="1" name="jobskill" value="1"> </center> </td>
      </tr>
      <tr>
        <td><b>Comments: </b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
    <table class="table table-bordered">
    <thead>
      <tr>
        
        <th></th>
        <th>(5) 
Outstanding</th>
        <th>(4)
Exceeded 
Expectations
</th>
        <th>(3) Satisfactory</th></th>
        <th>(2)
Needs
Improvement</th>
        <th>(1)
Unsatisfactory</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>QUALITY </b>
Consider accuracy and
reliability of results and
wasted time in rework.
.</td>
        <td>Produces unreliable
results with frequent
errors. Requires
constant checking.
</td>
        <td>Very well
informed on all
phases of the
job. Requires
little or no
supervision</td>
        <td>(3)
Produces good
quality work.
Results are
generally accurate,
but may require
occasional rework.

</td>
        <td>Has minimal
knowledge of the
essentials.
Needs close
supervision.</td>
        <td>Produces unreliable
results with frequent
errors. Requires
constant checking.
td>

      </tr>
      <tr>
        <td><b>Rating</b></td>
        <td> <center> <input type="radio" id="5" name="quality" value="5"> </center> </td>
        <td> <center> <input type="radio" id="4" name="quality" value="4"> </center> </td>
        <td> <center> <input type="radio" id="3" name="quality" value="3"> </center> </td>
        <td> <center> <input type="radio" id="2" name="quality" value="2"> </center> </td>
        <td> <center> <input type="radio" id="1" name="quality" value="1"> </center> </td>
       
      </tr>
      <tr>
        <td><b>Comments: </b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
  <table class="table table-bordered">
    <thead>
      <tr>
        
        <th></th>
        <th>(5) 
Outstanding</th>
        <th>(4)
Exceeded 
Expectations
</th>
        <th>(3) Satisfactory</th></th>
        <th>(2)
Needs
Improvement</th>
        <th>(1)
Unsatisfactory</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>SERVICE
ORIENTATION </b> <br>
Consider overall
internal and external
service commitment
and behavior. Clients
may include customers,
peers and supervisors

.</td>
        <td>Provides exceptional
service. Initiates
suggestions for
overall service
improvement.
Feedback from clients
indicate an
extraordinary level of
commitment to
service.
</td>
        <td>Provides
consistent top
quality service.
Consistently
exceeds clients’
service
expectations.
</td>
        <td>Displays positive
service
orientation.
Clients are
satisfied with level
of service
provided.


</td>
        <td>Occasionally
displays positive
service
orientation.
 </td>
        <td>Rarely displays a positive
service orientation.
Improvement necessary.</td>

      </tr>
      <tr>
        <td><b>Rating</b></td>
        <td> <center> <input type="radio" id="5" name="service" value="5"> </center> </td>
        <td> <center> <input type="radio" id="4" name="service" value="4"> </center> </td>
        <td> <center> <input type="radio" id="3" name="service" value="3"> </center> </td>
        <td> <center> <input type="radio" id="2" name="service" value="2"> </center> </td>
        <td> <center> <input type="radio" id="1" name="service" value="1"> </center> </td>
       
      </tr>
      <tr>
        <td><b>Comments: </b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
        <table class="table table-bordered">
    <thead>
      <tr>
        
        <th></th>
        <th>(5) 
Outstanding</th>
        <th>(4)
Exceeded 
Expectations
</th>
        <th>(3) Satisfactory</th></th>
        <th>(2)
Needs
Improvement</th>
        <th>(1)
Unsatisfactory</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>JUDGMENT </b>
Consider success in
organizing work and the
ability to differentiate
between decisions that
should be made or
deferred.


.</td>
        <td>Thinks quickly and
logically. Decisions
made are extremely
reliable and sound.
Exceptionally wellorganized.

</td>
        <td>Shows consistently
sound judgment.
Very well-organized..</td>
        <td>Displays sound
judgment. Good
organizational
ability.


</td>
        <td>Minimum ability to
organize daily work.
Some improvement
may be required in
judgment.
 </td>
        <td>Work is not
organized.
Consistently poor
judgment.</td>

      </tr>
      <tr>
        <td><b>Rating</b></td>
        <td> <center> <input type="radio" id="5" name="judgment" value="5"> </center> </td>
        <td> <center> <input type="radio" id="4" name="judgment" value="4"> </center> </td>
        <td> <center> <input type="radio" id="3" name="judgment" value="3"> </center> </td>
        <td> <center> <input type="radio" id="2" name="judgment" value="2"> </center> </td>
        <td> <center> <input type="radio" id="1" name="judgment" value="1"> </center> </td>
       
      </tr>
      <tr>
        <td><b>Comments: </b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


                <table class="table table-bordered">
    <thead>
      <tr>
        
        <th></th>
        <th>(5) 
Outstanding</th>
        <th>(4)
Exceeded 
Expectations
</th>
        <th>(3) Satisfactory</th></th>
        <th>(2)
Needs
Improvement</th>
        <th>(1)
Unsatisfactory</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>ADAPTABILITY </b>
Consider willingness to
learn new practices and
adjust to changes in
assignments 

.</td>
        <td>Adapts to change
rapidly and displays
positive attitude.
May help others
adapt to change.</td>
        <td>Quickly learns new
practices. Has
positive attitude
about change.
</td>
        <td>Competently learns
new practices and
adjusts well to
change.


</td>
        <td>Learns new
practices after much
instruction. Accepts
change with
hesitancy.
 </td>
        <td>Does not retain
instructions.
Resistant to change..</td>

      </tr>
      <tr>
        <td><b>Rating</b></td>
        <td> <center> <input type="radio" id="5" name="adaptability" value="5"> </center> </td>
        <td> <center> <input type="radio" id="4" name="adaptability" value="4"> </center> </td>
        <td> <center> <input type="radio" id="3" name="adaptability" value="3"> </center> </td>
        <td> <center> <input type="radio" id="2" name="adaptability" value="2"> </center> </td>
        <td> <center> <input type="radio" id="1" name="adaptability" value="1"> </center> </td>
       
      </tr>
      <tr>
        <td><b>Comments: </b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

              <table class="table table-bordered">
    <thead>
      <tr>
        
        <th></th>
        <th>(5) 
Outstanding</th>
        <th>(4)
Exceeded 
Expectations
</th>
        <th>(3) Satisfactory</th></th>
        <th>(2)
Needs
Improvement</th>
        <th>(1)
Unsatisfactory</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>COMMUNICATION </b>
Consider verbal,
written, and
interpersonal
communication skills

.</td>
        <td>Exceptional
communication and
interpersonal skills.
Interacts extraordinarily
well with all levels of
employees and
managers. May be used
as an expert service
resource or act as an

</td>
        <td>Very strong
communication
and interpersonal
skills. Interacts
very well with all
levels of
employees and
managers.
</td>
        <td>Fully competent
communication
and interpersonal
skills. Interacts
well with others

</td>
        <td>Communication and
interpersonal skills
need improvement in
some areas. May
interact well with
some, but not all,
levels of employees
and managers. </td>
        <td>Interpersonal and
communication
skills are
unacceptable.
Does not interact
well with others.
.</td>

      </tr>
      <tr>
        <td><b>Rating</b></td>
        <td> <center> <input type="radio" id="5" name="communication" value="5"> </center> </td>
        <td> <center> <input type="radio" id="4" name="communication" value="4"> </center> </td>
        <td> <center> <input type="radio" id="3" name="communication" value="3"> </center> </td>
        <td> <center> <input type="radio" id="2" name="communication" value="2"> </center> </td>
        <td> <center> <input type="radio" id="1" name="communication" value="1"> </center> </td>
       
      </tr>
      <tr>
        <td><b>Comments: </b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

                <table class="table table-bordered">
    <thead>
      <tr>
        
        <th></th>
        <th>(5) 
Outstanding</th>
        <th>(4)
Exceeded 
Expectations
</th>
        <th>(3) Satisfactory</th></th>
        <th>(2)
Needs
Improvement</th>
        <th>(1)
Unsatisfactory</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>ATTENDANCE </b> <br>
Consider punctuality
and unscheduled or
unapproved absences.


.</td>
        <td>ATTENDANCE
Consider punctuality
and unscheduled or
unapproved absences.

</td>
        <td>Always arrives on
time. All absences
are approved in
advance. </td>
        <td>Consistently arrives
on time. Absences
are approved in
advance with rare
exception.

</td>
        <td>Generally arrives on
time. Absences are
often approved in
advance </td>
        <td>Unacceptable
amount of tardiness
and unscheduled or
unapproved
absences.</td>

      </tr>
      <tr>
        <td><b>Rating</b></td>
        <td> <center> <input type="radio" id="5" name="attendance" value="5"> </center> </td>
        <td> <center> <input type="radio" id="4" name="attendance" value="4"> </center> </td>
        <td> <center> <input type="radio" id="3" name="attendance" value="3"> </center> </td>
        <td> <center> <input type="radio" id="2" name="attendance" value="2"> </center> </td>
        <td> <center> <input type="radio" id="1" name="attendance" value="1"> </center> </td>
       
      </tr>
      <tr>
        <td><b>Comments: </b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
                <table class="table table-bordered">
    <thead>
      <tr>
        
        <th></th>
        <th>(5) 
Outstanding</th>
        <th>(4)
Exceeded 
Expectations
</th>
        <th>(3) Satisfactory</th></th>
        <th>(2)
Needs
Improvement</th>
        <th>(1)
Unsatisfactory</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>SAFETY COMPLIANCE </b>
Consider safety
practices in work area.


.</td>
        <td>Numerical value is
not assigned and
should not affect
any statistical
average analyses.

</td>
        <td>Numerical value is
not assigned and
should not affect
any statistical
average analyses.
</td>
        <td>Complies with
emergency
procedures and
safety programs.

</td>
        <td>Complies with
emergency
procedures and
safety programs. </td>
        <td>Does not comply
with emergency
procedures and
safety programs.
</td>

      </tr>
      <tr>
        <td><b>Rating</b></td>
        <td> <center> <input type="radio" id="5" name="safety" value="5"> </center> </td>
        <td> <center> <input type="radio" id="4" name="safety" value="4"> </center> </td>
        <td> <center> <input type="radio" id="3" name="safety" value="3"> </center> </td>
        <td> <center> <input type="radio" id="2" name="safety" value="2"> </center> </td>
        <td> <center> <input type="radio" id="1" name="safety" value="1"> </center> </td>
       
      </tr>
      <tr>
        <td><b>Comments: </b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>




  </table>
</div>

    </tbody>
  </table>
      </tr>
    </tbody>
  </table>
</div>




  </table>
</div>

    </tbody>
  </table>
      </tr>
    </tbody>
  </table>
</div>




  </table>
</div>

    </tbody>
  </table>
    </tbody>
  </table>
</div>




  </table>
</div>

    </tbody>
  </table>
      </tr>
    </tbody>
  </table>
</div>





  </table>
</div>

    </tbody>
  </table>

</div>




  </table>

</div>



<br>

<center>a) Did the student report to work in their Gala Uniform/Business Attire/School
Uniform/Company Uniform as required with ID? Please encircle the number.
<input type="radio" id="5" name="gala" value="5"> 5High
<input type="radio" id="4" name="gala" value="4"> 4High
<input type="radio" id="3" name="gala" value="3"> 3High
<input type="radio" id="2" name="gala" value="2"> 2High
<input type="radio" id="1" name="gala" value="1"> 1High

</center>
<center>b) Is the student properly placed? If not please explain briefly.
    <input name="placed" required>


</center>
<center>c) What is the student’s most outstanding qualification?
     <input name="qualification" required>
</center>
<center>d) What is the student’s weakness?
     <input name="weakness" required>
</center>
 <br>
 <br>
 <br>

 <center> <h1>OVERALL APPRAISAL </h1>
<p class="dotted"> Using the following standards, please select the summary description that most closely describe the
overall performance for the entire Practicum/OJT deployment period </p>

<br>

<p class="double">{ } OUTSTANDING (5): Performance far exceeds expectations and requirements of the position.
The student consistently integrates a wide variety of skills to outstandingly and effectively solve problems
and carry out duties, responsibilities and objectives well beyond the expectations of the position.
Outcomes and solutions are routinely excellent and seldom matched by others. S/He demonstrates the
highest level of performance standards in handling all assignments. His/Her performance is consistent
with the behavior associated with the selected critical performance factors. Overall, performance
demonstrates a very high degree of expertise and serves as a model of excellence for other students
undergoing Practicum. S/He adds value to the organization well beyond what was expected. His/Her high
level of sustained performance merits special recognition and compares with the best this office has seen.
Very few students achieve this level of competency, particularly in an overall evaluation. </p><br>
<p class="double">{ } EXCEEDED EXPECTATIONS (4): Performance often exceeds expectations and requirements of
the position. The student frequently demonstrates the ability to integrate a variety of skills to effectively
solve problems and carry out duties, responsibilities and objectives beyond the expectations required in
the job assigned. His/Her performance is consistent with the behavior associated with the performance
factors used for our employees. S/He adds value to the organization beyond what is expected.</p> <br>
<p class="double">{ } SATISFACTORY (3): Performance meets and sometimes may exceed expectations and
requirements of the position. Fully competent. The student adds value to the organization and is a fully
competent performer. Critical goals, tasks, and projects are achieved within acceptable standards.
During the Practicum period, there may have been some accomplishments that exceeded expectations,
some that may have met expectations and, possibly, some areas where results may not have fully met
expectations. Overall, s/he demonstrates the ability to handle projects or assignments within the scope of
the assigned job and demonstrates the ability to integrate a variety of skills to solve problems and carry
out duties, responsibilities and objectives. His/Her performance is generally consistent with the behavior
associated with the performance factors used for our employees. </p><br>
<p class="double">{ } NEEDS IMPROVEMENT (2): Performance often does not meet expectations and requirements
of the position. Improvement is necessary. The student needs further development and/or
improvement in one or more of the performance factors. S/He requires more than normal amount of
guidance and follow-up to assure that assignments were progressing adequately. Performance is
occasionally consistent with the behavior associated with the performance factors. Sustained progress
and improvement are required in one or more of the performance factors. </p><br>
<p class="double">{ } UNSATISFACTORY (1): Performance consistently does not meet expectations and requirements
of the assigned job. Improvement is required. Performance is below the minimum needed to fulfill
assigned duties, responsibilities, objectives and expectations. S/He requires an unreasonable amount of
direction and guidance.</p></center>


<center> <h4> <b> Supervisor’s Signature
(signature over printed name) <input name="supervisor" value="{{Auth::user()->name}}" required>
<br>
Date:     <input name="date" value="{{ date('m/d/Y', time()) }}" required>                    
                              
</center> </h4></b>

<center><input type="submit" value="Submit"></center>


<h3>Please enclose this Performance Rating in the supplied envelope, seal it and sign across.
Thank you very much.  </h3>

</form>


    </div>

    <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

        $(document).ready(() => {
                $('#name').change(() => {
                        const name = $('#name').val();
                        if(name != "") {
                                alert(name);
                        }
                });
        });

    </script>
@endsection