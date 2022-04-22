<?php 
include('security.php');

$user =   $_SESSION['username'];
$query = "SELECT usertype FROM register WHERE email='$user'";
$query_run = mysqli_query($connection, $query);
$usertype  =  mysqli_fetch_array($query_run);

{
  include_once('includes/header.php');  
  include_once('includes/navbar.php');
 
  include_once('index.php');

  }
 

      
?>



<div class="modal fade" id="addfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Files</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
 
      <form action="code.php" method="POST" enctype="multipart/form-data">

<div class="modal-body">

<div class="form-group">
<label>Title</label>
        <input type="text" name="Title" required class="form-control" placeholder="Title">
    </div>
   
    <div class="form-group">
        <label>Description</label>
        <textarea name="Description" class="form-control" placeholder="Description"></textarea>
    </div>
    <div class="form-group">
        <label>Upload File</label>
        <input type="file" name="file" />
        <br>
        </div>
   
       
    
 
    </div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="uploadfilebtn" class="btn btn-primary">Save</button>
    
</div>
</form>


    </div>
     </div>
 </div>

 <div class="card-header py-3">
<h4 class="m-0 font-weight-bold text-primary">My Folder</h4>
    <h6 class="m-0 font-weight-bold text-primary">
           <p align="right"> <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#addfile">
              Add New File
            </button> </p>  
    </h6>
  </div> 
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">


  <div class="card-body">
    <?php
  if(isset($_SESSION['success']) && $_SESSION['success']!='')
  {
    echo '<h2 class="bg-primary text-white">'.$_SESSION['success'].'</h2>';
    unset($_SESSION['success']);
  }

  if(isset($_SESSION['']) && $_SESSION['status']!='')
  {
    echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].'</h2>';
    unset($_SESSION['status']);
  }






?>
    <div class="table-responsive">
      <?php
      $username = $_SESSION['username'];
      $query = "SELECT * FROM files where created_by = '$username'";
      $query_run = mysqli_query($connection, $query);
      ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th> Title </th>
            <th> Description   </th>
            <!-- <th> Description </th> -->
            <!-- <th>Brand </th>
            <th>Location</th> -->
            <th>Action</th>
            <th>share Link</th>
            
        
          </tr>
        </thead>
        <tbody>

        <?php
        
        if(mysqli_num_rows($query_run) > 0)
        {
          
          while($row = mysqli_fetch_assoc($query_run))
          {
           ?>

           
       
          <tr>
          
            <td> <?php echo $row['title'];  ?> </td>
          

            <td> <?php echo $row['description'];  ?> </td>
            
            <td><a class="btn btn-primary" href="Uploads/<?php echo $row['filename']; ?>"  target="_blank" role="button">View</a>
            <form action="code.php" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id'];  ?>">
                  <button type="submit" name="deletefile_btn" class="btn btn-danger"> Delete</button>
           
                 
                
                
                </form>
  
                  <!-- <button type="submit" name="opdelete_btn" class="btn btn-danger"> DOWNLOAD</button> -->
               
            </td>
              <?php 
                $base_url = "http://localhost/system/Uploads";
                $url=$base_url . $row['filename'];
                $short_url=substr(md5($url.mt_rand()),0,8);

              ?>
            <td> <?php echo $base_url."=". $short_url; ?>
                  </a>
                 </td>
            
          </tr>
          <?php
            
          }
        }
        
        
        else {
          echo "No Record Found";
        }
        ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>