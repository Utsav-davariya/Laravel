<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome BC....!</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <h1>All USER DATA</h1>

    <table class="table table-striped table-bordered ">
        <thead class="table-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">Email</th>
                <th scope="col">view</th>
                <th scope="col">delete</th>



            </tr>
        </thead>
        <tbody>
            @foreach ($data as $user)
                <tr>

                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>

                        <a href="{{ route('view.user', $user->id) }}">
                            <button class="btn btn-outline-primary btn-sm">View</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('delete.user', $user->id) }}">
                            <button class="btn btn-outline-danger btn-sm">delete</button>
                        </a>

                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="mt-5 ">{{ $data->links() }}</div>
    {{-- <div class="mt-5 ">{{ $data->links('pagination::bootstrap-5') }}</div> --}}
    {{-- <div>
        Total users=>{{ $data->total() }} <br>
        current page=>{{ $data->currentpage() }} <br>
        next page url=> {{ $data->nextPageUrl() }} <br>
        per page record=> {{ $data->perPage() }} <br>
        page name=> {{ $data->getPageName() }} <br>

    </div> --}}


</body>

</html>
