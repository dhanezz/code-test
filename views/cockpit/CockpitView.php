<?php

?>

<div class="card text-center bg-transparent">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="#">Map</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        [TBD]
    </div>
</div>

<div id="xyzcoordinates" class="text-light"></div>

<div class="container">
    <div class="map-canvas"></div>
</div>

<script>
    const {
        ctx
    } = VBCanvas.createCanvas({
        target: '.map-canvas',
        viewBox: [0, 0, 100, 100],
        scaleMode: 'fit'
    });

    let angle = 0;

    (function draw() {
        // draw a rectangle in the center of the canvas
        ctx.fillRect(40, 40, 20, 20);

        requestAnimationFrame(draw);
    })();

    const canvas = ctx.canvas;
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