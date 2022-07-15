



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    

<?php    

require_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php'); 





$connection = new mysqli(constant("DB_HOST"), constant("DB_USER"), constant("DB_PASSWORD"), constant("DB_NAME"));

// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

 

$current_user = wp_get_current_user();

$current_user_id = $current_user->ID;



$current_post = get_post();

$current_post_id = $current_post->ID;









$query = "SELECT * FROM wpp_wishlist WHERE wishlist_user_id = $current_user_id AND wishlist_event_id = $current_post_id";

$check_wishlist_query = mysqli_query($connection,$query);

$rowcount=mysqli_num_rows($check_wishlist_query);







if($rowcount > 0){

	

	?>





				<button onclick="location.href='/profilis';" class="btn btn-default">

                <i  class="fas fa-heart" color="red"></i> Mokymai įsiminti, peržiūrėkite sąrašą

                </button>



<?php

} else {

	

	?>



<iframe name="wishlist_button" style="display:none"></iframe>

<p id="statusText"></p>

<form action="" method="post" target="wishlist_button">

				<button id="createBtn" type="submit" name="add_to_wishlist" class="btn btn-default">

                <i  class="fas fa-heart" color="red"></i> Įsiminti mokymus

                </button>

</form>

<?php

if(isset($_POST['add_to_wishlist'])){

$query = "INSERT INTO wpp_wishlist(wishlist_user_id,wishlist_event_id)";

$query .= "VALUES ('{$current_user_id}','{$current_post_id}')";

$insert_wish = mysqli_query($connection,$query);

//header('Location: index.php');

}

}

?>



<script>



			$("#createBtn").click(function () 

{         

            $("#statusText").html("Mokymai sėkmingai įsiminti. <br><a href='/profilis'>Įsimintų mokymų sąrašas</a>");

});

</script>