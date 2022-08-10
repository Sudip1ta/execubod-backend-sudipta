
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goals</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <div class="col-md-12" style="margin-bottom:30px;">
                    <h6>Goals List <a href="{{ url('add-new-goal')}}" style="float: right" class="btn btn-primary">Add New Goal</a></h6>

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-12">
                    <table class="categoryTable mt-2">
                        <thead class="table-primary">
                            <th>Goal Id</th>
                            <th>Goal Name</th>
                            <th>Note</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @if(count($get_goals) > 0)
                                @foreach ($get_goals as $goal_info)
                              
                                    <tr id="tr_<?= $goal_info->id?>">
                                        <input type="hidden" class="goal_id" value="{{ $goal_info->id}}">
                                        <td>{{ $sl++ }}</td>
                                        <td class="goal_name">{{ $goal_info->goal_name}}</td>
                                        <td class="note">{{ $goal_info->note}}</td>

                                        <td>{{ date('d-m-Y ',strtotime($goal_info->created_at))}}</td>
                                        <td>
                                            <input type="checkbox" class="goal_status" <?= $goal_info->status == 0 ? 'checked' : ''?> >&nbsp;&nbsp;
                                            <i class="fa-solid fa-pen-to-square editGoal" data-toggle="modal" data-target="#exampleModal"></i>&nbsp;&nbsp;
                                            <i class="fa-solid fa-trash-can deleteGoal"></i>
                                            
                                        </td>
                                    </tr>   
                                @endforeach
                            @endif
                        </tbody>
                        
                    </table>
                </div>
                
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Goal</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form  autocomplete="off" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 alert alert-danger" style="display: none">
                                    
                                </div> 
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="goal_name_modal">Goal Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="goal_name_modal" id="goal_name_modal" >
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="note_modal">Note</label>
                                <textarea name="note_modal" id="note_modal" class="form-control" cols="20" rows="5"></textarea>

                                <input type="hidden" id="goal_id_modal" >
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary cl" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary save_changes_goal">Save changes</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
        </main>

    @include('admin.include.footer')