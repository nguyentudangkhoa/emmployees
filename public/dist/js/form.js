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

    $('.btn-option-salary').click(function(){
        $('#user_name').attr('value',$(this).data('name'));
        $('#user_id').attr('value',$(this).data('id'));
    });
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    $('#form_add_salary').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var _token = $('input[name="_token"]').val();
        console.log(formData.get('user_id'));

        $.ajax({
            url: "addSalary",
            method:"PUT",
            data:{
                id:formData.get('user_id'),
                name:formData.get('name'),
                salary:formData.get('salary'),
                _token:_token
            },
            success:function(data){
                alert(data);
                $('#p'+formData.get('user_id')).text(formatNumber($('#user-salary').val())+' VND');
            }
        });
    });
    $('#form-overtime').submit(function(e){
        e.preventDefault();
        var formData= new FormData(this);
        var nameEm = $('#inputNameEm').children('option:selected').data('id');
        var _token = $('input[name="_token"]').val();
        // ajax function
        $.ajax({
            url: "AddOverTime",
            method:"POST",
            data:{
                mem_id:nameEm,
                date_ot:formData.get('date_overtime'),
                from_time:formData.get('from_hour'),
                to_time:formData.get('to_hour'),
                place_ot:formData.get('place_ot'),
                task_name:formData.get('task_name'),
                note_ot:formData.get('note_ot'),
                _token:_token
            },
            success:function(data){
                alert(data);
            }
        });
    });
    $('.btn-ot').click(function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var note = $(this).data('note');
        $('#ot_id').val(id);
        $('#em_name').val(name);
        $('#em_note').val(note);
    });
    $('#confirm_ot').click(function(){
        var id_ot = $('#ot_id').val();
        var name_em = $('#em_name').val();
        var note_em = $('#em_note').val();
        var stas_em = $('#em_status').val();

        if(stas_em == null){
            $('#sta_vef').css('display','block');
            $('#sta_vef').text('Please select a status');
        }else if(note_em == ""){
            $('#note_vef').css('display','block');
            $('#note_vef').text("Note can't empty");
        }else{
            $.ajax({
                url: 'UpdateStatusOT',
                method:"PUT",
                data:{
                    id_ot:id_ot,
                    note_em:note_em,
                    stas_em:stas_em,
                    _token:$(this).data('token')
                },
                success:function(data){
                    alert(data);
                    $('#note'+id_ot).text(note_em);
                    $('#status'+id_ot).text(stas_em);
                    $('.btn-ot').data('note',note_em);
                    $('#sta_vef').css('display','none');
                    $('#sta_vef').text('');
                    $('#note_vef').css('display','none');
                    $('#note_vef').text("");
                }
            });
        }

    });
    $('#close_ot').click(function(){
        $('#sta_vef').css('display','none');
        $('#sta_vef').text('');
        $('#note_vef').css('display','none');
        $('#note_vef').text("");
    });
    $('.btnDis').click(function(){
        $('#idlocal').val($(this).data('idloca'));
        console.log($(this).data('idloca'));
    });
    $('#dislocation').click(function(){
        var id_location = $('#idlocal').val();
        var $message = $(this).data('message');
        if(!confirm($message)){
            e.preventDefault();
        }else if(id_location != ""){
            $.ajax({
                url: 'disable-location',
                method:"PUT",
                data:{
                    id_location:id_location,
                    _token:$(this).data('token')
                },
                success:function(data){
                    alert(data);
                    $('#status-location'+id_location).text('Disable');
                    $('#dis-location'+id_location).css('display','none');
                    $('#en-location'+id_location).css('display','block');
                }
            });
        }
    });
    $('.del-house-form').click(function(){
        $('#id_house').val($(this).data('idhouse'));
    });
    $('#del-house').click(function(){
        var id_house = $('#id_house').val();
        var $message = $(this).data('message');
        if(!confirm($message)){
            e.preventDefault();
        }else if(id_house != ""){
            $.ajax({
                url: 'disable-house',
                method:"PUT",
                data:{
                    id_house:id_house,
                    _token:$(this).data('token')
                },
                success:function(data){
                    alert(data);
                    $('#status-house'+id_house).text('Sold');
                    $('#dis-house'+id_house).css('display','none');
                    $('#en-house'+id_house).css('display','block');
                }
            });
        }
    });
    $('.btn-dis-user').click(function(e){
        var id_user = $(this).data('iduser');
        var $message = $(this).data('message');
        if(!confirm($message)){
            e.preventDefault();
        }else if(id_user != ""){
            $.ajax({
                url: 'disable-user',
                method:"PUT",
                data:{
                    id_user:id_user,
                    _token:$(this).data('token')
                },
                success:function(data){
                    alert(data);
                    $('#status-user'+id_user).text('Disable');
                    $('#dis-user'+id_user).css('display','none');
                    $('#en-user'+id_user).css('display','block');
                }
            });
        }
    })
    //enable house
    $('.en-house').click(function(e){
        var id_house = $(this).data('idhouse');
        var $message = $(this).data('message');
        if(!confirm($message)){
            e.preventDefault();
        }else if(id_house != ""){
            $.ajax({
                url: 'enable-house',
                method:"PUT",
                data:{
                    id_house:id_house,
                    _token:$(this).data('token')
                },
                success:function(data){
                    alert(data);
                    $('#status-house'+id_house).text(' ');
                    $('#dis-house'+id_house).css('display','block');
                    $('#en-house'+id_house).css('display','none');
                }
            });
        }
    });
    //enable location
    $('.en-location').click(function(e){
        var id_location = $(this).data('idloca');
        var $message = $(this).data('message');
        if(!confirm($message)){
            e.preventDefault();
        }else if(id_location != ""){
            $.ajax({
                url: 'enable-location',
                method:"PUT",
                data:{
                    id_location:id_location,
                    _token:$(this).data('token')
                },
                success:function(data){
                    alert(data);
                    $('#status-location'+id_location).text(' ');
                    $('#dis-location'+id_location).css('display','block');
                    $('#en-location'+id_location).css('display','none');
                }
            });
        }
    });
    //enable user
    $('.en-user').click(function(e){
        var id_user = $(this).data('idloca');
        var $message = $(this).data('message');
        if(!confirm($message)){
            e.preventDefault();
        }else if(id_user != ""){
            $.ajax({
                url: 'enable-user',
                method:"PUT",
                data:{
                    id_user:id_user,
                    _token:$(this).data('token')
                },
                success:function(data){
                    alert(data);
                    $('#status-user'+id_user).text(' ');
                    $('#dis-user'+id_user).css('display','block');
                    $('#en-user'+id_user).css('display','none');
                }
            });
        }
    });
});
