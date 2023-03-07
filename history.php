<?php 
    include('navbar.php');
?>

<div class="container1 my-4">
  <h2 style="text-align: center; color: #000; margin-bottom: 20px !important; font-weight: bold;">Transaction History
  </h2>
  <hr>

  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">S.No.</th>
        <th scope="col">Sender</th>
        <th scope="col">Receiver</th>
        <th scope="col">Amount</th>
        <th scope="col">Date & Time</th>
      </tr>
    </thead>
    <?php 
      include 'config.php';
      $sql = "SELECT * FROM transaction";
      $result = mysqli_query($conn,$sql);
      while($rows=mysqli_fetch_assoc($result)){
      ?>
    <tbody>
      <tr>
        <td class="py-2"><?php echo $rows['sno']; ?></td>
        <td class="py-2"><?php echo $rows['sender']; ?></td>
        <td class="py-2"><?php echo $rows['receiver']; ?></td>
        <td class="py-2"><?php echo $rows['amount']; ?></td>
        <td class="py-2"><?php echo $rows['datetime']; ?></td>
      </tr>
      <?php
      }
    ?>
    </tbody>
  </table>
</div>

<?php include('footer.php') ?>

</body>
</html>