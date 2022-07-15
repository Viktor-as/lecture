                     <table class="table table-bordered table-hover">

                           <thead>

                               <tr>

                                   <th>Mokymų iliustracija</th>

                                   <th>Pavadinimas</th>

                                   <th>Mokymų registracijos pabaiga</th>

								   <th>Mokymų pradžios data</th>

                                    <th>Pašalinti?</th>

                               </tr>

                           </thead>

                           <tbody>

                               

                               

<?php



require_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php'); 

$connection = new mysqli(constant("DB_HOST"), constant("DB_USER"), constant("DB_PASSWORD"), constant("DB_NAME"));


if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

 

$current_user = wp_get_current_user();

$current_user_id = $current_user->ID;



$query = "SELECT * FROM wpp_wishlist WHERE wishlist_user_id = $current_user_id";

$select_wishlist_query = mysqli_query($connection,$query);



while($row = mysqli_fetch_assoc($select_wishlist_query)){



    $wishlist_id = $row['wishlist_id'];

    $wishlist_user_id = $row['wishlist_user_id'];

    $wishlist_event_id = $row['wishlist_event_id'];    



$events_title = get_the_title($wishlist_event_id);

$events_name = get_post_meta( $wishlist_event_id, 'events-name' );

//$events_deadline = get_the_date( 'l F j, Y', $wishlist_event_id  );

$events_deadline = get_post_meta( $wishlist_event_id, 'events-date' );

$events_deadline = date_i18n('l F j, Y', $events_deadline[0] );

$events_start = get_post_meta( $wishlist_event_id, 'events-start-date' );

$events_start = date_i18n('l F j, Y', $events_start[0] );

$event_link = get_permalink($wishlist_event_id);



$events_image2 = get_the_post_thumbnail( $wishlist_event_id );



 echo "<tr>";

	echo "<td class=" . "wishlist_td_image" . "><img width=100 src=" . $events_image2 . " </td>";

   echo "<td><a href='$event_link'>$events_title</a></td>";

   echo "<td>$events_deadline</td>";

   echo "<td>$events_start</td>";



$url = $_SERVER['REQUEST_URI'];

echo "<td><a href='?delete=$wishlist_id' >Pašalinti</a></td>";

    echo "</tr>";





}



?>    

<?php                                 

// DELETE POST

if(isset($_GET['delete'])){

$wishlist_id_to_delete = $_GET['delete'];



$query = "DELETE FROM wpp_wishlist WHERE wishlist_id = $wishlist_id_to_delete";    

$the_delete_query = mysqli_query($connection, $query);    

?> <script>window.location.href = "/profilis/";</script>  <?php

}

?>                                                                

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>                            

                                  

                                  

                           

                           </tbody>

                       </table>