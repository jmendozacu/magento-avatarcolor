<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Enterprise
 * @package     Enterprise_CatalogSearch
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

/**
 * Enterprise Catalog Search Helper
 *
 * @category    Enterprise
 * @package     Enterprise_CatalogSearch
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Enterprise_CatalogSearch_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Path to fulltext indexer mode
     */
    const XML_PATH_LIVE_FULLTEXT_REINDEX_ENABLED = 'index_management/index_options/fulltext';

    /**
     * Return whether fulltext engine is on
     *
     * @return bool
     */
    public function isFulltextOn()
    {
        $searchEngine = (string) Mage::getStoreConfig('catalog/search/engine');
        return $searchEngine === '' || $searchEngine == 'catalogsearch/fulltext_engine';
    }

    /**
     * Return whether index update on save is on
     *
     * @return boolean
     */
    public function isLiveFulltextReindexEnabled()
    {
        return (bool)(string)Mage::getStoreConfig(self::XML_PATH_LIVE_FULLTEXT_REINDEX_ENABLED);
    }
}
