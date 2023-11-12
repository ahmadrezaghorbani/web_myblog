<?php include "./include/header.php"?>

<?php
if (isset($_GET['post'])){
    $post_id=$_GET['post'];
    $query="SELECT * FROM posts WHERE `id`=$post_id";
    $result=$con->query($query)->fetch();
    @$id=$result['id'];
}

?>

<section class="py-3">

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 mb-4">
                <div class="container">
                    <?php if($result){ ?>
                    <div class="row">
                        <div>
                            <img src="imag/<?php echo $result['image']; ?>" class="img-fluid" alt="">
                        </div>

                        <div class="p-3">

                            <div class="d-flex align-items-center">
                                <h2><?php echo $result['title']; ?></h2>
                                <div class="mr-2">
                                    <span class="badge badge-secondary">دسته 2</span>
                                </div>
                            </div>
                            <p class="text-justify">
                                <?php echo $result['body']; ?>
                            </p>

                            <p> نویسنده : <?php echo $result['author']; ?> </p>
                        </div>

                    </div>
                    <?php
                    }else{
                    echo "<p class='bg-danger'>مقاله مورد نظر یافت نشد</p>";
                    }
                    ?>
                    <hr>

                    <!-- Commentes -->
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (isset($_POST['post_comment'])){
                                if (trim($_POST['name']) !="" || trim($_POST['comment']) != ""){
                                    $name=$_POST['name'];
                                    $comment=$_POST['comment'];
                                    $insert_comm="INSERT INTO `comments`(`name`, `comment`,`post-id`) VALUES (:NAME,:COMMENT,:POST_ID)";
                                    $stmt=$con->prepare($insert_comm);
                                    $stmt->execute([':NAME'=>$name,':COMMENT'=>$comment,':POST_ID'=>$result['id']]);
                                    $stmt->rowCount();
                                }else{
                                    echo "<p class='bg-danger'>فیلد ها نباید خالی یماند</p>";
                                }
                            }
                            ?>
                            <form method="post">
                                <div class="form-group">
                                    <label for="name">نام</label>
                                    <input type="name" name="name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="comment">متن کامنت</label>
                                    <textarea name="comment" class="form-control" rows="5"></textarea>
                                </div>

                                <button type="submit" name="post_comment" class="btn btn-outline-primary">ارسال</button>
                            </form>

                        </div>
                    </div>
                    <hr>
                    <?php

                    $comment_query="SELECT * FROM comments where `post-id`=:post_id AND `status`=:status";
                    $post_comment=$con->prepare($comment_query);
                    $post_comment->execute([':post_id'=>$id,':status'=>1]);
                    $result_comment=$post_comment->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="row p-md-3">

                        <p>تعداد کامنت : <?php echo $post_comment->rowCount();?></p>
                        <?php
                        foreach ($result_comment as $res){
                        ?>
                        <div class="col-12 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">

                                        <div class="mr-3">
                                            <h5 class="card-title"> <?php echo $res['name']; ?> </h5>
                                        </div>
                                    </div>

                                    <p class="card-text pt-3 pr-3">
                                       <?php echo $res['comment']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>


                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <?php include "./include/sidebar.php"?>

        </div>
    </div>
</section>


<?php include "./include/footer.php"?>