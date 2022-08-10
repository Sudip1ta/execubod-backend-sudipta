
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>User Management</title>
     @include('admin.include.path')
 </head>
 <body>
 
 
     @include('admin.include.sidebar')
 
          <!--Main Navigation-->
   
         <!--Main layout-->
         <main style="margin-top: 58px;">
             <div class="container pt-4">

                <div class="col-md-12">
                    <h6>Users List  <a href="{{ url('user-add')}}" style="float: right;margin-bottom:20px;" class="btn btn-primary btn-xs">Add User</a></h6>
                </div>
               
                <div class="col-md-12">
                    <table class="userTable mt-2">
                        <thead class="table-primary">
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Last Login</th>
                            <th>Register At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @if(count($users) > 0)
                                @foreach ($users as $user_data)
                                @php
                                    $gender = $user_data->gender == 1 ? 'Male' : ($user_data->gender == 2 ? 'Female' : 'Transgender');
                                    $status = $user_data->status == 0 ? 'Active' : 'Inactive';
                                @endphp
                                    <tr id="tr_<?=$user_data->id;?>">
                                        <input type="hidden" class="user" value="{{ $user_data->id}}">
                                        <input type="hidden" class="gender" value="{{ $user_data->gender }}">
                                        <input type="hidden" class="status" value="{{ $user_data->status }}"> 
                                        <td>{{ $sl++ }}</td>
                                        <td class="name">{{ $user_data->first_name.' '.$user_data->last_name}}</td>
                                        <td class="userName">{{ $user_data->user_name}}</td>
                                        <td class="email">{{ $user_data->email}}</td>
                                        <td class="genderText">{{ $gender}}</td>
                                        <td>{{ date('d-m-Y h:s',strtotime($user_data->last_login_at))}}</td>
                                        <td>{{ date('d-m-Y h:s',strtotime($user_data->created_at))}}</td>
                                        <td>
                                            <input type="checkbox" class="status_check" <?= $user_data->status == 0 ? 'checked' : ''?> title="Click for active inactive status" >&nbsp;&nbsp;
                                            <i class="fa-solid fa-circle-info userInfo"></i>&nbsp;
                                            <i class="fa-solid fa-pen-to-square editUser" data-toggle="modal" data-target="#exampleModal"></i>&nbsp;
                                            <i class="fa-solid fa-trash-can deleteUser"></i>
                                            
                                        
                                        </td>
                                    </tr>   
                                @endforeach
                            @endif
                        </tbody>
                        
                    </table>
                </div>
                

             </div>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" autocomplete="off" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 alert alert-danger" style="display: none">
                                    
                                </div> 
                            </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="first_name" id="first_name" >
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="last_name" id="last_name" >

                                <input type="hidden" id="user_id">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="" disabled selected>--Select--</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Transgender</option>
                                </select>
                                
                            </div>

                            <div class="col-md-6">
                                <label for="user_name">User Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="user_name" id="user_name" >
                            </div>
                            
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" autocomplete="off" name="email" id="email" >
                            </div>

                            
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary cl" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary save_changes">Save changes</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
         </main>
         <!--Main layout-->
 
     @include('admin.include.footer')