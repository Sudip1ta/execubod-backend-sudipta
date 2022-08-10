
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Free Trial</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <div class="col-md-12">
                    <h6>7 days Free Trial Users</h6>
                </div>
                

                <div class="col-md-12">
                    <table class="userTable mt-2">
                        <thead class="table-primary">
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Package Name</th>
                            <th>Amount</th>
                            <th>Apply On</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @if(count($list) > 0)
                                @foreach ($list as $list_data)
                                    @php

                                       if($list_data->status == 0){
                                            $status = "Under Trail";
                                       } else if($list_data->status == 1){
                                            $status = "Complete Trail";
                                       }else{
                                        $status = "Cancel";
                                       }
                                    @endphp

                                    <tr id="tr_<?=$list_data->id;?>">
                                        <input type="hidden" class="user" value="{{ $list_data->user_id}}">
                                        
                                        <td>{{ $sl++ }}</td>
                                        <td class=""><a href="<?= url('/').'/admin/'.$list_data->user_id.'/user-information'?>">{{ $list_data->first_name.' '.$list_data->last_name}}</a></td>
                                        <td class=""><a href="<?= url('/').'/admin/'.$list_data->id.'/package-details'?>">{{ $list_data->title}}</a></td>

                    
                                        <td class=""><i class="fa-solid fa-dollar-sign"></i> {{ $list_data->amount}}</td>

                                        <td>{{ date('d-m-Y',strtotime($list_data->created_at))}}</td>
                                        <td>{{ date('d-m-Y',strtotime($list_data->trial_end_date))}}</td>
                                        <td> {{ $status}}</td>

                                       
                                    </tr>   
                                @endforeach
                            @endif
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </main>

    @include('admin.include.footer')