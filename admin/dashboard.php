<?php
  include "includes/header.php";
  include "includes/connect.php";
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
            <a href="dashboard.php" class="nav-link text-white p-3 bg-darker- bg-blue-700">Dashboard</a>
          </li>

          <li class="list">
            <a href="addstd.php" class="nav-link text-white p-3 bg-darker-h">Add Student</a>
          </li>

          <li class="list">
            <a href="logout.php" class="nav-link text-white p-3 bg-red-500 hover:bg-red-400">Logout</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="overflow-y-scroll p-3">
      <input type="text" class="w-full p-3 text-md ounded-0 text-black" id="src" placeholder="Matric N0 or Receipt ID">
      <table class="bg-dark mt-0 text-center md:w-full tbl" id="tbl-resp">
        <tr>
          <th class="p-2 border-r-dark">SN</th>
          <th class="p-2 border-r-dark">MATRIC N0</th>
          <th class="p-2 border-r-dark">LEVEL</th>
          <th class="p-2 border-r-dark">Full Name</th>
          <th class="p-2 w-" colspan="2">Status</th>
        </tr>
        <tbody id="tbl-body">
        <tr>
          <?php
              $select = "SELECT * FROM  students";
              $query = mysqli_query($con, $select);
              $i = 0;
              while ($row = mysqli_fetch_array($query)) {
                $i++;
          ?>
            <td class="border-r-dark border-t-dark p-2"><?=$i?></td>
            <td class="border-r-dark border-t-dark p-2"><?=$row["matric"]?></td>
            <td class="border-r-dark border-t-dark p-2"><?=$row["level"]?></td>
            <td class="border-r-dark border-t-dark p-2"><?=$row["surname"]?> &nbsp; <?=$row["lastname"]?></td>
              <?php
                if ($row["status1"] == 1) {
                  echo '<td class="border-r-dark border-t-dark bg-blue-500 p-2">Paid</td>';
                }else {
                  echo '<td class="border-r-dark border-t-dark p-2 bg-yellow-500"> Not Paid </td>';
                }
                if ($row["status2"] == 1) {
                  echo '<td class="border-r-dark border-t-dark bg-blue-500 p-2">Paid</td>';
                }else {
                  echo '<td class="border-r-dark border-t-dark p-2 bg-yellow-500"> Not Paid </td>';
                }
              ?>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  document.querySelector("#src").addEventListener("keyup", function () {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if (xml.readyState == 4 && xml.status == 200) {
        document.querySelector("#tbl-resp").innerHTML = xml.responseText
      }
    }
    xml.open("GET", "search.php?txt="+document.querySelector("#src").value, true);
    xml.send()
  })
</script>
<?php
  include "includes/footer.php";
?>