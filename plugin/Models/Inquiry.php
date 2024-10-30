<?php

namespace Inquiry\Models;

use Inquiry\Models\Input;
use Amostajo\LightweightMVC\Model;
use Amostajo\LightweightMVC\Traits\FindTrait;

/**
 * Inquiry model.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.0.0
 */
class Inquiry extends Model
{
	use FindTrait;

    /**
     * Model's post type.
     * @since 1.0
     * @var string
     */
    protected $type = 'inquiry';

    /**
     * Model's post status.
     * @since 1.0
     * @var string
     */
    protected $status = 'publish';

    /**
     * Inquiry input data.
     * @since 1.0
     * @var array
     */
    public $data = [];

    /**
     * Model's aliases.
     * @since 1.0
     * @var array
     */
    protected $aliases = [
        // Author
        'title'         => 'post_title',
        // Data as html
        'html'          => 'post_content',
        // Author
        'author'        => 'post_author',
        // Flag that indicates if inquiry was viewed by user
        'viewed'        => 'meta_viewed',
        // List of inputs added
        'inputs'        => 'meta_inputs',
    ];

    /**
     * Adds input coming from forms.
     * @since 1.0.0
     *
     * @param array $input Input definition.
     * @param mixed $value Value.
     *
     * @return object this for chaining.
     */
    public function add( $input, $value )
    {
        $slug = slugify( $input['label'] );
        // Add data
        $this->data[$slug] = [
            'label'     => $input['label'],
            'type'      => $input['type'],
            'inres'     => $input['inresults'],
            'value'     => $value,
        ];
        // Set inputs as array
        if ( ! $this->inputs || ! is_array( $this->inputs ) )
            $this->inputs = [];
        // Add slugified name to list
        if ( ! in_array( $slug, $this->inputs ) ) {
            $inputs = $this->inputs;
            $inputs[] = $slug;
            $this->inputs = $inputs;
        }
        return $this;
    }

    /**
     * OVERRIDE
     * Saves model.
     * @since 1.0.0
     */
    public function save()
    {
        // Update content
        $this->html = $this->get_html();
        parent::save();
    }

    /**
     * OVERRIDE
     * Saves all meta values.
     * @since 1.0.0
     * @since 1.1.0 Framework update fix.
     */
    public function save_meta_all()
    {
        // Save inputs.
        foreach ( $this->data as $key => $input ) {
            update_post_meta(
                $this->attributes['ID'],
                'input_' . $key,
                json_encode( $input )
            );
        }
        parent::save_meta_all();
    }

    /**
     * OVERRIDE
     * Loads meta values into objet.
     * @since 1.0.0
     */
    public function load_meta()
    {
        parent::load_meta();
        // Load inputs
        foreach ( get_post_meta( $this->attributes['ID'] ) as $key => $value ) {
            if ( preg_match( '/input_/', $key ) ) {
                $value = $value[0];
                $key = preg_replace( '/input_/', '', $key );

                $this->data[$key] = is_string( $value )
                    ? (array)json_decode( $value )
                    : ( is_integer( $value )
                        ? intval( $value )
                        : floatval( $value )
                    );
            }
        }
    }

    /**
     * Returns HTML of the data.
     * @since 1.0.0
     *
     * @return string
     */
    private function get_html()
    {
        return inquiry()->get_view( 'plugins.inquiry.admin.metaboxes.data', [
            'inquiry' => $this,
        ] );
    }
}