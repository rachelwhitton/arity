<?php

declare(strict_types=1);

namespace ModuleBuilder;

use Arity\Config;
use Arity\Template;
use Arity\Exception\FileNotFoundException;

class ModuleBuilder
{
    /**
     * Cache Key
     *
     * @var string
     */
    private $cache_key = '_acf_cache';

    /**
     * Cache expires (in hours).
     *
     * @var string
     */
    private $cache_expires = 48;

    /**
     * Theme config instance.
     *
     * @var array
     */
    protected $config;

    /**
     * Partials Path.
     *
     * @var string
     */
    protected $partialsPath;

    /**
     * Partials Full Path.
     *
     * @var string
     */
    protected $partialsPathFull;

    /**
     * Templates Extension.
     *
     * @var string
     */
    protected $templatesExt;

    /**
     * ACF Settings Extension.
     *
     * @var string
     */
    protected $acfExt;

    /**
     * Current Page Template.
     *
     * @var string
     */
    protected $currentPageTemplate;

    /**
     * Module Builder Partials.
     *
     * @var string
     */
    protected $partials;

    /**
     * Module Builder Partials.
     *
     * @var string
     */
    protected $previousModule;

    /**
     * Construct ModuleBuilder.
     *
     * @param \Arity\Config $config
     * @return void
     */
    public function __construct(Config $config)
    {
        // Define config
        $this->config = $config;

        // Define partial's location
        $this->partialsPath = !empty($this->config['directories']['templates-partials']) ? $this->config['directories']['templates-partials'] : null;
        if (empty($this->partialsPath)) {
            $this->partialsPath = !empty($this->config['directories']['templates']) ? $this->config['directories']['templates'] : 'templates';
        }

        // Define full path for partial's location
        $this->partialsPathFull = $this->config['paths']['directory'] . DIRECTORY_SEPARATOR . $this->partialsPath;

        // Define templates extension
        $this->templatesExt = !empty($this->config['templates']['extension']) ? $this->config['templates']['extension'] : '.php';

        // Define acf settings extension
        $this->acfExt = !empty($this->config['acf']['extension']) ? $this->config['acf']['extension'] : '.php';

        // Remove Cache on Post Update
        $this->cacheBusting();
    }

    /**
     * Init Module Builder.
     *
     * @return void
     */
    public function init() {
        return;
    }

    /**
     * Returns html string.
     *
     * @param string $content
     * @return string
     */
    public function getContent($content = '')
    {
        if( $partials = $this->getPartials() ) {
            $content = '';
            foreach($partials as $partial) {
                $content .= $partial->getContent();
            }
        }

        return $content;
    }

    /**
     * Returns ACF fields as partials.
     *
     * @return array|false $partials
     */
    private function getPartials()
    {
        if($this->partials) {
            return $this->partials;
        }

        if (empty($acf_fields = $this->getFields())) {
            return false;
        }

        if(!empty($acf_fields['content'])) {
            $acf_fields = $acf_fields['content'];
        }

        if(!empty($acf_fields['modules'])) {
            $acf_fields = $acf_fields['modules'];
        }

        $partials = array();

        // For each field, create a partial object
        foreach ($acf_fields as $acf_field) {
            $partials[] = $this->getPartial($acf_field);
        }

        // Set partials for future use.
        $this->setPartials($partials);

        return $partials;
    }

    /**
     * Returns ACF fields as partials.
     *
     * @return void
     */
    public function getPartial(array $acf_field=array())
    {
        return new ModuleBuilder_Partial($this->config, $acf_field);
    }

    /**
     * Returns ACF fields as partials.
     *
     * @return void
     */
    private function setPartials(array $partials=array())
    {
        $this->partials = $partials;
    }

    /**
     * Render Partials as HTML
     *
     * @return void
     */
    public function render()
    {
        $partials = $this->getPartials();
        foreach($partials as $partial) {
            $partial->render();
        }
    }

    private function getFields()
    {
        if (!function_exists('get_fields')) {
            return false;
        }

        global $post;

        // Get fields with cache
        if(is_preview() || !$this->cache_expires || empty($acf_fields = $this->getCache())) {
            // Get Fields without cache
            if (empty($acf_fields = get_fields())) {
                return false;
            }
        }


        return $acf_fields;
    }

    private function getCache()
    {
        global $post;
        $cache = get_post_meta( $post->ID, $this->cache_key, true );
        if ( empty( $cache ) || $cache['expires'] < time() ) {
            return false;
        }
        return $cache['data'];
    }

    private function setCache($data)
    {
        global $post;

        if(empty($post) || empty($post->ID)) {
            return;
        }

        $expires = false;
        if(!empty($this->cache_expires)) {
            $expires = time() + $this->cache_expires * HOUR_IN_SECONDS;
        }

        $cache = array(
            'expires' => $expires,
            'data' => $data,
        );

        update_post_meta( $post->ID, $this->cache_key, $cache );
    }

    private function cacheBusting()
    {
        add_filter('save_post', function($post_ID) {
            // If this is just a revision, don't do a thing.
        	if ( wp_is_post_revision( $post_ID ) )
        		return;

            if (function_exists('get_fields') && !empty($acf_fields = get_fields($post_ID))) {
                // After getting fields data, store it in cache
                $this->setCache($acf_fields);
            }
        }, 10, 1);
    }

    /**
     * Helper function to include an ACF Settings file.
     *
     * @param string $name
     * @param string $type
     * @return void
     */
    public function includeACFSettings($name = '', $type = '')
    {
        if ($name == '') {
            return;
        }

        $file = $this->partialsPathFull . DIRECTORY_SEPARATOR;

        if ($type) {
            $file .= $type . DIRECTORY_SEPARATOR;
        }

        $file .= $name . DIRECTORY_SEPARATOR . $name . $this->acfExt;

        if (file_exists($file)) {
            include_once($file);
        }
    }

    public function buildModulesFieldGroup(array $settings=array())
    {
        $layouts = [];
        foreach($GLOBALS['acf']->local->temp_groups as $group) {
            if(strpos($group['name'], 'module__') !== false) {
              //removing these from ALL Modules Listing
              if(!in_array($group['name'], ['module__headless-form-container','module__hero-d'])) {
                $title = str_replace('Module - ', '', $group['title']);
                $layouts[] = [
                    'label' => $title,
                    'name' => $group['name'],
                    'sub_fields' => [
                        [
                          'type' => 'clone',
                          'label' => '',
                          'name' => $group['name'],
                          'key' => str_replace('group_', 'field_', $group['key']),
                          'display' => 'seamless',
                          'clone' => [
                              $group['key']
                          ]
                        ]
                    ]
                ];
              }
            }
        }

        // Skip if there's no modules found
        if (empty($layouts)) {
            return;
        }

        // Sort Layouts
        usort($layouts, function($a, $b)
        {
            return strcmp($a['label'], $b['label']);
        });

        // ACF Fields
        $fields = [
            acf_flexible_content([
                'label' => '',
                'name' => 'modules',
                'key' => 'field_modules',
                'instructions' => '',
                'required' => 0,
                'button_label' => 'Add Module',
                'layouts' => $layouts
            ])
        ];

        $location[] = acf_location('post_type', 'page');
        if(isset($settings['page_template'])) {
            $location[] = acf_location('page_template', $settings['page_template']);
        }

        // ACF Field Group
        acf_field_group([
            'title' => 'Module Builder',
            'name' => 'modules',
            'key' => 'group_modules',
            'fields' => $fields,
            'location' => [
                $location
            ],
            'hide_on_screen' => [
                'the_content',
                'custom_fields',
                'format',
                'featured_image'
            ]
        ]);
    }
}

class ModuleBuilder_Partial
{
    /**
     * Theme config instance.
     *
     * @var array
     */
    protected $config;

    /**
     * Partial Key.
     *
     * @var String
     */
    protected $key;

    /**
     * Partial Name.
     *
     * @var String
     */
    public $name;

    /**
     * Partial Type.
     *
     * @var String
     */
    public $type;

    /**
     * Partial Data.
     *
     * @var Array | String
     */
    public $data;

    /**
     * Partial Content.
     *
     * @var String
     */
    public $content;

    /**
     * ACF Data Raw.
     *
     * @var Array
     */
    private $acfRaw;

    /**
     * Construct Partial.
     *
     * @param array $data
     * @return ModuleBuilder\ModuleBuilder_Partial self
     */
    public function __construct(Config $config, Array $data=array())
    {
        $this->config = $config;
        $this->acfRaw = $data;
        $this
            ->setKey()
            ->setType()
            ->setName()
            ->setData()
            ->setContent();

        return $this;
    }

    /**
     * Set partial key.
     *
     * @return self
     */
    private function setKey() {
        if(!empty($this->acfRaw['acf_fc_layout'])) {
            $this->key = $this->acfRaw['acf_fc_layout'];
        } else {
            $this->key = key($this->acfRaw);
        }

        return $this;
    }

    /**
     * Returns partial key.
     *
     * @return string
     */
    private function getKey() {
        return $this->key;
    }

    /**
     * Set partial name.
     *
     * @return self
     */
    private function setName($str = null)
    {
        // Define Partial name
        if(empty($this->name = $str)) {
            $this->name = $this->getName();
        }

        return $this;
    }

    /**
     * Returns partial name.
     *
     * @return string
     */
    public function getName()
    {
        if($this->name) {
            return $this->name;
        }

        return $this->stripType($this->getKey());
    }

    /**
     * Set partial type.
     *
     * @return self
     */
    private function setType($str = null)
    {
        // Define Partial Type
        if(empty($this->type = $str)) {
            $this->type = $this->getType();
        }

        return $this;
    }

    /**
     * Returns partial type.
     *
     * @return string
     */
    public function getType()
    {
        if($this->type) {
            return $this->type;
        }

        $key = $this->getKey();

        if ($this->isModule($key)) {
            return 'module';
        }

        if ($this->isComponent($key)) {
            return 'component';
        }

        if ($this->isElement($key)) {
            return 'element';
        }

        return '';
    }

    /**
     * Helper to strip partial type from string.
     *
     * @param string $str
     * @return string $str
     */
    private function stripType(String $str)
    {
        $type = $this->getType();
        if(strpos($str, $type) === 0) {
            return str_replace($type . '__', '', $str);
        }
        return $str;
    }

    /**
     * Helper to determine if module.
     *
     * @param $str String
     * @return Boolean
     */
    private function isModule($str = '')
    {
      if (strpos($str, 'module__') === 0) {
          return true;
      }

      // For the abbreviated version
      if (strpos($str, 'm__') === 0) {
          return true;
      }

      return false;
    }

    /**
     * Helper to determine if component.
     *
     * @param $str String
     * @return Boolean
     */
    private function isComponent($str = '')
    {
      if (strpos($str, 'component__') === 0) {
          return true;
      }

      // For the abbreviated version
      if (strpos($str, 'c__') === 0) {
          return true;
      }

      return false;
    }

    /**
     * Helper to determine if element.
     *
     * @param $str String
     * @return Boolean
     */
    private function isElement($str = '')
    {
      if (strpos($str, 'element__') === 0) {
          return true;
      }

      // For the abbreviated version
      if (strpos($str, 'e__') === 0) {
          return true;
      }

      return false;
    }

    /**
     * Sets partial data.
     *
     * @return self
     */
    private function setData($data = null)
    {
        if(empty($this->data = $data)) {
            $this->data = $this->getData();
        }

        return $this;
    }

    /**
     * Returns partial data.
     *
     * @return array
     */
    public function getData()
    {
        $data = $this->acfRaw;
        unset($data['acf_fc_layout']);

        if(!empty($data[$this->getKey()])) {
            $data = $data[$this->getKey()];
        }

        return $this->cleanUpData($data);
    }

    /**
     * Clean up partials data.
     *
     * @return array
     */
    private function cleanUpData(Array $data)
    {
        return $data;
    }

    public function getContent()
    {
        if($this->content) {
            return $this->content;
        }

        $template = new Template($this->config);
        $template
            ->setPartial($this);

        return $template->getContent();
    }

    private function setContent()
    {
        $this->content = $this->getContent();
    }

    public function render()
    {
        echo $this->getContent();
    }
}
