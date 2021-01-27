<?php include 'db_connect.php' ?>
<div class="container-fluid">
	<div class="row">
        <div class="col-12 col-lg-12 p-3 p-md-5"></div>
        <div class="col-12 col-lg-12 p-3 p-md-5 text-center">
		<h1>Axcora Cashier Apps</h1>
		<p class="lead">
		Free and open source code project for help your bussiness.
		</p>
		<p class="lead">
		
Donation
<br/>
make a contribution by sharing our application with the world through your social media or voluntary donations to our account so we can give the best for you again.
<br/>
Donate Now using moneygram or western union send money to we local bank account.

<br/>BANK CENTRAL ASIA
<br/>ACCOUNT NO : 0181884109
<br/>ACCOUNT NAME : SUCI CHANIFAH
<br/>IBAN/SWIFT CODE : CENAIDJA
</p>
            </div>

    </div>
</div>
<script>
	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }
</script>