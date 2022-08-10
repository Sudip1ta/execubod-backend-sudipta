
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Intro Create</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <h6>Intro Create</h6>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif
                
                <form method="post" action="{{ url('new-intro-submit')}}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="shrt_des">Short Description</label>
                           <textarea name="shrt_des" class="form-control" id="shrt_des" cols="5" rows="3"></textarea>
                        </div>
    
                        <div class="col-md-12">
                            <label for="full_des">Full Description</label>
                            <textarea name="full_des" class="form-control" id="full_des" cols="10" rows="7"></textarea>
                        </div>
                    </div>
    
                    <input type="submit" class="btn btn-primary mt-3" value="Submit" >
                </form>
                
            </div>
        </main>

    @include('admin.include.footer')