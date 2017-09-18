<div id="fb-root"></div>

<script>

    window.fbAsyncInit = function () {
        FB.init({
            appId: '200818277047626',
            xfbml: true,
            version: 'v2.6'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
//                      js.src = "//connect.facebook.net/en_US/sdk.js";
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    function facebookLogin() {
        //alert('fb');
        FB.login(function (response) {

            if (response.authResponse) {

                FB.api('/me?fields=first_name,last_name,email,gender', function (response) {

                    var data = new Object();
                    data.admin_first_name = response.first_name;
                    data.admin_last_name = response.last_name;
                    data.admin_email = response.email;
                    data.admin_social_id = response.id;
                    data.admin_gender = response.gender;
                    data.admin_social_types = 'facebook';
                    //data.user_verification = 'yes';
                    console.log(data);
                    var url = "http://ticketchai.com/ticketchaiorg/merchant-dashboard/ajax/saveFacebookGoogleData.php";
                    //var urlToMail = mbaseUrl + 'email/SocialLogin.php';
                    data.msg_subject = 'Facebook loging';
                    data.msg = 'Dear user your facebook login was successfuly done';



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
                                    $.post("./email/merchentAccountCreation.php", {'type': 'Facebook.com'}, function (data, status) {
                                        console.log("send mail");
                                        document.location.href = ('' + obj.link);
                                    });
                                } else if (obj.send_mail === "no") {
                                     document.location.href = ('' + obj.link);
                                }else{
                                    document.getElementById("msg").innerHTML = "Something went wrong. Please try again";
                                }



                                // var mbaseUrl = 'ticketchai.org/merchant-dashboard/login.php';



                            } else {
                                document.getElementById("msg").innerHTML = "You can't login with Facebook";
                            }

                        },
                        error: function (output) {
                            //alert("Process Working Stopped");
                            document.getElementById("msg").innerHTML = "Process Working Stopped";
                        }

                    });


                });
                access_token = response.authResponse.accessToken; //get access token
                user_id = response.authResponse.userID; //get FB UID

            } else {
                //user hit cancel button
                //console.log('User cancelled login or did not fully authorize.');
                document.getElementById("msg").innerHTML = "User cancelled login or did not fully authorize.";
            }
        }, {
            scope: 'email'
        });
    }
    (function () {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
    }());





</script>