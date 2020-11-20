<?php
include 'assets/php/db/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Custom Style  -->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <title>Juwolf Admin</title>
        
    </head>
    <body>
        <!-- add categories -->
        <?php
        if(isset($_POST['add-cat'])){
            $sql= "SELECT c_id from categories ORDER BY c_id DESC LIMIT 1";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                while ($row=mysqli_fetch_array($result)) {
                    $c_id = $row['c_id'];
                }
                $c_id++;
            } else {
                $c_id= '1' ;
                
            }
            $price=$_POST['price'];
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            echo $folder = "assets/img/cat-img/".$filename;
            $size = filesize($tempname);
            $extension = substr($filename,strlen($filename)-4,strlen($filename));
            $allowed_extensions = array(".jpg","jpeg",".png",".gif",".JPG","JPEG",".PNG",".GIF");
            if(!in_array($extension,$allowed_extensions))
            {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            }
            else
            {
                if ($size>8388608) {
                    echo $sizeErr="image size should be less than 8 MB";
                } else {
                    move_uploaded_file($tempname,$folder);
                    $cat_query = "INSERT into categories values ('$c_id','$filename','$price')";
                    $cat_result = mysqli_query($conn, $cat_query);
                }
            }
        }
        ?>
        <!-- add flavor -->
        <?php
        if (isset($_POST['add-flav'])) {
            $c_id = $_POST['c_id'];
            $tbc_name = $_POST['tbc_name'];
            $flavor = $_POST['flavor'];
            if(isset($_POST['status']))
            {
                $status ='0';
            }
            else
            {
                $status ='1';
            }
            $sql= "SELECT id from flavor ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                while ($row=mysqli_fetch_array($result)) {
                    $id = $row['id'];
                }
                $id++;
            } else {
                $id= '1' ; 
            }
            $flav_query = "INSERT into flavor values('$id','$c_id','$tbc_name','$flavor','$status')" ;
            $flav_result = mysqli_query($conn,$flav_query);
        }
        ?>
        <!-- update tobacco img and price -->
        <?php
        if (isset($_POST['update-tobacco-img-price'])) {
            $updt_c_id = $_POST['c_id'];
            $old_img = $_POST['old_image'];
            $updt_price = $_POST['updt_price'];

            $updt_filename = $_FILES["updt_uploadfile"]["name"];
            if ($updt_filename) {
                $updt_tempname = $_FILES["updt_uploadfile"]["tmp_name"];
                $folder = "assets/img/cat-img/".$updt_filename;
                $updt_size = filesize($updt_tempname);
                $updt_extension = substr($updt_filename,strlen($updt_filename)-4,strlen($updt_filename));
                $updt_allowed_extensions = array(".jpg","jpeg",".png",".gif",".JPG","JPEG",".PNG",".GIF");
                if(!in_array($updt_extension,$updt_allowed_extensions))
                {
                    echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
                }
                else
                {
                    if ($updt_size>8388608) {
                        $sizeErr="image size should be less than 8 MB";
                    }
                    else {
                        move_uploaded_file($updt_tempname,$folder);
                        $updt_cat_query = "UPDATE categories set image='$updt_filename', price='$updt_price' where c_id='$updt_c_id'";
                        $updt_cat_result = mysqli_query($conn,$updt_cat_query);
                       /* if (array_key_exists('image', $_POST)) {
                            $filename1 = "assets/img/cat-img/$updt_c_id-".$old_img;
                            if (file_exists($filename1)) {
                                unlink($filename1);
        
                            }
                        }*/
                    }
                }
            }
            else {
                $updt_tempname = $old_img;
                $updt_cat_query = "UPDATE categories set price='$updt_price' where c_id='$updt_c_id'";
                $updt_cat_result = mysqli_query($conn,$updt_cat_query);

            }
        }
        ?>
        <!-- delete categories -->
        <?php
        if (isset($_POST['delete_cat'])) {
            $delete_c_id = $_POST['delete_c_id'];
            $delete_cat_query = "DELETE from categories where c_id='$delete_c_id'";
            $delete_cat_result = mysqli_query($conn, $delete_cat_query);
            $delete_flav_query = "DELETE from flavor where c_id='$delete_c_id'";
            $delete_flav_result = mysqli_query($conn, $delete_flav_query);
        }
        ?>
        <!-- update flavor -->
        <?php
        if (isset($_POST['update-flav'])) {
            $update_id = $_POST['update-id'];
            $update_c_id = $_POST['update-c_id'];
            $update_tbc_name = $_POST['update_tbc_name'];
            $update_flavor_name = $_POST['update_flavor_name'];
            if(isset($_POST['update_status'])){
                $update_status ='0';
            }
            else{
                $update_status ='1';
            }
            $update_flavor_query = "UPDATE flavor SET tbc_name='$update_tbc_name', flavor='$update_flavor_name', status='$update_status' where id=$update_id AND c_id=$update_c_id";
            $update_flavor_result = mysqli_query($conn, $update_flavor_query);
        }
        ?>
        <!-- delete flavor -->
        <?php
        if (isset($_POST['delete_tbc'])) {
            $delete_id = $_POST['delete_id'];
            $delete_c_id = $_POST['delete_c_id'];
            $delete_tbc_query = "DELETE from flavor where id=$delete_id AND c_id=$delete_c_id";
            $delete_tbc_result = mysqli_query($conn, $delete_tbc_query);
        }
        ?>
        <!-- add category popup -->
        <div id="add-category-popup" class="popup-common overlay">
            <div class="popup">
                <h2>Add New Cataegory</h2>
                <a class="close" href="javascript:void(0)">&times;</a>
                <div class="content">
                    <form action="index.php" method="POST" class="form-container" enctype="multipart/form-data">
                        <div class="image-input">
                            <div id="file-upload-filename-category" class="file-upload-filename"> </div>
                            <div class="certificate-btn fileinput-button">
                                <input type="file" name="uploadfile" id="file-upload-category">
                                <span>Upload Image</span>
                            </div>
                        </div>
                        <div class="popup-tobaco-flavour">
                            <p class="label">Tobacco Price</p>
                            <div class="popup-flavours-lists">
                                <input type="text" name="price" placeholder="Enter Tobacco Price">
                            </div>
                        </div>
                        <div class="submt-new-tobacco">
                            <button type="submit" id="new-tobacoo-submit-btn" name="add-cat" class="btn-anim">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- add tobacco popup -->
        <div id="new-tobacco-popup" class="popup-common overlay">
            <div class="popup">
                <h2>Add New Tobacco</h2>
                <a class="close close-icons" href="index.php">&times;</a>
                <div class="content">
                    <form action="index.php" method="POST" class="form-container" enctype="multipart/form-data">
                        <div class="popup-tobaco-name">
                            <input id="get_id" type="hidden" name="c_id" value="">
                            <p class="label">Tobacco Name</p>
                            <input type="text" name="tbc_name" placeholder="Enter Tobacco Name">
                        </div>
                        <div class="popup-tobaco-flavour">
                            <p class="label">Tobacco Flavour</p>
                            <div class="popup-flavours-lists">
                                <input type="text" name="flavor" placeholder="Enter Tobacco Flavour">
                            </div>
                        </div>
                        <div class="popup-stock-status">
                            <label class="switch">
                                <input type="checkbox" value="" name="status" >
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="submt-new-tobacco">
                            <button type="submit" id="new-tobacoo-submit-btn" class="btn-anim" name="add-flav">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- update tobacco popup -->
        <div id="update-tobacco-popup" class="popup-common overlay">
            <div class="popup">
                <h2>Update Tobacco</h2>
                <a class="close close-icons" href="index.php">&times;</a>
                <div class="content">
                    <form action="index.php" method="POST" class="form-container" enctype="multipart/form-data">
                        <?php
                        $id = $_GET['id'];
                        $c_id = $_GET['c-id'];
                        
                        $select_old_name_query = "SELECT * from flavor where id=$id AND c_id=$c_id";
                        $select_old_res = mysqli_query($conn,$select_old_name_query);
                        while ($selected_res=mysqli_fetch_array($select_old_res)) {
                            $tbc_name_old = $selected_res['tbc_name'];
                            $flavor_name_old = $selected_res['flavor'];
                            $old_status = $selected_res['status'];
                            if($old_status==0) {
                                $checked="checked";
                            }
                            else{ 
                                $checked = "";
                            }
                        }
                        ?>
                        <div class="popup-tobaco-name">
                            <input id="get_id" type="hidden" name="update-c_id" value="<?php echo $c_id; ?>">
                            <input id="get_id" type="hidden" name="update-id" value="<?php echo $id; ?>">
                            <p class="label">Tobacco Name</p>
                            <input type="text" name="update_tbc_name" placeholder="Enter Tobacco Name" value="<?php echo $tbc_name_old; ?>">
                        </div>
                        <div class="popup-tobaco-flavour">
                            <p class="label">Tobacco Flavour</p>
                            <div class="popup-flavours-lists">
                                <input type="text" name="update_flavor_name" placeholder="Enter Tobacco Flavour" value="<?php echo $flavor_name_old; ?>">
                            </div>
                        </div>
                        <div class="popup-stock-status">
                            <label class="switch">
                                <input type="checkbox" value="" name="update_status" <?php echo $checked; ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="submt-new-tobacco">
                            <button type="submit" id="new-tobacoo-submit-btn" class="btn-anim" name="update-flav">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- delete tobacco popup -->
        <div id="delete-confirm" class="popup-common overlay">
            <div class="popup">
                <a class="close close-icons" href="index.php">&times;</a>
                <div class="content">
                    <form action="index.php" method="POST" class="form-container" enctype="multipart/form-data">
                        <?php
                        $id = $_GET['id'];
                        $c_id = $_GET['c-id'];
                        ?>
                        <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="delete_c_id" value="<?php echo $c_id; ?>">
                        <div class="popup-tobaco-name text-center">
                            <p class="delete-heading text-center">Are you sure?</p>
                            <p class="delete-subtext text-center">Once deleted, you will not be able to recover this data</p>
                        </div>
                        <div class="submt-new-tobacco">
                            <button type="submit" id="delete-record" class="btn-anim" >Cancel</button>
                            <button type="submit" id="delete-record" name="delete_tbc" class="okay-btn btn-anim" >Okay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- delete categories popup -->
        <div id="delete-cat-confirm" class="popup-common overlay">
            <div class="popup">
                <a class="close close-icons" href="index.php">&times;</a>
                <div class="content">
                    <form action="index.php" method="POST" class="form-container" enctype="multipart/form-data">
                        <?php
                        $c_id = $_GET['c-id'];
                        ?>
                        <input type="hidden" name="delete_c_id" value="<?php echo $c_id; ?>">
                        <div class="popup-tobaco-name text-center">
                            <p class="delete-heading text-center">Are you sure?</p>
                            <p class="delete-subtext text-center">Once deleted, you will not be able to recover this data</p>
                        </div>
                        <div class="submt-new-tobacco">
                            <button type="submit" id="delete-record" class="btn-anim" >Cancel</button>
                            <button type="submit" id="delete-record" name="delete_cat" class="okay-btn btn-anim" >Okay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- admin dashboard -->
        <div class="admin-dash-wrapper">
            <h2>Admin Panel</h2>
            
            <div class="admin-dash-inner">
                <?php
                $sql= "SELECT * from categories";
                $result = mysqli_query($conn,$sql);
                while ($res=mysqli_fetch_array($result)) {
                    $c__id = $res['c_id'];
                    $image = $res['image'];
                ?>
                <!-- categories list -->
                <div class="tobaco-box">
                    <div class="tobaco-inner">
                        <form action="index.php" method="POST" class="form-container" enctype="multipart/form-data">
                            <div class="image-input">
                                <div id="file-upload-filename" class="display_img file-upload-filename"><?php echo $image; ?></div>
                                <div class="certificate-btn fileinput-button">
                                    <input type="file" name="updt_uploadfile" id="file-upload" class="get_img"  value="<?php echo $image; ?>">
                                    <span>Upload Image</span>
                                </div>
                                <!-- <?php 
                                    // echo "<script>var input = document.getElementById( 'file-upload".$c__id."' );
                                    //     var infoArea = document.getElementById( 'file-upload-filename".$c__id."' );
                                    //     input.addEventListener( 'change', showFileName );
                                    //     function showFileName( event ) {

                                    //         var input = event.srcElement;
                                    //         var fileName = input.files[0].name;
                                    //         infoArea.textContent =  fileName;

                                    //     }</script>";
                                ?> -->
                            </div>
                            <input type="hidden" name="c_id" value="<?php echo $c__id; ?>">
                            <input type="hidden" name="old_image" value="<?php echo $image; ?>">
                            <div class="price-text">
                                <label>Price : </label> <input type="text" name="updt_price" value="<?php echo $res['price']; ?>" placeholder="Add Price">
                            </div>
                            <div class="image-price-box">
                                <button type="submit" name="update-tobacco-img-price" id="update-tobacco-img-price" class="btn-anim">Update Image & price</button>
                            </div>
                        </form>
                        
                            <form action="index.php" method="POST" class="form-container" enctype="multipart/form-data">
                                <div class="tobaco_lists tobaco-header">
                                    <div class="tobaco_name_flavour">
                                        Tobacco Name
                                    </div>
                                    <div class="stck-edit-wrap">
                                        <div class="stock-detail">
                                            Out of stock
                                        </div>
                                        <div class="edit-field">
                                            Action
                                        </div>
                                    </div>
                                </div>
                                <div class="tobacco-list-prime">
                                    <!-- flavor list -->
                                    <?php
                                    $show_tbcname= "SELECT * from flavor where c_id='$c__id'";
                                    $tbcname_result = mysqli_query($conn,$show_tbcname);
                                    while ($res=mysqli_fetch_array($tbcname_result)) {
                                        $tbc_name = $res['tbc_name'];
                                        $flavor = $res['flavor'];
                                        $status = $res['status'];
                                    ?>
                                    
                                        <div class="tobaco-list-row">
                                        <div class="tobaco_lists">
                                            <div class="tobaco_name_flavour">
                                                <p class="tobaco-name"><?php echo $tbc_name; ?></p>
                                                <p class="falours-txt"> <span><?php echo $flavor; ?></span></p>
                                            </div>
                                            <div class="stck-edit-wrap">
                                                <div class="stock-detail">
                                                    <div class="in_stock out-of-stock">
                                                        <?php
                                                        if ($status==0) {
                                                            $stock="fa-check";
                                                        } elseif ($status==1) {
                                                            $stock="fa-times";
                                                        }
                                                        ?>
                                                        <i class="fa <?php echo $stock; ?>" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <div class="edit-field">
                                                    <a href="index.php?id=<?php echo $res['id']; ?>&c-id=<?php echo $c__id; ?>#update-tobacco-popup" id="update-tobacco-button-popup" class="btn btn-info btn-anim" role="button">Update</a>
                                                    <a href="index.php?id=<?php echo $res['id']; ?>&c-id=<?php echo $c__id; ?>#delete-confirm" id="delete-tobacco-button-popup" class="btn delete-btn btn-info btn-anim" role="button">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    
                                    <?php } ?>
                                </div>
                                <input type="hidden" name="c_id" value="<?php echo $c__id; ?>">
                                <div class="add-new-tobaco">
                                    <a href="javascript:void(0)" id="add-new-tobacoo-popup" class="add-new-tobacoo-popup btn-anim" onclick="get_id(<?php echo $c__id; ?>)">Add New Tobacco </a>
                                    <a href="index.php?c-id=<?php echo $c__id; ?>#delete-cat-confirm" id="update-cat-button-popup" class="btn delete-btn btn-info btn-anim" role="button">Delete Category</a>
                                </div>

                            </form>

                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="add-new-tobacco-category">
                <a href="javascript:void(0)" id="add-new-tobacoo-category" class="add-category-popup btn-anim">Add New Category </a>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Custom JS -->
        <script src="assets/js/custom.js"></script>
        <script >
            $('.add-category-popup').click(function(event) {
                $('#add-category-popup').addClass('active-popup');
            });

            $('.add-new-tobacoo-popup').click(function(event) {
                $('#new-tobacco-popup').addClass('active-popup');
            });



            $('.close').click(function(event) {
                $(this).parents().parent('.popup-common').removeClass('active-popup');
            });
        </script>
    </body>
</html>