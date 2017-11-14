<?php
/**
 * Created by PhpStorm.
 * User: himanshu
 * Date: 9/1/2017
 * Time: 5:58 PM
 */
?>
<h1>User Info</h1>

<label for="">Hello, <?= $info->first_name; ?></label>
<br>

<p>Username : <?= $info->username ?></p>
<p>Password : <?= $info->raw_password ?></p>
