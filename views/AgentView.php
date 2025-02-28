<?php
if (isset($_GET['success'])) {
    echo '<div class="alert alert-sucess" role="alert">Agent created</div>';
}
if (!isset($factionsOptions)) {
    echo "Error: factionsOptions is not set!";
    exit;
}
?>

<div>
    <h2>Agents</h2>

    <form class="form-inline" method="POST" action"?page=agent">
        <div class="mb-3">
            <label for="agentName">Agent Name</label>
            <input type="text" class="form-control" id="agentName" name="symbol" placeholder="Enter Agent Name">
        </div>

        <div class="mb-3">
            <label for="agentFaction">Faction</label>
            <select class="form-select" id="agentFaction" aria-label="Faction" name="faction" placeholder="Select Faction">
                <option value="" selected disabled>Select Faction</option>
                <?= $factionsOptions ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>