<?php include '../admin_nav.php';?>


<?php

include '../../includes/db_connect.php';
$qry = "select * from comments where is_approve = '0' order by created_at desc";
$result = $con->query($qry);
include '../../includes/db_close.php';

?>



<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl mt-12 font-bold text-[#061638]">Pending Comments</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />
    <div class="my-8">
      <table  id="myTable" class="display">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Action</th>
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
              <td><?php echo $row['username'] ;?></td>
              <td><?php echo $row['email'] ;?></td>
              <td><?php echo $row['comment'] ;?></td>
              <td class="flex gap-2">
                <form action="approvestatus.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $row['id'] ;?>">
                  <button type="submit" name="approve" class="bg-blue-600 hover:bg-blue-800 text-white text-lg cursor-pointer font-semibold px-4 py-2 rounded-lg"><i class="fas fa-check"></i></button>
                </form>
                <a class="bg-red-600 hover:bg-red-800 text-white rounded-lg px-4 py-2 cursor-pointer text-lg font-semibold delete" id="<?php echo $row['id'] ?>"><i class="far fa-times"></i></a>
              </td>
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

<script>
   $(document).ready(function(){
        $('.delete').click(function(){
            $(document).ready(function(){

                $(document).on('click', '.delete', function(){
                    var id = $(this).data('id');
                    swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                    }).then((result) => {
                        if (result.value){
                            $.ajax({
                                url: 'delete.php',
                                type: 'POST',
                                data: {'id' : this.id },
                                dataType: 'json'
                            })
                            .done(function(response){
                                swal.fire('Deleted!', response.message, response.status);
                                setTimeout(function(){location.href="pending.php"} , 2000);
                            })
                            .fail(function(){
                                swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                            });
                        }
                    })
                });
            });
        });
    });
</script>



<?php include '../admin_footer.php';?>