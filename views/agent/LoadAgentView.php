<?php
if (isset($_GET['success'])) {
    echo '<div class="alert alert-sucess" role="alert">Agent created</div>';
}
if (!isset($factionsOptions)) {
    echo "Error: factionsOptions is not set!";
    exit;
}
?>

<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card border-warning">
        <div class="card-header pixelify-sans-bold">
            Load Agent
        </div>
        <div class="card-body">
            <form class="row row-cols-lg-auto g-3 align-items-center" method="GET">
                <input type="hidden" name="page" value="agent">
                <input type="hidden" name="load" value="1">
                <input type="hidden" name="form_action" value="load_agent_data">
                <div class="col-12">
                    <label class="visually-hidden" for="agentName">Agent Token</label>
                    <input type="text" class="form-control" id="agentName" name="agent_token" placeholder="Enter Agent Token">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-warning">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>