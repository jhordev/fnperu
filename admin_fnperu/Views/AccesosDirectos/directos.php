            
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">

                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fa-solid fa-gauge bg-mean-fruit"></i>
                                </div>
                                <div>
                                    <span class="fw-500"><?= $page_title ?></span>
                                </div>
                            </div>

                            <div class="page-title-actions d-none">
                                <div class="d-inline-block">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="app-main__content fs-18 pb-5 ps-5">

                        <?= getHtmlForCategoriasMoodle($categorias, '') ?>

                    </div>

                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_cambiarImagen" tabindex="-1" aria-labelledby="modal_cambiarImagenLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" id="from_cambiarImagen" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modal_cambiarImagenLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="text-center mb-3">
                            <img src="" alt="" id="img_view_cat" style="max-height: 700px;">
                        </div>

                        <input type="number" name="id_cat" id="input_id_cat" class="d-none">

                        <div class="mb-3 ps-3 pe-4">
                            <label for="nameCurso" class="form-label fw-500 text-black">CAMBIAR IMAGEN:</label>
                            <input accept="image/png, image/jpg, image/jpeg" type="file" class="form-control form-control-sm" id="input_img" name="input_img">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php

function getHtmlForCategoriasMoodle($contenido, $nivel)
{
    $html = '';
    // $nivel++;

    // $guiones = '|';

    // for ($index = 0; $index < $nivel; $index ++) 
    // { 
    //     $guiones .= '---';
    // }

    $guiones = '';

    foreach ($contenido as $key => $value) 
    {
        $html .= '<div style="min-height: 20px">' . $guiones . str_replace('| - - -', '|', $nivel) . ' ' . '</div>';
        $html .= '<div class="">' . $guiones . $nivel . ' ' . $value['name'] . ' <span class="fs-15 action_categoria text-primary user-select-none" style="cursor: pointer" data-nombre="' . str_replace('"', "'", $value['name']) . '" data-img="' . $value['cat_course_imagen'] . '" data-id="' . $value['id'] . '">( <i class="fs-14 fa-solid fa-pen-to-square"></i> Editar )</span></div>';
        
        if (isset($value['contenido'])) {
            $html .= getHtmlForCategoriasMoodle($value['contenido'], str_replace(' - - -', '<span class="text-white"> - - - </span>', $nivel) . '| - - -');
        }
    }

    return $html;
}