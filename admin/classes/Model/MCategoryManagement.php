<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V4.

* ZeusCart V4 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 4 of the License, or
* (at your option) any later version.
* 
* ZeusCart V4 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/


/**
 * This class contains functions add a new category from the admin side 
 *
 * @package  		Model_MCategoryManagement
 * @category  		Model
 * @author    		AjSquareInc Dev Team
 * @link   		http://www.zeuscart.com
  * @copyright 		Copyright (c) 2008 - 2013, AjSquare, Inc.
 * @version  		Version 4.0
 */


class Model_MCategoryManagement
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	
	/**
	 * Function displays a template for adding a new category  
	 * from the admin side   
	 * 
	 * @return array
	 */
	function ShowTemplate()
	{
		include("classes/Lib/HandleErrors.php");
		$output['val']=$Err->values;
		$output['msg']=$Err->messages;
		

		include_once('classes/Core/Category/CCategory.php');
		include_once('classes/Display/DCategoryManagement.php');
		include("classes/Core/Settings/CCategoryManagement.php");
		$cat = new Core_Category_CCategory();
	
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
			$output['insmsg']=$_SESSION['insmsg'];
			$_SESSION['insmsg']='';
			$output['allcat']=$cat->showCat();			
			$content= new Core_Settings_CCategoryManagement();
			$output['content']=$content->showContent();			
			$output['attrib']=$content->getAttributes();
			$output['categoryparent']=$content->showCategoryParent();
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');
		$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
		$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
		$output['totalorders']=(int)Core_CAdminHome::totalOrders();
		$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
		$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
		$output['totalusers']=(int)Core_CAdminHome::totalUsers();
		$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
		$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
		$output['totalincome']=Core_CAdminHome::totalIncome();
		$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
		$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
		$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
		$output['lowstock']=Core_CAdminHome::lowStock();
		$output['totalproducts']=Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
		
		Bin_Template::createTemplate('categorymanagement.html',$output);
	}
	
	/**
	 * Function updates the new category  
	 * from the admin side   
	 * 
	 * @return array
	 */
	function addMainCategory()
	{

		include('classes/Lib/CheckInputs.php');
		$obj = new Lib_CheckInputs('category');
		
		include("classes/Lib/HandleErrors.php");
     		include_once('classes/Core/Category/CCategory.php');
		include_once('classes/Display/DCategoryManagement.php');
		include("classes/Core/Settings/CCategoryManagement.php");
				
		
		include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');
		$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
		$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
		$output['totalorders']=(int)Core_CAdminHome::totalOrders();
		$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
		$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
		$output['totalusers']=(int)Core_CAdminHome::totalUsers();
		$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
		$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
		$output['totalincome']=Core_CAdminHome::totalIncome();
		$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
		$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
		$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
		$output['lowstock']=Core_CAdminHome::lowStock();
		$output['totalproducts']=Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
	
		$content= new Core_Settings_CCategoryManagement();
		$_SESSION['updatemiancatmsg']=$content->addCategory();
		
		header('Location:?do=showmain');

						
	}	
	
	
	/**
	 * Function displays the preiview of the landing content for a category  
	 * at the admin side   
	 * 
	 * @return array
	 */
	 
	function showPreview()
	{
		include_once('classes/Core/Category/CCategory.php');
		include("classes/Core/Settings/CCategoryManagement.php");

		include_once('classes/Display/DCategoryManagement.php');
		$content= new Core_Settings_CCategoryManagement();
		$cat = new Core_Category_CCategory();
	
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{
		     $content= new Core_Settings_CCategoryManagement();
		     $output['htmlcontent']=$content->showPreview();
		}
		else
		{
		     $output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
		     Bin_Template::createTemplate('Errors.html',$output);
		}
		

	}
	/**
	 * Function to show the sub category  
	 * 
	 * @return array
	 */
	function selectSubChild()
	{

		include("classes/Core/Settings/CCategoryManagement.php");
		
		echo Core_Settings_CCategoryManagement::selectSubChild();

	}
	
}
?>