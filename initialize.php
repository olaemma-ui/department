<?php
include "includes/connect.php";
// include "includes/session.php";
  session_start();
function receiptID () {
  $u = array_merge(range('A', 'Z'));
  $l = array_merge(range('a', 'z'));
  $bool = true;
  while ($bool) {

    $len = 10;
    $uid = "NCS-";
    for ($i=0; $i < $len; $i++) {
      $rand = mt_rand(0, 25);
      $uid = $uid.$u[$rand];
      $rand = mt_rand(0, 25);
      $uid = $uid.$l[$i];
    }

    $file = fopen("stdID.NCS", "a+");
    while (!feof($file)) {
      $prev = fgets($file);
      if (!$prev == $uid) {
        $bool=!$bool;
        fwrite($file, $uid."\n");
      }
    }

    fclose($file);
  }
  return $uid;
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "includes/validate.php";

    if (empty($lev_err) && empty($email_err)) {
      $bool = false;
      ?>
      <script>
        function payWithPaystack(){
          var handler = PaystackPop.setup({
            key: 'pk_test_d3871f9d673ad989528033c2fc1bf93b6b98fca8',
            email: '<?=$email[0]?>',
            amount: 10000,
            metadata: {
              custom_fields: [
                  {
                      display_name: "Matic Number",
                      variable_name: "matic_number",
                      value: "<?=$_SESSION['matric']?>"
                  }
              ]
            },
            callback: function(response){
                <?php
                  $insert = "INSERT INTO payed VALUES('', '100', now(), '".$_SESSION['matric']."', '".receiptID()."', '".$lev."', '".$email[0]."')";
                  $query = mysqli_query($con, $insert);
                  if ($query) {
                    $stat = "";
                    if ($lev == 'ND 1' || $lev == 'HND 1') {
                      $stat = "status1";
                    }
                    else if ($lev == 'ND 2' || $lev == 'HND 2') {
                      $stat = "status2";
                    }
                    $update = "UPDATE students SET ".$stat." = '1' WHERE matric = '".$_SESSION['matric']."'";
                    $query = mysqli_query($con, $update);
                    ?>
                      alert('Transaction Successful <?=$stat?>');
                    <?php
                  }
                ?>
            },
            onClose: function(){
                alert('window closed');
            }
          });
          handler.openIframe();
        }
      </script>
      <?php
    }else {
      echo "Invalid/Incomplete Details";
    }
  }
?>