<?php
/**
 * @version     1.0.0
 * @package     com_labgeneagrogene
 * @copyright   Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Pedro Augusto <pams.pedro@gmail.com> - http://ther.com.br/
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load language file
$lang = JFactory::getLanguage();
$lang->load('com_labgeneagrogene', JPATH_SITE);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_labgeneagrogene/assets/js/form.js');
$doc->addStyleSheet(JUri::base() . '/components/com_labgeneagrogene/assets/css/labgeneagrogene.css');

?>
<script type="text/javascript">
    if (jQuery === 'undefined') {
        document.addEventListener("DOMContentLoaded", function (event) {
            jQuery('#form-request').submit(function (event) {

            });
        });
    } else {
        jQuery(document).ready(function () {
            jQuery('#form-request').submit(function (event) {

            });
        });
    }
</script>
<h1><?php echo JText::_('COM_LABGENEAGROGENE_ITEM_ADD'); ?></h1>
<form id="form-requeste" action="<?php echo JRoute::_('index.php?option=com_labgeneagrogene&task=request.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <legend><?php echo JText::_('COM_LABGENEAGROGENE_ANIMAL'); ?></legend>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('name', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('name', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('name', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('age', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('age', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('age', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('gender', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('gender', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('gender', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('breed', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('breed', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('breed', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('species', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('species', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('species', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('owner', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('owner', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('owner', 'animals'); ?></div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo JText::_('COM_LABGENEAGROGENE_CLINIC'); ?></legend>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('title', 'readonly', 'true', 'clinics'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('title', 'clinics'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('title', 'clinics'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('code', 'readonly', 'true', 'clinics'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('code', 'clinics'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('code', 'clinics'); ?></div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo JText::_('COM_LABGENEAGROGENE_MAIN'); ?></legend>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('urgent', 'disabled', 'true'); ?>
            <?php $this->form->setFieldAttribute('urgent', 'class', 'readonly'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('urgent'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('urgent'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('totalcontainers', 'readonly', 'true'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('totalcontainers'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('totalcontainers'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('containerslist', 'readonly', 'true'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('containerslist'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('containerslist'); ?></div>
        </div>
        <div class="span5 control-group">
            <strong><?php echo JText::_('COM_LABGENEAGROGENE_FORM_LBL_SITUATION'); ?>: </strong>
            <?php $this->form->setFieldAttribute('situationsid', 'readonly', 'true'); ?>
            <span><?php echo $this->form->getInput('situationsid'); ?></span>
        </div>
    </fieldset>
    <?php if($exams = $this->form->getGroup('examslist')): ?>
    <fieldset>
        <legend><?php echo JText::_('COM_LABGENEAGROGENE_EXAMS'); ?></legend>
        <div class="control-group">
            <?php foreach($this->form->getGroup('examslist') as $field): ?>
                <div class="control-group">
                    <?php $field->readonly = true; ?>
                    <div class="exam-category"><?php echo $field->label; ?></div>
                    <div class="exam-checkboxes"><?php echo $field->input; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </fieldset>
    <?php endif; ?>
    <fieldset>
        <div class="control-group">
            <div class="controls">
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_labgeneagrogene&task=requestform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        <input type="hidden" name="option" value="com_labgeneagrogene" />
        <input type="hidden" name="task" value="request.save" />
        <?php echo JHtml::_('form.token'); ?>
    </fieldset>
</form>
