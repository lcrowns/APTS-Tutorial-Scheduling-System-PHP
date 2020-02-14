 $('#addtopicform').on('submit', function(event){  
      event.preventDefault(); 
          
      $.ajax({  
        url:'addtopic.php',  
        method:"POST",  
        data:$('#addtopicform').serialize(),  
       
        success:function(data){  
          $('#addtopicform')[0].reset();  
          $('#addtopicbtn').modal('hide');  
          $('#topictbl').html(data);
      }
      });  
   });
