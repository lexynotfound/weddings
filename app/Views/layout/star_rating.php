<div class="row">
    <div class="col-md-2">
        <div class="d-flex align-items-center">
            <i class="fa fa-star" style="font-size: 48px; color: gold;"></i>
            <?php
            // Calculate the total rating based on reviews
            $totalRating = 0;
            $totalReviews = 0;
            foreach ($reviews as $review) {
                $totalRating += $review['rating'] * $review['rating_count'];
                $totalReviews += $review['rating_count'];
            }

            // Calculate the average rating
            $averageRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;
            ?>
            <span class="ms-2 fs-3"><?= number_format($averageRating, 1); ?>/5</span>
        </div>
    </div>
    <div class="col-md-10">
        <?php for ($step = 1; $step <= 5; $step++) : ?>
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-star" style="font-size: 24px; color: gold;"></i>
                    <div class="flex-grow-1 ms-3">
                        <div class="progress">
                            <?php
                            // Get the rating count for the current step
                            $ratingCount = 0;
                            foreach ($reviews as $review) {
                                if ($review['rating'] == $step) {
                                    $ratingCount = $review['rating_count'];
                                    break;
                                }
                            }
                            ?>
                            <div class="progress-bar star-progress" role="progressbar" style="width: <?= ($ratingCount / count($reviews)) * 100; ?>%; background-color: gold;" aria-valuenow="<?= ($ratingCount / count($reviews)) * 100; ?>" aria-valuemin="0" aria-valuemax="100"><?= $step; ?></div>
                        </div>
                    </div>
                    <span class="ms-2"><?= $ratingCount; ?></span> <!-- Display the rating count -->
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>