<?php
if (isset($_GET['success'])) {
    echo '<div class="alert alert-sucess" role="alert">Agent created</div>';
}
?>


<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card border-warning">
        <div class="card-header pixelify-sans-bold">
            Register Agent
        </div>
        <div class="card-body">
            <form class="row row-cols-lg-auto g-3 align-items-center" method="POST" action"?page=agent&action=register_agent">
                <input type="hidden" name="action" value="register_agent">
                <div class="col-12">
                    <label class="visually-hidden" for="agentName">Agent Name</label>
                    <input type="text" class="form-control" id="agentName" name="symbol" placeholder="Enter Agent Name">
                </div>
                <div class="col-12">
                    <select class="form-select" id="agentFaction" aria-label="Faction" name="faction" placeholder="Select Faction">
                        <option value="" selected disabled>Select Faction</option>
                        <?= $factionsOptions ?>
                    </select>
                </div>
                <div class="col-12">
                    <button type=" submit" class="btn btn-warning">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>