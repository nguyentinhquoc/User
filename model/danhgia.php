<?php
               function echo_start_true($a) {
                for ($i=0; $i < $a; $i++) { 
                    echo '<i class="fa fa-star" aria-hidden="true" style="color: #f6931f;"></i>';
                }
               }
               function echo_start_false($a) {
                for ($i=0; $i < $a; $i++) { 
                    echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                }
               }
                ?>