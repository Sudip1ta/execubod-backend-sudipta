  

</body>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
{{-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" ></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        const APP_URI = "{{url('/')}}";

        $(".table").dataTable({
            "pageLength" : 20,
            "order" : []
        });

        $(".userTable").dataTable({
            "pageLength" : 20,
            "order" : []
        });

        $(".introTable").dataTable({
            "pageLength" : 20,
            "order" : []
        });

        $(".categoryTable").dataTable({
            "pageLength" : 20,
            "order" : []
        });

        $('.editUser').click(function (e) { 
            e.preventDefault();
            var user = $(this).parent('td').parent('tr').find('.user').val();
            var name = $(this).parent('td').parent('tr').find('.name').text().split(' ');
            var userName = $(this).parent('td').parent('tr').find('.userName').text();
            var email = $(this).parent('td').parent('tr').find('.email').text();
            var gender = $(this).parent('td').parent('tr').find('.gender').val();

            $("#user_id").val(user);
            $("#first_name").val(name[0]);
            $("#last_name").val(name[1]);
            $("#email").val(email);
            $("#user_name").val(userName);
            $("#gender").val(gender).change();
        });


        $('.save_changes').click(function (e) { 
            e.preventDefault();
            var errorMsg = '';
            var userId = $("#user_id").val();
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var email = $("#email").val();
            var user_name = $("#user_name").val();
            var gender = $("#gender").val();
            var CSRF = "{{csrf_token()}}";
            //var status = $("input[name='status']").val();

            $.ajax({
                type: "POST",
                url: APP_URI+"/user-edit-store",
                data: {
                    first_name :first_name,
                    last_name : last_name,
                    email : email,
                    user_name : user_name,
                    gender : gender,
                    _token: CSRF,
                    user_id : userId,
                },
                success: function (response) {
                   if(response.status == 1){
                       
                       $.each(response.errors, function(index, value){
                            errorMsg+=value+"<br>";   
                       });

                        $(".alert-danger").show();
                        $(".alert-danger").html(errorMsg);
                   }else{
               
                   
                        var gender = response.a.gender == 1 ? 'Male' : (response.a.gender == 2 ? 'Female' : 'Transgender');

                        $("#tr_"+userId).find('.name').text(response.a.first_name+' '+response.a.last_name);
                        $("#tr_"+userId).find('.userName').text(response.a.user_name);
                        $("#tr_"+userId).find('.email').text(response.a.email);
                        $("#tr_"+userId).find('.gender').val(response.a.gender);
                        $("#tr_"+userId).find('.status').val(response.a.status);
                        $("#tr_"+userId).find('.genderText').text(gender);
                        
                        $(".alert-danger").hide();
                        $(".alert-danger").html('');
                        $(".cl").trigger('click');
                        swal({
                            title: "Success!",
                            text: "User Data Updated Successfully!",
                            icon: "success",
                            button: "Ok!",
                        });
                   }
                }
            });
            
            
        });

        $('.deleteUser').click(function(){
            var that = $(this).parent('td').parent('tr');
            var user = $(this).parent('td').parent('tr').find('.user').val();

            swal({
      title: "Are you sure?",
      text: "Do You Want to Delete this Record ?",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
            $.ajax({
                type: "GET",
                url: APP_URI+"/user-delete",
                data: { user_id : user},
                success: function (response) {
                    console.log(response);
                    if(response.status == 1){
                        that.remove();
                        swal({
                            title: 'Success!',
                            text: 'User successfully deleted!',
                            icon: 'success'
                        });
                    }
                   
                }
            });
        
        } else {
            swal("Cancelled", "Your imaginary record is safe :)", "error");
        }
    });
        });


        $(".status_check").click(function(){

            that = $(this);
            var user = $(this).parent('td').parent('tr').find('.user').val();

            if($(this).is(":checked")){
                $.ajax({
                    type: "GET",
                    url: APP_URI+"/user-status-update",
                    data: {user_id: user, update : 0},
                    success: function (response) {
                        swal({
                            title: "Success!",
                            text: "User is now Active!",
                            icon: "success",
                            button: "Ok!",
                        });
                    }
                });
            }else{
                
                $.ajax({
                    type: "GET",
                    url: APP_URI+"/user-status-update",
                    data: {user_id: user, update : 1},
                    success: function (response) {
                        swal({
                            title: "Success!",
                            text: "User is now Inactive!",
                            icon: "success",
                            button: "Ok!",
                        });
                    }
                });
            }
        });


        $('.userInfo').click(function (e) { 
            e.preventDefault();

            var user_id = $(this).parent('td').parent('tr').find('.user').val();
            
            if($.trim(user_id) != ''){
                window.location.href = APP_URI+"/"+user_id+"/user-information";
            }
        });

        /***************** App Intro **************/

        $('.editIntro').click(function (e) { 
            e.preventDefault();
            var introId = $(this).parent('td').parent('tr').find('.id').val();
            var short_description = $(this).parent('td').parent('tr').find('.shrt_des').text();
            var description = $(this).parent('td').parent('tr').find('.des').text();
          
            $("#short_des_modal").val(short_description);
            $("#description_modal").val(description);
            $("#intro_id").val(introId);
        });


        $('.save_changes_intro').click(function (e) { 
            e.preventDefault();
            var errorMsg = '';
            var intro_id = $("#intro_id").val();
            var shrt_des = $("#short_des_modal").val();
            var des = $("#description_modal").val();
            var CSRF = "{{ csrf_token() }}";

            $.ajax({
                type: "POST",
                url: APP_URI+"/intro-update",
                data: {
                    intro_id : intro_id,
                    shrt_des : shrt_des,
                    des : des,
                    _token : CSRF
                },
                success: function (response) {

                    if(response.status == 2){
                        $.each(response.errors, function(index, value){
                            errorMsg+=value+"<br>";   
                        });

                        $(".alert-danger").show();
                        $(".alert-danger").html(errorMsg);
                    }else{
                        if(response.status == 1){
                            $("#tr_"+intro_id).find('.shrt_des').text(response.data.short_description);
                            $("#tr_"+intro_id).find('.des').text(response.data.description);
                            $(".cl").trigger('click');

                            swal({
                                title: 'Success!',
                                text: 'App Intro successfully Updated!',
                                icon: 'success'
                            });

                        }else{
                            swal({
                                title: 'Error!',
                                text: 'Some Error Occured!',
                                icon: 'error'
                            });
                        }
                    }
                }
            });
        });


        $('.deleteIntro').click(function(){
            var that = $(this).parent('td').parent('tr');
            var intro_id = $(this).parent('td').parent('tr').find('.id').val();

            var token = "{{ csrf_token()}}";

            swal({
                title: "Are you sure?",
                text: "Do You Want to Delete this Record ?",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
                }).then(function(isConfirm) {

                if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: APP_URI+"/intro-delete",
                            data: { id : intro_id , _token : token},
                            success: function (response) {
                                   
                                if(response.status == 1){
                                    that.remove();
                                    swal({
                                        title: 'Success!',
                                        text: 'Intro successfully deleted!',
                                        icon: 'success'
                                    });
                                }
                            
                            }
                        });
                    
                    } else {
                        swal("Cancelled", "Your imaginary record is safe :)", "error");
                    }
                });
            });


            $(".intro_status").click(function(){

                that = $(this);
                var id = $(this).parent('td').parent('tr').find('.id').val();

                var token = "{{ csrf_token() }}";

                if($(this).is(":checked")){
                    update = 0;
                }else{
                    update = 1;
                }

                $.ajax({
                        type: "POST",
                        url: APP_URI+"/intro-status-update",
                        data: {id: id, update :update, _token : token },
                        success: function (response) {
                            if(response.status == 1)
                            {
                                if(update == 0){
                                    swal({
                                        title: "Success!",
                                        text: "Intro is now Active!",
                                        icon: "success",
                                        button: "Ok!",
                                    });
                                }else{
                                    swal({
                                        title: "Success!",
                                        text: "Intro is now Inactive!",
                                        icon: "success",
                                        button: "Ok!",
                                    });
                                }
                            }
                        }
                    });
            });




            /***************** Category **************/

            $('.editCategory').click(function (e) { 
                e.preventDefault();
                var category_id = $(this).parent('td').parent('tr').find('.category_id').val();
                var category_name = $(this).parent('td').parent('tr').find('.category_name').text();
                var note = $(this).parent('td').parent('tr').find('.note').text();
                var position = $(this).parent('td').parent('tr').find('.position').text();
                
                $("#category_name_modal").val(category_name);
                $("#position").val(position);
                $("#description_modal").val(note);
                $("#category_id_modal").val(category_id);
            });

            $('.save_changes_category').click(function (e) { 
            e.preventDefault();
            var errorMsg = '';

            var category_id = $("#category_id_modal").val();
            var category_name = $("#category_name_modal").val();
            var position = $("#position").val();
            var note = $("#description_modal").val();
            var CSRF = "{{ csrf_token() }}";

            $.ajax({
                type: "POST",
                url: APP_URI+"/category-update",
                data: {
                    category_id : category_id,
                    category_name : category_name,
                    position : position,
                    note : note,
                    _token : CSRF
                },
                success: function (response) {

                    if(response.status == 2){
                        $.each(response.errors, function(index, value){
                            errorMsg+=value+"<br>";   
                        });

                        $(".alert-danger").show();
                        $(".alert-danger").html(errorMsg);
                    }else{
                        if(response.status == 1){

                            $("#tr_"+category_id).find('.category_name').text(response.data.category_name);
                            $("#tr_"+category_id).find('.note').text(response.data.note);
                            $("#tr_"+category_id).find('.position').text(response.data.position);
                            $(".cl").trigger('click');

                            swal({
                                title: 'Success!',
                                text: 'Category successfully Updated!',
                                icon: 'success'
                            });

                        }else{
                            swal({
                                title: 'Error!',
                                text: 'Some Error Occured!',
                                icon: 'error'
                            });
                        }
                    }
                }
            });
        });


        $(".category_status").click(function(){

          
            that = $(this);
            var id = $(this).parent('td').parent('tr').find('.category_id').val();

            var token = "{{ csrf_token() }}";

            if($(this).is(":checked")){
                update = 0;
            }else{
                update = 1;
            }

            $.ajax({
                    type: "POST",
                    url: APP_URI+"/category-status-update",
                    data: {id: id, update :update, _token : token },
                    success: function (response) {
                        if(response.status == 1)
                        {
                            if(update == 0){
                                swal({
                                    title: "Success!",
                                    text: "Category is now Active!",
                                    icon: "success",
                                    button: "Ok!",
                                });
                            }else{
                                swal({
                                    title: "Success!",
                                    text: "Category is now Inactive!",
                                    icon: "success",
                                    button: "Ok!",
                                });
                            }
                        }
                    }
                });
            });


            $('.deleteCategory').click(function(){

            var that = $(this).parent('td').parent('tr');
            var cat_id = $(this).parent('td').parent('tr').find('.category_id').val();

            var token = "{{ csrf_token()}}";

            swal({
                title: "Are you sure?",
                text: "Do You Want to Delete this Record ?",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
                }).then(function(isConfirm) {

                if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: APP_URI+"/category-delete",
                            data: { id : cat_id , _token : token},
                            success: function (response) {
                                   
                                if(response.status == 1){
                                    that.remove();
                                    swal({
                                        title: 'Success!',
                                        text: 'Category successfully deleted!',
                                        icon: 'success'
                                    });
                                }
                            
                            }
                        });
                    
                    } else {
                        swal("Cancelled", "Your imaginary record is safe :)", "error");
                    }
                });
            });


            /************* Package jquery Start   **************/

            $("#total_week,#avg_day_per_week").on('keyup',function(){
                var total_week = $("#total_week").val();
                var total_day_per_week =  $("#avg_day_per_week").val();

               
                if(total_day_per_week > 7){
                    $("#avg_day_per_week").val('');
                    $("#avg_workout_time").prop('readonly',true);
                }else{

                    if($.trim(total_week) != ''  && $.trim(total_day_per_week) != ''){
                        $("#avg_workout_time").removeAttr('readonly');
                    }else{
                        $("#avg_workout_time").prop('readonly',true);
                        $("#avg_hours_in_week").html('');
                        $("#duration_in_hours").html('');
                        $("#duration").val('');
                    }
                }
            });

            $("#total_week,#avg_day_per_week,#avg_workout_time").on('keyup',function(){
                var input = $("#avg_workout_time").val();
                var total_day_per_week =  $("#avg_day_per_week").val();
                var total_week = $("#total_week").val();

                if($.trim(input) != '' && $.trim(total_week) != ''  && $.trim(total_day_per_week) != ''){

                    total_minute_a_week = parseInt(input) * parseInt(total_day_per_week);

                    total_duration = parseInt(total_minute_a_week) * parseInt(total_week);

                    hours = Math.floor(total_duration / 60);          
                    minutes = total_duration % 60;

                    hours_in_a_week = Math.floor(total_minute_a_week / 60);          
                    minutes_in_a_week = total_minute_a_week % 60;

                    
                    $("#duration").val(total_duration);
                    $("#avg_hours_in_week").html(`Total Hours in a Week : ${hours_in_a_week}.${minutes_in_a_week} HR`);
                    $("#duration_in_hours").html(`Total Package Hours : ${hours}.${minutes} HR`);
                }
            });

            arrayCount= 0;
            $("#category,#goal").on('change',function(){
                var html = '<option value="" selectd>--Select--</option>';
                var cat_id = $("#category").val();
                var goal_id = $("#goal").val();
                var token = "{{ csrf_token() }}";

                if($.trim(cat_id) != '' && $.trim(goal_id) != ''){
                    $.ajax({
                        type: "POST",
                        url: APP_URI+"/fetch-excercise",
                        data: {
                            cat_id:cat_id,
                            goal_id:goal_id,
                            _token : token
                        },
                        success: function (response) {

                         
                                if(response.status == 1){
                                    
                                    $.each(response.data,function(index,value){
                                        
                                        html+='<option value="'+value.id+'">'+value.excercise_name+'</option>';

                                        arrayCount++;
                                        $("#excercise_name").html(html);
                                    });

                             

                                   
                                }else{
                                    $("#excercise_name").html(html);
                                }

                                
                        }
                    });
                }
            });

            rowClone = 1;

            $(document).on('click','.cloneBtn',function(){
                var cat_id = $("#category").val();
                var goal_id = $("#goal").val();
                if($.trim(cat_id) != '' && $.trim(goal_id) != ''){

                    if(rowClone < arrayCount)
                    {
                        var clone = $(this).parent('div').parent('div').clone();

                        $('.add_excercise').append(clone);

                        rowClone++;
                    }
                   
                }
               
            });

            $('.pack_status').click(function () { 
        

                that = $(this);
                var id = $(this).parent('td').parent('tr').find('.pack_id').val();

                var token = "{{ csrf_token() }}";

                if($(this).is(":checked")){
                    update = 0;
                }else{
                    update = 1;
                }
                

                $.ajax({
                        type: "POST",
                        url: APP_URI+"/pack-status-update",
                        data: {id: id, update :update, _token : token },
                        success: function (response) {
                            if(response.status == 1)
                            {
                                if(update == 0){
                                    swal({
                                        title: "Success!",
                                        text: "Package is now Active!",
                                        icon: "success",
                                        button: "Ok!",
                                    });
                                }else{
                                    swal({
                                        title: "Success!",
                                        text: "Package is now Inactive!",
                                        icon: "success",
                                        button: "Ok!",
                                    });
                                }
                            }
                        }
                    });
                
            });

            

            $('.deletePack').click(function(){

            var that = $(this).parent('td').parent('tr');
            var pack_id = $(this).parent('td').parent('tr').find('.pack_id').val();

            var token = "{{ csrf_token()}}";

            swal({
                title: "Are you sure?",
                text: "Do You Want to Delete this Record ?",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
                }).then(function(isConfirm) {

                if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: APP_URI+"/package-delete",
                            data: { id : pack_id , _token : token},
                            success: function (response) {
                                
                                if(response.status == 1){
                                    that.remove();
                                    swal({
                                        title: 'Success!',
                                        text: 'Goal successfully deleted!',
                                        icon: 'success'
                                    });
                                }
                            
                            }
                        });
                    
                    } else {
                        swal("Cancelled", "Your imaginary record is safe :)", "error");
                    }
                });
            });

            $('.packInfo').click(function (e) { 
                e.preventDefault();

                var pack_id = $(this).parent('td').parent('tr').find('.pack_id').val();
            
                if($.trim(pack_id) != ''){
                    window.location.href = APP_URI+"/"+pack_id+"/package-details";
                }
                
            });

           


        /************* Goal jquery Start   **************/

            $('.editGoal').click(function (e) { 
                e.preventDefault();

                var goal_id = $(this).parent('td').parent('tr').find('.goal_id').val();
                var goal_name = $(this).parent('td').parent('tr').find('.goal_name').text();
                var note = $(this).parent('td').parent('tr').find('.note').text();
                
                $("#goal_name_modal").val(goal_name);
                $("#note_modal").val(note);
                $("#goal_id_modal").val(goal_id);

                
            });


            $('.save_changes_goal').click(function (e) { 
                e.preventDefault();

                var errorMsg = '';
                var goal_id = $("#goal_id_modal").val();
                var goal_name = $("#goal_name_modal").val();
                var note = $("#note_modal").val();
                var CSRF = "{{ csrf_token() }}";

                $.ajax({
                    type: "POST",
                    url: APP_URI+"/goal-update",
                    data: {
                        goal_id : goal_id,
                        goal_name : goal_name,
                        note : note,
                        _token : CSRF
                    },
                    success: function (response) {

                       
                        if(response.status == 2){
                            $.each(response.errors, function(index, value){
                                errorMsg+=value+"<br>";   
                            });

                            $(".alert-danger").show();
                            $(".alert-danger").html(errorMsg);
                        }else{
                            if(response.status == 1){

                                $("#tr_"+goal_id).find('.goal_name').text(response.data.goal_name);
                                $("#tr_"+goal_id).find('.note').text(response.data.note);
                                $(".cl").trigger('click');

                                swal({
                                    title: 'Success!',
                                    text: 'Goal successfully Updated!',
                                    icon: 'success'
                                });

                            }else{
                                swal({
                                    title: 'Error!',
                                    text: 'Some Error Occured!',
                                    icon: 'error'
                                });
                            }
                        }
                    }
                });
            });


            $(".goal_status").click(function(){

                that = $(this);
                var id = $(this).parent('td').parent('tr').find('.goal_id').val();

                var token = "{{ csrf_token() }}";

                if($(this).is(":checked")){
                    update = 0;
                }else{
                    update = 1;
                }

                $.ajax({
                        type: "POST",
                        url: APP_URI+"/goal-status-update",
                        data: {id: id, update :update, _token : token },
                        success: function (response) {
                            if(response.status == 1)
                            {

                                if(update == 0){
                                    $("#tr_"+id).find('.pack_status').prop('checked',true);
                                    swal({
                                        title: "Success!",
                                        text: "Goal is now Active!",
                                        icon: "success",
                                        button: "Ok!",
                                    });
                                }else{
                                    $("#tr_"+id).find('.pack_status').removeAttr('checked');
                                    swal({
                                        title: "Success!",
                                        text: "Goal is now Inactive!",
                                        icon: "success",
                                        button: "Ok!",
                                    });
                                }
                            }
                        }
                    });
                });



            $('.deleteGoal').click(function(){

            var that = $(this).parent('td').parent('tr');
            var goal_id = $(this).parent('td').parent('tr').find('.goal_id').val();

            var token = "{{ csrf_token()}}";

            swal({
                title: "Are you sure?",
                text: "Do You Want to Delete this Record ?",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
                }).then(function(isConfirm) {

                if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: APP_URI+"/goal-delete",
                            data: { id : goal_id , _token : token},
                            success: function (response) {
                                
                                if(response.status == 1){
                                    that.remove();
                                    swal({
                                        title: 'Success!',
                                        text: 'Goal successfully deleted!',
                                        icon: 'success'
                                    });
                                }
                            
                            }
                        });
                    
                    } else {
                        swal("Cancelled", "Your imaginary record is safe :)", "error");
                    }
                });
            });

            
             /************* Excercise jquery Start   **************/

             $('.editExcercise').click(function (e) { 
                e.preventDefault();

                var excercise_id = $(this).parent('td').parent('tr').find('.excercise_id').val();
                var category = $(this).parent('td').parent('tr').find('.category_name').text();
                var goal = $(this).parent('td').parent('tr').find('.goal_name').text();
                var excercise_name = $(this).parent('td').parent('tr').find('.excercise_name').text();
                var position = $(this).parent('td').parent('tr').find('.position').text();
                var note = $(this).parent('td').parent('tr').find('.note').text();
                var cetgory_id = $(this).parent('td').parent('tr').find('.category_id').val();
                var goal_id = $(this).parent('td').parent('tr').find('.goal_id').val();
                
                $("#category").val(cetgory_id).change();
                $("#goal").val(goal_id).change();
                $("#excercise_name").val(excercise_name);
                $("#position").val(position);
                $("#note_modal").val(note);
                $("#excercise_id_modal").val(excercise_id);

                
            });



            $('.save_changes_excercise').click(function (e) { 
                e.preventDefault();
               
                var errorMsg = '';
                var excercise_id = $("#excercise_id_modal").val();
                var category_id = $("#category").val();
                var goal_id = $("#goal").val();
                var excercise_name =  $("#excercise_name").val();
                var position = $("#position").val();
                var note = $("#note_modal").val();
                var CSRF = "{{ csrf_token() }}";

                var category_text = $("#category :selected").text();
                var goal_text = $("#goal :selected").text();
                $.ajax({
                    type: "POST",
                    url: APP_URI+"/excercise-update",
                    data: {
                        excercise_id : excercise_id,
                        category_id : category_id,
                        goal_id : goal_id,
                        excercise_name : excercise_name,
                        position : position,
                        note : note,
                        _token : CSRF
                    },
                    success: function (response) {

                       
                        if(response.status == 2){
                            $.each(response.errors, function(index, value){
                                errorMsg+=value+"<br>";   
                            });

                            $(".alert-danger").show();
                            $(".alert-danger").html(errorMsg);
                        }else{
                            if(response.status == 1){

                                $("#tr_"+excercise_id).find('.category_name').text(category_text);
                                $("#tr_"+excercise_id).find('.goal_name').text(goal_text);
                                $("#tr_"+excercise_id).find('.excercise_name').text(response.data.excercise_name);
                                $("#tr_"+excercise_id).find('.note').text(response.data.note);
                                $("#tr_"+excercise_id).find('.position').text(response.data.position);
                                $("#tr_"+excercise_id).find('.category_id').val(response.data.category_id);
                                $("#tr_"+excercise_id).find('.goal_id').val(response.data.goal_id);

                                $(".cl").trigger('click');
                                
                                swal({
                                    title: 'Success!',
                                    text: 'Category successfully Updated!',
                                    icon: 'success'
                                });

                            }else{
                                swal({
                                    title: 'Error!',
                                    text: 'Some Error Occured!',
                                    icon: 'error'
                                });
                            }
                        }
                    }
                });
            });

            

            $(".excercise_status").click(function(){

            that = $(this);
            var id = $(this).parent('td').parent('tr').find('.excercise_id').val();

            var token = "{{ csrf_token() }}";

            if($(this).is(":checked")){
                update = 0;
            }else{
                update = 1;
            }

            $.ajax({
                    type: "POST",
                    url: APP_URI+"/excercise-status-update",
                    data: {id: id, update :update, _token : token },
                    success: function (response) {
                        if(response.status == 1)
                        {
                            if(update == 0){
                                swal({
                                    title: "Success!",
                                    text: "Excercise is now Active!",
                                    icon: "success",
                                    button: "Ok!",
                                });
                            }else{
                                swal({
                                    title: "Success!",
                                    text: "Excercise is now Inactive!",
                                    icon: "success",
                                    button: "Ok!",
                                });
                            }
                        }
                    }
                });
            });


            

            $('.deleteExcercise').click(function(){

            var that = $(this).parent('td').parent('tr');
            var excercise_id = $(this).parent('td').parent('tr').find('.excercise_id').val();

            var token = "{{ csrf_token()}}";

            swal({
                title: "Are you sure?",
                text: "Do You Want to Delete this Record ?",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
                }).then(function(isConfirm) {

                if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: APP_URI+"/excercise-delete",
                            data: { id : excercise_id , _token : token},
                            success: function (response) {
                                
                                if(response.status == 1){
                                    that.remove();
                                    swal({
                                        title: 'Success!',
                                        text: 'Excercise successfully deleted!',
                                        icon: 'success'
                                    });
                                }
                            
                            }
                        });
                    
                    } else {
                        swal("Cancelled", "Your imaginary record is safe :)", "error");
                    }
                });
            });

    </script>
</html>