<?php include '../admin_nav.php';?>

<?php

include '../../includes/db_connect.php';
$qry = "select * from comments where is_approve = '1' order by updated_at desc";
$result = $con->query($qry);
include '../../includes/db_close.php';

?>



<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl mt-12 font-bold text-[#061638]">Approved Comments</h1>
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
              <td>
                <a class="text-red-600 hover:text-red-800 rounded-lg cursor-pointer text-xl font-bold delete" id="<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></a>
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
                                setTimeout(function(){location.href="approve.php"} , 2000);
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