<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Search Results</h2>

                <?php if (empty($searchResults)) : ?>
                    <p>No products found for your search.</p>
                <?php else : ?>
                    <ul>
                        <?php foreach ($searchResults as $result) : ?>
                            <li>
                                <h4><?= $result['nama_produk']; ?></h4>
                                <p><?= $result['description']; ?></p>
                                <p>Posted by: <?= $result['username']; ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>