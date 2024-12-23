<?php
          require_once './site/config/db.php'; // Make sure you adjust the path based on your setup

          // Fetch images from the gallery table
          $stmt = $pdo->query("SELECT * FROM gallery");
          $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>
            <?php $I=1; foreach ($images as $image): ?>
            <div class="masonry-item cell cell-<?php echo $I;?> panel-body wow bounceInUp" data-wow-duration="2s">
               <a href="#" class="zoom" data-toggle="modal" data-target="#lightbox">
                  <img src="./site/uploads/gallery/<?php echo $image['image']; ?>" alt="<?php echo $image['title']; ?>">
                  <span class="overlay"><i class="fa-light fa-plus-large"></i></span>
               </a>
            </div>
            <?php endforeach; ?>