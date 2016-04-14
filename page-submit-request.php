<?php

//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

}

//response messages
$not_human       = "Human verification incorrect.";
$missing_content = "Please supply all information.";
$email_invalid   = "Email Address Invalid.";
$message_unsent  = "Message was not sent. Try Again.";
$message_sent    = "Thanks! Your message has been sent.";

//user posted variables
$name = $_POST['message_name'];
$email = $_POST['message_email'];
$message = $_POST['message_text'];
$human = $_POST['message_human'];

//php mailer variables
$to = get_option('admin_email');
$subject = "Someone sent a message from ".get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" .
  'Reply-To: ' . $email . "\r\n";

//validation
if(!$human == 0){
    if($human != 8) my_contact_form_generate_response("error", $not_human); //not human!
    else {

        //validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            my_contact_form_generate_response("error", $email_invalid);
        else //email is valid
        {
            //validate presence of name and message
            if(empty($name) || empty($message)){
                my_contact_form_generate_response("error", $missing_content);
            }
            else //ready to go!
            {
                //send email
                $sent = wp_mail($to, $subject, strip_tags($message), $headers);

                if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
                else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent

            }
        }
    }
}
else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);


?>
<?php get_header(); ?>

<div class="site-title">

    <div style="flex: 1;" ></div>
    <div style="flex: 1; order: 99;"></div>
    <div style="flex: 1 1 1000px">
        <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php endwhile; ?>
    </div>

</div>
<div id="main-content">
    <div style="flex: 1;"  ></div>
    <div style="flex: 1; order: 99;"></div>
    <div class="site-content">
        <div class="main-column" style="">
            <?php while ( have_posts() ) : the_post(); ?>

            <div class="entry-content">
                <div id="instructions"><?php the_content(); ?></div>



                <div id="respond">
                    <?php echo $response;  ?>
                    <form action="<?php the_permalink(); ?>" method="post">

                        <p><label for="name"><h3>Name <span>*</span></h3> <br><input type="text" name="message_name" value="<?php echo ( isset( $_POST['message_name'] )) ? esc_attr($_POST['message_name']) : ''; ?>"></label></p>

                        <p><label for="message_email"><h3>Email <span>*</span></h3><br><input type="text" name="message_email" value="<?php echo ( isset( $_POST['message_email'] ) ) ? esc_attr($_POST['message_email']) : ''; ?>"></label></p>

                        <p><label for="message_text"><h3>Message <span>*</span></h3><br><textarea rows="10" type="text" name="message_text"><?php echo ( isset( $_POST['message_text'] ) ) ? esc_textarea($_POST['message_text']) : ''; ?></textarea></label></p>

                        <div style="display:flex;">
                            <div style="">
                                <p><label for="message_human"><h3>Human Verification <span>*</span></h3><br><input type="text" style="width: 60px;" name="message_human"> + 3 = 11</label></p>
                            </div>


                        <input type="hidden" name="submitted" value="1">

                        <p style="display:flex; flex:1; justify-content: flex-end; align-content: center;"><input type="submit"></p>
                        </div>
                    </form>
                </div>

            </div><!-- .entry-content -->

            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>

