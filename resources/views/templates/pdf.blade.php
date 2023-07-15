<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            text-align: center;
        }

        main {
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ccc;
        }

        table {
            margin: 0 auto;
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        th.service,
        td.service {
            text-align: left;
        }

        td.desc {
            text-align: left;
        }

        td.total {
            font-weight: bold;
        }

        .notice {
            font-style: italic;
        }

        footer {
            margin-top: 20px;
        }
    </style>
</head>

<body>
<header class="clearfix">

</header>

<main>
    <table>
            @foreach($arr as $key => $value)
            <tr>
                <th>Product name: {{$key}}</th>
                <th>In stock {{count($value)}}</th>
                </tr>
                @foreach($value as $val)
                <tr>
                    <td><strong>IMEI:</strong> {{$val}}</td>
                </tr>
                @endforeach
            @endforeach
    </table>
</main>
</body>

</html>
