<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</head>
<body>

    <div class="container mt-5">
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
      
        <h4 style="text-align: center">Login</h4>
        <form method="post" action="{{ url('admin/verify')}}" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="">Email</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="off" required>
                </div>

                <div class="col-md-12">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Submit</button>

        </form>
           
    </div>
    
</body>
</html>