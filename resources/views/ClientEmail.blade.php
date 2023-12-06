
@component('mail::message')

{{$subject}}

Name of sender: {{$name}}
<br>
Email of sender: {{$email}}
<br>
Phone numer of sender: {{$number}}
<br>
The message: {{$message}}

@endcomponent