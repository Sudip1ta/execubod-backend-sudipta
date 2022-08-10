
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Management</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">

                <div class="col-md-12">
                    <h6>App Intro <a href="{{ url('admin/add-new-intro')}}" style="float: right" class="btn btn-primary">Add New Intro</a> </h6>

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>
               
                <div class="col-md-12 mt-4">
                    <table class="introTable mt-2">
                        <thead class="table-primary">
                            <th>Intro Id</th>
                            <th>Short Description</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php //echo "<pre>"; print_r($info);?>
                            @php
                                $sl = 1;
                            @endphp
                            @if(count($info) > 0)
                                @foreach ($info as $info_data)
                              
                                    <tr id="tr_<?= $info_data->id?>">
                                        <input type="hidden" class="id" value="{{ $info_data->id}}">
                                        <td>{{ $sl++ }}</td>
                                        <td class="shrt_des">{{ $info_data->short_description}}</td>
                                        <td class="des">{{ $info_data->description}}</td>
                                        
                                        <td>{{ date('d-m-Y ',strtotime($info_data->created_at))}}</td>
                                        <td>
                                            <input type="checkbox" class="intro_status" <?= $info_data->status == 0 ? 'checked' : ''?> >&nbsp;&nbsp;
                                            <i class="fa-solid fa-pen-to-square editIntro" data-toggle="modal" data-target="#exampleModal"></i>&nbsp;&nbsp;
                                            <i class="fa-solid fa-trash-can deleteIntro"></i>
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
                      <h5 class="modal-title" id="exampleModalLabel">Edit Intro</h5>
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
                                <label for="short_des_modal">Short Description</label>
                                <input type="text" class="form-control" autocomplete="off" name="short_des_modal" id="short_des_modal" >
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="last_name">Description</label>
                                <textarea name="description_modal" id="description_modal" class="form-control" cols="30" rows="10"></textarea>

                                <input type="hidden" id="intro_id" >
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary cl" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary save_changes_intro">Save changes</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
        </main>

    @include('admin.include.footer')