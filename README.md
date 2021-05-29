# CI3-HMVC-Midtrans-Integration

This is an example of an application made with Codeigniter 3 HMVC which has been integrated with the midtrans payment gateway.

This App Using:

- [Modular Extensions - HMVC](https://github.com/brianwozeniak/codeigniter-modular-extensions-hmvc/)
- [Midtrans Codeigniter library](https://github.com/Midtrans/Midtrans-Codeigniter/)
- [Boostrap 4](https://getboostrap.com/)

Please learn more about that Extensions and Library.

## Features

- Dinamic Order
- Auto change payment status
- SNAP Payment Midtrans

## ⚠️ Installation - Follow this instruction!

\*This app must be hosted and accessible using the internet. At least to be able to receive a callback from Midtrans to change the payment status.

\*Import midtrans.sql for the database.

\*Change the database.php config if needed.

\*Change the Client Key on View details_package.php on 'welcome' folder with your own.

```sh
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
```

\*Change the Server Key on every controller with your own.

```sh
$params = array('server_key' => 'YOUR_CLIENT_KEY', 'production' => false);
```

\*To recieve callback from Midtrans. Change this url endpoint. Settings -> Configuration
![alt text](https://i.ibb.co/m5f63Dn/Capture.jpg)

This app only used 3 controllers. Which is Welcome, Snap and Notification.
There'is 3 another controllers from [Midtrans Codeigniter library](https://github.com/Midtrans/Midtrans-Codeigniter/) that can be modify.

## Screenshot Demo

- Homepage
  ![alt text](https://i.ibb.co/WfQYXKw/Capture.jpg)

- Snap Pop Up
  ![alt text](https://i.ibb.co/Yk5CFLy/snap.jpg)

- Order List
  ![alt text](https://i.ibb.co/zrg9w6d/orderlist.jpg)

Thanyou.
