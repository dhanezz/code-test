<?php

?>

<nav class="navbar bg-transparent">
    <div class="container-fluid">
        <a class="nav-brand nav-link pixelify-sans-regular dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $agent->getSymbol() ?>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=home&action=logout">Logout</a></li>
        </ul>
        <div class="d-flex flex-column" id="credits">
            <span class="me-2 pixelify-sans-regular">🪙&nbsp;<?= $agent->getCredits(); ?></span>
            <p class="me-2 pixelify-sans-regular fs-6">Ship(s):&nbsp;<?= $agent->getShipCount(); ?></p>
        </div>
    </div>
</nav>

<div class="container-typewriter">
    <div class="typed-out pixelfiy-sans-regular">Current Location: <?= $agent->getCurrentLocation($startingLocationSymbol) ?></div>
</div>

<div class="d-none">
    <img id="headquarters" src="assets/images/headquarters.png" alt="headquarters">
</div>

<div class="container">
    <div class="row">
        <div class="col-6">
            <!-- <div class="map-canvas"></div> -->
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header pixelify-sans-regular">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="contracts-tab" data-bs-toggle="tab" data-bs-target="#contracts-tab-pane" type="button" role="tab" aria-controls="contracts-tab-pane" aria-selected="true">Contracts</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ships-tab" data-bs-toggle="tab" data-bs-target="#ships-tab-pane" type="button" role="tab" aria-controls="ships-tab-pane" aria-selected="false">Ships</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="contracts-tab-pane" role="tabpanel" aria-labelledby="contracts-tab" tabindex="0">
                            <div class="accordion container" id="contracts">
                                <?= $contractsHTML ?>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="ships-tab-pane" role="tabpanel" aria-labelledby="ships-tab" tabindex="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const {
        ctx
    } = VBCanvas.createCanvas({
        target: '.map-canvas',
        viewBox: [0, 0, 100, 100],
        scaleMode: 'fit'
    });
    const image = document.getElementById("headquarters");
    const canvas = ctx.canvas;

    ctx.translate(canvas.width / 2, canvas.height / 2);

    if (canvas) {
        canvas.addEventListener('mousemove', (e) => {
            // Get mouse position relative to the canvas
            const rect = ctx.canvas.getBoundingClientRect()
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            document.getElementById("xyzcoordinates").innerHTML = "&nbsp;&nbsp;Coordinates: (" + x + "," + y + ")";
        });
    } else {
        console.error("Canvas Element not found!");
    }
</script>