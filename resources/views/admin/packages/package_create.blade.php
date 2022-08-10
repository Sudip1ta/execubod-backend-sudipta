
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Package Add</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

    @php
        $min = 60;
        $hours = 500;
    @endphp

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <div class="row">
                    <div class="col-md-12">
                        <h5>New Package</h5>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <?= $error."<br>";?>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <form method="post" action="{{ url('package-submit')}}" >
                    @csrf
               
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="">Package Title</label>
                       <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="" selected disabled>--Select--</option>
                            @foreach($category as $category_list)
                                <option value="{{ $category_list->id }}">{{$category_list->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="goal">Main Goal</label>
                        <select name="goal" id="goal" class="form-control" required>
                            <option value="" selected disabled>--Select--</option>
                            @foreach($goals as $goal_list)
                            <option value="{{ $goal_list->id }}">{{$goal_list->goal_name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="" selected disabled>--Select--</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>

                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="total_week">Total Week</label>
                        <input type="number" min="0" class="form-control" name="total_week" id="total_week" required>
                    </div>

                    <div class="col-md-4">
                        <label for="avg_day_per_week">Average Days/Week</label>
                        <input type="number" min="0" step="any" class="form-control" name="avg_day_per_week" id="avg_day_per_week"  required>
                        <small id="avg_hours_in_week"></small>
                    </div>
                

                    <div class="col-md-4">
                        <label for="avg_workout_time">Average Workout Time <small>(In Minute)</small></label>
                        <input type="number" min="0" class="form-control" name="avg_workout_time" id="avg_workout_time" readonly required>
                        
                    </div>

                </div>

                


                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="duration">Total Duration <small>(Showing In Minute)</small></label>
                        <input type="number" min="0" class="form-control" name="duration" id="duration" required>
                        <small id="duration_in_hours"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="free_days">Free Trail Days</label>
                        <input type="number" min="0" step="any" class="form-control" name="free_days" id="free_days" max="7" required>
                    </div>

                    <div class="col-md-4">
                        <label for="cost">Package Cost</label>
                        <input type="number" min="0" step="any" class="form-control" name="cost" id="cost" required>
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="note">Description</label>
                        <textarea name="note" id="note" class="form-control" cols="10" rows="5"></textarea>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Excercise</h4>
                    </div>
                    
                </div>
                <div class="add_excercise">
                    <div class="row mt-4 rowExcercise">
                        <div class="col-md-5">
                            <label for="">Excercise Name</label>
                            <select name="excercise_name[]" id="excercise_name" class="form-control">
                                <option value="" selected disabled>--Select--</option> 
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Time Per Day <small>(In Minute)</small></label>
                            <input type="number" name="time[]" class="form-control" id="time">
                        </div>
    
                        <div class="col-md-2">
                            <button type="button" style="margin-top: 30px;" class="btn btn-primary btn-xs cloneBtn">Add More</button>
                        </div>
                    </div>
                </div>
                
              
                <input type="submit" class="btn btn-primary mt-2">
            </form>
            </div>
        </main>

    @include('admin.include.footer')