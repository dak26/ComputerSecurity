<?php

echo "<form action='cwUpdatePasswordCheck.php' method='POST'>";

echo "<pre>";

echo "Username: ";
echo "    <input name='txtUsername' type='text'/>";
echo "<br/>";

echo "Old Password: ";
echo "<input name='txtOldPassword' type='password'/>";
echo "<br/>";

echo "New Password: ";
echo "<input name='txtNewPassword' type='password'/>";
echo "<br/>";
echo "<br/>";

echo "<input type='submit' value='Update Password'>";

echo "</pre>";

echo "</form>";

?>