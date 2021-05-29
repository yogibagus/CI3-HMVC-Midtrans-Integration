<!DOCTYPE html>
<html lang="en">

<head>
    <title>Details Package</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="your_client_key"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="<?= base_url('') ?>">Midtrans CI HMVC</a>

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('welcome/order_list') ?>">Order List</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-4">
        <div class="jumbotron text-center">
            <img class="card-img-top" src="<?= base_url('') ?>assets/img/<?= $this->input->get('icon') ?>.png" alt="Card image" style="max-width:150px;"><br>
            <small>PACKAGE ID: <?= $this->input->get('package_id') ?></small>
            <h1><?= $this->input->get('package_name') ?></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis assumenda velit nobis, voluptas repellendus quam, sunt quasi praesentium repellat nulla commodi hic quo atque. Repudiandae, qui! Voluptatum error animi quam.</p>
            <h3>Complete the form!</h3>
            <form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">
                <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="Guest" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="guest@mail.com" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <input type="hidden" id="package_id" value="<?= $this->input->get('package_id') ?>">
                <input type="hidden" id="package_name" value="<?= $this->input->get('package_name') ?>">
                <input type="hidden" id="package_price" value="<?= $this->input->get('package_price') ?>">
                <button type="submit" id="pay-button" class="btn btn-primary">BUY PACKAGE</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $('#pay-button').click(function(event) {
            event.preventDefault();
            $(this).attr("disabled", "disabled");
            var name = $("#name").val();
            var email = $("#email").val();
            var package_id = $("#package_id").val();
            var package_name = $("#package_name").val();
            var package_price = $("#package_price").val();
            $.ajax({
                type: 'POST',
                url: '<?= site_url() ?>/snap/token',
                data: {
                    name: name,
                    email: email,
                    package_id: package_id,
                    package_name: package_name,
                    package_price: package_price
                },
                cache: false,

                success: function(data) {
                    //location = data;

                    console.log('token = ' + data);

                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type, data) {
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {

                        onSuccess: function(result) {
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            $("#payment-form").submit();
                        },
                        onPending: function(result) {
                            changeResult('pending', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        },
                        onError: function(result) {
                            changeResult('error', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        }
                    });
                }
            });
        });
    </script>
</body>
<br>
<hr>
<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>Demo Midtrans Implementation &copy; , please download and customize it for yourself!</p>
    </div>
</footer>

</html>