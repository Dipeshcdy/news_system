<?php include '../admin_nav.php';?>

<?php
function limitWords($string, $limit) {
    $words = explode(' ', $string); // Split the string into an array of words
    $limitedWords = array_slice($words, 0, $limit); // Extract the desired number of words
    $limitedString = implode(' ', $limitedWords); // Join the limited words back into a string
    return $limitedString;
}
?>

<?php

include '../../includes/db_connect.php';
$qry = "SELECT news.*,categories.cat_name FROM news INNER JOIN categories ON news.cat_id = categories.id";
$result = $con->query($qry);
include '../../includes/db_close.php';

?>

<!-- toast notification-->
<div id="toast"> <i id="toastIcon"></i> <span id="message"></span></div>

<div class="lg:py-20  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl font-bold text-[#061638]">News</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />
    <div class="fixed right-1 bottom-[4rem]">
        <a href="create.php"
            class="text-blue-600 font-normal px-4 py-2">
            <i class="text-2xl border-2 border-[#061638] rounded-full px-2 py-1 font-bold fas fa-plus"></i>
        </a>
    </div>
    <div class="my-8">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Posted By</th>
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
                    <td><?php echo limitWords($row['title'],5); ;?></td>
                    <td><?php echo limitWords($row['description'],30); ;?></td>
                    <td class="w-[15%]"><img class=" w-full" src=" ../../Images/news/<?php echo $row['image'] ;?>"
                            alt="no image">
                    </td>
                    <td><?php echo $row['cat_name'] ;?></td>
                    <td><?php echo $row['postBy'] ;?></td>
                    <td class="w-[14%]">
                        <a class="py-2" href="edit.php?id=<?php echo $row['id']?>">
                            <i class="text-2xl text-blue-600 hover:text-blue-800 font-bold fas fa-edit"></i>
                        </a>
                        <button
                            class=" font-bold delete ml-2"
                            id="<?php echo $row['id'] ?>"><i class="text-red-600 hover:text-red-800 text-2xl fas fa-trash"></i></button>
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
$(document).ready(function() {
    $('.delete').click(function() {
        $(document).ready(function() {

            $(document).on('click', '.delete', function() {
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
                    if (result.value) {
                        $.ajax({
                                url: 'delete.php',
                                type: 'POST',
                                data: {
                                    'id': this.id
                                },
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal.fire('Deleted!', response.message,
                                    response.status);
                                setTimeout(function() {
                                    location.href = "index.php"
                                }, 2000);
                            })
                            .fail(function() {
                                swal.fire('Oops...',
                                    'Something went wrong with ajax !',
                                    'error');
                            });
                    }
                })
            });
        });
    });
});
</script>



<?php include '../admin_footer.php';?>