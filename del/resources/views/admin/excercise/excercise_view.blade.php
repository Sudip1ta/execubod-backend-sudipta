
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Excercise</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <div class="col-md-12" style="margin-bottom:30px;">
                    <h6>Excercise List <a href="{{ url('admin/new-excercise')}}" style="float: right" class="btn btn-primary">Add New Excercise</a></h6>

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-12">
                    <table class="categoryTable mt-2">
                        <thead class="table-primary">
                            <th>Excercise Id</th>
                            <th>Category Name</th>
                            <th>Goal Name</th>
                            <th>Excercise Name</th>
                            <th>Note</th>
                            <th>Position</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @if(count($excercise_list) > 0)
                                @foreach ($excercise_list as $excercise)
                              
                                    <tr id="tr_<?= $excercise->id?>">
                                        <input type="hidden" class="excercise_id" value="{{ $excercise->id}}">
                                        <input type="hidden" class="category_id" value="{{ $excercise->category_id}}">
                                        <input type="hidden" class="goal_id" value="{{ $excercise->goal_id}}">
                                        <td>{{ $sl++ }}</td>
                                        <td class="category_name">{{ $excercise->category_name}}</td>
                                        <td class="goal_name">{{ $excercise->goal_name}}</td>
                                        <td class="excercise_name">{{ $excercise->excercise_name}}</td>
                                        <td class="note">{{ $excercise->note}}</td>
                                        <td class="position">{{$excercise->position }}</td>
                                        <td>{{ date('d-m-Y ',strtotime($excercise->created_at))}}</td>
                                        <td>
                                            <input type="checkbox" class="excercise_status" <?= $excercise->status == 0 ? 'checked' : ''?> >&nbsp;&nbsp;
                                            <i class="fa-solid fa-pen-to-square editExcercise" data-toggle="modal" data-target="#exampleModal"></i>&nbsp;&nbsp;
                                            <i class="fa-solid fa-trash-can deleteExcercise"></i>
                                            
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
                      <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
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

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="note_modal">Note</label>
                                <textarea name="note_modal" id="note_modal" class="form-control" cols="10" rows="5"></textarea>

                                <input type="hidden" id="excercise_id_modal" >
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary cl" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary save_changes_excercise">Save changes</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
        </main>

    @include('admin.include.footer')