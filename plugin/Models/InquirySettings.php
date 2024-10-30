<?php

namespace Inquiry\Models;

use Inquiry\Models\OptionModel;
use Amostajo\LightweightMVC\Model;
use Amostajo\LightweightMVC\Traits\FindTrait;

/**
 * Inquiry Settings model.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality
 * @package Inquiry
 * @version 1.1.0
 */
class InquirySettings extends OptionModel
{
    /**
     * Model id.
     * @since 1.0.0
     * @var string
     */
    protected $id = 'inquiry';

    /**
     * Widget instance information.
     * @since 1.0.0
     * @var string
     */
    protected $instance;

    /**
     * Field aliases and definitions.
     * @since 1.0.0
     * @since 1.1.0 Added SMTP
     * @var array
     */
    protected $aliases = [
        'inputs'                    => 'field_inputs',
        'is_notification_enabled'   => 'field_is_notification_enabled',
        'notification_email'        => 'field_notification_email',
        'notification_subject'      => 'field_notification_subject',
        'can_admin_edit'            => 'field_can_admin_edit',
        'button_text'               => 'field_button_text',
        'title_format'              => 'field_title_format',
        'can_enqueue'               => 'field_can_enqueue',
        'engine'                    => 'field_engine',
        'smtp_host'                 => 'field_smtp_host',
        'smtp_auth'                 => 'field_smtp_auth',
        'smtp_username'             => 'field_smtp_username',
        'smtp_password'             => 'field_smtp_password',
        'smtp_raw_password'         => 'func_get_smtp_password',
        'smtp_port'                 => 'field_smtp_port',
        'smtp_security'             => 'field_smtp_security',
        'smtp_from'                 => 'field_smtp_from',
        'security_key'              => 'field_security_key',
    ];

    /**
     * Finds and returns record from db.
     * @since 1.0.0
     *
     * @return object
     */
    public static function find()
    {
        return new self();
    }

    /**
     * Sets widget instance.
     * @since 1.0.0
     *
     * @param array $instance Widget instance.
     *
     * @return this for chaining
     */
    public function instance( $instance )
    {
        $this->instance = $instance;
        return $this;
    }

    /**
     * Returns encrypted value.
     * @since 1.1.0
     *
     * @param mixed $value Value to encrypt.
     *
     * @return string
     */
    protected function encrypt( $value )
    {
        return base64_encode( mcrypt_encrypt(
            MCRYPT_RC2,
            $this->security_key,
            $value,
            MCRYPT_MODE_ECB
        ) );
    }

    /**
     * Returns decrypted value.
     * @since 1.1.0
     *
     * @param string $value Value to decrypt.
     *
     * @return mixed
     */
    protected function decrypt( $value ) {
        return trim( mcrypt_decrypt(
            MCRYPT_RC2,
            $this->security_key,
            base64_decode( $value ),
            MCRYPT_MODE_ECB
        ) );
    }

    /**
     * Returns decrypted smtp password.
     * @since 1.1.0
     *
     * @return string
     */
    public function get_smtp_password()
    {
        return $this->decrypt( $this->smtp_password );
    }

    /**
     * Sets and encrypts smtp password.
     * @since 1.1.0
     *
     * @param string $value Password.
     */
    public function set_smtp_password($value)
    {
        $this->smtp_password = $this->encrypt( $value );
    }
}