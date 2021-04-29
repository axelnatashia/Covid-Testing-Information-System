<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{--  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">  --}}
    <style>
        table {
            border-collapse: collapse;
        }
        table tr td {
            padding:15px;
            border:1px solid black;
        }

        table tr th {
            padding:20px;
            border:1px solid black;
        }
    </style>
</head>
<body>
    <div class="table-responsive">
        <table class="table table-bordered" id="my-data-table" style="border:1px solid black;">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Status Test</th>
                    <th>Test Date</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td width="50">{{ $i }}</td>
                        <td>{{ $item->patient->name }}</td>
                        <td>{{ ucfirst($item->type) }}</td>
                        <td>{{ ucfirst($item->status) }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->updated_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
