<?php include "./include/header.php"?>
<?php
if (isset($_GET['search'])){
    $search=$_GET['search'];
    $sql = "SELECT * FROM `posts` WHERE `title` LIKE :searchTerm";
    $stmt=$con->prepare($sql);
    $stmt->bindValue(':searchTerm',"%$search%",PDO::PARAM_STR);
    $stmt->execute();
}
?>
<section class="py-3">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 mb-4">

                <div class="row">

                    <div class="col-sm-12 mt-2">
                        <div class="alert alert-primary">
                            پست های مرتبط با کلمه [ <?php echo $_GET['search']?> ]
                        </div>
                    </div>
                    <?php
                    if ($stmt->rowCount() > 0){
                        foreach ($stmt as $results){
                        $cat_id=$results["categories_id"];
                        $query="SELECT * FROM `categories` WHERE `id`=$cat_id";
                        $cat=$con->query($query)->fetch();
                    ?>
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <img src="./imag/<?php echo $results["image"]; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title"><?php echo $results["title"]; ?></h5>
                                    <div><span class="badge badge-secondary bg-secondary"><?php echo $cat['title'];?></span></div>
                                </div>
                                <p class="card-text text-justify">
                                    <?php echo substr($results["body"],0,500)."..."?>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="single.php" class="btn btn-outline-primary stretched-link">مشاهده</a>
                                    <p> نویسنده : <?php echo $results["author"]?> </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                        }
                    }
                    ?>


                </div>

            </div>

            <!-- Sidebar -->
            <?php include "./include/sidebar.php"?>

        </div>

    </div>

</section>

<!-- Footer -->
<?php include "./include/footer.php"?>