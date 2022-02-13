<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <!--[if mso]>
                    <xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml>
                    <style>
                      td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
                    </style>
                  <![endif]-->
    <title>Greetings from {{ env('APP_MAIN_NAME') }} 👋</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        .hover-underline:hover {
            text-decoration: underline !important;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        @keyframes pulse {
            50% {
                opacity: .5;
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: none;
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        @media (max-width: 600px) {
            .sm-leading-32 {
                line-height: 32px !important;
            }

            .sm-px-24 {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }

            .sm-py-32 {
                padding-top: 32px !important;
                padding-bottom: 32px !important;
            }

            .sm-w-full {
                width: 100% !important;
            }
        }

    </style>
</head>

<body
    style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; --bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity));">
    <div role="article" aria-roledescription="email" aria-label="Welcome to {{ env('APP_MAIN_NAME') }} 👋" lang="en">
        <table style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; width: 100%;" width="100%"
            cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td align="center"
                    style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;"
                    bgcolor="rgba(236, 239, 241, var(--bg-opacity))">
                    <table class="sm-w-full" style="font-family: 'Montserrat',Arial,sans-serif; width: 600px;"
                        width="600" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                            <td class="sm-py-32 sm-px-24"
                                style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; padding: 48px; text-align: center;"
                                align="center">
                                <a href="https://grapegames.net">
                                    <img src="https://hrm.fast-devs.com/assets/img/logo2.png" width="155"
                                        alt="{{ env('APP_MAIN_NAME') }} Admin"
                                        style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" class="sm-px-24"
                                style="font-family: 'Montserrat',Arial,sans-serif;">
                                <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%"
                                    cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td class="sm-px-24"
                                            style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));"
                                            bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
                                            <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Hey ! 😃</p>
                                            <p
                                                style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #ff5850; color: rgba(255, 88, 80, var(--text-opacity));">
                                            </p>
                                            <p class="sm-leading-32"
                                                style="font-weight: 600; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                                                You are receiving this email because we received a password reset
                                                request for your account. 👍
                                            </p>
                                            @component('mail::button', ['url' => $actionUrl, 'color' => 'red'])
                                                {{ $actionText }}
                                            @endcomponent
                                            <p style="margin: 24px 0;">
                                                This password reset link will expire in 60 minutes.

                                                If you did not request a password reset, no further action is required.
                                            </p>
                                            <a href="https://grapegames.net">
                                                <img src="https://hrm.fast-devs.com/assets/img/job-letter.png"
                                                    width="500" alt="{{ env('APP_MAIN_NAME') }}"
                                                    style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;">
                                            </a>
                                            <p style="margin: 24px 0;">
                                                <span style="font-weight: 600;">{{ env('APP_MAIN_NAME') }}</span>
                                                is a software company based in Pakistan providing premier
                                                services that believes in providing the best solutions to every IT
                                                related query which includes Applications and highly appealing 3D Games
                                                For IOS And Android with finest Digital Marketing Services. The mobile
                                                application services involve the development of all types of technical
                                                and general applications. Whereas, the website development services
                                                include the development of every category of website with its unique
                                                layout. Moreover, we are providing digital marketing services. 🤩
                                            </p>
                                            <table style="font-family: 'Montserrat',Arial,sans-serif;" cellpadding="0"
                                                cellspacing="0" role="presentation">
                                                <tr>
                                                    <td style="mso-padding-alt: 16px 24px; --bg-opacity: 1; background-color: #7367f0; background-color: rgba(115, 103, 240, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;"
                                                        bgcolor="rgba(115, 103, 240, var(--bg-opacity))">
                                                        <a href="https://grapegames.net" class="btn btn-primary"
                                                            style="display: block; font-weight: 600; font-size: 14px; line-height: 100%; padding: 16px 24px; --text-opacity: 1; color: #ffffff; color: rgba(255, 255, 255, var(--text-opacity)); text-decoration: none;">
                                                            View Grape Games Site &rarr;</a>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;"
                                                width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                <tr>
                                                    <td
                                                        style="font-family: 'Montserrat',Arial,sans-serif; padding-top: 32px; padding-bottom: 32px;">
                                                        <div
                                                            style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); height: 1px; line-height: 1px;">
                                                            &zwnj;</div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <p style="margin: 0 0 16px;">Thanks, <br>The {{ env('APP_MAIN_NAME') }}
                                                Team
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: 'Montserrat',Arial,sans-serif; height: 20px;"
                                            height="20"></td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 12px; padding-left: 48px; padding-right: 48px; --text-opacity: 1; color: #eceff1; color: rgba(236, 239, 241, var(--text-opacity));">
                                            <p align="center" style="cursor: default; margin-bottom: 16px;">
                                                <a href="https://www.facebook.com/{{ env('APP_MAIN_NAME') }}s"
                                                    style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img
                                                        src="https://pixinvent.com/demo/vuexy-mail-template/images/facebook.png"
                                                        width="17" alt="Facebook"
                                                        style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                                                &bull;
                                                <a href="https://twitter.com/{{ env('APP_MAIN_NAME') }}s"
                                                    style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img
                                                        src="https://pixinvent.com/demo/vuexy-mail-template/images/twitter.png"
                                                        width="17" alt="Twitter"
                                                        style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                                                &bull;
                                                <a href="https://www.instagram.com/{{ env('APP_MAIN_NAME') }}s"
                                                    style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img
                                                        src="https://pixinvent.com/demo/vuexy-mail-template/images/instagram.png"
                                                        width="17" alt="Instagram"
                                                        style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: 'Montserrat',Arial,sans-serif; height: 16px;"
                                            height="16"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        {{-- Subcopy --}}
        @isset($actionText)
            @lang(
            "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
            'into your web browser:',
            [
            'actionText' => $actionText,
            ]
            )
        @endisset
    </div>
</body>

</html>
