







<script> 



function myFunction() {

  var checkBox = document.getElementById("myCheck");

  var text = document.getElementById("text");



  if (checkBox.checked == true){

    text.style.display = "block";

  } else {

    text.style.display = "none";

  }

}











</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');  



$connection = new mysqli(constant("DB_HOST"), constant("DB_USER"), constant("DB_PASSWORD"), constant("DB_NAME"));


if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

$current_user = wp_get_current_user();

$current_user_id = $current_user->ID;



$current_post = get_post();

$current_post_id = $current_post->ID;



$query = "SELECT * FROM wpp_wishlist_subscribers WHERE user_id = $current_user_id";

$check_wishlist_query = mysqli_query($connection,$query);

   



$rowcount=mysqli_num_rows($check_wishlist_query);

if($rowcount > 0){

	?>

	

	<form action="" method="post">

	Jei norite atšaukti priminimus spauskite 

 <button id="createBtn" type="submit" name="delete_from_subscribers" class="btn btn-default">

                <i id="deleteicon" class="fas fa-envelope"></i> Atšaukti

                </button>

 

 </form>

	<?php

	if(isset($_POST['delete_from_subscribers'])){

$query = "DELETE FROM wpp_wishlist_subscribers WHERE user_id = $current_user_id";    

$the_delete_query = mysqli_query($connection, $query);    

	

	?>

<script>

location.reload();

</script>

<?php

	}

	

	

} else {

	

	?>

 <form action="" method="post">

 Gaukite priminimą apie mokymus paskutinę registracijos dieną! 

 <button id="createBtn" type="submit" name="add_to_subscribers" class="btn btn-default">

                <i id="addicon" class="fas fa-envelope"></i> Gauti

                </button>

 

 </form>

 <?php

 

if(isset($_POST['add_to_subscribers'])){







$query = "INSERT INTO wpp_wishlist_subscribers(user_id,subscribed)";

$query .= "VALUES ('{$current_user_id}','1')";

$add_subscriber_query = mysqli_query($connection,$query);

?>

<script>

location.reload();

</script>

<?php





	

	

}









}

?>