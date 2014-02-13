<?php

/*
 * What protocol to use?
 * mail, sendmail, smtp
 */
$config['protocol'] = 'mail';

/*
 * SMTP server address and port
 */
$config['smtp_host'] = '127.0.0.1';
$config['smtp_port'] = '25';

/*
 * SMTP username and password.
 */
$config['smtp_user'] = 'smtpuser';
$config['smtp_pass'] = 'smtppass';

/*
 * Heroku Sendgrid information.
 */
/*
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.sendgrid.net';
$config['smtp_port'] = 587;
$config['smtp_user'] = $_SERVER['SENDGRID_USERNAME'];
$config['smtp_pass'] = $_SERVER['SENDGRID_PASSWORD'];
*/

$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html';
