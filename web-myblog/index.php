<?php include "./include/header.php"?>

<?php include "./include/slider.php"?>

<?php
if (isset($_GET['category']) ){
    $category_id = $_GET['category'];

    $posts = $con->prepare('SELECT * FROM posts WHERE `categories_id` = :id');

    $posts->execute(['id' => $category_id]);
}else{
    $query="SELECT * FROM `posts`";
    $posts=$con->query($query);
}
?>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-8">
            <div class="row">
                <?php
                if ($posts->rowCount() > 0){
                    foreach ($posts as $post){
                        $category_id=$post['categories_id'];
                        $query_cat="SELECT * FROM `categories` WHERE `id`=$category_id";
                        $cat=$con->query($query_cat)->fetch();
                ?>
                <div class="col-sm-6 mt-2">
                    <div class="card">
                        <img src="./imag/<?php echo $post['image'];?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title"><?php echo $post['title']; ?></h5>
                                <div><span class="badge badge-secondary bg-secondary"> <?php echo $cat['title']; ?> </span></div>
                            </div>
                            <p class="card-text text-justify">
                                <?php echo substr($post['body'],0,500)."..."; ?>
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="single.php?post=<?php echo $post['id']; ?>" class="btn btn-outline-primary stretched-link">مشاهده</a>
                                <p> نویسنده : <?php echo $post['author']; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }else{
                ?>
                    <div class="col">
                        <div class="alert alert-danger">
                            مقاله ای سافت نشد
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <!--------slider--------->
        <?php include "./include/sidebar.php"?>

    </div>
</div>

<?php include "./include/footer.php"?>