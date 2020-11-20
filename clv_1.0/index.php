<?php
include 'admin/assets/php/db/config.php';

function get_rating_avg( $flavor_id, $conn ){
    $rating_query  = "SELECT rating from rating WHERE flavor_id = '".$flavor_id."' ";
    $rating_result = mysqli_query($conn,$rating_query,0);
    $rating        = 0;
    $avg           = 0;
    
    if( !empty( $rating_result ) && mysqli_num_rows( $rating_result ) > 0 ){
        while ( $res = mysqli_fetch_assoc( $rating_result ) ) {
            $rating = $rating + $res['rating'];
        }
        $avg = $rating / mysqli_num_rows( $rating_result );
        $avg = str_replace('.', ',', round( $avg, 2 ) );
    }
    
    return $avg;

}

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
        <!--<link rel="icon" href="assets/img/favicon.png" type="image/gif" sizes="16x16">-->
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Custom Style  -->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <title>Juwolf Front</title>
        
    </head>
    <body>
        <!-- <?php
        if (isset($_POST['submit_rating'])) {
        echo $rating2=$_POST['rating2'];
        }
        ?> -->

        <!-- Rating Popup -->
        <div id="rating-popup" class=" popup-common overlay rating-popup ">
            <div class="popup">
                <h2>Add Rating</h2>
                <a class="close" href="javascript:void(0);">&times;</a>
                <div class="content">
                    <form action="" method="POST" class="form-container" id="rating-form" enctype="multipart/form-data">
                        <div id="half-stars-example">
                            <div class="rating-group">
                                <input class="rating__input rating__input--none" checked name="rating2" id="rating2-0" value="0" type="radio">
                                <label aria-label="0 stars" class="rating__label" for="rating2-0">&nbsp;</label>
                                <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-05" value="0.5" type="radio">
                                <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-10" value="1" type="radio">
                                <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-15" value="1.5" type="radio">
                                <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-20" value="2" type="radio">
                                <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-25" value="2.5" type="radio" checked>
                                <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-30" value="3" type="radio">
                                <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-35" value="3.5" type="radio">
                                <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-40" value="4" type="radio">
                                <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-45" value="4.5" type="radio">
                                <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating2" id="rating2-50" value="5" type="radio">
                            </div>
                        </div>
                        <div class="rating-error" style="display: none;color: red;"></div>
                        <div class="submt-new-tobacco">
                            <button type="submit" id="submit_rating" name="submit_rating" class="btn-anim" value="Reset">Submit</button>
                        </div>
                        <input type="hidden" name="flavor_id" id="flavor_id" value="">
                    </form>
                </div>
            </div>
        </div>

        <!-- Front Design Tobacoo list -->
        <div class="cest-lavie-main">
            <div class="cest-header">
                <img src="assets/img/logo-png.png" class="logo">
                <p class="header-subtext"> Tabak sortiment </p>
            </div>
            <div class="main-content">
                <div class="cest-section">
                    <?php
                    
                    $sql = "SELECT * FROM categories";
                    $result= mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                    $cat_id = $row['c_id'];
                    $cat_image = $row['image'];
                    ?>
                    <div class="cest-row">
                        <div class="cest-left-block">
                            <div class="alma-img-block">
                                <img src="admin/assets/img/cat-img/<?php echo $cat_image; ?>" class="tobaco-img">
                            </div>
                            <div class="tobacco-price">
                                <h3><?php echo $row['price']; ?> <span>&euro;</span></h3>
                            </div>
                        </div>
                        <div class="cest-right-block">
                            <ul class="toaco-lists-flavour">
                                <?php
                                $sql1 = "SELECT * FROM flavor where c_id=$cat_id";
                                $result1= mysqli_query($conn,$sql1);
                                while($row1 = mysqli_fetch_array($result1)) {
                                ?>
                                <li>
                                    <div class="tabco-list-box">
                                        <?php
                                        if ($row1['status']==1) {
                                        $stock="out-of-stock";
                                        } elseif($row1['status']==0) {
                                        $stock="in-stock";
                                        }
                                        ?>
                                        <div class="tac-heading <?php echo $stock; ?>">
                                            <!-- <h3><a href="#rating-popup"><?php echo $row1['tbc_name']; ?></a></h3> -->
                                            <h3><a href="javascript:void(0);" class="openrating-pop" class="openrating-popup" data-flavor-id="<?php echo $row1['id']; ?>" ><?php echo $row1['tbc_name']; ?></a></h3>
                                            <div class="rating">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <span></span>
                                                <?php echo get_rating_avg( $row1['id'], $conn ); ?>
                                            </div>
                                        </div>
                                        <p class="tobaco-flavour"><?php echo $row1['flavor']; ?></p>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery.min.js"></script>
        <script >
            $('.openrating-pop').click(function(event) {
                $('.rating-error').html('').hide();
                $('.rating-popup').addClass('active');
                $('#flavor_id').val($(this).data('flavor-id'));
            });

            $('.close').click(function(event) {
                $(this).parents('.rating-popup').removeClass('active');
            });

            $( document ).on( 'click', '#submit_rating', function(e){
                e.preventDefault();
                $this = $(this);

                var rating_products = JSON.parse(getCookie('rating-products')) || [];
                $('.rating-error').html('').hide();
                if( rating_products.includes($('#flavor_id').val()) ){
                    $('.rating-error').html('You already given rating for this product.').css('color','red').show();
                    return false;
                }

                $.ajax({
                    url: 'admin/assets/php/add-rating.php',
                    type: "post",
                    data: $('#rating-form').serializeArray(),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if( response.success ){
                            rating_products.push($('#flavor_id').val());
                            setCookie( 'rating-products', JSON.stringify(rating_products) , 365 );
                            $('.rating-error').html('Thank you for giving us a perfect rating.').css('color','green').show();
                        }else{
                            $('.rating-error').html('Something went wrong. Please try later.').css('color','red').show();
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus, errorThrown);
                    }
                });
            } );

            function setCookie(name,value,days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days*24*60*60*1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "")  + expires + "; path=/";
            }
            function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for(var i=0;i < ca.length;i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1,c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
                }
                return null;
            }
            function eraseCookie(name) {   
                document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            }

        </script>
    </body>
</html>
