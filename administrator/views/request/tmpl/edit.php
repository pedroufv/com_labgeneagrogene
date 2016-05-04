<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Labgeneagrogene
 * @author     Pedro Augusto <pams.pedro@gmail.com>
 * @copyright  Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.modal');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_labgeneagrogene/assets/css/labgeneagrogene.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    Joomla.submitbutton = function (task) {
        if (task == 'request.cancel') {
            Joomla.submitform(task, document.getElementById('request-form'));
        }
        else {

            if (task != 'request.cancel' && document.formvalidator.isValid(document.id('request-form'))) {

                Joomla.submitform(task, document.getElementById('request-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_labgeneagrogene&layout=edit&id=' . (int)$this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="request-form" class="form-validate">
    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_LABGENEAGROGENE_REQUEST', true)); ?>
        <div class="row-fluid">
            <div class="span12 form-horizontal">
                <fieldset class="adminform">
                    <input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>"/>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('product'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('product'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('deadline'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('deadline'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('lot'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('lot'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('reference'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('reference'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('date_manufacture'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('date_manufacture'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('date_validity'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('date_validity'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('constitution'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('constitution'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('number_products'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('number_products'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('date_reception'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('date_reception'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('situationsid'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('situationsid'); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('info'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('info'); ?></div>
                    </div>
                    <div class="span12 control-group">
                        <?php foreach($this->form->getGroup('examslist') as $field): ?>
                            <div class="span4 control-group">
                                <div class="exam-category"><?php echo $field->label; ?></div>
                                <div class="exam-checkboxes"><?php echo $field->input; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
            </div>
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        <input type="hidden" name="task" value=""/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
