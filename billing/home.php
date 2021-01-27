<?php include '../db_connect.php' ?>
<?php 
if(isset($_GET['id'])):
$order = $conn->query("SELECT * FROM orders where id = {$_GET['id']}");
foreach($order->fetch_array() as $k => $v){
    $$k= $v;
}
$items = $conn->query("SELECT o.*,p.name FROM order_items o inner join products p on p.id = o.product_id where o.order_id = $id ");
endif;
?>
<div class="container-fluid">
	<div class="row">
	        <div class="col-12 col-lg-12 p-3 p-md-3"></div>
        <div class="col-12 col-lg-6 p-3 p-md-5">
           <div class="card shadow">
                <div class="card-header border-dark">
                    <b>Point of Sale Cashier</b>
                </div>
               <div class="card-body">
            <form action="" id="manage-order">
                <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                <div class="bg-white" id='o-list'>
                           <table class="table" >
                       
                       <thead>
                           <tr>
                               <th>Item</th>
                               <th>Qty</th>
                               <th>Price</th>
                               <th></th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php 
                                if(isset($items)):
                           while($row=$items->fetch_assoc()):
                           ?>
                           <tr>
                               <td>
                                         <span class="btn btn-sm btn-danger"><b><i class="fa fa-minus"></i></b></span>
                                        <input type="number" class="col-2 col-md-2" name="qty[]" id="" value="<?php echo $row['qty'] ?>">
                                        <span class="btn btn-sm btn-primary btn-plus"><b><i class="fa fa-plus"></i></b></span>
                                  
                                </td>
                                <td>
                                    <input type="hidden" name="item_id[]" id="" value="<?php echo $row['id'] ?>">
                                    <input type="hidden" name="product_id[]" id="" value="<?php echo $row['product_id'] ?>"><?php echo ucwords($row['name']) ?>
                                    <small class="psmall"> (<?php echo number_format($row['price'],0) ?>)</small>
                                </td>
                                <td class="text-right">
                                    <input type="hidden" name="price[]" id="" value="<?php echo $row['price'] ?>">
                                    <input type="hidden" name="amount[]" id="" value="<?php echo $row['amount'] ?>">
                                    <span class="amount"><?php echo number_format($row['amount'],0) ?></span>
                                </td>
                                <td>
                                    <span class="btn btn-sm btn-danger btn-rem"><b><i class="fa fa-times text-white"></i></b></span>
                                </td>
                           </tr>
                           <script>
                               $(document).ready(function(){
                                 qty_func()
                                    calc()
                                    cat_func();
                               })
                           </script>
                       <?php endwhile; ?>
                       <?php endif; ?>
                       </tbody>
                   </table>
                </div>
                   <div class="d-block bg-white" id="calc">
                       <table class="" width="100%">
                           <tbody>
                                <tr>
                                   <td><b><h4>Total</h4></b></td>
                                   <td class="text-right">
                                       <input type="hidden" name="total_amount" value="0">
                                       <input type="hidden" name="total_tendered" value="0">
                                       <span class=""><h4><b id="total_amount">0.00</b></h4></span>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
           </form>
               </div>
           </div>
        </div>
        <div class="col-12 col-lg-6 p-3 p-md-5">
            <div class="card shadow">
                <div class="card-header">
                    <b>Products</b>
                </div>
                <div class="card-body d-flex" id='prod-list'>
                    <div class="col-md-3 text-center">
                        <div class="" id="cat-list">
                            <div class="card bg-danger mx-3 mb-2 cat-item" style="height:auto !important;" data-id = 'all'>
                                <div class="card-body">
                                    <span><b class="text-white">
                                        All
                                    </b></span>
                                </div>
                            </div>
                            <?php 
                            $qry = $conn->query("SELECT * FROM categories order by name asc");
                            while($row=$qry->fetch_assoc()):
                            ?>
                            <div class="card bg-danger mx-3 mb-2 cat-item" style="height:auto !important;" data-id = '<?php echo $row['id'] ?>'>
                                <div class="card-body">
                                    <span><small><b class="text-white">
                                        <?php echo ucwords($row['name']) ?>
                                    </b></small></span>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="col-md-9 text-center">
                       
                        <div class="row">
                            <?php
                            $prod = $conn->query("SELECT * FROM products where status = 1 order by name asc");
                            while($row=$prod->fetch_assoc()):
                            ?>
                            <div class="col-md-4 mb-2">
                                <div class="card bg-primary prod-item" data-json = '<?php echo json_encode($row) ?>' data-category-id="<?php echo $row['category_id'] ?>">
                                    <div class="card-body">
                                        <span><small><b class="text-white">
                                            <?php echo $row['name'] ?>
                                        </b></small></span>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        </div>
                    </div>   
                </div>
            
            </div>      			
        </div>
    </div>
</div>
<script>
    var total;
    cat_func();
   $('#prod-list .prod-item').click(function(){
        var data = $(this).attr('data-json')
            data = JSON.parse(data)
        if($('#o-list tr[data-id="'+data.id+'"]').length > 0){
            var tr = $('#o-list tr[data-id="'+data.id+'"]')
            var qty = tr.find('[name="qty[]"]').val();
                qty = parseInt(qty) + 1;
                qty = tr.find('[name="qty[]"]').val(qty).trigger('change')
                calc()
            return false;
        }
        var tr = $('<tr class="o-item"></tr>')
        tr.attr('data-id',data.id)
        tr.append('<td><input type="hidden" name="item_id[]" id="" value=""><input type="hidden" name="product_id[]" id="" value="'+data.id+'">'+data.name+' <small class="psmall">('+(parseFloat(data.price).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))+')</small></td>') 
        tr.append('<td><div class="d-flex"><span class="btn btn-sm btn-danger btn-minus"><b><i class="fa fa-minus"></i></b></span><input class="col-2" type="number" name="qty[]" id="" value="1"><span class="btn btn-sm btn-primary btn-plus"><b><i class="fa fa-plus"></i></b></span></div></td>') 
        tr.append('<td class="text-right"><input type="hidden" name="price[]" id="" value="'+data.price+'"><input type="hidden" name="amount[]" id="" value="'+data.price+'"><span class="amount">'+(parseFloat(data.price).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))+'</span></td>') 
        tr.append('<td><span class="btn btn-sm btn-danger btn-rem"><b><i class="fa fa-times text-white"></i></b></span></td>')
        $('#o-list tbody').append(tr)
        qty_func()
        calc()
        cat_func();
   })
    function qty_func(){
         $('#o-list .btn-minus').click(function(){
            var qty = $(this).siblings('input').val()
                qty = qty > 1 ? parseInt(qty) - 1 : 1;
                $(this).siblings('input').val(qty).trigger('change')
                calc()
         })
         $('#o-list .btn-plus').click(function(){
            var qty = $(this).siblings('input').val()
                qty = parseInt(qty) + 1;
                $(this).siblings('input').val(qty).trigger('change')
                calc()
         })
         $('#o-list .btn-rem').click(function(){
            $(this).closest('tr').remove()
            calc()
         })
         
    }
    function calc(){
         $('[name="qty[]"]').each(function(){
            $(this).change(function(){
                var tr = $(this).closest('tr');
                var qty = $(this).val();
                var price = tr.find('[name="price[]"]').val()
                var amount = parseFloat(qty) * parseFloat(price);
                    tr.find('[name="amount[]"]').val(amount)
                    tr.find('.amount').text(parseFloat(amount).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))
                
            })
         })
         var total = 0;
         $('[name="amount[]"]').each(function(){
            total = parseFloat(total) + parseFloat($(this).val()) 
         })
            console.log(total)
        $('[name="total_amount"]').val(total)
        $('#total_amount').text(parseFloat(total).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))
    }
   function cat_func(){
    $('.cat-item').click(function(){
            var id = $(this).attr('data-id')
            console.log(id)
            if(id == 'all'){
                $('.prod-item').parent().toggle(true)
            }else{
                $('.prod-item').each(function(){
                    if($(this).attr('data-category-id') == id){
                        $(this).parent().toggle(true)
                    }else{
                        $(this).parent().toggle(false)
                    }
                })
            }
    })
   }
   $('#save_order').click(function(){
    $('#tendered').val('').trigger('change')
    $('[name="total_tendered"]').val('')
    $('#manage-order').submit()
   })
   $("#pay").click(function(){
    start_load()
    var amount = $('[name="total_amount"]').val()
    if($('#o-list tbody tr').length <= 0){
        alert_toast("Please add atleast 1 product first.",'danger')
        end_load()
        return false;
    }
    $('#apayable').val(parseFloat(amount).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))
    $('#pay_modal').modal('show')
    setTimeout(function(){
        $('#tendered').val('').trigger('change')
        $('#tendered').focus()
        end_load()
    },500)
    
   })
   $('#tendered').keyup('input',function(e){
        if(e.which == 13){
            $('#manage-order').submit();
            return false;
        }
        var tend = $(this).val()
            tend =tend.replace(/,/g,'') 
        $('[name="total_tendered"]').val(tend)
        if(tend == '')
            $(this).val('')
        else
            $(this).val((parseFloat(tend).toLocaleString("en-US")))
        tend = tend > 0 ? tend : 0;
        var amount=$('[name="total_amount"]').val()
        var change = parseFloat(tend) - parseFloat(amount)
        $('#change').val(parseFloat(change).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))
   })
   
    $('#tendered').on('input',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val)
    })
    $('#manage-order').submit(function(e){
        e.preventDefault();
        start_load()
        $.ajax({
            url:'../ajax.php?action=save_order',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp > 0){
                    if($('[name="total_tendered"]').val() > 0){
                        alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            var nw = window.open('../receipt.php?id='+resp,"_blank","width=900,height=600")
                            setTimeout(function(){
                                nw.print()
                                setTimeout(function(){
                                    nw.close()
                                    location.reload()
                                },500)
                            },500)
                        },500)
                    }else{
                        alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            location.reload()
                        },500)
                    }
                }
            }
        })
    })
</script>