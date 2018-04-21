<?php

    require_once('../../controller/fachada.php');
    $fachada = Fachada::getInstance();

    $array = $fachada->cargoPesquisar();


    if (isset($_POST["tombol"]))
    {
        echo "<pre>";
        //print_r($_POST);
        echo "</pre>";
        
        $detail = $_POST["item"];
        
        $items = array();
        
        for ($i = 0; $i < sizeof($detail['code']); $i++) {
                array_push($items, array(
                    "Codigo da vaga" => 'teste',
                    "Codigo do item" => $detail['code'][$i],
                    "Tipo do item" => $detail['qty'][$i]
                ));
        }
        echo "<pre>";
        print_r($items);
        echo "</pre>";
        
    }
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <h2>Cadastro de vaga</h2>
    <table width ="50%">
        <tr>
            <th><select >
                    <option>Selecione o cargo ao qual é destinado a vaga</option>
                    <?php 

                        foreach ($array as $key => $value) {
                            if ($key == 'sucess'){
                                $array2 = $value;
                                foreach ($array2 as $key => $value) { 
                                    $array3 = $value;
                                    foreach ($array3 as $key => $value) {
                    ?>
                                        <option value="<?php echo $array3->cd_cargo; ?>"> <?php echo $array3->ds_cargo; ?></option>

                    <?php         
                                    }
                                }
                            }
                        }




                    ?>
                </select></th>

            <th><textarea placeholder="Descrição da vaga" type="text" class="span1" name="itemcode" id="itemcode"></textarea></th>
            <th><input placeholder="Tipo de contratação" type="text" class="span3" name="itemname" id="itemname"/></th>
            <th><input placeholder="Beneficios" type="text" class="span2" name="itemprice" id="itemprice"/></th>
            <th><input placeholder="Data Inicio" type="text" class="span2" name="itemqty" id="itemqty"/></th>
            
            <th>Action</th>
        </tr>
        <tbody id="itemlist">
        </tbody>
    </table>
    <input type="submit" name="tombol" value="Save"/>
</form>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
<script type="text/javascript">
    $('#itemqty').on('keypress', function(e) {
        if(e.keyCode==13){
            $('#itemcode').focus();
        }
    });
    $('#itemname').on('keypress', function(e) {
        if(e.keyCode==13){
            $('#itemprice').focus();
        }
    });
    $('#itemprice').on('keypress', function(e) {
        if(e.keyCode==13){
            $('#itemqty').focus();
        }
    });
    function clear (){
        $("#itemcode").val("");
        $("#itemname").val("");
        $("#itemprice").val("");
        $("#itemqty").val("");
    }
     $("tbody#itemlist").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });
    $('#itemqty').on('keypress', function(e) {
        if(e.keyCode==13){
            e.preventDefault();
            var itemcode = $("#itemcode").val();
            var itemname = $("#itemname").val();
            var itemprice = $("#itemprice").val();
            var itemqty = $("#itemqty").val();
            var items = "";
            items += "<tr>";
            items += "<td><input type='hidden' name='item[code][]' value='"+ itemcode +"'>"+itemcode+"</td>";
            items += "<td>"+ itemname +"</td>";
            items += "<td><input type='hidden' class='span2' name='item[price][]' value='"+ itemprice +"'>"+ itemprice +"</td>";
            items += "<td><input type='hidden' class='span2' name='item[qty][]' value='"+ itemqty +"'>"+ itemqty +"</td>";
            items += "<td><a href='javascript:void(0);' id='hapus'>Remove</a></td>";
            items += "</tr>";
        
            if ($("tbody#itemlist tr").length == 0)
            {
                $("#itemlist").append(items);
                clear();
            }else{
                var callback = checkList(itemcode);
                if(callback === true){
                    $("#itemlist").append(items);
                    clear();
                    return false;
                }
            }
        }
    });
    function checkList(val){
        var cb = true;
        console.log($(itemcode).val());
    
        $("#itemlist tr").each(function(index){
            var input = $(this).find("input[type='hidden']:first");
            if (input.val() == $(itemcode).val()){
                cb = false;
            }
        });
        return cb;
    }
   
</script>