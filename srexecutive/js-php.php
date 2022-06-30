  <script type="text/javascript">
    var id=2;
    $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field'); //Input field wrapper

    var x = 1; 
    
    $(addButton).click(function(){

      var inb='<div class="col-lg-5" id="f1'+id+'"><label for="recipient-name" class="col-form-label">Branch Name</label><input type="text" class="form-control rounded-corner" id="B'+id+'" name="BArray[]"></div>'

      var fieldHTML = inb+'<div class="col-lg-5" id="f2'+id+'"><label for="recipient-name" class="col-form-label">Select District</label><select id="D'+id+'" name="DArray[]" class="form-control rounded-corner" required> <option value="">Select</option><?php
      $Data="SELECT * from cyrusbackend.districts order by District";
      $result=mysqli_query($con,$Data);
      if (mysqli_num_rows($result)>0)
      {
        while ($arr=mysqli_fetch_assoc($result))
        {
          ?>
          <option value="<?php echo $arr['District']; ?>"><?php echo $arr['District']; ?></option> <?php
        }
      }?></select></div><div class="col-lg-2" style="margin-top:55px;" id="f3'+id+'"><button class="btn btn-danger remove_button" onclick="javascript:void(0);" id="'+id+'"> Remove</button></div>';


      if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
            id++;
          }
        });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
      e.preventDefault();
      var idf=$(this).attr("id");
      console.log(idf);
      $('#'+'f1'+idf).remove();
      $('#'+'f2'+idf).remove();
      $('#'+'f3'+idf).remove();
      x--;
      id--;
    });
  });
</script>