<?php
// Mail Configuration

$config['protocol']    = 'smtp';
$config['smtp_host']    = getMailConfiguration()['smtp_host'];
$config['smtp_port']    = getMailConfiguration()['smtp_port'];
$config['smtp_timeout'] = getMailConfiguration()['smtp_timeout'];
$config['smtp_user']    = getMailConfiguration()['smtp_user'];
$config['smtp_pass']    = getMailConfiguration()['smtp_pass'];
$config['charset']    = getMailConfiguration()['smtp_charset'];
$config['newline']    = getMailConfiguration()['smtp_newline'];
$config['mailtype'] = getMailConfiguration()['smtp_mailtype'];
$config['validation'] = getMailConfiguration()['smtp_validation'];