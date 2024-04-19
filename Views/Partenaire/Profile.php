<!DOCTYPE HTML >
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="../public/Partenaire/style/profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Partenaire Profile </title>
</head>
<body>
<?php require "navbar.php"; ?>
<h1>Profile </h1>


<div class="row py-6 px-4">
    <div class="col-xl-6 col-md-6 col-sm-10 mx-auto">
        <!-- Profile widget -->
        <div class="bg-gris shadow rounded overflow-hidden">
            <div class="px-2 pt-0 pb-4 bg-warning bg-gradient">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3"><img src="https://bootstrapious.com/i/snippets/sn-profile/teacher.jpg"
                                                   alt="..." width="160" class="rounded mb-2 img-thumbnail"><a href="../Partenaire/editprofile.php<?php echo '?id='.$partenaire['id']; ?> " class="btn btn-outline-dark btn-sm btn-block">Edit profile</a></div>
                    <div class="media-body mb-5 text-black">
                        <h4 class="mt-0 mb-0"><?php
                            if(isset($partenaire['Firstname']) && isset($partenaire['Lastname'])) {
                                echo $partenaire['Lastname'].' '.$partenaire['Firstname'];
                            } else {
                                echo "Firstname or Lastname is not set";
                            }
                            ?></h4>
                        <p class="small mb-4"> <i class="fa fa-map-marker mr-2"></i><?php if (isset($partenaire['Ville'])) {
                                echo $partenaire['Ville'];
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
                            if(isset($partenaire['Nbr_commande'])) {
                                echo $partenaire['Nbr_commande'];
                            } else {
                                echo "Nbr_commande is not set";
                            }
                            ?>
                        </h5><small class="text-muted"> <i class="fa fa-picture-o mr-1"></i>Nombre de commande </small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">
                            <?php
                            if(isset($partenaire['Note'])) {
                                echo $partenaire['Note'];
                            } else {
                                echo "Note is not set";
                            }
                            ?>
                        </h5><small class="text-muted"> <i class="fa fa-user-circle-o mr-1"></i>Note</small>
                    </li>
                </ul>
            </div>

            <div class="py-4 px-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Services:</h5>
                        <!-- from services    $services  show each service and it detail -->
                    <?php
                    if(isset($services)) {
                        foreach ($services as $service) {
                            echo '<a href="#" class="btn btn-link text-primary"> '.$service['ServiceName'].' </a>';
                        }
                    } else {
                        echo "No services found";
                    }
                    ?>
                </div>
                <div class="row">

                </div>
                <div class="py-4">
                    <h5 class="mb-3">Recents Comment :</h5>
                    <div class="p-4 bg-light rounded shadow-sm">
                        <!-- from comments    $comments  show each comment and it detail -->
                        <?php
                        if(isset($comments)) {
                            foreach ($comments as $comment) {
                                echo '<p class="font-italic mb-0"> '.$comment['Comment'].' </p>';
                                echo '<p class="font-italic mb-0"> '.$comment['Date'].' </p>';
                            }
                        } else {
                            echo "No comments found";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div><!-- End profile widget -->

    </div>
</div>
</body>