<!--app/views/form.blade.php-->
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel</title>
</head>
<body>
{{ Form::label('username','Username',array('id'=>'','class'=>'')) }}
{{ Form::text('username','clivern',array('id'=>'','class'=>'')) }}

{{ Form::label('status','Status',array('id'=>'','class'=>'')) }}
{{ Form::radio('status','enabled',true) }} Enabled
{{ Form::radio('status','disabled') }} Disabled
<br>
<br>
<br>
{{ Form::label('status','Status',array('id'=>'','class'=>'')) }}
{{ Form::select('status',array('enabled'=>'Enabled','disabled'=>'Disabled'),'enabled') }}

</body>
</html>