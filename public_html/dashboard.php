<?php
    // =========================================================================
    // System     : LiqSec
    // Repository : https://github.com/christian-westbrook/liqsec.git
    // File       : dashboard.php
    // Developers : Nathan Brown, Nicholas Leonard, and Christian
    // Version    : Pre-release
    // Abstract   : Member center for LiqSec
    // =========================================================================

    $css = array(
				    0 => 'dashboard'
	    	    );

    // Import statements
    include 'header.php';
    include 'database.php';

    if($sessionStarted == false)
    {
       header('Location: /~iot3/');
    }

    $sql = 'SELECT * FROM DEVICES WHERE USER_ID = :USER_ID';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":USER_ID", $_SESSION['USER_ID'], PDO::PARAM_INT);

    if($stmt->execute())
    {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_POST['devices'] = $results;
    }
?>

<div id="container">
    <h1>Dashboard</h1>

    <?php
        $devices = $_POST['devices'];

        $length = count($devices);
        for($i = 0; $i < $length; $i++)
        {
            echo '<div class="device"><p class="devname">' . $devices[$i]['NAME'] . '</p></div>';
        }
    ?>
</div>

<?php
    include 'footer.php';
?>
