<?php
  include "includes/connect.php";
  include "includes/header.php";
?>
<!-- md:top-60 md:absolute -->
  <div class="w-full flex justify-center">

      <div class="form relative md:top-80 bottom-14 lg:w-5/12 md:w-8/12 w-11/12">
        <div class="form-body p-3 bg-dark shadow-md">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
              include "includes/validate.php";
              if (empty($uname_err) && empty($psw_err)) {
                $select = "SELECT * FROM admin WHERE username = '".$uname[0]."' AND password = '".$psw[0]."'";
                $query = mysqli_query($con, $select);
                if ($query) {
                  if (mysqli_num_rows($query) == 1) {
                    $_SESSION["username"] = $uname[0];
                    $_SESSION["password"] = $psw[0];
                    header("location: dashboard.php");
                  }
                  else {
                    ?>
                      <div class="alert mb-5 md:mt-0 p-3 bg-red-500 rounded text-white shadow-md">
                        Invalid details
                      </div>
                  <?php
                  }
                }
              }
            }
          ?>
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
              <div class="txt text-white text-center md:text-3xl text-xl mb-8 border-b-dark pb-4">
                Admin
              </div>
            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Username: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($uname_err[0])) {
                    echo $uname_err[0];
                  }
                ?>
              </label>
            <input type="text" name="uname[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark mb-3"
            value="<?php
                if (isset($uname[0])) {
                  echo $uname[0];
                }
              ?>"
            >

            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Password: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($psw_err[0])) {
                    echo $psw_err[0];
                  }
                ?>
              </label>
            <input type="password" name="psw[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
            value="<?php
                if (isset($psw[0])) {
                  echo $psw[0];
                }
              ?>"
              >
            <button class="btn bg-green-800 text-white p-3 mt-3" name="login">
              Login <i class="far fa-user-circle"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
  include "includes/footer.php";
?>