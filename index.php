<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Pannash Greens Canteen</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="css/index.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

  <body>
              

  <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>

    <div class="mycontainer">
    <section id="mysection">
        
      <section id="section1">
        <div class="myrow">

          <div class="column1">
           
          <div class="content1">
              <h1 class="heading" style="color:red;">Pannash Greens</h1>
              <h2 class="heading">Hungry? Don't have time to stand in queue? </h2>
              <p>Use PannashGreensEats to resolve your hunger and save your precious time.</p>
              <div class="btn-group">
                <a href="customer.php" class="waves-effect waves-light btn btncolor studentlogin">Cafeteria</a>
                <a href="employee.php" class="waves-effect waves-light btn btncolor studentlogin">Employee</a>
              </div>
          </div>

          </div>
        
          <div class="column2">
              <img id="one" src="images/home-img.jpeg" /> 
          </div>
        </div>     

      </section>
    </section>

    <div>&nbsp;</div>

  

    </div>
    
    
    <script>

$('.mycontainer').hide(); // this or use css to hide the div
$('.big').delay(1000).fadeOut('slow');
$('.mycontainer').delay(2000).fadeIn('slow');

var sect1= document.querySelector('#section1'); 
$(document).ready(function(){
  $('.studentlogin').click(function(){
    // $('#section1').css("transform","translate(-1600px,0)");
    $('#mysection').css("transform","translate(0,-675px)");
  });
});



$(document).ready(function () {
            $('.tabs').tabs();
});
     



    </script>

</body>
</html>
<!--  YELLOW #FAA41A  GREY #262626-->
