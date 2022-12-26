<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('frontend/css/otp-mail.css')}}">
</head>

<body width="100%" class="get-secret-body">
    <center class="w-100 bg-white">
        <div class="get-secret-ghost">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div class="email-container get-secret-email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="ma">
                <tr class="get-secret-email-container-tr">
                    <td valign="top" class="bg_white" class="email-container-table-wrapper">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td class="logo text-center">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
                <tr>
                    <td valign="middle" class="hero bg_white get-secret-hero">
                        <p class="fs-14px">Hi</p>
                        <p class="fs-14px">You are receiving this email because a new email verification code was requested for your getting your shared
                            secret. Please enter code in your input form:</p>
                        <p class="fs-32px text-center">{{ $otp }}</p>
                        <p class="fs-14px">If you did not request a new email verification code, ignore this email.</p>
                        <p class="fs-14px">Thank you for choosing {{ env('APP_URL') }} - Your cybersecurity self-defense platform.</p>
                        <br>
                        <p class="fs-14px">Visit us at: {{ env('APP_URL') }}</p>
                        <br>
                        <br>
                        <p class="fs-14px">Please do not reply to system mail</p>

                    </td>
                </tr><!-- end tr -->
            </table>
        </div>
    </center>
</body>

</html>