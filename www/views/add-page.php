<head>
    <title>Ajouter une page</title>
</head>

<div class="site-content">
<?php 
if(isset($_GET['message']) && !empty($_GET['message'])) {
    echo '<p style="width: 100%; background-color: #5aab5a40; color: #07750a; padding: 10px; margin: auto; text-align:center">' . urldecode($_GET['message']) . '</p>';
} 
?>
    <div id="head-title">
        <h2>Ajouter une page</h2>
    </div>
    <div id="separation-bar"></div>
    <div class=form-add style='margin-top: 50px;'>
        <h2>ici le getForm() page</h2>
    </div>
</div>