<?php

    namespace FNPERU\Controllers;
    use ADMINFN\Models\FNPeru\UrbanizationBenefitsModel;
    use ADMINFN\Models\FNPeru\UrbanizationContactModel;
    use ADMINFN\Models\FNPeru\UrbanizationDocModel;
    use ADMINFN\Models\FNPeru\UrbanizationModel;
    use ADMINFN\Models\FNPeru\UrbanizationModulesModel;
    use ADMINFN\Models\FNPeru\UrbanizationSliderModel;
    use FNPERU\Core\BaseController;

    class Urbanizaciones extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function ver(int $idUrbanization)
        {
            $urbanization = new UrbanizationModel();
            $data['urbanization'] = $urbanization -> getPublicById($idUrbanization);

            if ($data['urbanization'] == false) {
                redirect($this -> base_url() . '/#urbanizaciones');
            }

            $auxClass = new UrbanizationDocModel();
            $data['docs'] = $auxClass -> getByUrbanization($idUrbanization);

            $auxClass = new UrbanizationContactModel();
            $data['contacts'] = $auxClass -> getByUrbanization($idUrbanization);

            $auxClass = new UrbanizationSliderModel();
            $data['slider'] = $auxClass -> getByUrbanization($idUrbanization);

            $data['firstContacts'] = null;

            if (isset($data['contacts'][0])) {
                $data['firstContacts'] = $data['contacts'][0];
            }

            $auxClass = new UrbanizationBenefitsModel();
            $data['benefits'] = $auxClass -> getByUrbanization($idUrbanization);

            $auxClass = new UrbanizationModulesModel();
            $data['modules'] = $auxClass -> getWithIndicatorsByUrbanization($idUrbanization, true);

            $data['page_title'] = $data['urbanization']['name'];
            $data['page_active'] = 'urbanization';
            $data['page_swalert'] = true;
            $data['icofont'] = true;
            $data['icomoon'] = true;
            $data['page_css'] = 'pages/urbanization';
            $data['page_js'] = 'urbanization/show';

            $this -> view(['WebTemplate/header', 'Urbanization/show', 'WebTemplate/footer'], $data);
        }
    }
