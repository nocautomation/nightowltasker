<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    @if(Session::has('message'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.success("{{ session('message') }}");
      @endif

      Date.prototype.addHours= function(h){
            this.setHours(this.getHours()+h);
            return this;
        }

    //Start!!! - When user selected a branch in new loan page
    $('#branch').change(function(e){

        e.preventDefault();

        var branch = $('#branch').find(":selected").val();

        if(branch != ""){
            $('#coordinator').find("option").remove();
            $('#coordinator').prop("disabled", false);

            $.ajax({
                url: '/requestorandcoordinator',
                type: 'POST',
                data: {
                    branch: branch
                },
                dataType: 'JSON',
                success: function(response){

                    var x = 0;

                    for(x = 0; x < response.length; x++){

                        $('#coordinator').append('<option value="' + response[x].id + '">' + response[x].first_name + ' ' + response[x].last_name + '</option>');
                       
                    }
                }
            });
        }
        else{

            $('#coordinator').prop("disabled", true);
            $('#coordinator').find("option").remove();

        }   
    });
    //END!!!! 

    //START!!! When Start button for scrub was clicked
    $('#scrubstart').click(function(e){
        e.preventDefault();
        $('#datetimescrubstart').val(new Date().addHours(-7).toJSON().slice(0,19));
    });
    //END!!!

    //START!!! When End button for scrub was clicked
    $('#scrubend').click(function(e){
        e.preventDefault();
        
        
        $('#datetimescrubend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!


//START!!! When Start button for File Setup was clicked
    $('#filesetupstart').click(function(e){
        e.preventDefault();

        $('#datetimefilesetupstart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for File Setup was clicked
    $('#filesetupend').click(function(e){
        e.preventDefault();

        $('#datetimefilesetupend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for Disclosure was clicked
    $('#disclosurestart').click(function(e){
        e.preventDefault();

        $('#datetimedisclosurestart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for Disclosure was clicked
    $('#disclosureend').click(function(e){
        e.preventDefault();

        $('#datetimedisclosureend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for Appraisal was clicked
    $('#appraisalstart').click(function(e){
        e.preventDefault();

        $('#datetimeappraisalstart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for Appraisal was clicked
    $('#appraisalend').click(function(e){
        e.preventDefault();

        $('#datetimeappraisalend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for FasTrack Disclosure was clicked
    $('#fastrackdisclosurestart').click(function(e){
        e.preventDefault();

        $('#datetimeftdisclosurestart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for FasTrack Disclosure was clicked
    $('#fastrackdisclosureend').click(function(e){
        e.preventDefault();

        $('#datetimeftdisclosureend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for FasTrack Disclosure was clicked
    $('#fastracksubmissionstart').click(function(e){
        e.preventDefault();

        $('#datetimeftsubmissionstart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for FasTrack Disclosure was clicked
    $('#fastracksubmissionend').click(function(e){
        e.preventDefault();

        $('#datetimeftsubmissionend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for FasTrack Disclosure was clicked
    $('#cocdisclosurestart').click(function(e){
        e.preventDefault();

        $('#datetimecocdisclosurestart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for FasTrack Disclosure was clicked
    $('#cocdisclosureend').click(function(e){
        e.preventDefault();

        $('#datetimecocdisclosureend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for FasTrack Disclosure was clicked
    $('#conditionalreviewstart').click(function(e){
        e.preventDefault();

        $('#datetimeconditionalreviewstart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for FasTrack Disclosure was clicked
    $('#conditionalreviewend').click(function(e){
        e.preventDefault();

        $('#datetimeconditionalreviewend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for FasTrack Disclosure was clicked
    $('#closingdisclosurestart').click(function(e){
        e.preventDefault();

        $('#datetimeclosingdisclosurestart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for FasTrack Disclosure was clicked
    $('#closingdisclosureend').click(function(e){
        e.preventDefault();

        $('#datetimeclosingdisclosureend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for FasTrack Disclosure was clicked
    $('#inescrowreviewstart').click(function(e){
        e.preventDefault();

        $('#datetimeinescrowreviewstart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for FasTrack Disclosure was clicked
    $('#inescrowreviewend').click(function(e){
        e.preventDefault();

        $('#datetimeinescrowreviewend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for FasTrack Disclosure was clicked
    $('#preapprovalreviewstart').click(function(e){
        e.preventDefault();

        $('#datetimepreapprovalreviewstart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for FasTrack Disclosure was clicked
    $('#preapprovalreviewend').click(function(e){
        e.preventDefault();

        $('#datetimepreapprovalreviewend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When Start button for FasTrack Disclosure was clicked
    $('#hthsetupstart').click(function(e){
        e.preventDefault();

        $('#datetimehthsetupstart').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!

    //START!!! When End button for FasTrack Disclosure was clicked
    $('#hthsetupend').click(function(e){
        e.preventDefault();

        $('#datetimehthsetupend').val(new Date().addHours(-7).toJSON().slice(0,19));

    });
    //END!!!
    
    $('#editloanbtn').click(function(e){
        
        var form = $(this).closest("form");

        Swal.fire({
            title: 'Are you sure?',
            text: "you want to edit this Loan?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((willEdit) => {
            if (willEdit.isConfirmed) {
                form.submit();
            }
        });

    });

    $('.userdelete').click(function(e){
        e.preventDefault();

        var id = $(this).attr("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "you want to delete this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((willDelete) => {
            if (willDelete) {

                Swal.fire(
                    'Deleted!',
                    'User has been deleted.',
                    'success'
                ).then((confirmdelete) => {
                    if(confirmdelete.isConfirmed){
                        $.ajax({
                            url: '/deleteuser',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            dataType: 'HTML',
                            success: function(response){
                                window.location.reload();
                            }
                        });
                    }
                });
                
            }
        });  
    });

    $('.branchdelete').click(function(e){
        e.preventDefault();

        var id = $(this).attr("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "you want to delete this branch?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Branch has been deleted.',
                    'success'
                ).then((confirmdelete) => {
                    if(confirmdelete){
                        $.ajax({
                            url: '/deletebranch',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            dataType: 'HTML',
                            success: function(response){
                                window.location.reload();
                            }
                        });
                    }
                });
                
            }
        });  
    })

    $('#logout').click(function(e){
        var form = $(this).closest("form");

        form.submit();
    })

    $('.completetask').click(function(e){
        e.preventDefault();

        var id = $(this).attr("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "you want to complete this task?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, complete it!'
        }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/taskcomplete',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'HTML',
                        success: function(){
                            Swal.fire(
                                'Success!',
                                'Task has been completed.',
                                'success'
                            ).then((success) => {
                                if(success.isConfirmed){
                                    window.location.reload();
                                }
                            })
                        }
                    });
                    
                }
            })
    });

    $('.orderoutstatus').change(function(e){
        e.preventDefault();

        var status = $('.orderoutstatus').find(":selected").val();
        var id = $(this).attr("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change this status?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/orderoutchangestatus',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: 'HTML',
                    success: function(){
                        Swal.fire(
                            'Success!',
                            'Status has been changed.',
                            'success'
                        ).then((success) => {
                            if(success.isConfirmed){
                                window.location.reload();
                            }
                        })
                    }
                });
            }
        })
    });
    
    $('.orderoutnameedit').click(function(e){

        var id = $(this).attr("id");

        $.ajax({
            url: '/getorderoutname',
            type: 'POST',
            data: {
                id: id,
            },
            dataType: 'JSON',
            success: function(result){
                $('#orderoutlistedit').val(result.orderoutName);
                $('#orderoutnameID').val(id);
            }
        });
    });
    
    $('.orderoutnamedelete').click(function(e){
        e.preventDefault();

        var id = $(this).attr("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "you want to delete this order out type?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Order out type has been deleted.',
                    'success'
                ).then((confirmdelete) => {
                    if(confirmdelete){
                        $.ajax({
                            url: '/deleteorderouttype',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            dataType: 'HTML',
                            success: function(response){
                                window.location.reload();
                            }
                        });
                    }
                });
                
            }
        });  
    })

    $('.tasknameedit').click(function(e){

        var id = $(this).attr("id");

        $.ajax({
            url: '/gettaskname',
            type: 'POST',
            data: {
                id: id,
            },
            dataType: 'JSON',
            success: function(result){
                $('#tasklistedit').val(result.taskName);
                $('#tasklistId').val(id);
            }
        });
    });

    $('.tasknamedelete').click(function(e){
        e.preventDefault();

        var id = $(this).attr("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "you want to delete this task type?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Task type has been deleted.',
                    'success'
                ).then((confirmdelete) => {
                    if(confirmdelete){
                        $.ajax({
                            url: '/deletetasktype',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            dataType: 'HTML',
                            success: function(response){
                                window.location.reload();
                            }
                        });
                    }
                });
                
            }
        });  
    })

    $('.deleteloan').click(function(e){

        var id = $(this).attr("id");
        
        Swal.fire({
            title: 'Are you sure?',
            text: "you want to delete this loan?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Loan has been deleted.',
                    'success'
                ).then((confirmdelete) => {
                    if(confirmdelete){
                        $.ajax({
                            url: '/deleteloan',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            dataType: 'HTML',
                            success: function(response){
                                window.location.reload();
                            }
                        });
                    }
                });
                
            }
        })
    })

   $('.filterstatus').change(function(e){

        var form = $(this).closest("form");

        form.submit();
   })

    

</script>