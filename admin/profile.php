<?php 
require_once('../config.php');
require_once('includes/header.php');

$profiles = getAdminProfile($_SESSION['admis']['id']);

?>

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="profile.php">Profile</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            <?php 
                            if($profiles['photo'] != NULL) : 
                            ?>
                            <img class="mr-3 rounded-circle" style="object-fit:cover;" src="uploads/profile/<?php 
                            echo $profiles['photo']; 
                            ?>" width="80" height="80" alt="">
                            <?php else: ?>
                            <img class="mr-3" src="images/avatar/1.png" width="80" height="80" alt="">
                            <?php 
                            endif; 
                            ?>
                            <div class="media-body">
                                <h3 class="mb-0"><?php echo $profiles['username']; ?></h3>
                                <p class="text-muted mb-0"><?php echo $profiles['role']; ?></p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted px-4">Total Purchase</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted">Total Sale</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-12 text-center">
                            <a href="update-profile.php?id=<?php echo $_SESSION['admis']['id'] ?>" class="btn btn-danger px-5">Update Profile</a>
                            <br>
                            <br>
                            <a href="change-password.php" class="btn btn-warning px-5">Change Password</a>
                        </div>
                    </div>
                </div>  
            </div>
            
        </div>
    </div>
    

<?php require_once('includes/footer.php') ?>