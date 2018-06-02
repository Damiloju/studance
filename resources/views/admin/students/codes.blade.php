<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello Penaldo</title>
    <link href="{{ public_path() }}/template/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style>

        .title {
            color: grey;
            font-size: 18px;
        }
    </style>
</head>
<body>
<div style="width: 100%;">

    @foreach($students as $student)
        <div style="border: 5px solid lightseagreen; width: 40%; padding: 11px;margin-bottom: 20px; font-family: Roboto, 'Helvetica Neue', Helvetica, Arial;">
            <div>
                <img src="/{{ public_path() }}/template/assets/images/logo-sm.jpeg" style="width: 50px; height: 50px" alt="mcpherson_university">
                {{ $student->name }}
            </div>
            <div class="title" style="text-align: center">
                <em>{{ $student->program->department->name }}</em>
            </div>
            <div style="text-align: center">
                <img src="{{ public_path() }}/barcodes/{{ $student->matric_number }}.png" style="width: 250px;height: 25px; margin-top: 2px;">
            </div>
        </div>
    @endforeach
</div>

</body>
</html>