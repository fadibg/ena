<!DOCTYPE html>
<html lang="zxx">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
   <link rel="stylesheet" href="assets/css/animate.css">
   <link rel="stylesheet" href="assets/bootstarp/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/super-classes.css">
   <link rel="stylesheet" href="assets/css/custom-style.css">
   <link rel="stylesheet" href="assets/css/mobile.css">
   <title>ENA</title>
</head>

<body>
   <!--navbar-->
   <div class="w-100 float-left header-con">
      <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light p-0">
         <a class="navbar-brand" href="index.html" >
               <img src="assets/images/ENA-Logo.png" alt="ENA LOGO" id="navbar-brand">
               <!-- <a class="navbar-brand" href="index.html" >
                        <img src="assets/images/ENA-Logo.png" alt="ENA LOGO" id="navbar-brand" style="padding-bottom: 20px;">
                     </a> -->
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               <span class="navbar-toggler-icon"></span>
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item active pl-lg-0">
                     <a class="nav-link p-0" href="index.html">HOME <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link p-0" href="about.html">ABOUT</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link p-0" href="contact.html">CONTACT</a>
                  </li>
                  <!-- <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       PAGES
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <ul class="list-unstyled">
                           <li><a class="dropdown-item" href="speaker-detail.html">SPEAKER DETAILS</a></li>
                           <li><a class="dropdown-item" href="event-detail.html">EVENT DETAILS</a></li>
                           <li><a class="dropdown-item" href="contact.html">CONTACT</a></li>
                        </ul>
                     </div>
                   </li> -->
                  <li class="nav-item">
                     <a class="nav-link p-0" href="membership.html">MEMBERSHIP</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link p-0" href="events.html">EVENTS</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link p-0" href="gallery.php">GALLERY</a>
                  </li>
               </ul>
               <div class="navbar-btn d-inline-block">
                  <a href="register.php">REGISTER <i class="fas fa-angle-right"></i></a>
               </div>
               <div class="navbar-btn d-inline-block">
                  <a href="login.html">LOGIN <i class="fas fa-sign-in-alt"></i></a>
               </div>
            </div>
         </nav>
      </div>
   </div>
   <!--navbar-->
   <!--banner-->
   <section class="sub-banner-sec w-100 float-left d-table position-relative">
      <div class="d-table-cell align-middle">
         <div class="container">
            <div class="banner-inner-con text-white text-center wow bounceInUp" data-wow-duration="2s">
               <h1 class="position-relative">Our Gallery</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb d-inline-block">
                    <li class="breadcrumb-item d-inline-block"><a class="text-white" href="index.html">Home</a></li>
                    <li class="breadcrumb-item active text-white d-inline-block" aria-current="page">Gallery</li>
                    </ol>
                </nav>
            </div>
         </div>
      </div>
   </section>
   <!--banner-->
   <!--gallery-sec-->
   <div class="gallery-sec w-100 float-left padding-top padding-bottom text-center">
      <div class="container">
         <div class="masonry">
         <?php
          require_once './site/config/db.php'; // Make sure you adjust the path based on your setup

          // Fetch images from the gallery table
          $stmt = $pdo->query("SELECT * FROM gallery");
          $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>
            <?php $I=1; foreach ($images as $image): ?>
            <div class="masonry-item cell cell-<?php echo $I;?> panel-body wow bounceInUp" data-wow-duration="2s">
               <a href="#" class="zoom" data-toggle="modal" data-target="#lightbox">
                  <img src="uploads/gallery/<?php echo $image['image']; ?>" alt="<?php echo $image['title']; ?>">
                  <span class="overlay"><i class="fa-light fa-plus-large"></i></span>
               </a>
            </div>
            <?php endforeach; ?>
         </div>
         <div class="generic-button red-btn d-inline-block">
            <a href="speakers.html">LOAD MORE <i class="fas fa-angle-right"></i></a>
         </div>
      </div>
   </div>
   <!--gallery-sec-->
   <!--blog-sec-->
   <!-- <section class="blog-main-sec w-100 float-left padding-top position-relative">
      <div class="container">
         <div class="generic-title text-center">
            <h2 class="wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">Upcoming Events</h2>
            <p class="wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">Dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur <br>
               sint occaecat cupidatat non proident.</p>
         </div>
         <div class="row">
            <div class="col-lg-4">
               <div class="blog-con">
                  <div class="blog-img">
                     <a href="#" data-toggle="modal" data-target="#blog1">
                        <figure class="mb-0 wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                           <img src="assets/images/blog-img1.jpg" alt="blog-img1">
                        </figure>
                     </a>
                     <div class="date text-white wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;"><span>18</span><small>Apr</small></div>
                  </div>
                  <div class="blog-inner-con">
                     <div class="admin-con wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                        <ul class="list-unstyled d-inline-block">
                           <li class="d-inline-block">
                              <i class="fas fa-user"></i>
                              <span>Jonahtan Rem</span>
                           </li>
                           <li class="d-inline-block">
                              <i class="fas fa-map-marker-alt"></i>
                              <span>Prism Club, Canada</span>
                           </li>
                        </ul>
                     </div>
                     <a href="#" data-toggle="modal" data-target="#blog1">
                        <h5 class="wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">Maiores alias conseuatur aut
                           nerferendis eveniet</h5>
                     </a>
                     <p class="wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">Officia deserunt mollitia animi res est laborum et dolorum fugaharum quide rerum facilis expedia distinctio.</p>
                     <div class="blog-arrow wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                        <a class="d-inline-block" href="#" data-toggle="modal" data-target="#blog1"><i class="fas fa-angle-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog-con">
                  <div class="blog-img blog-left-img">
                     <a href="#" data-toggle="modal" data-target="#blog2">
                        <figure class="mb-0 wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                           <img src="assets/images/blog-img2.jpg" alt="blog-img2">
                        </figure>
                     </a>
                     <div class="date text-white wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;"><span>21</span><small>Apr</small></div>
                  </div>
                  <div class="blog-inner-con blog-right-con">
                     <div class="admin-con wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                        <ul class="list-unstyled d-inline-block">
                           <li class="d-inline-block">
                              <i class="fas fa-user"></i>
                              <span>Jonahtan Rem</span>
                           </li>
                           <li class="d-inline-block">
                              <i class="fas fa-map-marker-alt"></i>
                              <span>Prism Club, Canada</span>
                           </li>
                        </ul>
                     </div>
                     <a href="#" data-toggle="modal" data-target="#blog2">
                        <h5 class="wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">Maiores alias conseuatur aut
                           nerferendis eveniet</h5>
                     </a>
                     <p class="wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">Officia deserunt mollitia animi res est laborum et dolorum fugaharum quide rerum facilis expedia distinctio.</p>
                     <div class="blog-arrow wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                        <a class="d-inline-block" href="#" data-toggle="modal" data-target="#blog2"><i class="fas fa-angle-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog-con">
                  <div class="blog-img">
                     <a href="#" data-toggle="modal" data-target="#blog3">
                        <figure class="mb-0 wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                           <img src="assets/images/blog-img3.jpg" alt="blog-img3">
                        </figure>
                     </a>
                     <div class="date text-white wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;"><span>26</span><small>Apr</small></div>
                  </div>
                  <div class="blog-inner-con">
                     <div class="admin-con wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                        <ul class="list-unstyled d-inline-block">
                           <li class="d-inline-block">
                              <i class="fas fa-user"></i>
                              <span>Jonahtan Rem</span>
                           </li>
                           <li class="d-inline-block">
                              <i class="fas fa-map-marker-alt"></i>
                              <span>Prism Club, Canada</span>
                           </li>
                        </ul>
                     </div>
                     <a href="#" data-toggle="modal" data-target="#blog3">
                        <h5 class="wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">Maiores alias conseuatur aut
                           nerferendis eveniet</h5>
                     </a>
                     <p class="wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">Officia deserunt mollitia animi res est laborum et dolorum fugaharum quide rerum facilis expedia distinctio.</p>
                     <div class="blog-arrow wow bounceInUp" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: bounceInUp;">
                        <a class="d-inline-block" href="#" data-toggle="modal" data-target="#blog3"><i class="fas fa-angle-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section> -->
   <!--blog-sec-->
   <section class="footer-main-sec w-100 float-left padding-top position-relative">
      <div class="container">
         <!--form-sec-->
         <div class="form-sec d-flex align-items-center">
            <h3 class="mb-0">Subscribe To <br>
               Our Newsletter</h3>
            <input type="email" placeholder="Enter Email Address">
            <div class="form-btn red-btn d-inline-block">
               <button type="submit">SUBSCRIBE <i class="fas fa-angle-right"></i></button>
            </div>
         </div>
         <div class="footer-inner-sec">
            <ul class="list-unstyled text-center">
               <li class="d-inline-block"><a class="text-white" href="index.html">HOME</a></li>
               <li class="d-inline-block"><a class="text-white" href="about.html">ABOUT</a></li>
               <li class="d-inline-block"><a class="text-white" href="contact.html">CONTACT</a></li>
               <li class="d-inline-block"><a class="text-white" href="membership.html">MEMBERSHIP</a></li>
               <li class="d-inline-block"><a class="text-white" href="event.html">EVENTS</a></li>
               <li class="d-inline-block"><a class="text-white" href="gallery.php">GALLERY</a></li>



            </ul>
            <div class="footer-social-sec text-center">
               <a href="index.html">
                  <figure>
                     <!-- <img src="assets/images/Confrico.png" alt="Confrico"> -->
                     <a class="navbar-brand" href="index.html" >
                        <img src="assets/images/ENA-Logo.png" alt="ENA LOGO" id="navbar-brand" style="padding-bottom: 20px;">
                     </a>
                  </figure>
               </a>
               <ul class="list-unstyled p-0">
                  <li class="d-inline-block"><a class="d-inline-block" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                  <!-- <li class="d-inline-block"><a class="d-inline-block" href="https://twitter.com/i/flow/login"><i class="fab fa-twitter"></i></a></li>
                  <li class="d-inline-block"><a class="d-inline-block" href="https://www.linkedin.com/login"><i class="fab fa-linkedin-in"></i></a></li> -->
                  <li class="d-inline-block"><a class="d-inline-block" href="https://www.instagram.com/accounts/login/"><i class="fab fa-instagram"></i></a></li>
                  <!-- <li class="d-inline-block"><a class="d-inline-block" href="https://www.pinterest.com/login/"><i class="fab fa-pinterest-p"></i></a></li> -->
               </ul>
               <span class="text-white d-inline-block">Copyright 2024, Confrico. All Rights Reserved.</span>
            </div>
         </div>
         <!--form-sec-->

      </div>
   </section>
   <!--footer-sec-->
   <!--modal-->
   <div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <div class="modal-body">
                  <img src="" alt="" />
              </div>
          </div>
      </div>
  </div>
  <!--blog1 modal-->
  <div id="blog1" class="modal fade" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
         </div>
         <div class="modal-body text-center blog-model-content">
            <figure class="text-center">
               <img src="assets/images/blog-img1.jpg" alt="blog-img1" class="img-fluid">
            </figure>
            <div class="admin-con">
               <ul class="list-unstyled d-inline-block">
                  <li class="d-inline-block">
                     <i class="fas fa-user"></i>
                     <span>Jonahtan Rem</span>
                  </li>
                  <li class="d-inline-block">
                     <i class="fas fa-map-marker-alt"></i>
                     <span>Prism Club, Canada</span>
                  </li>
               </ul>
            </div>
            <h4>Maiores alias conseuatur aut nerferendis eveniet</h4>
            <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tempus in ante in vestibulum. Mauris tempor sem sed neque rutrum faucibus. Nam in nunc semper, porttitor justo id, feugiat enim. Donec pharetra, mi non suscipit fermentum, lectus velit tincidunt nibh, non molestie lacus erat id justo. Ut nec lacus id justo condimentum tristique. Maecenas ac arcu luctus, dignissim libero ac, tristique ipsum. Nunc commodo pharetra odio maximus volutpat. Praesent a tristique ligula. Nulla sed tellus eget ligula consectetur convallis. Praesent at tortor neque. Nam vel purus sem. Nulla auctor mi sapien, ac tempus metus fringilla ut. Vestibulum placerat purus ac bibendum facilisis. Nulla eu orci lectus. Cras interdum tellus a interdum malesuada. Duis consectetur posuere sem sed rutrum.</p>
            <ul class="list-unstyled model-list mb-md-3 mb-2">
               <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
               <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
               <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
            </ul>
            <div class="contact-form">
               <form>
                  <ul class="list-unstyled mb-0">
                     <li class="float-left"><input class="w-100" placeholder="Your Name" type="text" name="name" id="name"></li>
                     <li class="float-left"><input class="w-100" type="text" placeholder="Your Email" name="email" id="email"></li>
                     <li class="float-left"><input class="w-100" type="text" placeholder="Phone Number" name="phone" id="phone"></li>
                     <li class="float-left"><input class="w-100" type="text" placeholder="Subject" name="address" id="address"></li>
                     <li class="w-100"><textarea class="w-100" placeholder="Message"></textarea></li>
                     <li class="mb-0 w-100 d-inline-block form-btn red-btn">
                        <button>SUBMIT NOW<i class="fas fa-angle-right"></i></button>
                     </li>
                  </ul>
               </form>
             </div>
         </div>
      </div>
   </div>
</div>
<!--blog1 modal-->
<!--blog2 modal-->
<div id="blog2" class="modal fade" tabindex="-1">
<div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
      </div>
      <div class="modal-body text-center blog-model-content">
         <figure class="text-center">
            <img src="assets/images/blog-img2.jpg" alt="blog-img2" class="img-fluid">
         </figure>
         <div class="admin-con">
            <ul class="list-unstyled d-inline-block">
               <li class="d-inline-block">
                  <i class="fas fa-user"></i>
                  <span>Jonahtan Rem</span>
               </li>
               <li class="d-inline-block">
                  <i class="fas fa-map-marker-alt"></i>
                  <span>Prism Club, Canada</span>
               </li>
            </ul>
         </div>
         <h4>Maiores alias conseuatur aut nerferendis eveniet</h4>
         <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tempus in ante in vestibulum. Mauris tempor sem sed neque rutrum faucibus. Nam in nunc semper, porttitor justo id, feugiat enim. Donec pharetra, mi non suscipit fermentum, lectus velit tincidunt nibh, non molestie lacus erat id justo. Ut nec lacus id justo condimentum tristique. Maecenas ac arcu luctus, dignissim libero ac, tristique ipsum. Nunc commodo pharetra odio maximus volutpat. Praesent a tristique ligula. Nulla sed tellus eget ligula consectetur convallis. Praesent at tortor neque. Nam vel purus sem. Nulla auctor mi sapien, ac tempus metus fringilla ut. Vestibulum placerat purus ac bibendum facilisis. Nulla eu orci lectus. Cras interdum tellus a interdum malesuada. Duis consectetur posuere sem sed rutrum.</p>
         <ul class="list-unstyled model-list mb-md-3 mb-2">
            <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
            <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
            <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
         </ul>
         <div class="contact-form">
            <form>
               <ul class="list-unstyled mb-0">
                  <li class="float-left"><input class="w-100" placeholder="Your Name" type="text" name="name" id="name"></li>
                  <li class="float-left"><input class="w-100" type="text" placeholder="Your Email" name="email" id="email"></li>
                  <li class="float-left"><input class="w-100" type="text" placeholder="Phone Number" name="phone" id="phone"></li>
                  <li class="float-left"><input class="w-100" type="text" placeholder="Subject" name="address" id="address"></li>
                  <li class="w-100"><textarea class="w-100" placeholder="Message"></textarea></li>
                  <li class="mb-0 w-100 d-inline-block form-btn red-btn">
                     <button>SUBMIT NOW<i class="fas fa-angle-right"></i></button>
                  </li>
               </ul>
            </form>
          </div>
      </div>
   </div>
</div>
</div>
<!--blog2 modal-->
<!--blog3 modal-->
<div id="blog3" class="modal fade" tabindex="-1">
<div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
      </div>
      <div class="modal-body text-center blog-model-content">
         <figure class="text-center">
            <img src="assets/images/blog-img3.jpg" alt="blog-img3" class="img-fluid">
         </figure>
         <div class="admin-con">
            <ul class="list-unstyled d-inline-block">
               <li class="d-inline-block">
                  <i class="fas fa-user"></i>
                  <span>Jonahtan Rem</span>
               </li>
               <li class="d-inline-block">
                  <i class="fas fa-map-marker-alt"></i>
                  <span>Prism Club, Canada</span>
               </li>
            </ul>
         </div>
         <h4>Maiores alias conseuatur aut nerferendis eveniet</h4>
         <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tempus in ante in vestibulum. Mauris tempor sem sed neque rutrum faucibus. Nam in nunc semper, porttitor justo id, feugiat enim. Donec pharetra, mi non suscipit fermentum, lectus velit tincidunt nibh, non molestie lacus erat id justo. Ut nec lacus id justo condimentum tristique. Maecenas ac arcu luctus, dignissim libero ac, tristique ipsum. Nunc commodo pharetra odio maximus volutpat. Praesent a tristique ligula. Nulla sed tellus eget ligula consectetur convallis. Praesent at tortor neque. Nam vel purus sem. Nulla auctor mi sapien, ac tempus metus fringilla ut. Vestibulum placerat purus ac bibendum facilisis. Nulla eu orci lectus. Cras interdum tellus a interdum malesuada. Duis consectetur posuere sem sed rutrum.</p>
         <ul class="list-unstyled model-list mb-md-3 mb-2">
            <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
            <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
            <li><i class="fas fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscn elit.</li>
         </ul>
         <div class="contact-form">
            <form>
               <ul class="list-unstyled mb-0">
                  <li class="float-left"><input class="w-100" placeholder="Your Name" type="text" name="name" id="name"></li>
                  <li class="float-left"><input class="w-100" type="text" placeholder="Your Email" name="email" id="email"></li>
                  <li class="float-left"><input class="w-100" type="text" placeholder="Phone Number" name="phone" id="phone"></li>
                  <li class="float-left"><input class="w-100" type="text" placeholder="Subject" name="address" id="address"></li>
                  <li class="w-100"><textarea class="w-100" placeholder="Message"></textarea></li>
                  <li class="mb-0 w-100 d-inline-block form-btn red-btn">
                     <button>SUBMIT NOW<i class="fas fa-angle-right"></i></button>
                  </li>
               </ul>
            </form>
          </div>
      </div>
   </div>
</div>
</div>
<!--blog3 modal-->
   <!--js-->
   <script src="assets/js/jquery-3.6.0.min.js"></script>
   <!-- <script src="assets/js/jquery-3.2.1.slim.min.js"></script> -->
   <script src="assets/js/popper.min.js"></script>
   <script src="assets/js/bootstrap.min.js"></script>
   <script src="assets/js/wow.js"></script>
   <script>
      new WOW().init();
   </script>
   <script>
      $(document).ready(function() {
         var $lightbox = $('#lightbox');
         $('[data-target="#lightbox"]').on('click', function(event) {
            var $img = $(this).find('img'),
               src = $img.attr('src'),
               alt = $img.attr('alt'),
               css = {
                  'maxWidth': $(window).width() - 100,
                  'maxHeight': $(window).height() - 100
               };
            $lightbox.find('img').attr('src', src);
            $lightbox.find('img').attr('alt', alt);
            $lightbox.find('img').css(css);
         });
         $lightbox.on('shown.bs.modal', function (e) {
            var $img = $lightbox.find('img');
            $lightbox.find('.modal-dialog').css({'width': $img.width()});
            $lightbox.find('.close').removeClass('hidden');
            });
      });
   </script>


</body>
</html>