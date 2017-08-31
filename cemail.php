<?php



include('session.php');

//if(isset($login_session)){
//    echo "set";
//}else {
//    echo "unset";
//}

include("./xmlapi.php");   //XMLAPI cpanel client class
// Default whm/cpanel account info

$ip = "";           // should be WHM ip address
$account = "";        // cpanel user account name
$passwd = "";        // cpanel user password
$port = 2082;                 // cpanel secure authentication port unsecure port# 2082

$email_domain = 'trustsmartsl.com'; // email domain (usually same as cPanel domain)
$email_quota = 500; // default amount of space in megabytes


/* * ***********End of Setting********************** */

function getVar($name, $def = '') {
    if (isset($_REQUEST[$name]))
        return $_REQUEST[$name];
    else
        return $def;
}

// check if overrides passed
$email_user = getVar('user', '');
$email_pass = getVar('pass', $passwd);
$email_vpass = getVar('vpass', $vpasswd);
$email_domain = getVar('domain', $email_domain);
$email_quota = getVar('quota', $email_quota);

$msg = '';
if (!empty($email_user))
    while (true) {


        if ($email_pass !== $email_vpass) {       //check password
            $msg = "Email password does not match";
            break;
        }

        $xmlapi = new xmlapi($ip);

        $xmlapi->set_port($port);  //set port number. cpanel client class allow you to access WHM as well using WHM port.

        $xmlapi->password_auth($account, $passwd);   // authorization with password. not as secure as hash.
// cpanel email addpop function Parameters
        $call = array(domain => $email_domain, email => $email_user, password => $email_pass, quota => $email_quota);

        $xmlapi->set_debug(0);      //output to error file  set to 1 to see error_log.

        $result = $xmlapi->api2_query($account, "Email", "addpop", $call); // making call to cpanel api
//for debugging purposes. uncomment to see output
//echo 'Result\n<pre>';
//print_r($result);  
//echo '</pre>';

        if ($result->data->result == 1) {
            $msg = $email_user . '@' . $email_domain . ' account created';
        } else {
            $msg = $result->data->reason;
            break;
        }

        break;
    }
?>
<html>
    <head><title>iDeacurl Email Account Creator</title>
<?php include 'inc/header.php'; ?>
    </head>
    <body>
<?php echo '<div style="color:red; text-align:center; font-size:18px;">' . $msg . '</div>'; ?>
        <h1 align=center>Email Account Creator</h1>
        <form name="frmEmail" method="post">
            <table align=center width="400" border="0">
                <tr><td>Username:</td><td><input class="form-control" name="user" size="20" type="text" /></td></tr>
                <tr><td>Password:</td><td><input class="form-control" name="pass" size="20" type="password" /></td></tr>
                <tr><td>Verify Password:</td><td><input class="form-control" name="vpass" size="20" type="password" /></td></tr>
                <tr><td colspan="2" align="center"><hr /><input class="btn-danger" name="submit" type="submit" value="Create Email" /><br /><br />
                        <a class=btn href='logout.php'>Logout</a>
                    </td>
                </tr>

            </table>
        </form>
<?php include 'inc/footer.php'; ?>