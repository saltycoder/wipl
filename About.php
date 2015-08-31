<?php
    session_start();

?>

<!doctype html>
<html lang="us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WIPL - About Us</title>

    <link href="content/site2.css" rel="stylesheet">

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="Home.php">Home</a>
                <a class="navbar-brand" href="Contact.php">Contact Us</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <p class="navbar-text navbar-right">
                    <?php include "_navlogin.php" ?>
                </p>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>

    <div class="jumbotron banner">
        <div class="container banner-text">
            <h1>About Us</h1>
            <p>
                Debug
                <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                HTTP Status
            </p>
        </div>
    </div>

    <div>
        <div style="float:left;width:500px;">

            <div>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut purus justo, pellentesque at luctus vel, ultricies
                    semper nibh. Donec eu risus a quam ultricies lobortis. Quisque tincidunt enim turpis, ac venenatis urna
                    ullamcorper quis. Praesent sollicitudin justo vel faucibus feugiat. Suspendisse scelerisque scelerisque
                    sollicitudin. Suspendisse gravida tincidunt est sed semper. Nam accumsan, orci id tempor eleifend,
                    lectus ipsum tristique ex, nec consequat massa nisi in est. Proin sed metus sed enim venenatis posuere
                    sed sed nibh. Sed non dolor eu quam molestie faucibus et id metus. Praesent eu egestas massa, nec dapibus
                    arcu. Ut blandit non nibh sed malesuada. Phasellus consectetur sagittis condimentum.
                </p>

                <p>
                    Nullam sodales nisi ac lectus lacinia dictum. Donec varius, mi non blandit congue, ex lectus consectetur
                    lectus, id iaculis augue urna sit amet tellus. Nulla facilisis, risus in consectetur varius, elit tellus
                    placerat sapien, eu tincidunt felis nisl imperdiet eros. Aliquam eleifend dolor sit amet dolor mattis,
                    ac congue diam lacinia. Pellentesque vel convallis nisi. Suspendisse accumsan condimentum lectus, sit
                    amet venenatis turpis accumsan eu. Ut convallis molestie diam ut blandit.
                </p>

                <p>
                    Phasellus fringilla bibendum pulvinar. Morbi viverra nibh id dolor laoreet, ac hendrerit ex auctor. Nulla
                    auctor lorem est. Phasellus mauris nisl, aliquam quis ante non, tincidunt varius augue. In lacinia lectus
                    nisl. In in feugiat orci, et rhoncus erat. Proin pretium vehicula ante, finibus finibus leo fringilla at.
                    In hac habitasse platea dictumst.
                </p>

                <p>
                    Sed dapibus quis magna hendrerit sollicitudin. Integer a erat lorem. Phasellus at diam sed ipsum cursus
                    vulputate non sed diam. Ut ut rutrum magna. In hac habitasse platea dictumst. Vivamus dignissim neque eget
                    enim suscipit, eu tristique odio rutrum. Proin vel porttitor nisl. Nulla gravida risus odio, a hendrerit
                    eros dapibus non. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin vehicula elit cursus
                    mauris ullamcorper, quis fringilla nunc suscipit. Praesent semper libero eu rhoncus feugiat. In hendrerit
                    condimentum risus non posuere. Aliquam nibh nibh, suscipit nec aliquam eget, pulvinar vel ipsum. Vestibulum
                    ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                </p>

                <p>
                    Nam porta placerat tincidunt. Sed rutrum ante lorem, sit amet gravida mauris facilisis a. Suspendisse
                    in eleifend purus. Ut ut sapien neque. Donec nibh ante, maximus quis pretium at, varius eget dolor.
                    Quisque lobortis sapien quis libero suscipit fringilla. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Curabitur lacus leo, facilisis congue erat a, dapibus aliquet lorem. Pellentesque
                    interdum ultricies purus, in volutpat lorem ullamcorper id. Curabitur ac mi velit. Nunc pulvinar, eros
                    id porta dictum, tortor nisl bibendum quam, ac varius magna risus sed erat.
                </p>

            </div>

        </div>

        <div style="margin-left:600px;">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">In the News</h3>
                </div>
                <div class="panel-body">
                    <div id="newsResults" name="newsResults"></div>
                </div>
            </div>

        </div>
    </div>

    <?php include "_footer.php" ?>

    <script>

        $.ajax({
            url: "NewsFeed.php",
            success: function(html){
                $("#newsResults").append(html);
            }
        });

    </script>

</body>
</html>
