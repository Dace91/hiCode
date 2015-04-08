<?php

$hasError = [];
$hasSend = false;

if (!empty($_POST)) {

    $dataSanitize = [];
    $hasToken = true;
    
    // test token
    if (!wp_verify_nonce($_POST['contact_site_nonce'], 'contact_site_action')) {
        $hasToken = false;
    }

    // test email
    $email = sanitize_email($_POST['email']);
    if (!is_email($email)) {
        $hasError['email'] = 'email invalid';
    } else {
        $dataSanitize['email'] = $email;
    }

    // test message
    $message = esc_textarea($_POST['message']);
    if (empty($message)) {
        $hasError['message'] = 'vous devez laisser un message';
    } else {
        $dataSanitize['message'] = $message;
    }

    // ATTENTION DANS LE FICHIER functions.php
    if (empty($hasError) && $hasToken) {
        $html = $message;
        $headers = [];
        $headers[] = 'From : gomobility <' . $email . '>' . "\r\n";
        if (wp_mail('antoine.lucsko@gmail.com', '[Gomobility] Contact', $html, $headers)) {
            $hasSend = true;
        }else{
            // todo log
        }
    }
}
?>
<?php get_header('nologo'); ?>
<div class="container content">
    <div class="row content">
        <div class="col-xs-8">
            <?php if (!$hasSend): ?>
                <h2>Laissez un message</h2>
                <form role="form" action="<?php the_permalink(); ?>"  method="post" >
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input value="<?php echo (!empty($dataSanitize ['email']))? $dataSanitize['email'] : ''; ?>" name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        <?php echo (!empty($hasError['email']))? '<p>'.$hasError['email'].'</p>' : ''; ?>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="3"><?php echo (!empty($dataSanitize['message']))? $dataSanitize['message'] : ''; ?></textarea>
                        <?php echo (!empty($hasError['message']))? '<p>'.$hasError['message'].'</p>' : ''; ?>
                    </div>
                    <?php wp_nonce_field('contact_site_action', 'contact_site_nonce'); ?>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            <?php else: ?>
                <p>Merci pour votre message</p>
            <?php endif; ?>
        </div>
    </div>
</div><!-- content -->
<?php get_footer(); ?>
