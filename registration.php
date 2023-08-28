<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link href="styles.css">
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>

<body>
  <div class="container mt-5">
   
  <?php
  if(isset($_GET["id"])){
    $ID=$_GET["id"];
  }
  
  ?>
 <?php require "include/registrationForm.php"?>
 
  </div>
  <style>
    .error{
      color: #FF0000;
    }
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
  </style>
   <script>
   $(document).ready(function() {
    $("#State").on("change", function() {
      var stateName = this.value;
     
      if (stateName != "") {
        $.ajax({
          url: "ajax/ajax.php",
          type: "POST",
          data: {
            "action": 'getCity',
            'state_name': stateName
          },
          success: function(resp) {
            $("#district").html(resp);
          }
        })
      }
    })
  })
</script>
</body>

</html>