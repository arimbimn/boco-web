<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bocorocco</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: tahoma;
      color: #333;
    }

    body {
      background: url('<?= base_url() ?>/assets/under-construction.png') no-repeat top center;
      width: 100vw;
      height: 100vh;
      background-size: cover;
    }

    div.center {
      position: fixed;
      top: 50%;
      left: 50%;
      width: 500px;
      margin: auto;
      transform: translate(-50%, -50%);
      text-align: center;
    }

    .logo {
      width: 350px;
      margin-bottom: 20px;
    }

    .countdown {
      margin-top: 10px;
    }

    .countdown p {
      font-size: 30px;
      font-weight: bold;
    }

    .countdown p span {
      font-size: 14px;
      font-weight: normal;
      margin-left: 5px;
      border-top: solid 3px black;
    }

    @media only screen and (max-width: 700px) {
      .logo {
        width: 300px;
      }

      div.center {
        font-size: .9em;
      }

      div.countdown p {
        font-size: 25px;
      }

      .countdown p span {
        font-size: 12px;
        border-top: solid 2px black;
      }
    }

    @media only screen and (max-width: 500px) {
      .logo {
        width: 200px;
      }

      div.center {
        width: 90%;
        font-size: .75em;
      }

      div.countdown p {
        font-size: 19px;
      }

      .countdown p span {
        font-size: 10px;
        margin-left: 3px;
        border-top: solid 2px black;
      }

    }

    @media only screen and (max-width: 300px) {
      .logo {
        width: 170px;
      }
    }
  </style>
</head>

<body>
  <div class="center">
    <img src="<?= base_url('assets/images/icon/logo.png') ?>" width="200"><br><br>
    <h1>Sorry for Your Inconvenience.</h1>
    <h3 style="font-weight: normal; margin-top: 20px;">Our website is currently under construction</h3>
    <!-- <div class="countdown" id="kotak">
      <p id="demo"></p>
    </div> -->
  </div>
  <script>
    // Set the date we're counting down to
    var countDownDate = new Date("August 16, 2021 08:00:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get todays date and time
      var now = new Date().getTime();

      // Find the distance between now an the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = days + "<span>days</span> " + hours + "<span>hours</span> " +
        minutes + "<span>mins</span> " + seconds + "<span>secs</span> ";

      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
        document.getElementById("kotak").style.display = "none";
        //        window.location = "http://www.visualtv.live/live.html";
      }
    }, 1000);
  </script>
</body>

</html>