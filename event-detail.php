<?php
// Database connection
require './site/config/db.php';

// Fetch the event ID from the URL
$eventId = $_GET['id'] ?? null;

if ($eventId) {
    // Retrieve event details from the database
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = :id");
    $stmt->execute(['id' => $eventId]);
    $event = $stmt->fetch();

    if ($event) {
        // Prepare event details
        $title = htmlspecialchars($event['title']);
        $description = htmlspecialchars($event['description']);
        $date = htmlspecialchars($event['event_date']);
        $location = htmlspecialchars($event['location']);
        $imageUrl = htmlspecialchars($event['image_url']);
        $createdBy = htmlspecialchars($event['created_by']);
    } else {
        die("Event not found.");
    }
} else {
    die("No event ID provided.");
}
?>
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

   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include jQuery (Always include this first) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



   <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.js"></script>


   <title>Event Detail</title>
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
                  <li class="nav-item dropdown">
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
                   </li>

                  <li class="nav-item">
                     <a class="nav-link p-0" href="gallery.php">GALLERY</a>
                  </li>
               </ul>
               <div class="navbar-btn d-inline-block">
                  <a href="contact.html">BUY TICKET <i class="fas fa-angle-right"></i></a>
               </div>
            </div>
         </nav>
      </div>
   </div>
   <!--navbar-->
   <!--banner-->
   <section class="sub-banner-sec generic-banner w-100 float-left d-table position-relative">
      <div class="d-table-cell align-middle">
         <div class="container">
            <div class="banner-inner-con text-white text-center wow bounceInUp" data-wow-duration="2s">
               <h1 class="position-relative">Event Detail</h1>
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb d-inline-block">
                  <li class="breadcrumb-item d-inline-block"><a class="text-white" href="index.html">Home</a></li>
                  <li class="breadcrumb-item active d-inline-block" aria-current="page">Upcoming Events</li>
                  <li class="breadcrumb-item active text-white d-inline-block" aria-current="page">Event Detail</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </section>
 <!--banner-->
   <!--conference-sec-->
<!-- Event Details -->
<section class="event-detail-sec w-100 float-left padding-top padding-bottom">
      <div class="container">
         <div class="event-details-main-con w-100 float-left">
            <div class="event-image-con blog-img position-relative wow bounceInUp" data-wow-duration="2s">
               <figure class="mb-0">
                  <img src="<?php echo $imageUrl; ?>" alt="Event Image">
               </figure>
               <div class="date text-white">
                  <span><?php echo date('d', strtotime($date)); ?></span>
                  <small><?php echo date('M', strtotime($date)); ?></small>
               </div>
            </div>
            <div class="event-details wow bounceInUp" data-wow-duration="2s">
               <div class="admin-con mr-0">
                  <ul class="list-unstyled d-inline-block">
                     <li class="d-inline-block"><i class="fas fa-user"></i> <span><?php echo $createdBy; ?></span></li>
                     <li class="d-inline-block"><i class="fas fa-map-marker-alt"></i> <span><?php echo $location; ?></span></li>
                  </ul>
               </div>
               <h2><?php echo $title; ?></h2>
               <p><?php echo $description; ?></p>
               <div class="generic-button red-btn d-inline-block">
                  <a href="contact.html">For More Information <i class="fas fa-angle-right"></i></a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!--blog-sec-->
   <!-- Include jQuery (if not already included) -->

   <script>
    document.addEventListener("DOMContentLoaded", () => {

        const container = document.querySelector('.schedule-inner-sec');

        if (!container) {
            console.warn('Container element not found, skipping content population');
        }

        fetch("./site/auth/fetch_events.php")
            .then(response => response.json())
            .then(events => {
                if (events.error) {
                    console.error(events.error);
                    return;
                }
                const urlParams = new URLSearchParams(window.location.search);
                const eventId = urlParams.get('id');

                const filteredEvents = events.filter(event => event.id != eventId);

                const eventsToDisplay = filteredEvents.slice(0, 3);

                let content = '';

                eventsToDisplay.forEach(event => {
                    const eventDate = new Date(event.date);
                    const day = eventDate.getDate();
                    const month = eventDate.toLocaleString('default', { month: 'long' });
                    const time = event.time;

                    content += `
                        <div class="tabs-content d-flex align-items-center wow bounceInUp" data-wow-duration="2s">
                            <div class="value-sec float-left">
                                <div class="count float-left">${day}</div>
                                <div class="date-con d-inline-block">
                                    <span>${month}</span>
                                    <small class="d-block">${time}</small>
                                </div>
                            </div>
                            <div class="detail-sec d-flex align-items-center">
                                <figure class="mb-0">
                                    <img src="${event.image_url}" alt="${event.title}">
                                </figure>
                                <div class="admin-con">
                                    <h5>${event.title}</h5>
                                    <ul class="mb-0 list-unstyled">
                                        <li class="d-inline-block">
                                            <i class="fas fa-user"></i> By: ${event.author || 'Unknown'}
                                        </li>
                                    </ul>
                                    <a href="event-detail.php?id=${event.id}" class="read-more-btn">Read More</a>
                                </div>
                            </div>
                        </div>`;
                });

                // إضافة المحتوى إذا كان العنصر موجودًا
                if (container) {
                    container.innerHTML = content;
                }
            })
            .catch(error => {
                console.error('Error fetching events:', error);
            });
    });
</script>







   <!--blog-sec-->
   <!--footer-sec-->
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
               <li class="d-inline-block"><a class="text-white" href="gallery.php">GALLERY</a></li>
               <li class="d-inline-block"><a class="text-white" href="event-detail.html">EVENT DETAILS</a></li>
               <li class="d-inline-block"><a class="text-white" href="contact.html">CONTACT</a></li>
            </ul>
            <div class="footer-social-sec text-center">
               <a href="index.html">
                  <figure>
                     <img src="assets/images/Confrico.png" alt="Confrico">
                  </figure>
               </a>
               <ul class="list-unstyled p-0">
                  <li class="d-inline-block"><a class="d-inline-block" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                  <li class="d-inline-block"><a class="d-inline-block" href="https://twitter.com/i/flow/login"><i class="fab fa-twitter"></i></a></li>
                  <li class="d-inline-block"><a class="d-inline-block" href="https://www.linkedin.com/login"><i class="fab fa-linkedin-in"></i></a></li>
                  <li class="d-inline-block"><a class="d-inline-block" href="https://www.instagram.com/accounts/login/"><i class="fab fa-instagram"></i></a></li>
                  <li class="d-inline-block"><a class="d-inline-block" href="https://www.pinterest.com/login/"><i class="fab fa-pinterest-p"></i></a></li>
               </ul>
               <span class="text-white d-inline-block">Copyright 2023, Confrico. All Rights Reserved.</span>
            </div>
         </div>
         <!--form-sec-->

      </div>
   </section>
   <!--footer-sec-->

   <script src="assets/js/jquery-3.6.0.min.js"></script>
   <!-- <script src="assets/js/jquery-3.2.1.slim.min.js"></script> -->
   <script src="assets/js/popper.min.js"></script>
   <script src="assets/js/bootstrap.min.js"></script>
   <script src="assets/js/wow.js"></script>
   <script>
      new WOW().init();
   </script>
</body>

</html>