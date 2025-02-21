<!DOCTYPE html>
<html>
<head>
    <title>Товары</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
.product-container {
    display: flex;
    flex-wrap: wrap; 
    justify-content: space-between; 
}

.product {
    width: 23%; 
    margin: 1%; 
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center; 
}

.product img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

    </style>
</head>
<body>

    <div class="container">


        <div class="row">
            <div class="col-md-12">
                <div class="product-container">
                    <?php

                    // Массив товаров json ? 
                    $products = [
                        ['name' => 'Товар 1', 'price' => 100, 'image' => 'images1/product1.jpg'],
                        ['name' => 'Товар 2', 'price' => 200, 'image' => 'images/product2.jpg'],
                        ['name' => 'Товар 3', 'price' => 300, 'image' => 'images/product3.jpg'],
                        ['name' => 'Товар 4', 'price' => 400, 'image' => 'images/product4.jpg'],
                        ['name' => 'Товар 5', 'price' => 500, 'image' => 'images/product5.jpg'],
                    ];

                    // Выводим товары в блоках
                    foreach ($products as $product) {
                        echo "<div class='product'>";
                        echo "<img src='{$product['image']}' alt='{$product['name']}'>";
                        echo "<h3>{$product['name']}</h3>";
                        echo "<p>Цена: {$product['price']} руб.</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <!-- add Bootstrap js  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </footer>

</html>