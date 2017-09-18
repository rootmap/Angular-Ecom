<!--Google Login API Javascript functions-->
<?php
$Type = '';
if (isset($_GET['type'])) {
    $Type = $_GET['type'];
}
?>
<script type="text/javascript">

    function logout()
    {
        gapi.auth.signOut();
        location.reload();
    }


    function googleLogin()
    {
        var myParams = {
            'clientid': '948155867752-6kae5etea0qjpcpo2lcftkorv1kccgn3.apps.googleusercontent.com',
            'cookiepolicy': 'single_host_origin',
            'callback': 'loginCallback',
            'approvalprompt': 'force',
            'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email'
        };
        gapi.auth.signIn(myParams);

    }

//loginCallback() function is to check whether user is successfully logged in or not and if do then get response
    function loginCallback(result)
    {
        if (result['status']['signed_in'])
        {
            var request = gapi.client.plus.people.get(
                    {
                        'userId': 'me'
                    });
            request.execute(function (resp)
            {
                var email = '';
                if (resp['emails'])
                {
                    for (i = 0; i < resp['emails'].length; i++)
                    {
                        if (resp['emails'][i]['type'] == 'account')
                        {
                            email = resp['emails'][i]['value'];
                        }
                    }
                }


                var data = new Object();
                data.user_first_name = resp['name']['givenName'];
                data.user_last_name = resp['name']['familyName'];
                data.user_email = email;
                data.user_social_id = resp['id'];
                data.user_gender = resp['gender'];
                data.user_social_types = 'google';
//                data.user_verification = 'yes';
                console.log(data);
                var url = "http://ticketchai.com/ticketchaiorg/ajax/saveFacebookGoogleData.php";



                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        var obj = response;
                        if (obj.output === "success") {
                            document.getElementById("msg").innerHTML = 'Login successfull, please wait...';
                            
                            if (obj.send_mail === "yes") {
                                $.post("./email/googleLogin.php", {'type': 'Facebook.com'}, function (data, status) {
                                    console.log("send mail");
                                    document.location.href = ('' + obj.link);
                                });
                            } else if (obj.send_mail === "no") {
                                document.location.href = ('' + obj.link);
                            } else {
                                document.getElementById("msg").innerHTML = "Something went wrong. Please try again";
                            }


                        } else {
                            error(obj.msg);
                        }

                    },
                    error: function (output) {
                        //alert("not working whole process");
                        document.getElementById("msg").innerHTML = "You can't login with Google";
                    }

                });
            });

        }

    }
    function onLoadCallback()
    {
        gapi.client.setApiKey('AIzaSyD53EmYL-9Tj9d6_jgcOHNHxYSEKPpYUaU');
        gapi.client.load('plus', 'v1', function () {
        });
    }

</script>


<script type="text/javascript">
//      Asynchronous call to google client api

    (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();
</script>
<!--  Google Login API Javascript functions-->