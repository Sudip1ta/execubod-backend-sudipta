
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Information</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <div class="row">

                   
                    <div class="col-md-12">
                        <h6>User Information</h6>

                        
                        <div class="row">
                            <div class="col-md-4">
                                @if(!empty($userInfo->profile_image_id))
                                    <img src="<?= asset('images').'/'.$userInfo->profile_image_id?>" alt="Image" style="width: 322px;">
                                @else
                                <img src="<?= asset('images/no-image.png')?>" alt="Image" style="width: 322px;">
                                @endif
                            </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-4">
                                    <b>Name :</b> <?= $user->first_name.' '.$user->last_name;?>
                                </div>
    
                                <div class="col-md-4">
                                    <b>Gender :</b> <?= $user->gender == 1 ? 'Male' : ($user_data->gender == 2 ? 'Female' : 'Transgender');?>
                                </div>

                                <div class="col-md-4">
                                    <b>User Name :</b> <?= $user->user_name;?>
                                </div>
    
                               
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <b>Date of Birth :</b> <?= date('m-d-Y',strtotime($user->dob));?>
                                </div>

                                <div class="col-md-4">
                                    <b>Age :</b> <?= $age;?>
                                </div>
    
                                <div class="col-md-4">
                                    <b>Email :</b> <?= $user->email;?>
                                </div>
    
                                
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <b>Occupation :</b> <?= $user->occupation;?>
                                </div>

                                <div class="col-md-4">
                                    <b>Last Login :</b>  <?= date('d-m-Y',strtotime($user->last_login_at));?>
                                </div>

                                <div class="col-md-4">
                                    <b>Registered At :</b>  <?= date('d-m-Y',strtotime($user->created_at));?>
                                </div>
                            </div>
                            

                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                       <table class="table information">
                           
                            <tr>
                                <th>Height</th>
                                <td>{{ $userInfo->height }} CM</td>
                                <th>Current Weight</th>
                                <td>{{ $userInfo->current_weight }} KG</td>
                                <th>Target Weight</th>
                                <td>{{ $userInfo->target_weight }} KG</td>
                            </tr>
                            <tr>
                                <th>Chest</th>
                                <td>{{ $userInfo->chest }}</td>
                                <th>Shoulder</th>
                                <td>{{ $userInfo->shoulder }}</td>
                                <th>Waist</th>
                                <td>{{ $userInfo->waist }}</td>
                            </tr>
                            <tr>
                                
                                <th>Stomach</th>
                                <td>{{ $userInfo->stomach }}</td>
                           
                                <th>Calves</th>
                                <td>{{ $userInfo->calves }}</td>
                                <th>Thighs</th>
                                <td>{{ $userInfo->thighs }}</td>
                            </tr>
                            <tr>
                                <th>Goals</th>
                                <td>{{ $userInfo->goals }}</td>
                                <th>Experience</th>
                                <td>{{ $userInfo->experience }}</td>
                                <th>Subscription_status</th>
                                <td><?= $userInfo->subscription_status == 0 ? 'Free User' : 'Subscripted User'; ?></td> 
                            </tr>
                           
                       </table> 
                    </div>
                    
                </div>

                
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <h6>Previous Goals</h6>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>Goal No.</th>
                            <th>Goal</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @php
                                $sl=1;
                            @endphp
                            @foreach($prev_goles as $goal)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $goal->goals }}</td>
                                    <td>{{ date('m-d-Y',strtotime($goal->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>

            <div style="height: 50px;"></div>
           
        </main>

    @include('admin.include.footer')