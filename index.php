<?php 
$file_str = @file_get_contents('blogs.json');
if (!$file_str) {
    $blogs = [];
} else {
    $blogs = json_decode($file_str, true);
}
// less text function    
function small($string)
{
    return substr($string, 0, 200);
}




// // delete post 
// if(isset($_POST['submitdelete']))
//         {
//             unset ($posts[$i]);
//             $save = json_encode(array_values($posts), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//             file_put_contents('posts.json', $save);
//         }



$page_title = 'Blog posts';
include('header.php');
?>
<div class="container">  
<?php foreach ($blogs as $blog) : ?>
    <div class="col-lg-12">
        <div class="card mx-auto m-5" style="width: 45rem;">
            <img src="<?php echo $blog['img_url']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $blog['blog_title']; ?></h5>
                <span class=""><?php echo $blog['location']; ?></span>
                <span class=""><?php echo $blog['categories']; ?></span>
                <p class="card-text"><?php echo small($blog['blog_text']); ?></p>
                <a href="single-post.php?id=<?php echo $blog['id'];?> " class="btn btn-primary">Read more</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>