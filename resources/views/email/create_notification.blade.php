@component('mail::message')
Hello, {{ $user->name }}

 {{$student_name}} successfully submitted a journal for today. You can view this journal in our online system.


@component('mail::button', ['url' => route('show_logbook')])
VIEW JOURNAL
@endcomponent

Thanks,<br>
OJT Monitoring Team

<br>
<hr><br>
If you're having trouble clicking the "View Journal" button, copy and paste the URL below into your web browser: <a href='{{ route("show_logbook") }}'>{{ route('show_logbook') }}</a>

@endcomponent
