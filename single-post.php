<?php 
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

// foreach ($posts as $i => $post) 
// {
//     if ($post->id == $id) 
//     {
//         unset ($posts[$i]);
//         $save = json_encode(array_values($posts), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//         file_put_contents('posts.json', $save);
//         break;
//     }
// }


$page_title = 'Blog';
include('header.php');
?>

<div class="container">
    <div class="col">
    <?php foreach ($blogs as $blog) : 
        if (in_array($blog_id, $blog)){
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
    if (isset($_POST['submitdelete'])){
        // unset($blogs[$blog_id]);
        var_dump('halló');
    }
    endforeach; ?>
    </div>
</div>