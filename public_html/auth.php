<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : auth.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Allows users to log in to LiqSec.
    // =========================================================================

    $css = array(
				    0 => 'auth'
	    	    );

    include 'header.php';
?>

<div id="container">
    <p id="label"><b>Log In</b></p>
    <form action="php/login-script.php" method="POST">
        <input type="text" name="email" placeholder="Email" class="field" /></br>
        <input type="password" name="password" placeholder="Password" class="field" /></br>
        <input type="submit" value="Log In" class="field" />
    </form>

    <?php
        if($_GET['error'] == '1')
        {
            echo '<p id="error"><b>Unable to contact LiqSec servers</b></p>';
        }
        else if($_GET['error'] == '2')
        {
            echo '<p id="error"><b>Invalid email or password</b></p>';
        }
    ?>
</div>

<?php
    include 'footer.php';
?>
