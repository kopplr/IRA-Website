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
$nonce_unverified= "Sorry, your nonce did not verify. This is a secure Wordpress website.";
$email_invalid   = "Email Address Invalid.";
$message_unsent  = "Message was not sent. Try again or email irahelp@mcmaster.ca directly";
$message_sent    = "Thanks! Your message has been sent.";

//user posted variables
$name = $_POST['message_name'];
$email = $_POST['message_email'];
$message = PHP_EOL . $_POST['message_text'];

$phone = $_POST['message_phone'];
$department = $_POST['message_department'];
$purpose = $_POST['message_purpose'];
$time_period = $_POST['message_time_period'];
$delivery = $_POST['message_delivery'];

$human = $_POST['message_human'];

//php mailer variables
$to = 'irahelp@mcmaster.ca';
$subject = $name . " sent a message to the " . get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" .
  'Reply-To: ' . $email . "\r\n";

//validation
if(!empty($delivery)){$message = 'Delivery Date and Format: ' . $delivery . PHP_EOL . $message;}
if(!empty($time_period)){$message = 'Time Period of Requested Data: ' . $time_period . PHP_EOL . $message;}
if(!empty($purpose)){$message = 'Purpose and Who will be using the Report: ' . $purpose . PHP_EOL . $message;}
if(!empty($department)){$message = 'Department and Relationship to McMaster: ' . $department . PHP_EOL . $message;}
if(!empty($phone)){$message = 'Phone Number: ' . $phone . PHP_EOL . $message;}

if(isset($_POST['submit-request-nonce'])){
    if(wp_verify_nonce($_POST['submit-request-nonce'], 'submit-request-nonce')){

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

    }
    else {
        my_contact_form_generate_response("error", $nonce_unverified);
    }
}

?>
<?php get_header(); ?>

<div class="site-title" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/arch_skinny.jpeg);">

    <div style="flex: 1;" ></div>
    <div style="flex: 1; order: 99;"></div>
    <div style="flex: 1 1 1000px">
        <?php while ( have_posts() ) : the_post(); ?>
        <h2><?php the_title(); ?></h2>
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



                <div id="respond">
                    <?php echo $response;  ?>
                    <form action="<?php the_permalink(); ?>" method="post">
                        <div style="display:flex; flex-wrap: wrap; justify-content: space-between;">

                        <div id="name">
                            <h3><label for="name-form">Name <span>*</span></label></h3>
                            <input id="name-form" class="required-field" type="text" name="message_name" value="<?php echo ( isset( $_POST['message_name'] )) ? esc_attr($_POST['message_name']) : ''; ?>">
                        </div>

                        <div id="email">
                        <h3><label for="email-form">Email <span>*</span></label></h3>
                        <input id="email-form" class="required-field" type="text" name="message_email" value="<?php echo ( isset( $_POST['message_email'] ) ) ? esc_attr($_POST['message_email']) : ''; ?>">
                        </div>

                        </div>
                        <div class="not-required-fields">

                        <div class="form-entry">
                            <label for="phone-form">Phone Number</label>
                            <input id="phone-form" type="text" name="message_phone" value="<?php echo ( isset( $_POST['message_phone'] ) ) ? esc_attr($_POST['message_phone']) : ''; ?>">
                        </div>

                        <div class="form-entry">
                            <label for="department-form">Department and Relationship to McMaster</label>
                            <input id="department-form" type="text" name="message_department" value="<?php echo ( isset( $_POST['message_department'] ) ) ? esc_attr($_POST['message_department']) : ''; ?>">
                        </div>

                        <div class="form-entry">
                            <label for="purpose-form">Purpose and Who will be using the Report</label>
                            <input id="purpose-form" type="text" name="message_purpose" value="<?php
                            echo ( isset( $_POST['message_purpose'] ) ) ? esc_attr($_POST['message_purpose']) : ''; ?>">
                        </div>

                        <div class="form-entry">
                            <label for="time-period-form">Time Period of Requested Data</label>
                            <input id="time-period-form" type="text" name="message_time_period" value="<?php
                            echo ( isset( $_POST['message_time_period'] ) ) ? esc_attr($_POST['message_time_period']) : ''; ?>">
                        </div>

                        <div class="form-entry">
                            <label for="delivery-form">Delivery Date and Format</label>
                            <input id="delivery-form" type="text" name="message_delivery" value="<?php
                            echo ( isset( $_POST['message_delivery'] ) ) ? esc_attr($_POST['message_delivery']) : ''; ?>">
                        </div>

                        </div>

                        <h3><label for="message-text-form">Message <span>*</span></label></h3>
                        <textarea id="message-text-form" class="required-field" rows="10" type="text" name="message_text"><?php echo ( isset( $_POST['message_text'] ) ) ? esc_textarea($_POST['message_text']) : ''; ?></textarea>

                        <div style="display:flex; flex-wrap: wrap;">
                            <div id="human-verification" style="">
                                <h3><label for="human-verification-form">Human Verification <span>*</span></label></h3>
                                <input id="human-verification-form" class="required-field" type="text" style="width: 60px;" name="message_human"> + 3 = 11
                            </div>


                        <input type="hidden" name="submitted" value="1">

                        <p id="submit-button"style=""><input type="submit" value="submit"></p>
                        </div>

                        <input type="hidden" name="submit-request-nonce" value="<?php echo wp_create_nonce('submit-request-nonce')?>">

                    </form>
                </div>
            </div><!-- .entry-content -->

            <?php endwhile; // end of the loop. ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>

