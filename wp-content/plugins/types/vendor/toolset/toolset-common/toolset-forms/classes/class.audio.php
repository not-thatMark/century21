<?php
require_once 'class.file.php';

/**
 * Description of class
 *
 * @author Srdjan
 *
 *
 */
class WPToolset_Field_Audio extends WPToolset_Field_File
{
    protected $_settings = array('min_wp_version' => '3.6');

    public function metaform()
    {
        $validation = $this->getValidationData();
        $validation = self::addTypeValidation($validation);
        $this->setValidationData($validation);
        return parent::metaform();
    }

    public static function addTypeValidation($validation) {
        $validation['extension'] = array(
            'args' => array(
                'extension',
                '16svx|2sf|8svx|aac|aif|aifc|aiff|amr|ape|asf|ast|au|aup|band|brstm|bwf|cdda|cust|dsf|dwd|flac|gsf|gsm|gym|it|jam|la|ly|m4a|m4p|mid|minipsf|mng|mod|mp1|mp2|mp3|mp4|mpc|mscz|mt2|mus|niff|nsf|off|ofr|ofs|ogg|ots|pac|psf|psf2|psflib|ptb|qsf|ra|raw|rka|rm|rmj|s3m|shn|sib|sid|smp|spc|spx|ssf|swa|tta|txm|usf|vgm|voc|vox|vqf|wav|wma|wv|xm|ym',
            ),
            'message' => __( 'You can add only audio.', 'wpv-views' ),
        );
        return $validation;
	}

	/**
	 * Get the default label for the Media Manager button when selecting a value.
	 *
	 * @return string
	 *
	 * @since 3.3
	 */
	protected function get_select_label() {
		return __( 'Select audio', 'wpv-views' );
	}

	/**
	 * Get the default label for the Media Manager button when editing a value.
	 *
	 * @return string
	 *
	 * @since 3.3
	 */
	protected function get_edit_label() {
		return __( 'Replace audio', 'wpv-views' );
	}
}
