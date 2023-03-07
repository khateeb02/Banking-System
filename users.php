<?php 
    include 'config.php';
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn,$sql);
?>

<?php 
    include('navbar.php');
?>

<div class="container1  my-4">
  <h2 style="text-align: center; color: #000; margin-bottom: 20px !important; font-weight: bold;">Users
  </h2>
  <hr>
               
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">EMAIL</th>
        <th scope="col">BALANCE</th>
        <th scope="col">OPERATION</th>
      </tr>
    </thead>
    <?php 
      while($rows=mysqli_fetch_assoc($result)){
    ?>
    <tbody>
      <tr>
          <td scope="row"><?php echo $rows['id'] ?></td>
          <td><?php echo $rows['name']?></td>
          <td><?php echo $rows['email']?></td>
          <td><?php echo $rows['balance']?></td>
          <td><a href="transfer.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="btn btn-success">Transact</button></a></td> 
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>

</div>
<br>
  <br>
  <br>
  
<?php include('footer.php') ?>

</body>
</html>