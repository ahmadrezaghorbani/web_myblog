<?php
$query="SELECT * FROM `post-slider`";
$post_id=$con->query($query);
?>
<div class="container-fluid p-0">
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"  aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php if ($post_id->rowCount() > 0){
                 foreach ($post_id as $post_slider){
                     $id_post=$post_slider['post-id'];
                     $query_posts="SELECT * FROM posts WHERE `id`=$id_post";
                     $post=$con->query($query_posts)->fetch();
                 ?>
            <div class="carousel-item <?php echo ($post_slider['active'] >0) ? "active" : "" ; ?>" data-bs-interval="10000">
                <img src="./imag/<?php echo $post['image']?>" class="./imag/1.jpg"  style="height: 500px ; width: 100%" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $post['title'];?></h5>
                    <p><?php echo substr($post['body'],0,200)." ...";?></p>
                </div>
            </div>
            <?php
                 }
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>