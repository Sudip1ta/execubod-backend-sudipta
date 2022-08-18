
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Package List</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <div class="col-md-12">
                    <h5>All Packages <a href="{{ url('package-create')}}" style="float: right;margin-bottom:20px;" class="btn btn-primary btn-xs">Add Package</a></h5>

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>
                {{--<div class="col-md-12">
                    <table class="table mt-2">
                        <thead class="table-primary">
                            <th>Pack No.</th>
                            <th>Package Name</th>
                            <th>Goal</th>
                            <th>Level</th>
                            <th>Weeks</th>
                            <th>Days/Week</th>
                            <th>Workout Time / Day</th>
                            <th>Total Duration</th>
                            <th>Free Days</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @if(count($get_packages) > 0)
                                @foreach ($get_packages as $packages_details)

                                    <tr id="tr_<?=$packages_details->id;?>">
                                        <input type="hidden" class="pack_id" value="{{ $packages_details->id}}">
                                        <input type="hidden" class="status" value="{{ $packages_details->status }}"> 
                                        <td>{{ $sl++ }}</td>
                                        <td class="pack_name">{{ $packages_details->title}}</td>
                                        <td class="goal">{{ $packages_details->main_goal}}</td>
                                        <td class="level">{{ $packages_details->level}}</td>
                                        <td class="weeks">{{ $packages_details->weeks}}</td>
                                        <td class="days">{{ $packages_details->avg_days}}</td>
                                        <td class="time_per_day">{{ $packages_details->avg_workout_time_per_day}} MIN</td>
                                        <td class="duration">{{ $packages_details->total_duration}} MIN</td>
                                       
                                        <td class="free">{{ $packages_details->free_days}}</td>
                                        <td class="cost"><i class="fa-solid fa-dollar-sign"></i> {{ $packages_details->cost}}</td>
                                        <td>
                                            <input type="checkbox" class="pack_status" <?= $packages_details->status == 0 ? 'checked' : ''?> >&nbsp;&nbsp;
                                            <i class="fa-solid fa-circle-info packInfo"></i>&nbsp;
                                           
                                            <i class="fa-solid fa-trash-can deletePack"></i>
                                            
                                        
                                        </td>
                                    </tr>   
                                @endforeach
                            @endif
                        </tbody>
                        
                    </table>
                </div>--}}
            </div>
        </main>

    @include('admin.include.footer')