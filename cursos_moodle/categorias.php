<?php

    require_once dirname(__FILE__) . '/Config/Config.php';

    if ( !isset($_GET['parent']) ) {
        $_GET['parent'] = '0';
    }

    if ( !ctype_digit($_GET['parent']))  
    {
        echo 'ERROR';
    }
    else 
    {
        $_GET['parent'] = intval($_GET['parent']);

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  HOST_CURL . '/cursosmoodle/categorias',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('key' => 'SinPass#$%*(*/-PorSiLasDudas62875461', 'parent' => $_GET['parent']),
            CURLOPT_HTTPHEADER => array()
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $response = json_decode($response);

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  HOST_CURL . '/cursosmoodle/cursos',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('key' => 'SinPass#$%*(*/-PorSiLasDudas62875461', 'parent' => $_GET['parent']),
            CURLOPT_HTTPHEADER => array()
        ));

        $cursos = curl_exec($curl);
        
        curl_close($curl);
        
        $cursos = json_decode($cursos);
        
        if ( ( $response == null && $response !== [] ) || ( $cursos == null  && $cursos !== [] ) ) 
        {
            echo 'ERROR';
        }
        else
        {
            $rutas = $response -> rutas;
            $response = $response -> categorias;
            ?> 
                <!-- <link rel="stylesheet" href="<?= BASE_URL ?>/assets/moodle/categorias.css?v=<?= MEDIA_VERSION ?>"> -->
                <div id="container_categorias" style="display: flex; flex-wrap: wrap; justify-content: space-around;">

                <?php foreach ($response as $key => $value) { 
                    
                    if ($value -> cat_course_imagen == '') {
                        $linkImg = BASE_URL . "/assets/web/images/general/no-image-no-oficial.png";
                    } else {
                        $linkImg = BASE_URL . "/assets/moodle/images/categorias/" . $value -> cat_course_imagen;
                    }
                    ?>
                        
                    <div class="cuadros_ind" style="width: 242px; text-align: center; padding: 15px">
                        <a href="<?= CAMPUS_URL ?>/course/index.php?categoryid=<?= $value -> id ?>" target="_blank" style="display: block; text-decoration:none">

                            <img style="width: 168px; height: 138px; border: 1px solid grey; margin:auto; padding: 5px" src="<?= $linkImg ?>" alt="">

                            <p style="font-size: 21px; margin-top: 10px; line-height: 1.2;"><?= $value -> name ?></p>

                        </a>
                    </div>

                <?php } ?>
                
                <?php foreach ($cursos as $key => $value) { 
                    
                    if ($value -> img != '') {
                        $linkImg = CAMPUS_URL . "/pluginfile.php/" . $value -> id_img . "/course/overviewfiles/" . $value -> img;
                    } else {
                        $linkImg = BASE_URL . "/assets/web/images/general/no-image-no-oficial.png";
                    }
                    ?>
                        
                    <div class="cuadros_ind" style="width: 242px; text-align: center; padding: 15px">
                        <a href="<?= CAMPUS_URL ?>/course/view.php?id=<?= $value -> id ?>" <?= ($_GET['parent'] == 0) ? 'target="_blank"' : '' ?> style="display: block; text-decoration:none">

                            <img style="width: 168px; height: 138px; border: 1px solid grey; margin:auto; padding: 5px" src="<?= $linkImg ?>" alt="">

                            <p style="font-size: 21px; margin-top: 10px; line-height: 1.2;"><?= $value -> fullname ?></p>

                        </a>
                    </div>
                    

                <?php } ?>

                </div>  
                <script>
                    document.querySelector('.page-header-headings').innerHTML = "<?= str_replace('"', "'", $rutas) ?>";
                </script>    
            <?php
        }
    }
