<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Trashed</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-4">

        <h2 class="mb-4 ml-5">  @if (session()->has('user_name'))
            {{session()->get('user_name')}}
        @else
           Guest
       @endif  Customers Information
       <a href="{{ url('customer/') }}" class="ml-5 float-right">
        <button class="btn btn-info  btn-lg">Back</button>
    </a>
    </h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr >
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">State</th>
                    <th scope="col">Country</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Edit</th>


                </tr>
            </thead>
            <tbody>

                @foreach ($customers as $customer)
                    <tr>

                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->state }}</td>
                        <td>{{ $customer->country }}</td>
                        <td>{{get_formatted_date( $customer->dob,"d/M/Y") }}</td>
                        <td>
                            @if ($customer->status == '1')
                            <a href="" class="btn-sm"
                            style="background-color: rgb(157, 226, 157);text-decoration: none;color :black;pointer-events: none">
                            <span>Active</span>
                            @else
                                <a href="" class="btn-sm"
                                    style="background-color: rgb(229, 174, 160);text-decoration: none;color :black;pointer-events: none">
                                    <span>Inactive</span>
                                </a>
                            @endif


                        </td>


                            <td>
                            {{-- <a href="{{ route('customer.delete', ['id' => $customer->cutomer_id]) }}"> --}}

                            <a href="{{ url('customer/forcedelete') }}/{{ $customer->id }}">
                                <button class="btn btn-outline-danger btn-sm">delete</button>
                            </a>
                        </td>

                        <td>


                            <a href="{{ route('customer.restore', $customer->id) }}">
                                <button class="btn btn-outline-primary btn-sm">restore</button>
                            </a>

                        </td>




                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>


