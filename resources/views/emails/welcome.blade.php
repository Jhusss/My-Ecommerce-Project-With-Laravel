<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome Email</title>
</head>
<body>
  <table>
    <tr><td> Dear {{ $name }}!</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Your account has been successfully activated!.</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Your account information is at below :</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Email : {{ $email }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Password: ****** (as chosen by you)</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thanks & Regards,</td></tr>
    <tr><td>Ailoveyu International</td></tr>
  </table>
  
</body>
</html>