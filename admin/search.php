<?php
  include "includes/connect.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["txt"] != "") {

          $select = "SELECT * FROM  payed INNER JOIN students on payed.matric = students.matric WHERE students.matric LIKE '%".$_GET["txt"]."%' or payed.receipt_id LIKE '%".$_GET["txt"]."%'";
          $query = mysqli_query($con, $select);
          $i = 0;
          if(mysqli_num_rows($query) != 0){
            ?>
            <tr>
              <th class="p-2 border-r-dark">SN</th>
              <th class="p-2 border-r-dark">RECEIPT ID</th>
              <th class="p-2 border-r-dark">LEVEL</th>
              <th class="p-2 border-r-dark">#AMOUNT</th>
              <th class="p-2 border-r-dark">DATE</th>
              <th class="p-2 w-">ACTION</th>
            </tr>

            <?php
              while ($row = mysqli_fetch_array($query)) {
                $i++;
               ?>
              <tr>
                <td class="border-r-dark border-t-dark p-2"><?=$i?></td>
                <td class="border-r-dark border-t-dark p-2"><?=$row["receipt_id"]?></td>
                <td class="border-r-dark border-t-dark p-2"><?=$row["level"]?></td>
                <td class="border-r-dark border-t-dark p-2"><?=$row["amount"]?></td>
                <td class="border-r-dark border-t-dark p-2"><?=$row["date"]?></td>
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
            <?php }
          }else {
            ?>
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
                  $select = "SELECT * FROM  students WHERE matric LIKE '%".$_GET['txt']."%'";
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
            </tbody>
          <?php }
          }
    }else{
      ?>
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
        </tbody>
      <?php }
    }

  }else header("location: ashboard.php");

?>