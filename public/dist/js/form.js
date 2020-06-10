$(document).ready(function(){
    //edit user
    $('#form_settings').submit(function(e){
        e.preventDefault();
        // var name = $('#inputName').val();
        // var email = $('#inputEmail').val();
        // var address = $('#inputAddress').val();
        // var identity_card = $('#inputIDCard').val();
        // var issue_place = $('#inputIssuePlace').val();
        // var issue_date = $('#inputIssueDate').val();
        // var university = $('#inputUniversity').val();
        // var university = $('#inputGrandudateYear').val();
        var date = new Date($('#inputStartJobAt').val());
        var start_job_at = date.getFullYear()
                        +'-'+ (date.getMonth()<10?0:'')+(date.getMonth()+1)
                        +'-'+(date.getDate()<10?0:'')+date.getDate()
                        +' '+date.getHours()+':'+date.getMinutes()+':'
                        +date.getSeconds();
        // alert(start_job_at.toString());
        var formData= new FormData(this);
        formData.append('note',$('#inputNote').val())
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url:"edit-user",
                method:"POST",
                data:{  id_member:formData.get('id_member'),
                        name:formData.get('name'),
                        email:formData.get('email'),
                        address:formData.get('address'),
                        identity_card:formData.get('identity_card'),
                        issue_place:formData.get('issue_place'),
                        issue_date:formData.get('issue_date'),
                        university:formData.get('university'),
                        granduate_year:formData.get('granduate_year'),
                        start_job_at:start_job_at,
                        birthday:formData.get('birthday'),
                        gender:formData.get('gender'),
                        note:formData.get('note'),
                        _token:_token
                    },
                success:function(data){
                    alert(data);
                    $('#master-name').text(formData.get('name'));
                    $('#txtUser-name').text(formData.get('name'));
                    $('#txtGender').text(formData.get('gender'));
                    $('#txtAddress').text(formData.get('address'));
                    $('#txtUniversity').text(formData.get('university'));
                    $('#txtGranduate-year').text(formData.get('granduate_year'));
                    $('#txtId-card').text(formData.get('identity_card'));
                    $('#txtIssue-date').text(formData.get('issue_date'));
                    $('#txtIssue-place').text(formData.get('issue_place'));
                    $('#txtBirthday').text(formData.get('birthday'));
                    $('#txtNote').text(formData.get('note'));

                }
        });
    });
    //toggle change avatar
    $('#toggle-btn').click(function(){
        $('.form-avatar').toggle('slow');
        var $this = $(this);
        $this.toggleClass('toggel-btn-ready');
        if($this.hasClass('toggel-btn-ready')){
            $this.text('Change Avatar');
        } else {
            $this.text('Cancel');
        }
    });
    //make change avatar
    $('#exampleInputFile').change(function(e){
        var fileName = e.target.files[0].name;
        $('#label-img').text(fileName);
    });
    //sending letter leave of absence
    $('#setting-letter').submit(function(e){
        e.preventDefault();
        var formData= new FormData(this);
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url:"create-letter",
                method:"POST",
                data:{  id_member:formData.get('id_member'),
                        from_date:formData.get('from_date'),
                        to_date:formData.get('to_date'),
                        reason:formData.get('reason'),
                        _token:_token
                    },
                success:function(data){
                    alert(data);
                }
        });
    });
    //add data to approve form
    $('.approve').click(function(e){
        e.preventDefault()
        var id = $(this).data('id');
        $('#confirm_approve').data('id_letter',id);
    });
    //add data to dissaprove form
    $('.dissapprove').click(function(e){
        e.preventDefault()
        var id = $(this).data('id');
        $('#saveChange').data('id',id);
    });
    //Confirm reason dissapprove
    $('#saveChange').click(function(e){
        e.preventDefault()
        var id = $(this).data('id');
        var reason = $('#inputReason').val();
        var _token = $(this).data('token');
        $.ajax({
            url:$(this).data('urf'),
            method:"POST",
            data:{
                id_letter:id,
                reason:reason,
                _token:_token
            },
            success:function(data){
                alert(data);
                $('.tr-'+id).text('reject');
                $('.tr-reason-'+id).text(reason);
                $('#approve-'+id).attr('disabled','disabled');
                $('#dissapprove-'+id).attr('disabled','disabled');
            }
        });
    });
    //confirm approve
    $('#confirm_approve').click(function(){
        var id = $(this).data('id_letter');
        var _token = $(this).data('token');
        $.ajax({
            url:$(this).data('urf'),
            method:"POST",
            data:{
                id_letter:id,
                _token:_token
            },
            success:function(data){
                alert(data);
                $('.tr-'+id).text('aprroved');
                $('#approve-'+id).attr('disabled','disabled');
                $('#dissapprove-'+id).attr('disabled','disabled');
            }
        });
    });
    var array = [];
    $.ajax({
        url: 'get-data',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            var data = JSON.parse(response);
            var x;
            for (i = 0; i < data.length; i += 1)
            {
                array[i] = data[i];
            }
        }
    });
    $('#show_data').click(()=>{
        console.log(array);
    });
});
