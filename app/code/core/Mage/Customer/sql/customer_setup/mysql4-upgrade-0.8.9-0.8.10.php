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
 * @category    Mage
 * @package     Mage_Customer
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

$installer = $this;
/* @var $installer Mage_Customer_Model_Entity_Setup */

$tableCustomer =
$tableCustomerAddress = $this->getTable('customer/address_entity');

$types = array('datetime', 'decimal', 'int', 'text', 'varchar');

$tables = array($this->getTable('customer/entity'),
    $this->getTable('customer/address_entity'));

foreach ($tables as $table) {
    foreach ($types as $type) {
        $tableName = $table . '_' . $type;

        $select = $installer->getConnection()->select()
            ->from($tableName, array(
                'entity_id'         => 'entity_id',
                'attribute_id'      => 'attribute_id',
                'rows_count'        => 'COUNT(*)'))
            ->group(array('entity_id', 'attribute_id'))
            ->having('rows_count > 1');
        $query = $installer->getConnection()->query($select);

        while ($row = $query->fetch()) {
            $sql = 'DELETE FROM `' . $tableName . '`'
                . ' WHERE entity_id=? AND attribute_id=?'
                . ' LIMIT ' . ($row['rows_count'] - 1);
            $installer->getConnection()->query($sql, array(
                $row['entity_id'],
                $row['attribute_id']
            ));
        }

        $installer->getConnection()->addKey($tableName, 'IDX_ATTRIBUTE_VALUE', array('entity_id', 'attribute_id'), 'unique');
    }
}