<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello Penaldo</title>
    <style>

    </style>
</head>
<body>
<table class="table table-responsive table-hover">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Matric No</th>
    </tr>
    @foreach($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->name }}</td>
            <td><img src="{{ public_path() }}/barcodes/{{ $student->matric_number }}.png"></td>
        </tr>
    @endforeach
</table>
</body>
</html>



<img src="/favicon.ico">