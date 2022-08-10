
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
    @include('admin.include.path')

</head>
<body>

    @include('admin.include.sidebar')

        <main style="margin-top: 58px;">
            <div class="container pt-4">
                <div class="col-md-12" style="margin-bottom:30px;">
                    <h6>Category List <a href="{{ url('admin/add-new-category')}}" style="float: right" class="btn btn-primary">Add New Category</a></h6>

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-12">
                    <table class="categoryTable mt-2">
                        <thead class="table-primary">
                            <th>Category Id</th>
                            <th>Category Name</th>
                            <th>Note</th>
                            <th>Position</th>
                            
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @if(count($category) > 0)
                                @foreach ($category as $category_info)
                              
                                    <tr id="tr_<?= $category_info->id?>">
                                        <input type="hidden" class="category_id" value="{{ $category_info->id}}">
                                        <td>{{ $sl++ }}</td>
                                        <td class="category_name">{{ $category_info->category_name}}</td>
                                        <td class="note">{{ $category_info->note}}</td>
                                        
                                        <td class="position">{{$category_info->position }}</td>
                                        {{-- <td class="status">
                                            <input type="checkbox" class="category_status" <?= $category_info->status == 0 ? 'checked' : ''?> >
                                        </td> --}}

                                        <td>{{ date('d-m-Y ',strtotime($category_info->created_at))}}</td>
                                        <td>
                                            <input type="checkbox" class="category_status" <?= $category_info->status == 0 ? 'checked' : ''?> >&nbsp;&nbsp;
                                            <i class="fa-solid fa-pen-to-square editCategory" data-toggle="modal" data-target="#exampleModal"></i>&nbsp;&nbsp;
                                            <i class="fa-solid fa-trash-can deleteCategory"></i>
                                            
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
                                <label for="category_name_modal">Category Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="category_name_modal" id="category_name_modal" >
                            </div>
                            <div class="col-md-6">
                                <label for="position">Position</label>
                                <input type="number" min="0" class="form-control" autocomplete="off" name="position" id="position" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="description_modal">Description</label>
                                <textarea name="description_modal" id="description_modal" class="form-control" cols="30" rows="10"></textarea>

                                <input type="hidden" id="category_id_modal" >
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary cl" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary save_changes_category">Save changes</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
        </main>

    @include('admin.include.footer')