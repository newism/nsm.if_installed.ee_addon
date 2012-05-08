<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require PATH_THIRD.'nsm_if_installed/config.php';

/**
 * NSM If Installed Plugin
 * 
 * Generally a module is better to use than a plugin if if it has not CP backend
 *
 * @package         NsmIfInstalled
 * @version         0.0.1
 * @author          Leevi Graham <http://leevigraham.com>
 * @copyright       Copyright (c) 2007-2010 Newism <http://newism.com.au>
 * @license         Commercial - please see LICENSE file included with this distribution
 * @link            http://expressionengine-addons.com/nsm-if-installed
 * @see             http://expressionengine.com/docs/development/plugins.html
 */

/**
 * Plugin Info
 *
 * @var array
 */
$plugin_info = array(
    'pi_name' => NSM_IF_INSTALLED_NAME,
    'pi_version' => NSM_IF_INSTALLED_VERSION,
    'pi_author' => 'Leevi Graham',
    'pi_author_url' => 'http://leevigraham.com/',
    'pi_description' => 'Plugin description',
    'pi_usage' => "Refer to the included README"
);

class Nsm_if_installed {

    /**
     * The return string
     *
     * @var string
     */
    var $return_data = "";
    var $addon_id = NSM_IF_INSTALLED_ADDON_ID;

    function __construct() {

        $EE =& get_instance();

        // Init the cache
        $this->_initCache();

        if(! $addon = $EE->TMPL->fetch_param('addon'))
        {
            $this->return_data = "";
            return;
        }

        if(false == isset($this->cache['installedModules'])) {
            $EE->load->model('addons_model');
            $installedModules = $EE->addons_model->get_installed_modules()->result();
            $this->cache['installedModules'] = array();
            foreach ($installedModules as $module) {
                $this->cache['installedModules'][] = $module->module_name;
            }
        }

        $installedModules = $this->cache['installedModules'];

        $this->return_data = (in_array($addon, $installedModules) || in_array($addon, $EE->TMPL->plugins))
                                ? $EE->TMPL->tagdata
                                : $EE->TMPL->fetch_param('error', $EE->TMPL->no_results());
    }

    /**
     * Initialises a cache for the addon
     * 
     * @access private
     * @return void
     */
    private function _initCache() {

        $EE =& get_instance();

        // Sort out our cache
        // If the cache doesn't exist create it
        if (! isset($EE->session->cache[$this->addon_id])) {
            $EE->session->cache[$this->addon_id] = array();
        }

        // Assig the cache to a local class variable
        $this->cache =& $EE->session->cache[$this->addon_id];
    }
}