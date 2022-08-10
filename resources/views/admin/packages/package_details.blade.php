
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Package Details</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <div class="row">
                    <div class="col-md-12">
                        <h6>Package Details</h6>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="">Package Title</label>

                        <label for="" class="form-control" readonly>{{ $get_package->title}}</label>
                      
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="category">Category</label>
                        <label for="" class="form-control" readonly>{{ $get_package->category_name}}</label>
                    </div>

                    <div class="col-md-4">
                        <label for="goal">Main Goal</label>
                        <label for="" class="form-control" readonly>{{ $get_package->main_goal}}</label>
                    </div>

                    <div class="col-md-4">
                        <label for="level">Level</label>
                        <label for="" class="form-control" readonly>{{ $get_package->level}}</label>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="total_week">Total Week</label>
                        <label for="" class="form-control" readonly>{{ $get_package->weeks}}</label>
                    </div>

                    <div class="col-md-4">
                        <label for="avg_day_per_week">Average Days/Week</label>
                        <label for="" class="form-control" readonly>{{ $get_package->avg_days}}</label>
                    </div>
                

                    <div class="col-md-4">
                        <label for="avg_workout_time">Average Workout Time <small>(In Minute)</small></label>
                        <label for="" class="form-control" readonly>{{ $get_package->avg_workout_time_per_day}} </label>
                        
                    </div>

                </div>

                


                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="duration">Total Duration <small>(Showing In Minute)</small></label>
                        <label for="" class="form-control" readonly>{{ $get_package->total_duration}}
                        
                    </div>
                    <div class="col-md-4">
                        <label for="free_days">Free Trail Days</label>
                        <label for="" class="form-control" readonly>{{ $get_package->free_days}}
                    </div>

                    <div class="col-md-4">
                        <label for="cost">Package Cost</label>
                        <label for="" class="form-control" readonly>{{ $get_package->cost}}
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="note">Description</label>
                        <textarea name="note" id="note" class="form-control" cols="10" rows="5" readonly>{{ $get_package->description}}</textarea>
                    </div>
                </div>


                @if(count($get_excercise) > 0)
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Excercise</h4>
                    </div>
                </div>
                    
                @foreach($get_excercise as $excercise)
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <label for="">Excercise Name</label>
                            <label for="" class="form-control" readonly>{{ $excercise->excercise_name}}
                        </div>
                        <div class="col-md-3">
                            <label for="">Time Per Day <small>(In Minute)</small></label>
                            <label for="" class="form-control" readonly>{{ $excercise->time}}
                        </div>
                    </div>
                    @endforeach
                    
                    
                
                @endif

                <div style="margin-bottom: 100px;"></div>
            </div>
        </main>

    @include('admin.include.footer')