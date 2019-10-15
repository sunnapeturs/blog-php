<?php
ob_start();
// blog id
if(isset($_GET['id'])){
  $blog_id = $_GET['id'];
} else {
  echo "failed";
}
// breyta í array
$file_str = @file_get_contents('blogs.json');

if (!$file_str) {
    $blogs = [];
} else {
    $blogs = json_decode($file_str, true);
}
$page_title = 'Blog';
include('header.php');
?>
<div class="container">
    <div class="col">
    <?php 

    foreach ($blogs as $blog) : 
        if (in_array($blog_id, $blog) && isset($_POST['submitdelete'])){ 
            unset ($blog);
            $save = json_encode(array_values($blog));
            file_put_contents('blogs.json', $save);
       
            header("HTTP/1.1 301 Moved Permanently");   
            header("Location:index.php");
            exit;
        }
        if (in_array($blog_id, $blog) && !isset($_POST['submitdelete'])){
        ?>
        <div class="card" style="width: 25rem;">
            <img src="<?php echo $blog['img_url']; ?>" class="card-img-top" alt="...">
            <div class="card-body">

            <td class="contact-delete">
                <form action="" method="post">
                 <input type="submit" name="submitdelete" value="Delete">
             </form>
            </td>
            
                <h5 class="card-title"><?php echo $blog['blog_title']; ?></h5>
                <p class="card-text"><?php echo $blog['blog_text']; ?></p>
                <p class="card-text"><?php echo $blog['categories']; ?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    <?php  }
    endforeach; ?>
    </div>
</div>