<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{ config('app.name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');

body {
    background-color: #fdf2f8;
    color: #4b5563;
    font-family: 'Nunito', sans-serif;
    -webkit-text-size-adjust: none;
    margin: 0;
    padding: 0;
    width: 100% !important;
}

.wrapper {
    background-color: #fdf2f8;
    margin: 0;
    padding: 30px;
    width: 100%;
}

.content {
    margin: 0;
    padding: 0;
}

.header {
    padding: 25px 0;
    text-align: center;
}

.header a {
    color: #ec4899;
    font-size: 19px;
    font-weight: bold;
    text-decoration: none;
}

.logo {
    height: 75px;
    max-height: 75px;
    width: auto;
}

.body {
    background-color: #ffffff;
    border-bottom: 1px solid #fbcfe8;
    border-top: 1px solid #fbcfe8;
    margin: 0;
    padding: 0;
    width: 100%;
}

.inner-body {
    background-color: #ffffff;
    border-color: #fbcfe8;
    border-radius: 16px;
    border-width: 1px;
    box-shadow: 0 4px 6px rgba(236, 72, 153, 0.1);
    margin: 0 auto;
    padding: 0;
    width: 570px;
}

.content-cell {
    max-width: 100vw;
    padding: 32px;
}

.footer {
    margin: 0 auto;
    padding: 0;
    text-align: center;
    width: 570px;
}

.footer p {
    color: #9ca3af;
    font-size: 12px;
    text-align: center;
}

h1 {
    color: #ec4899;
    font-size: 24px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
}

h2 {
    color: #ec4899;
    font-size: 20px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
}

h3 {
    color: #ec4899;
    font-size: 16px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
}

p {
    color: #4b5563;
    font-size: 16px;
    line-height: 1.5em;
    margin-top: 0;
    text-align: left;
}

.button {
    border-radius: 12px;
    display: inline-block;
    font-weight: 600;
    padding: 12px 24px;
    text-decoration: none;
    -webkit-text-size-adjust: none;
}

.button-primary {
    background-color: #ec4899 !important;
    border-bottom: 8px solid #ec4899 !important;
    border-left: 18px solid #ec4899 !important;
    border-right: 18px solid #ec4899 !important;
    border-top: 8px solid #ec4899 !important;
    color: #ffffff;
}

.button-secondary {
    background-color: #fbcfe8;
    border-bottom: 8px solid #fbcfe8;
    border-left: 18px solid #fbcfe8;
    border-right: 18px solid #fbcfe8;
    border-top: 8px solid #fbcfe8;
    color: #ec4899;
}

.panel {
    background-color: #fdf2f8;
    border-left: 4px solid #ec4899;
    border-radius: 8px;
    margin: 21px 0;
}

.panel-content {
    color: #4b5563;
    padding: 16px;
}

.panel-item {
    padding: 0;
}

.panel-item p:last-of-type {
    margin-bottom: 0;
    padding-bottom: 0;
}

.table {
    margin: 30px auto;
    width: 100%;
}

.table th {
    border-bottom: 1px solid #fbcfe8;
    color: #ec4899;
    padding-bottom: 8px;
}

.table td {
    color: #4b5563;
    font-size: 15px;
    line-height: 18px;
    padding: 10px 0;
}

.subcopy {
    border-top: 1px solid #fbcfe8;
    margin-top: 25px;
    padding-top: 25px;
}

.subcopy p {
    color: #9ca3af;
    font-size: 13px;
}

.baby-decoration {
    margin: 15px 0;
    text-align: center;
}

.baby-decoration img {
    height: 30px;
    width: auto;
}

@media only screen and (max-width: 600px) {
    .inner-body {
        width: 100% !important;
    }

    .footer {
        width: 100% !important;
    }
}

@media only screen and (max-width: 500px) {
    .button {
        width: 100% !important;
    }
}
</style>
{{ $head ?? '' }}
</head>
<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    {{ $header ?? '' }}

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        
                                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                                        {{ $subcopy ?? '' }}
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{ $footer ?? '' }}
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
