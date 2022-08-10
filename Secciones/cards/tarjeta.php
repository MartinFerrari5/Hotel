<?php

use Hotel\Propiedades;

$properties=Propiedades::get($num);

foreach($properties as $property):
?>
            <div class="card">
                <div class="card-img">
                    <img src="/imagenes/<?php echo $property->imagen ?>" alt="">
                </div>
                <div class="card-info">
                    <p class="text-title"><?php echo $property->titulo ?></p>
                    <p class="text-body"><?php echo $property->descripcion ?></p>
                </div>
                <div class="card-price">
                <?php echo '$' . $property->precio ?>
                </div>
                <div class="card-footer">
                <span class="text-title"></span>
                <a href="/Secciones/cards/individualCard.php?id=<?php echo $property->titulo ?>" class="card-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-question" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <circle cx="10" cy="10" r="7" />
                        <path d="M21 21l-6 -6" />
                        <line x1="10" y1="13" x2="10" y2="13.01" />
                        <path d="M10 10a1.5 1.5 0 1 0 -1.14 -2.474" />
                    </svg>
                </a>
                </div>
            </div>
<?php endforeach;?>
            
      