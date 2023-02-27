<?php 
  $bodyClass = "faq"; 
  
  include 'includes/header.php';
  include 'includes/nav.php';
  $faqs = $sdk->gFaq();
  $faqsTax = $sdk->getTaxonomy("all", "categorias_preguntas_frecuentes");
  $groupedItems = array_reduce($faqs, function ($carry, $item) {
    $carry[$item->field_categoria_list][] = $item;
    return $carry;
}, []);
?> 
<main>
    <div class="container">
        <h2>Preguntas frecuentes</h2>
        <div class="grid">
            <?php
              foreach ($groupedItems as $category_id => $category_items) {
                $nombre_categoria = "";
                foreach ($faqsTax as $category) {
                    if($category_id == $category->tid){
                        $nombre_categoria = $category->name;
                    }
                }
                echo '<h3 class="Montserrat thin">' . $nombre_categoria . '</h3>';
            
                foreach ($category_items as $item) {
                    echo '<details>';
                    echo '<summary class="Montserrat thin">' . $item->title . '</summary>';
                    echo $item->body;
                    echo '</details>';
                }
            }
            
            ?>
        </div>
    </div>
    
</main>
<?php include 'includes/footer.php'; ?>