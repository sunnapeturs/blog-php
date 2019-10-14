<?php 
//field value variables
$blog_title = $blog_text = $img_url = $location = '';
//errors
$blog_title_error = $blog_text_error = $img_url_error = $location_error = '';
// Initialize error count
$error_count = 0;
// Initialize success indicator
$success = false;
// Check if the form is submitted
if (isset($_POST['submit'])) {
    $blog_title = $_POST['blog_title'];
    $blog_text = $_POST['blog_text'];
    $img_url = $_POST['img_url'];
    $location = $_POST['location'];

    // Do some validation
    if (empty($_POST['blog_title'])) {
        $blog_title_error = 'You forgot title';
        $error_count++;
    } 

    if (empty($_POST['blog_text'])) {
        $blog_text_error = 'You forgot text';
        $error_count++;
    }

    if (empty($_POST['img_url'])) {
        $img_url_error = 'You forgot image, please use a link to a image';
        $error_count++;
    }

    if (empty($_POST['location'])) {
        $location_error = 'You forgot the location';
        $error_count++;
    }
    // If there are no errors reset field values
    if ($error_count === 0) {
        $blog_title = $blog_text = $img_url = $location = '';

        // Get jobs file
        $blogs_str_in = @file_get_contents('blogs.json'); // Returns false if file does not exist
        if (!$blogs_str_in) {
            $blogs = [];
        } else {
            $blogs = json_decode($blogs_str_in, true);
        }

        // Add new job to jobs array
        array_push($blogs, $_POST);

        // Convert job to JSON format
        $blogs_str_out = json_encode($blogs, true);

        // Save the job JSON string to jobs.json
        file_put_contents('blogs.json', $blogs_str_out);

        // Indicate that the job got added successfully
        $success = true;
    }
}


$page_title = 'Add blog post';
include('header.php');
?>
<div class="container">
    <div class="col-9">
        <h3 class="mt-5 mb-5">Add a new blog post</h3>
        <!-- FORM -->
        <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo uniqid(); ?>">

            <div class="form-group">
                <label>Blog Title:</label>
                <input type="text" name="blog_title" class="form-control" value="<?php echo $blog_title; ?>" placeholder="Blog title here">
                <?php if (!empty($blog_title_error)) : ?>
                <div class="alert alert-danger"><?php echo $blog_title_error; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Blog text:</label>
                <textarea class="form-control" rows="3" name="blog_text" value="<?php echo $blog_text; ?>"></textarea>
                <?php if (!empty($blog_text_error)) : ?>
                <div class="alert alert-danger"><?php echo $blog_text_error; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Blog imgage url:</label>
                <input type="text" name="img_url" class="form-control" value="<?php echo $img_url; ?>" placeholder="Image url here:">
                <?php if (!empty($img_url_error)) : ?>
                <div class="alert alert-danger"><?php echo $img_url_error; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label>Location:</label>
                <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Location of the climbing spot:">
                <?php if (!empty($location_error)) : ?>
                <div class="alert alert-danger"><?php echo $location_error; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Categories:</label>
                <select class="form-control" name="categories" value="<?php echo $categories; ?>">
                <option value="Trad">Trad</option>
                <option value="Lead">Lead</option>
                <option value="Boulder">Boulder</option>
                </select>
            </div>
            <div class="form-group">
                <label>Blog status:</label>
                <select class="form-control" name="status" value="<?php echo $status; ?>">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
