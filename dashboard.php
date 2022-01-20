<?php
  include "includes/header.php";
  include "includes/connect.php";
  include "includes/session.php";

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
    <div class="overflow-y-scroll p-3">
      <table class="bg-dark mt-4 text-center md:w-full tbl">
        <tr>
          <th class="p-2 border-r-dark">SN</th>
          <th class="p-2 border-r-dark">RECEIPT ID</th>
          <th class="p-2 border-r-dark">E-MAIL</th>
          <th class="p-2 border-r-dark">LEVEL</th>
          <th class="p-2 border-r-dark">#AMOUNT</th>
          <th class="p-2 border-r-dark">DATE</th>
          <th class="p-2 w-">Status</th>
        </tr>

        <?php
          $select = "SELECT * FROM  payed INNER JOIN students on payed.matric = students.matric WHERE students.matric = '".$_SESSION['matric']."'";
          $query = mysqli_query($con, $select);
          while ($row = mysqli_fetch_array($query)) {
        ?>
          <tr>
            <td class="border-r-dark border-t-dark p-2">1</td>
            <td class="border-r-dark border-t-dark p-2">NCS-55FB6MKO</td>
            <td class="border-r-dark border-t-dark p-2">Student@gmail.com</td>
            <td class="border-r-dark border-t-dark p-2">ND 2</td>
            <td class="border-r-dark border-t-dark p-2">700</td>
            <td class="border-r-dark border-t-dark p-2">09-09-2023</td>
            <td class="border-r-dark border-t-dark p-2 bg-blue-700">Paid</td>
          </tr>
          <?php }
          ?>

      </table>
    </div>
  </div>
</div>

<?php
  include "includes/footer.php";
?>