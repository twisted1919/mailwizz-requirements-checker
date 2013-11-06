<?php defined('MW_INSTALLER_PATH') or exit();

class RequirementsController extends Controller
{
    public function actionIndex()
    {
        $this->data['requirements'] = require dirname(__FILE__) . '/../inc/requirements.php';
        $result = 1;  // 1: all pass, 0: fail, -1: pass with warnings
        
        foreach($this->data['requirements'] as $i => $requirement) {
            
            if($requirement[1] && !$requirement[2]) {
                $result = 0;
            } elseif($result > 0 && !$requirement[1] && !$requirement[2]) {
                $result = -1;
            }
            
            if($requirement[4] === '') {
                $requirements[$i][4]='&nbsp;';
            }
        }

        $this->data['result'] = $result;
        
        $this->data['breadcrumbs'] = array(
            'Requirements' => 'index.php?route=requirements',
        );
        
        $this->render('requirements');
    }
    
}