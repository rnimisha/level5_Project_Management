<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrint-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    .container {
        text-align: center;
    }

    form .form-control {
        border: 2px solid #d3d3d3;
    }
    #button{
        align-content: center;
        margin-right: -13px;
    }
</style>

<body>
    <div class="container mt-5">
        <h1><b>GET IN TOUCH WITH US</b></h1>
        <form class="row g-3 mt-2 w-75 mx-auto">
            <div class="col-md-6 mt-5">
                <input type="text" class="form-control" placeholder="Firstname" name="fname" />
            </div>
            <div class="col-md-6 mt-5">
                <input type="text" class="form-control" placeholder="Lastname" name="lname" />
            </div>
            <div class="col-md-6 mt-5">
                <input type="tel" class="form-control" placeholder="Phone number" name="phone" />
            </div>
            <div class="col-md-6 mt-5">
                <input type="email" class="form-control" placeholder="Email address" name="email" />
            </div>
            <div class="col-md-12 mt-5">
                <textarea class="form-control" name="fname" rows="7">Enter message</textarea>
            </div>
            <div class="row justify-content-end mt-5">
                <button type="submit" id="button" class="btn btn-primary w-25">Send</button>
            </div>
        </form>
        <div class="row g-3 mt-5">
            <div class="col-md-4 mt-5">
                <i class="fa fa-map-marker fa-3x text-success" aria-hidden="true"></i>
                <h3>Location</h3>
                <p>area,city,country</p>
            </div>
            <div class="col-md-4 mt-5">
                <i class="fa fa-phone fa-3x text-secondary"></i>
                <h3>Phone</h3>
                <p>+92 345 4564566</p>
            </div>
            <div class="col-md-4 mt-5">
            <i class="fa fa-envelope fa-3x text-dark"></i>
                <h3>Email</h3>
                <p>phoenixmart123@gmail.com</p>
            </div>
        </div>
    </div>

</body>

</html>