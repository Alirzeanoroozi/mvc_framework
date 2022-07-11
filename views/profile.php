<h1>Profile</h1>
<?php $this->title = "Profile"; ?>
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-md-9 col-lg-7 col-xl-5">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex text-black">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><?= $firstname." ". $lastname ?></h5>
                            <p class="mb-2 pb-1" style="color: #2b2a2a;">Author ID : <?= $id ?></p>
                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #efefef;">
                                <div>
                                    <p class="small text-muted mb-1">Articles</p>
                                    <p class="mb-0"><?= $inscriptionNumbers ?></p>
                                </div>
                            </div>
                            <?php
                            foreach ($inscriptions as $inscription){
                                echo '<div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #efefef;">
                                        <div> 
                                            <p class="small text-muted mb-1">' . $inscription["id"] . ' '. $inscription["subject"]. '</p>
                                            <p class="mb-0">'. $inscription["content"]. '</p>
                                        </div>
                                      </div>';
                            }?>
                            <div class="d-flex pt-1">
                                <button type="button" class="btn btn-outline-primary me-1 flex-grow-1">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>