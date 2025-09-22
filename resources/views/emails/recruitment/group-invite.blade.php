<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Email Pendaftaran</title>

    <style>
        @media only screen and (max-width: 620px) {
            table[width="600"] {
                width: 100% !important;
            }

            td[style*="padding:30px 20px;"] {
                padding: 20px 10px !important;
            }

            td[style*="padding:0 40px 30px 40px;"] {
                padding: 0 10px 20px 10px !important;
            }

            .responsive-img {
                width: 80px !important;
                height: auto !important;
            }

            .responsive-box {
                padding: 12px !important;
                font-size: 16px !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4;">
    <table
        style="background-color:#178ADF; background-image: url('https://i.imgur.com/r76QizC.png'); background-size:cover; background-repeat:no-repeat; padding:40px 0;"
        width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">

                <table
                    style="background-color:#ffffff; border-radius:6px; overflow:hidden; font-family:Arial, sans-serif;"
                    width="600" cellpadding="0" cellspacing="0" border="0">

                    {{-- Header --}}
                    <tr>
                        <td style="padding:30px 20px;" align="center">
                            <img class="responsive-img" src="https://i.imgur.com/foOg2oz.png" alt="DOSCOM"
                                style="display:block; margin-bottom:10px;" width="120">
                            <table role="presentation" style="margin:20px auto;" width="80%" border="0"
                                cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="border-top:1px solid #ddd; font-size:0; line-height:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:0 40px 30px 40px; color:#333;">
                            <h3 style="margin:0; font-weight:bold; font-size: larger;">Hallo, {{ $nama_lengkap }} !</h3>
                            <p style="margin:18px 0 8px 0; font-size:16px; color:#444;">
                                Ketemu lagi nih, silahkan gabung group WhatsApp kita ya:
                            </p>
                            <p style="margin:18px 0 18px 0; font-size:16px; color:#444;">
                                <a href="https://chat.whatsapp.com/EF3o652tnrl3WtZisrKkdu"
                                    style="color:#178ADF; text-decoration:underline;">
                                    https://chat.whatsapp.com/EF3o652tnrl3WtZisrKkdu
                                </a>
                            </p>

                            <div class="responsive-box"
                                style="background-color:#fff8d9; padding:20px; text-align:center; border-radius:6px; font-weight:bold; font-size:20px; letter-spacing:2px;">
                                <a href="https://chat.whatsapp.com/EF3o652tnrl3WtZisrKkdu"
                                    style="display:inline-block; background-color:#25D366; color:#fff; text-decoration:none; padding:12px 28px; border-radius:5px; font-size:16px; font-weight:bold; margin:0 auto; box-shadow:0 2px 8px rgba(37,211,102,0.08); transition: background 0.2s, box-shadow 0.2s; text-align:center;">
                                    Gabung WhatsApp Group
                                </a>
                            </div>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td
                            style="background-color:#f4f4f4; padding:15px 20px; text-align:center; font-size:12px; color:#666;">
                            Apabila kamu mendapati pertanyaan silahkan menghubungi
                            <a href="mailto:doscom.go@gmail.com"
                                style="color:#0066cc; text-decoration:none;">doscom.go@gmail.com</a>
                            atau hubungi CP kami di nomor <b>0895396188006 ( Faiz )</b>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>
</body>

</html>
