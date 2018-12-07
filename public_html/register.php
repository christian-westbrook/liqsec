<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : register.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Allows users to register a new account with LiqSec.
    // =========================================================================

    $css = array(
				    0 => 'register'
	    	    );

    include 'header.php';
?>

<div id="container">
    <form action="php/register-script.php" method="POST">
        <input type="text" name="email" placeholder="Email" class="field" />
        <input type="text" name="fname" placeholder="First Name" class="field" />
        <input type="text" name="lname" placeholder="Last Name" class="field" />
        <input type="password" name="password" placeholder="Password" class="field" />
        <input type="password" name="confirm" placeholder="Confirm" class="field" />
        <input type="submit" value="Sign Up" class="field" />
    </form>
</div>

<?php
    include 'footer.php';
?>
