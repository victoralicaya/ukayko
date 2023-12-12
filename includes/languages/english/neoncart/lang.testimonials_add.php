<?php
/**
 * Testimonials Manager
 *
 * @package Template System
 * @copyright 2007 Clyde Jones
  * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Testimonials_Manager.php v1.5.4
 */

$define = [
    'NAVBAR_TITLE' => 'Add My Testimonial',
    'HEADING_ADD_TITLE' => 'Add My Testimonial',
    'TESTIMONIAL_SUCCESS' => 'Your testimonial has been successfully submitted and will be added to our other testimonials as soon as we approve it.',
    'TESTIMONIAL_SUBMIT' => 'Submit your testimonial using the form below.',
    'EMAIL_SUBJECT' => 'Your Testimonial Submission At ' . STORE_NAME . '.',
    'EMAIL_GREET_NONE' => 'Dear %s' . "\n\n",
    'EMAIL_WELCOME' => 'Thanks for your testimonial submission at <strong>' . STORE_NAME . '</strong>.' . "\n\n",
    'EMAIL_TEXT' => 'Your testimonial has been successfully submitted at ' . STORE_NAME . '. It will be added to our other testimonials as soon as we approve it. You will receive an email about the status of your submittal. If you have not received it within the next 48 hours, please contact us before submitting your testimonial again.' . "\n\n",
    'EMAIL_CONTACT' => 'For help with your testimonial submission, please contact us: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n",
    'EMAIL_WARNING' => '<b>Note:</b> This email address was given to us during a testimonial submission. If you have a problem, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n",
    'EMAIL_OWNER_SUBJECT' => 'Testimonial submission at ' . STORE_NAME,
    'SEND_EXTRA_TESTIMONIALS_ADD_SUBJECT' => '[TESTIMONIAL SUBMISSION]',
    'EMAIL_OWNER_TEXT' => 'A new testimonial was submitted at ' . STORE_NAME . '. It is not yet approved. Please verify this testimonial and activate.' . "\n\n",
    'EMAIL_GV_CLOSURE' => 'Sincerely,' . "\n\n" . STORE_OWNER . "\nStore Owner\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n",
    'EMAIL_DISCLAIMER_NEW_CUSTOMER' => 'This testimonial was submitted to us by you or by one of our users. If you did not submit a testimonial, or feel that you have received this email in error, please send an email to %s ',

    'TABLE_HEADING_TESTIMONIALS' => 'Customer Testimonials',
    'TESTIMONIAL_CONTACT' => 'Contact Information',

    'TEXT_TESTIMONIALS_TITLE' => 'Testimonial Title:&nbsp;',
    'TEXT_TESTIMONIALS_NAME' => 'Your Name:&nbsp;',
    'TEXT_TESTIMONIALS_MAIL' => 'Your Email:&nbsp;',
    'TEXT_TESTIMONIALS_COMPANY' => 'Company Name:&nbsp;',
    'TEXT_TESTIMONIALS_CITY' => 'City:&nbsp;',
    'TEXT_TESTIMONIALS_COUNTRY' => 'State or Country:&nbsp;',
    'TEXT_TESTIMONIALS_HTML_TEXT' => 'Testimonial',
    'TEXT_TESTIMONIALS_DESCRIPTION' => 'Testimonial Text:&nbsp;',
    'TEXT_TESTIMONIALS_DESCRIPTION_INFO' => 'Testimonial Text must be between ' . ENTRY_TESTIMONIALS_TEXT_MIN_LENGTH . ' &amp; ' . ENTRY_TESTIMONIALS_TEXT_MAX_LENGTH . ' characters!',
    'TEXT_CAPTCHA_INFO' => '<div class="testimonialsSmallText">Verification Code is case insensitive</div>',

    'RETURN_REQUIRED_INFORMATION' => ' = Required Information<br />',
    'RETURN_OPTIONAL_INFORMATION' => ' = Optional Information',
    'RETURN_OPTIONAL_IMAGE' => 'optional.png',
    'RETURN_OPTIONAL_IMAGE_ALT' => 'optional information',
    'RETURN_OPTIONAL_IMAGE_HEIGHT' => '12',
    'RETURN_OPTIONAL_IMAGE_WIDTH' => '12',
    'RETURN_REQUIRED_IMAGE' => 'required.png',
    'RETURN_REQUIRED_IMAGE_ALT' => 'required information',
    'RETURN_REQUIRED_IMAGE_HEIGHT' => '12',
    'RETURN_REQUIRED_IMAGE_WIDTH' => '12',
    'RETURN_WARNING_IMAGE' => 'exclamation.gif',
    'RETURN_WARNING_IMAGE_ALT' => 'warning',
    'RETURN_WARNING_IMAGE_HEIGHT' => '16',
    'RETURN_WARNING_IMAGE_WIDTH' => '16',

    'TEXT_TESTIMONIAL_LOGIN_PROMPT' => 'You are required to login or create an account in order to submit a testimonial',
    'ERROR_TESTIMONIALS_NAME_REQUIRED' => '<div class="testimonialsError alert-text">Your Name is Required!</div>',
    'ERROR_TESTIMONIALS_EMAIL_REQUIRED' => '<div class="testimonialsError alert-text">You Must include your E-mail address!</div>',
    'ERROR_TESTIMONIALS_TITLE_REQUIRED' => '<div class="testimonialsError alert-text">A Testimonial Title is Required!</div>',
    'ERROR_TESTIMONIALS_DESCRIPTION_REQUIRED' => '<div class="testimonialsError alert-text">Testimonial is Required!</div>',
    'ERROR_TESTIMONIALS_TEXT_MAX_LENGTH' => '<div class="testimonialsError alert-text">Less than ' . ENTRY_TESTIMONIALS_TEXT_MAX_LENGTH . ' characters!</div>',
    'ERROR_TESTIMONIALS' => 'Errors have occured on your submission! Please correct and re-submit!',
    
];

return $define;