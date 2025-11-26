<?php include('flowers.php'); ?>
<?php include('header.php'); ?>

<div class="container-xl">
    <div class="container mt-4">
        <h1 class="text-center mb-4">Danh sách các loài hoa</h1>
        <?php
            if (isset($_SESSION['flowers'])) {
                echo '<div class="row">';
                foreach ($flowers as $flower) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card h-100">';
                    echo '<img src="' . $flower['img'] . '" class="card-img-top" alt="' . $flower['name'] . '" style="height: 200px;width = 200px; object-fit: cover;">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $flower['name'] . '</h5>';
                    echo '<p class="card-text">' . $flower['description'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
        ?>
    </div>
</div>