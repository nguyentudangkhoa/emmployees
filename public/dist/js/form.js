$(document).ready(function(){
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
                        note:formData.get('note'),
                        _token:_token
                    },
                success:function(data){
                    alert(data);
                }
        });
    });

});
