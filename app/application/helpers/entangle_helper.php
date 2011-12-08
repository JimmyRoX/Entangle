<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function metadata_types() {
	
	return array('string' => 'string',
				'longtext' => 'text',
				'number' => 'number',
				'date' => 'date/time',
				'url' => 'url',
				'file' => 'file');
}

function contrib_types() {
	
	return array('text' => 'text',
				'url' => 'url',
				'file' => 'file');

}