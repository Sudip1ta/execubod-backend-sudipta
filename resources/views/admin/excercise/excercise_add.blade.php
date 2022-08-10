
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Excercise Add</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <h6>New Excercise </h6>
                
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{$error}}<br>
                    @endforeach
                </div>
                @endif

                <form method="post" action="{{ url('excercise-store')}}">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" id="category" required>
                                <option value="" selected disabled>--Select--</option>
                                @foreach($category as $category_list)
                                <option value="{{$category_list->id }}">{{$category_list->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="goal">Goal</label>
                            <select name="goal" class="form-control" id="goal" required>
                                <option value="" selected disabled>--Select--</option>
                                @foreach($goal as $goal_list)
                                <option value="{{$goal_list->id }}">{{$goal_list->goal_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="excercise_name">Excercise Name</label>
                            <input type="text" name="excercise_name" id="excercise_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="position">Position</label>
                            <input type="number" name="position" id="position" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="note">Note</label>
                            <textarea name="note" id="note" class="form-control" cols="10" rows="5"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </main>

    @include('admin.include.footer')