<?php
  include "includes/header.php";
  include "includes/connect.php";
  session_start();
?>
<!-- md:top-60 md:absolute -->
  <div class="w-full flex justify-center">

      <div class="form relative md:top-80 bottom-14 lg:w-5/12 md:w-8/12 w-11/12">
        <div class="form-body p-3 bg-dark shadow-md">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
              include "includes/validate.php";
              if (empty($matric_err) && empty($name_err)) {
                $select = "SELECT * FROM students WHERE matric = '".$matric[0]."' AND surname = '".$name[0]."'";
                $query = mysqli_query($con, $select);
                if ($query) {
                  if (mysqli_num_rows($query) == 1) {
                    $row = mysqli_fetch_array($query);
                    $_SESSION["level"] = $row["level"];
                    $_SESSION["matric"] = $matric[0];
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
                Student
              </div>
            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Matric: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($matric_err[0])) {
                    echo $matric_err[0];
                  }
                ?>
              </label>
            <input type="text" name="matric[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
            value="<?php
                if (isset($matric[0])) {
                  echo $matric[0];
                }
              ?>"
            >

            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Surname: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($name_err[0])) {
                    echo $name_err[0];
                  }
                ?>
              </label>
            <input type="text" name="name[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
            value="<?php
                if (isset($name[0])) {
                  echo $name[0];
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