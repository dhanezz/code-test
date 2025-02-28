<?php
if (isset($_GET['success'])) {
    echo '<div class="alert alert-sucess"> Agent created</div>';
}
if (!isset($factionsOptions)) {
    echo "Error: factionsOptions is not set!";
    exit;
}
?>

<div>
    <h2>Agents</h2>

    <form class="form-inline" method="POST" action"?page=agent">
        <div class="form-group">
            <label for="agentInput">Agents</label>
            <input type="text" class="form-control" id="agentInput" name="symbol" placeholder="Enter Agent Name">
        </div>
        <select class="form-control" id="agent-selection" name="" faction>
            <?= $factionsOptions ?>
        </select>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>