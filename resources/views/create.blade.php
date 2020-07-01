<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>学生添加</h2><hr>
    {{$name}}
    <hr>
    <form action="{{url('create')}}" method="post">
    @csrf
        <tr>
            <td>学生姓名</td>
            <td>
                <input type="text" name="name">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button>学生添加</button>
            </td>
        </tr>
    </form>
</body>
</html>