 $(document).on('click', '.Bill', function(){
  //$('#dataModal').modal();
  var BranchCode = $(this).attr("id");
  document.getElementById("branch").value = BranchCode;
  console.log(BranchCode);
  $.ajax({
   url:"Bill.php",
   method:"POST",
   data:{BranchCode:BranchCode},
   success:function(data){
    $('#BillData').html(data);
    $('#Bill').modal('show');
  }
});
});


 $(document).on('click', '.close', function(){


 });



 $(document).on('click', '.SaveReminder', function(){
  var BillID=document.getElementById("billid").value;
  var BranchCode=document.getElementById("branch").value;
  var Conversation=document.getElementById("conversation").value;
  var NextDate=document.getElementById("NextDate").value;
  var actionCheck=document.getElementById("Action");

if (actionCheck.checked == true){
  Action=1;
}else{
  Action=0;
}

  console.log(BranchCode);
  const obj = {BranchCode: BranchCode, BillID: BillID, Description: Conversation, NextReminderDate: NextDate, Action: Action};
  const Data = JSON.stringify(obj);
  console.log(Data);
  if (Conversation=='' || NextDate=='') {
    alert("Please enter all details")
  }else{
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      $.ajax({
       url:"Bill.php",
       method:"POST",
       data:{BranchCode:BranchCode},
       success:function(data){
        $('#BillData').html(data);
        $('#Bill').modal('show');
      }
    });

      document.getElementById("FormReminder").reset();
      document.getElementById("branch").value = BranchCode;

    }
  });
  }
});


 //Modals Script

 var exampleModal = document.getElementById('reminder')
 exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var BillID = button.getAttribute('data-bs-BillID')
  var BillNo = button.getAttribute('data-bs-Billno')
  document.getElementById("billid").value = BillID;
  console.log(BillID);
  var modalTitle = exampleModal.querySelector('.modal-title')

  modalTitle.textContent = 'Bill No. ' + BillNo

})