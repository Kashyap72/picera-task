<?php
$images = glob('images/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

$imagesPerPage = 3;  
$totalImages = count($images);
$totalPages = ceil($totalImages / $imagesPerPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $totalPages));  

$startIndex = ($page - 1) * $imagesPerPage;
$displayImages = array_slice($images, $startIndex, $imagesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Photo Album</title>
    
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
<div class="gallery">
    <div class="main-image">
        <?php if (isset($displayImages[0])): ?>
            <img src="<?php echo $displayImages[0]; ?>" alt="Main Image">
        <?php endif; ?>
    </div>

    <div class="small-images">
        <?php for ($i = 1; $i < count($displayImages); $i++): ?>
            <?php if (isset($displayImages[$i])): ?>
                <img src="<?php echo $displayImages[$i]; ?>" alt="Small Image <?php echo $i; ?>">
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>


<div class="pagination-controls">
    <a href="?page=<?php echo max(1, $page - 1); ?>" class="<?php echo $page == 1 ? 'disabled' : ''; ?>">Previous</a>
    <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
    <a href="?page=<?php echo min($totalPages, $page + 1); ?>" class="<?php echo $page == $totalPages ? 'disabled' : ''; ?>">Next</a>
</div>

<script src="script.js"></script>
</body>
</html>
