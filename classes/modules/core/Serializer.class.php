<?php
/*********************************************************************************
 * TimeTrex is a Workforce Management program developed by
 * TimeTrex Software Inc. Copyright (C) 2003 - 2018 TimeTrex Software Inc.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation with the addition of the following permission
 * added to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED
 * WORK IN WHICH THE COPYRIGHT IS OWNED BY TIMETREX, TIMETREX DISCLAIMS THE
 * WARRANTY OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact TimeTrex headquarters at Unit 22 - 2475 Dobbin Rd. Suite
 * #292 West Kelowna, BC V4T 2E9, Canada or at email address info@timetrex.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License
 * version 3, these Appropriate Legal Notices must retain the display of the
 * "Powered by TimeTrex" logo. If the display of the logo is not reasonably
 * feasible for technical reasons, the Appropriate Legal Notices must display
 * the words "Powered by TimeTrex".
 ********************************************************************************/


/**
 * @package Core
 */

//Use this class to serializer arrays in PHP, XML, and JSON formats.
class Serializer {
	protected $available_formats = array('PHP', 'XML', 'JSON');
	protected $format = NULL;

	protected $simple_xml_obj = NULL;

	/**
	 * Serializer constructor.
	 * @param string $format
	 */
	function __construct( $format = 'XML' ) {
		$format = strtoupper($format);

		if ( in_array($format, $this->available_formats) == TRUE ) {
			$this->format = $format;
		}

		return TRUE;
	}

	/**
	 * @param $data
	 * @return string
	 */
	function PHPSerialize( $data ) {
		return serialize( $data );
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	function PHPDeSerialize( $data ) {
		return deserialize( $data );
	}

	/**
	 * @param $data
	 * @return string
	 */
	function JSONSerialize( $data ) {
		return json_encode( $data );
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	function JSONDeSerialize( $data ) {
		return json_decode( $data );
	}

	/**
	 * @param $xml
	 * @return array|string
	 */
	function extractXML( $xml) {
		if (! ( $xml->children() ) ) {
			return (string)$xml;
		}

		$element = array();
		foreach ( $xml->children() as $child ) {
			$name = $child->getName();
			if ( count($xml->$name) == 1 ) {
				$element[$name] = $this->extractXML($child);
			} else {
				$element[$name][] = $this->extractXML($child);
			}
		}

		return $element;
	}

	/**
	 * @param $value
	 * @param $key
	 * @param $tmp_xml
	 */
	function XMLArrayWalkCallBack( &$value, $key, $tmp_xml ) {
		$tmp_xml->addChild( $key, $value );
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	function XMLSerialize( $data ) {
		if ( is_array( $data ) ) {

			//The first level should be the class name as a key.
			/*
			//Example array:
			array
			'UserFactory' =>
				array
				0 =>
					array
					'id' => string '6217' (length=4)
					'company_id' => string '1064' (length=4)
			*/
			foreach( $data as $class => $objects ) {
				$this->simple_xml_obj = new SimpleXMLElement('<timetrex></timetrex>');

				foreach( $objects as $value ) {
					$tmp_xml = $this->simple_xml_obj->addChild( $class, '' );

					array_walk_recursive( $value, array( $this, 'XMLArrayWalkCallBack' ), $tmp_xml );
				}
			}
		}

		$retval = $this->simple_xml_obj->asXML();
		unset($this->simple_xml_obj);

		return $retval;
	}

	/**
	 * @param $data
	 * @return array|string
	 */
	function XMLDeSerialize( $data ) {
		$xml = simplexml_load_string( $data );
		if ( $xml ) {
			return $this->extractXML( $xml );
		}
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	function serialize( $data ) {
		$function = $this->format.'Serialize';

		return $this->$function($data);
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	function deserialize( $data ) {
		$function = $this->format.'DeSerialize';

		return $this->$function($data);
	}
}
?>
