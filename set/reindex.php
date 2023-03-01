
<?php
    include '../includes/config.php';
    if($_GET['reindex']==1)
    {
        $sdk->reindexCache();
        
    }
?>
<form action="reindex.php">
    <input type="hidden" value="1" name="reindex"/>
    <button type="submit">
    Limpiar Caché del proyecto
</button>
</form>

