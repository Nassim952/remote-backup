<head>
    <title>Edition d'une page</title>
</head>

<div class="site-content">
    <div id="head-title">
        <h2 style="font-size:32px;">Edition d'une page</h2>
    </div>
    <div id="separation-bar"></div>
    <div class="lists-film">
        <table class="table-wrapper">
            <tr class="tr-container">
                <?php
                    foreach($pages as $page):
                ?>
                    <form enctype="multipart/form-data" class=add-film method="post">
                        
                    </form>
                <?php endforeach; ?>
            </tr>
        </table>
</div>

