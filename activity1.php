<?php 
include_once("configActivity.php");

?>


<!DOCTYPE hmtl>
<html lang="en">
  <head>
    <title>Activities</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    />

    <link rel="stylesheet" type="text/css" href="css/activity1.css" /> 
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/tippy.js@6/animations/scale.css"
    />

    <!-- Fonting -->
    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
    <div class="nav-content-wrapper">
      <!-- Navigation bar -->
      <nav class="navbar-expand-lg transitive" id="navbar">
        <!-- Nav Container -->
        <div class="nav-container transitive" id="nav-container">
          <!-- Home brand -->
          <a class="" href="index.html" style="float: left; padding: 0;">
            <img src="" height="30px" alt="" />
            College Activity Registration System
          </a>

          <!-- Menus -->
          <div class="menu" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active px-4">
                <a class="nav-link" href="index.html"
                  >HOME <span class="sr-only">(current)</span></a
                >
              </li>
              <li class="nav-item px-4">
                <a class="nav-link" href="activity.html">ACTIVITIES</a>
              </li>
              <li class="nav-item px-4">
                <a class="nav-link" href="food.html">FOOD</a>
              </li>
              <li class="nav-item px-4">
                <a class="nav-link" href="application.html">ACCOMMODATION</a>
              </li>
              <li class="nav-item px-4" style="margin-right: 64px;">
                <a class="nav-link" href="report.html">REPORT</a>
              </li>
              <!-- two buttons -->
              <li class="nav-item">
                <button
                  type="button"
                  class="btn nav-btn px-4 py-2"
                  style="background-color: #00df89; border-color: #00df89;"
                >
                  CONTACT US
                </button>
              </li>
              <li class="nav-item">
                <button
                  type="button"
                  id="button-log-in"
                  class="btn btn-outline-light nav-btn px-4 py-2"
                >
                  LOGIN
                </button>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <header id="header">
        <h1 class="title-header text-center">College Activities</h1>
      </header>
    </div>

    <main>
      <div id="wrapper">
        <?php 
        $sql = "SELECT * FROM Activity";
        $result = $connectionString->query($sql);
        if ($connectionString->query($sql) === TRUE) {
          echo "true";
        } else {
          echo "Error: " . $sql . "<br>" . $connectionString->error;
        } 
        echo  '<div class="row">';
        while ($a = $result->fetch_array()) {
        $activity_id = $a['Activity_ID'];
        $activity_no = substr($activity_id, 0, 1);
        $activity_name = $a['Activity_Name'];
        $college = $a['College'];
        $reg_date = $a['Reg_Dead'];
        $stat = $a['Status'];
        ?>
          <div class="card-<?php echo $activity_no; ?> fancycard" style="margin: auto;">
            <div class="wrapper">
              <div class="header">
                <div class="countdown">
                  <ul>
                    <li><span class="days"></span>Days</li>
                    <li><span class="hours"></span>Hours</li>
                    <li><span class="minutes"></span>Minutes</li>
                  </ul>
                </div>
                <div class="menu-content">
                  <span class="college"><?php echo $college;?></span>
                </div>
                <div class="menu-status">
                  <span class="status">STATUS</span>
              </div>
        </div>

              <div class="data">
                <div class="content">
                  <h1 class="title">
                    <a href="#"><?php echo $activity_name;?></a>
                  </h1>
                  
                  <a href="#popup-reg" class="button">Register Now!</a>
                  <a href="#popup-cancel" class="button">Cancel Registration</a>
                </div>
              </div>
            </div>
          </div>
        <?php
       }
        ?>
        </div>
      </div>
        
      <div id="popup-reg" class="overlay">
         <form id="msform" method="POST">    
          <ul id="progressbar">
            <li class="active">Register As</li>
            <li>Confirmation</li>
          </ul>
          <a class="close" href="#">x</a>

        <fieldset>
            <h2 class="fs-title">Choose your position</h2>
            <h3 class="fs-subtitle">Please choose your position</h3>
            <label>
              <input type="radio" name="position" value="highcomm" checked/>
              <span>High-Committee</span>
            </label>
            <label>
              <input type="radio" name="position" value="member"/>
              <span>Member</span>
            </label>
            <input type="button" name="next" class="next action-button" value="Next"/>
        </fieldset>

          <fieldset>
            <h2 class="fs-title">Confirmation</h2>
            <h3 class="fs-content">Congratulations! You have registered for Sukan Mahasiswa UM (SUKMUM)</h3>
            <input type="button" name="previous" class="previous action-button" value="Previous"/>
            <input type="submit" name="submit" class="submit action-button" onclick="myFunction()" value="Done" />          </fieldset>
        </form>
      </div>
  
      <div id="popup-cancel" class="overlay">
        <form id="msform" method="POST">
          <ul id="progressbar">
            <li class="active">Cancellation</li>
            <li>Confirmation</li>
          </ul>
          <a class="close" href="#">x</a>

        <fieldset>
            <h2 class="fs-title">Cancellation</h2>
            <h3 class="fs-subtitle">Do you confirm to cancel the registration for this activity?</h3>
            <label>
              <input type="radio" name="cancel" checked/>
              <span>Yes</span>
            </label>
            <label>
              <input type="radio" name="cancel"/>
              <span>No</span>
            </label>
            <input type="button" name="next" class="next action-button" value="Next"/>
        </fieldset>

          <fieldset>
            <h2 class="fs-title">Confirmation</h2>
            <h3 class="fs-content">You have cancelled your registration for Sukan Mahasiswa UM (SUKMUM)</h3>
            <input type="button" name="previous" class="previous action-button" value="Previous"/>
            <input type="submit" name="submit" class="submit action-button" onclick="myFunction()" value="Done" />
          </fieldset>
        </form>
      </div>


      

      

      



    </main>

    <footer>
      <div class="copyright">
        <p>&copy 2020 - Try Guess</p>
      </div>
      <div class="social">
        <a href="#" class="support">Contact Us</a>
        <a href="#" class="face">f</a>
        <a href="#" class="tweet">t</a>
        <a href="#" class="linked">ig</a>
      </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>

    <script>

    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches
    var v;

    $(".next").click(function(){
      if(animating) return false;
      animating = true;

      current_fs = $(this).parent();
      next_fs = $(this).parent().next();
  
      //activate next step on progressbar using the index of next_fs
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
      //show the next fieldset
      next_fs.show(); 
      //hide the current fieldset with style
      current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale current_fs down to 80%
          scale = 1 - (1 - now) * 0.2;
          //2. bring next_fs from the right(50%)
          left = (now * 50)+"%";
          //3. increase opacity of next_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({
            'transform': 'scale('+scale+')',
            'position': 'absolute'
          });
            next_fs.css({'left': left, 'opacity': opacity});
        }, 
        duration: 800, 
        complete: function(){
          current_fs.hide();
          animating = false;
        },
        //this comes from the custom easing plugin
        easeInOutBack: function (t, b, c, d, s) {
        if (s == undefined) s = 1.70158; 
        if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
        return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b; }
      });
    });

  $(".previous").click(function(){
    if(animating) return false;
    animating = true;
  
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
  
    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
  
    //show the previous fieldset
    previous_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
      step: function(now, mx) {
        //as the opacity of current_fs reduces to 0 - stored in "now"
        //1. scale previous_fs from 80% to 100%
        scale = 0.8 + (1 - now) * 0.2;
        //2. take current_fs to the right(50%) - from 0%
        left = ((1-now) * 50)+"%";
        //3. increase opacity of previous_fs to 1 as it moves in
        opacity = 1 - now;
        current_fs.css({'left': left});
        previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
      }, 
      duration: 800, 
      complete: function(){
        current_fs.hide();
        animating = false;
      }, 
      //this comes from the custom easing plugin
      easeInOutBack: function (t, b, c, d, s) {
      if (s == undefined) s = 1.70158; 
      if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
      return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
    }

    });
  });

  //submit position radio
  var form = document.getElementById('msform');
  form.onsubmit = function(e) {
    e.preventDefault();
    console.log(form.position.value);
  };
 



  // //close when click done
  // function myFunction() {
  //   var x = document.getElementById("msform");
  //   if(x.style.display == "none") {
  //     x.style.display = "block"
  //   }
  //   else {
  //     x.style.display = "none";
  //     document.querySelector(".overlay").style.display = "none";
  //   }
  // }

//close when click done
function myFunction() {
    var x = document.getElementById("msform");
    if(x.style.display == "none") {
      x.style.display = "block"
    }
    else {
      x.style.display = "none";
      document.querySelector(".overlay").style.display = "none";
    }
  }
  

 

 







      setCountdown("June 30, 2020 00:00:00", "card-1");
      setCountdown("July 26, 2020 00:00:00", "card-2");
      setCountdown("August 12, 2020 00:00:00", "card-3");
      setCountdown("September 15, 2020 00:00:00", "card-4");

      function setCountdown(date, card) {
        let second = 1000,
          minute = second * 60,
          hour = minute * 60,
          day = hour * 24;

        let countDown = new Date(date).getTime(),
          x = setInterval(function () {
            let now = new Date().getTime(),
              distance = countDown - now;

            (document.querySelector(
              "." + card + ".fancycard .days"
            ).innerText = Math.floor(distance / day)),
              (document.querySelector(
                "." + card + ".fancycard .hours"
              ).innerText = Math.floor((distance % day) / hour)),
              (document.querySelector(
                "." + card + ".fancycard .minutes"
              ).innerText = Math.floor((distance % hour) / minute));

            //do something later when date is reached
            //if (distance < 0) {
            //  clearInterval(x);
            //  'IT'S TODAY!;
            //}
          }, second);
      }

    </script>

  
  </body>
</html> 



