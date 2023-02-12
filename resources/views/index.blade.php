<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form with Laravel and SendGrid</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">


</head>

<body>

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex align-items-stretch">
                        <div class="contact-wrap w-100 p-md-5 p-4 py-5">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif


                            <form method="POST" action="/send_email">
                                @csrf
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="email">Email address</label>
                                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Your name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>

                                </div>
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="phone">Phone Number</label>
                                    <input name="phone" type="text" class="form-control" id="phone" aria-describedby="phone" placeholder="phone">
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>

                                </div>
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="exampleInputPassword1">Message</label>
                                    <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                </div>
                                <button type="submit" class="btn" style="background-color:#00CC87;">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 d-flex align-items-stretch" style="overflow: auto;">
                        <div class="w-300 p-md-5 p-4 py-5" style="width: 100%">
                            <div class="table-responsive" style="height: 100vh">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>To</th>
                                            <th>name</th>
                                            <th>content</th>
                                            <th>status</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emails as $email)
                                        <tr>
                                            <td>{{ $email->to }}</td>
                                            <td>{{ $email->name}}</td>
                                            <td>@if(strlen($email->content) > 10)
                                                {{ substr($email->content, 0, 10) . '...' }}
                                                @else
                                                {{ $email->content }}
                                                @endif
                                            </td>
                                            <td>{{ $email->status }}</td>
                                            <td>{{ $email->created_at }}</td>
                                            <td>
                                                <form action="{{ route('delete_email', $email->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>
