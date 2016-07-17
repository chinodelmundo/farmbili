<?php 
    return array(
      'driver' => 'smtp',
      'host' => 'smtp.gmail.com',
      'port' => 465,
      'from' => array('address' => 'farmbili.emailer@gmail.com', 'name' => 'FarmBili Emailer'),
      'encryption' => 'ssl',
      'username' => 'farmbili.emailer@gmail.com',
      'password' => 'bfxwewqjvqrbtkmw',
      'sendmail' => '/usr/sbin/sendmail -bs',
      'pretend' => false,
    );
?>