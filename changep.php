<?php
include('session.php');
?>
<html>
    <title>Change Password</title>
    <?php include 'inc/header.php'; ?>

    <body>
        <div class="middle">
            <form method="POST" class="ajax" action="changepass.php">
                <legend>Change Password</legend>
                <label>Current Password: <br><input class="form-control" type='password' name="curp" /></label><br>
                <label>New Password:<br> <input class="form-control" type='password' name="npass" /></label><br>
                <label>Retype Password: <br><input class="form-control" type='password' name="npassre" /></label><br><br>
                <input type="submit" class="btn"/>
            </form>
            <div id="success"></div>
        </div>
        <script>
            $('form.ajax').on('submit', function() {
//console.log('trigger');
                var that = $(this),
                        url = that.attr('action'),
                        type = that.attr('method'),
                        data = {};

                that.find('[name]').each(function(index, value) {
                    var that = $(this),
                            name = that.attr('name'),
                            value = that.val();

                    data[name] = value;
                });
                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    success: function(response) {
                        $("#success").html("<h3 class='alert alert-warning'>" + response + "</h3>");
                        //console.log(response);
                        $('#success').finish().show().delay(2000).fadeOut("slow");
                        
                    }
                });
                return false;
            });
        </script>
        <?php include 'inc/footer.php'; ?>

