<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Editor extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->c9auth->checkLogin();
    }

    public function index(){
        $settings = $this->_getDefaultConfig();
        $settings['name'] = '"Home Directory"';
        $settings['projectName'] = 'Home Directory';
        $settings['cdone'] = true;
        
        $this->_showEditor($settings);
	}
    
    public function project($id = ''){
        if ($id == ""){
            $this->load->view('errors/editor_no_project');
        } else {
            $this->load->model('projects', 'c9projects');
            
            if ($this->c9projects->isUsersProject($id, $this->c9auth->currUserID())){
                $projName = $this->c9projects->getProjName($id);
                
                $settings = $this->_getDefaultConfig();
                $settings['name'] = '"' . $projName . '"';
                $settings['projectName'] = $projName;
                
                $this->c9projects->checkProjDir($id);
                
                $settings['davPrefix'] = '"/workspace/' . $projName . '/"';
                
                $settings['cdone'] = true;
                
                $this->_showEditor($settings);
            } else {
                $this->load->view('errors/editor_no_project');
            }
        }
    }
    
    private function _showEditor($settings){
        if (!$settings['cdone']){
            return false;
        } else {
            $this->load->view('editor', $settings);
        }
    }
    
    private function _getDefaultConfig(){
        $settings = array();
        $settings['cdone'] = false;
        $settings['offlineManifest'] = '';
        $settings['staticUrl'] = '/static';
        $settings['davPrefix'] = '"/workspace"';
        $settings['workspaceDir'] = '""';
        $settings['debug'] = 'false';
        $settings['sessionId'] = '"random"';
        $settings['workspaceId'] = '"ide"';
        $settings['name'] = '"Default"';
        $settings['readonly'] = '""';
        $settings['projectName'] = 'Default';
        $settings['version'] = '"0.5.0"';
        $settings['requirejsConfig'] = '{"baseUrl":"/static/","paths":{"ace":"/static/support/ace/lib/ace","debug":"/static/support/lib-v8debug/lib/v8debug","apf":"/static/support/apf"},"waitSeconds":30}';
        $settings['settingsXml'] = '<settings version="0.0.4"></settings>';
        $settings['plugins'] = '["ext/filesystem/filesystem","ext/settings/settings","ext/editors/editors","ext/themes/themes","ext/themes_default/themes_default","ext/panels/panels","ext/dockpanel/dockpanel","ext/openfiles/openfiles","ext/tree/tree","ext/save/save","ext/recentfiles/recentfiles","ext/gotofile/gotofile","ext/newresource/newresource","ext/undo/undo","ext/clipboard/clipboard","ext/searchinfiles/searchinfiles","ext/searchreplace/searchreplace","ext/quickwatch/quickwatch","ext/quicksearch/quicksearch","ext/gotoline/gotoline","ext/html/html","ext/code/code","ext/imgview/imgview","ext/extmgr/extmgr","ext/run/run","ext/debugger/debugger","ext/noderunner/noderunner","ext/console/console","ext/tabbehaviors/tabbehaviors","ext/keybindings/keybindings","ext/watcher/watcher","ext/dragdrop/dragdrop","ext/beautify/beautify","ext/offline/offline","ext/stripws/stripws","ext/zen/zen","ext/codecomplete/codecomplete","ext/splitview/splitview"]';
        $settings['scripts'] = '<script type="text/javascript" src="/static/support/ace/build/src/ace-uncompressed.js"></script>' . "\n" . '<script type="text/javascript" src="/static/support/ace/build/src/mode-javascript.js"></script>';
        
        return $settings;
    }
}