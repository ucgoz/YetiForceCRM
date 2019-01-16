<?php

/**
 * YetiForce registration modal view class file.
 *
 * @package   Modules
 *
 * @copyright YetiForce Sp. z o.o
 * @license   YetiForce Public License 3.0 (licenses/LicenseEN.txt or yetiforce.com)
 * @author    Tomasz Poradzewski <t.poradzewski@yetiforce.com>
 */
class Settings_Yetiforce_AddLanguagesModal_View extends \App\Controller\ModalSettings
{
	/**
	 * {@inheritdoc}
	 */
	public function preProcessAjax(\App\Request $request)
	{
		$this->pageTitle = '<span class="fas fas fa-download mr-1"></span>' . \App\Language::translate('LBL_DOWNLOAD_LANGS', 'Install');
		parent::preProcessAjax($request);
	}

	/**
	 * Process user request.
	 *
	 * @param \App\Request $request
	 */
	public function process(\App\Request $request)
	{
		$qualifiedModuleName = $request->getModule(false);
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $qualifiedModuleName);
		$viewer->view('AddLanguagesModal.tpl', $qualifiedModuleName);
	}
}