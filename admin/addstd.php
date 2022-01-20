<?php
  session_start();
  include "includes/header.php";
  include "includes/connect.php";
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
            <a href="payment.php" class="nav-link text-white p-3 bg-blue-700">Add Student</a>
          </li>

          <li class="list">
            <a href="logout.php" class="nav-link text-white p-3 bg-red-500 hover:bg-red-400">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  <div class="w-full flex justify-center">

      <div class="form mt-3 lg:w-5/12 md:w-8/12 w-11/12">
        <div class="form-body p-3 bg-dark shadow-md">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
              include "includes/validate.php";
              if (empty($matric_err) && empty($name_err) && empty($lev_err)) {
                $insert = "INSERT INTO students VALUES('', '".$matric[0]."', '".$lev."', '".$name[0]."', '".$name[1]."', '0', '0')";
                $query = mysqli_query($con, $insert);
                if ($query) {
                  ?>
                    <div class="alert mb-5 md:mt-0 p-3 bg-green-700 rounded text-white shadow-md">
                      Student Added
                    </div>
                  <?php
                }
                else {
                  ?>
                  <div class="alert mb-5 md:mt-0 p-3 bg-red-500 rounded text-white shadow-md">
                    Duplicate Matic N0
                  </div>
                <?php
                }
              }
            }
          ?>
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="form">
              <div class="txt text-white text-center md:text-3xl text-xl mb-8 border-b-dark pb-4">
                Add Student
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
            <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Lastname: </span>
            <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($name_err[1])) {
                    echo $name_err[1];
                  }
                ?>
              </label>
            <input type="text" name="name[]" class="txt p-1 text-blue-400 w-full bg-darker h-14 border-b-dark"
            value="<?php
                if (isset($name[1])) {
                  echo $name[1];
                }
              ?>"
              >

              <span class="md:inline block md:text-sm txt mb-2 mt-3" style="color: gray;">Level: </span>
              <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($lev_err)) {
                    echo $lev_err;
                  }
                ?>
              </label>
              <select name="lev" id="lev" class="txt p-1 text-blue-400 mb-4 w-full bg-darker h-14 border-b-dark">
                <option class="text-xl" value="">
                  <option value="ND" class="text-sm">ND </option>
                  <option value="HND" class="text-sm">HND</option>
              </select>
            <button class="btn bg-green-800 text-md text-white p-3 mt-3" name="add" id="add">
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