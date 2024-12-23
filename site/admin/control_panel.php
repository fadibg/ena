<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch members
$stmt = $pdo->prepare("SELECT * FROM members");
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch gallery images
$stmt = $pdo->prepare("SELECT * FROM gallery");
$stmt->execute();
$gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch events
$stmt = $pdo->prepare("SELECT * FROM events");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">




    <style>
        #map {
            height: 400px;
            width: 100%;
        }
        .tab-container {
            display: flex;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-bottom: none;
            background-color: #f1f1f1;
            margin-right: 5px;
        }

        .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        .active {
            background-color: #fff;
            border-bottom: 1px solid white;
        }

        .active-content {
            display: flex;
        }
    </style>
</head>
<body>
    <div class="control-panel-container">
        <h1>Admin Control Panel</h1>
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>

        <div class="tab-container">
            <div class="tab active" onclick="showTab('members')">Manage Members</div>
            <div class="tab" onclick="showTab('gallery')">Manage Gallery</div>
            <div class="tab" onclick="showTab('events')">Manage Events</div>
        </div>

        <div id="members" class="tab-content active-content">
            <!-- Manage Members -->
            <h2>View Members</h2>
            <form action="process.php" method="POST">
                <button type="submit" name="generate_pdf">Generate PDF</button>
            <table>
                <thead>
                    <tr>
                        <th>CK</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Membership Type</th>
                        <th>Register date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $member): ?>
                        <form action="delete_member.php" method="POST">
                    <tr>
                        <td><label><input type="checkbox" name="options[]" value="<?= $member['id'] ?>"></label></td>
                        <td><?= $member['fullName'] ?></td>
                        <td><?= $member['email'] ?></td>
                        <td><?= $member['membershipType'] ?></td>
                        <td><?= $member['registration_date'] ?></td>
                        <td>

                                <input type="hidden" name="member_id" value="<?= $member['id'] ?>">
                                <button type="submit">Delete</button>

                        </td>
                    </tr>
                    </form>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </form>
        </div>

        <div id="gallery" class="tab-content">
            <!-- Manage Gallery -->
            <h2>Manage Gallery</h2>
            <form action="add_image.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Image Title" required>
                <input type="file" name="image" required>
                <button type="submit">Add Image</button>
            </form>

            <h3>Gallery Images</h3>
            <div class="gallery">
                <?php foreach ($gallery as $image): ?>
                    <div class="gallery-item">
                        <img src="../uploads/gallery/<?= $image['image'] ?>" alt="<?= $image['title'] ?>">
                        <p><?= $image['title'] ?></p>
                        <form action="delete_image.php" method="POST">
                            <input type="hidden" name="image_id" value="<?= $image['id'] ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="events" class="tab-content">
    <!-- Manage Events -->
    <h2>Manage Events</h2>
    <form action="add_event.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
        <label for="title">Event Title:</label>
        <input type="text" id="title" name="title" placeholder="Enter event title" required>
                </li>
                <li>
        <label for="description">Event Description:</label>
        <textarea id="description" name="description" placeholder="Enter event description" required></textarea>
        </li>
        <li>
        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" required>
        </li>
        <li>
        <label for="end_event">End Event Date:</label>
        <input type="date" id="end_event" name="end_event" required>
        </li>
        <li>
        <label for="created_by">Created By:</label>
        <input type="text" id="created_by" name="created_by" placeholder="Created by Mr./Ms." required>
        </li>
        <li>
        <label for="locationName">Location Name:</label>
        <input type="text" id="locationName" name="location" placeholder="Pick a location on the map" readonly required>
        </li>
        <li>
        <label for="locationLink">Google Maps URL:</label>
        <input type="text" id="locationLink" name="url_location" placeholder="Pick a location on the map" readonly required>
        </li>
        <li>
        <label for="image_url">Upload Event Image:</label>
        <input type="file" id="image_url" name="image_url" accept="image/*" required>
        </li>
        <li>
        <!-- <h2>Pick a Location on Google Maps</h2>
        <button type="button" id="openMap">Pick Location</button> -->

        <!-- Modal for Google Map -->
        <!-- <div id="mapModal" style="display:none;">
            <div id="map" style="width:100%; height:400px;"></div>
            <button id="confirmLocation">Confirm Location</button>
            <button id="closeMap">Close</button>
        </div>

        <script>
            let map;
            let marker;
            let selectedLocation;

            document.getElementById('openMap').addEventListener('click', function () {
                document.getElementById('mapModal').style.display = 'block';

                map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: 25.276987, lng: 55.296249 },
                    zoom: 13,
                });

                map.addListener('click', function (event) {
                    if (marker) {
                        marker.setPosition(event.latLng);
                    } else {
                        marker = new google.maps.Marker({
                            position: event.latLng,
                            map: map,
                        });
                    }

                    selectedLocation = event.latLng;

                    const geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ location: event.latLng }, function (results, status) {
                        if (status === 'OK' && results[0]) {
                            document.getElementById('locationName').value = results[0].formatted_address;
                            document.getElementById('locationLink').value = `https://www.google.com/maps/?q=${selectedLocation.lat()},${selectedLocation.lng()}`;
                        } else {
                            document.getElementById('locationName').value = 'Unknown location';
                        }
                    });
                });
            });

            document.getElementById('confirmLocation').addEventListener('click', function () {
                document.getElementById('mapModal').style.display = 'none';
            });

            document.getElementById('closeMap').addEventListener('click', function () {
                document.getElementById('mapModal').style.display = 'none';
            });
        </script> -->
                </li>
                </ul>
        <button type="submit">Add Event</button>
    </form>

    <h3>Upcoming Events</h3>
    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <strong><?= $event['title'] ?></strong><br>
                <?= $event['description'] ?><br>
                Date: <?= $event['event_date'] ?><br>
                Location: <?= $event['location'] ?>
                <a href="<?= $event['url_location'] ?>" target="_blank">View on Map</a><br>

                <form action="delete_event.php" method="POST" style="display:inline;">
                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    function showTab(tabId) {
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.classList.remove('active');
        });

        tabContents.forEach(content => {
            content.classList.remove('active-content');
        });

        document.querySelector(`#${tabId}`).classList.add('active-content');
        event.target.classList.add('active');
    }
</script>

</body>
</html>
