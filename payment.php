<?php
  include "includes/header.php";
  session_start();
?>
<div class="flex flex-col justify-center" style="align-items: center;">
  <div class="content absolute md:top-80 top-36 h-screen xl:w-9/12 md:w-11/12 w-11/12  bg-darker shadow-xl">
    <div class="navbar flex justify-between flex-wrap border-b-dark overflow-y-auto" style="align-items: center;">
      <div class="logo text-white p-3 md:text-2xl">
        NACOS
      </div>
      <div class="links p-3 md:visible md:relative invisible absolute">
        <ul class="navs flex">
          <li class="list">
            <a href="dashboard.php" class="nav-link text-white p-3 bg-darker-h">Dashboard</a>
          </li>

          <li class="list">
            <a href="payment.php" class="nav-link text-white p-3 bg-darker-h">Payment</a>
          </li>

          <li class="list">
            <a href="logout.php" class="nav-link text-white p-3 bg-red-500 hover:bg-red-400">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  <div class="w-full flex justify-center">

      <div class="form mt-3 lg:w-5/12 md:w-8/12 w-11/12">
        <div class="alert text-red-500 text-md" id="alert"></div>
        <div class="form-body p-3 bg-dark shadow-md">

          <form action="" method="POST" id="form">

              <div class="txt text-white text-center md:text-3xl text-xl mb-8 border-b-dark pb-4">
                Fee Payment
              </div>
            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">E-mail: </span>

            <input type="text" name="email[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark" value="">
            <label for="user" class="text-md mt-5 block">
              <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">level: </span>

            </label>
              <select name="lev" id="lev" class="txt p-1 text-blue-400 mb-4 w-full bg-darker h-14 border-b-dark">
                <option class="text-xl" value=""></option>
                  <?php

                    if ($_SESSION["level"] == "ND") {
                      ?>
                        <option value="ND 1" class="text-sm">ND 1</option>
                        <option value="ND 2" class="text-sm">ND 2</option>
                      <?php
                    }else if($_SESSION["level"] == "HND"){
                      ?>
                        <option value="HND 1" class="text-sm">HND 1</option>
                        <option value="HND 2" class="text-sm">HND 2</option>
                      <?php
                    }
                  ?>
              </select>
            <button class="btn bg-green-800 text-md text-white p-3 mt-3" name="pay" id="pay">
              Pay <i class="far fa-user-circle"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
  include "includes/footer.php";
?>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
  document.querySelector("#pay").addEventListener("click", function (e) {
    e.preventDefault();

    var form = new FormData(document.querySelector("#form"));
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if(xml.readyState == 4 && xml.status == 200){
        if (this.responseText != "Invalid/Incomplete Details") {
          payWithPaystack()
        }
      }
    }
    xml.open("POST", "initialize.php", true);
    xml.send(form);
  });
</script>
<script>
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_test_d3871f9d673ad989528033c2fc1bf93b6b98fca8',
      email: 'customer@email.com',
      amount: 10000,
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
          alert('success. transaction ref is ' + response.reference);
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
</script>