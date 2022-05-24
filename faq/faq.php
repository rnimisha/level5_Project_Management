<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: "Quicksand", sans-serif;
        background-color: #fff;
    }

    .faq {
        height: 100%;
        padding: 50px 0;
        color: #78967e;

    }

    .faq header {
        font-weight: 1000;
        font-size: 50px;
        text-align: center;
        padding: 20px 0 50px 0;
    }

    .accordion .card {
        background: none;
        border-radius: 0px;
        border-left-width: 0;
        border-right-width: 0;
        border-top-width: 0;
    }

    .accordion .card .card-header {
        background: none;
        padding-top: 7px;
        padding-bottom: 7px;
        border-radius: 0px;
    }

    .accordion .card-header h2 a {
        font-size: 1.2rem;
        text-decoration: none;
    }

    .accordion .card-header .btn {
        color: #78967e;
        width: 100%;
        text-align: left;
        padding-left: 0;
        padding-right: 0;
    }

    .accordion .card-header i {
        font-size: 1.3rem;
        position: absolute;
        top: 15px;
        right: 1rem;

    }

    .accordion .card-body {
        color: #78967e;
    }
</style>

<body>
    <div class="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <header class="head">FAQ's</header>
                    <div class="accordion" id="accordion-id">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapsei"> what are your policys<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapsei" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, eveniet illum aliquid dolorem laboriosam iure nam nulla reiciendis cumque officiis quidem assumenda provident consequatur commodi veniam eius reprehenderit, expedita cum?
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapseii"> what are your policys<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapseii" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, eveniet illum aliquid dolorem laboriosam iure nam nulla reiciendis cumque officiis quidem assumenda provident consequatur commodi veniam eius reprehenderit, expedita cum?
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapseiii"> what are your policys<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapseiii" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, eveniet illum aliquid dolorem laboriosam iure nam nulla reiciendis cumque officiis quidem assumenda provident consequatur commodi veniam eius reprehenderit, expedita cum?
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapseiv"> what are your policys<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapseiv" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, eveniet illum aliquid dolorem laboriosam iure nam nulla reiciendis cumque officiis quidem assumenda provident consequatur commodi veniam eius reprehenderit, expedita cum?
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapsev"> what are your policys<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapsev" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, eveniet illum aliquid dolorem laboriosam iure nam nulla reiciendis cumque officiis quidem assumenda provident consequatur commodi veniam eius reprehenderit, expedita cum?
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapsevi"> what are your policys<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapsevi" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, eveniet illum aliquid dolorem laboriosam iure nam nulla reiciendis cumque officiis quidem assumenda provident consequatur commodi veniam eius reprehenderit, expedita cum?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>