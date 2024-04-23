<!DOCTYPE HTML >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="../public/Partenaire/style/profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Partenaire Profile </title>
</head>
<body>
<?php require "navbar.php";
?>
<center>

    <h1>Profile </h1>
</center>


<div class="row py-6 px-4">
    <div class="col-xl-6 col-md-6 col-sm-10 mx-auto">
        <!-- Profile widget -->
        <div class="bg-gris shadow rounded overflow-hidden">
            <div class="px-2 pt-0 pb-4 bg-warning bg-gradient">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3"><img src="https://bootstrapious.com/i/snippets/sn-profile/teacher.jpg"
                                                   alt="..." width="160" class="rounded mb-2 img-thumbnail">
                        <a href="updateprofile" class="btn btn-dark btn-sm btn-block">Edit profile</a>

                    </div>
                    <div class="media-body mb-5 text-black">
                        <h4 class="mt-0 mb-0"><?php
                            if (isset($Partenaire['FirstName']) && isset($Partenaire['LastName'])) {
                                echo $Partenaire['LastName'] . ' ' . $Partenaire['FirstName'];
                            } else {
                                echo "Firstname or Lastname is not set";
                            }
                            ?></h4>
                        <p class="small mb-4"><i
                                    class="fa fa-map-marker mr-2"></i><?php if (isset($Partenaire['Ville'])) {
                                echo $Partenaire['Ville'];
                            } else {
                                echo "Ville is not set";
                            } ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">
                            <?php
                            if (isset($Partenaire['Nbr_commande'])) {
                                echo $Partenaire['Nbr_commande'];
                            } else {
                                echo "Nbr_commande is not set";
                            }
                            ?>
                        </h5><small class="text-muted"> <i class="fa fa-picture-o mr-1"></i>Nombre de commande </small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">
                            <?php
                            if (isset($Partenaire['Note'])) {
                                echo $Partenaire['Note'];
                            } else {
                                echo "Note is not set";
                            }
                            ?>
                        </h5><small class="text-muted"> <i class="fa fa-user-circle-o mr-1"></i>Note</small>
                    </li>
                </ul>
            </div>

            <div class="py-4 px-4">
                <h5 class="mb-0">Services:</h5>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <?php
                    if (isset($services)) {
                        foreach ($services as $service) {
                            ?>
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $service['Nom']; ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $service['Prix']; ?></h6>
                                    <p class="card-text"><?php echo $service['Description']; ?></p>
                                    <p class="card-text"><small
                                                class="text-muted">Note: <?php echo $service['Note']; ?></small></p>
                                    <p class="card-text"><small class="text-muted">Number of
                                            orders: <?php echo $service['Nbr_commande']; ?></small></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No services found";
                    }
                    ?>
                </div>
            </div>
            <div class="row">

            </div>
            <div class="py-4">
                <h5 class="mb-3">Recent Comments:</h5>
                <?php
                if (isset($commentaires)) {
                    foreach ($commentaires as $comment) {
                        ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <p class="card-text font-italic mb-0"><?php echo $comment['message']; ?></p>
                                <p class="card-text font-italic mb-0"><?php echo $comment['Rating']; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="alert alert-info" role="alert">No comments found</div>';
                }
                ?>

            </div>
        </div><!-- End profile widget -->

    </div>
</div>
</body>