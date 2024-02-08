<?php include '../admin_nav.php';?>


<?php

include '../../includes/db_connect.php';
$qry = "select * from messages order by created_at desc";
$result = $con->query($qry);
include '../../includes/db_close.php';

?>



<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl mt-12 font-bold text-[#061638]">Messages</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />
    <div class="my-8">
      <table  id="myTable" class="display">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Message</th>
          </tr>
        </thead>

        <tbody>
          <?php 
            $sn = 1;
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            ?>

            <tr>
              <td><?php echo $sn ;?></td>
              <td><?php echo $row['name'] ;?></td>
              <td><?php echo $row['email'] ;?></td>
              <td><?php echo $row['contact'] ;?></td>
              <td><?php echo $row['message'] ;?></td>
            </tr>

            <?php
              $sn++;
            }
          }
          ?>

        </tbody>
      </table>
    </div>
</div>





<?php include '../admin_footer.php';?>