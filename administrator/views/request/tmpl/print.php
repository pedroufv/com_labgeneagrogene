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

$document = JFactory::getDocument();
$document->addStyleSheet('components/com_labgeneagrogene/assets/css/labgeneagrogene.css');
$document->addStyleSheet('components/com_labgeneagrogene/assets/css/print.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function () {
        window.print();
    });
</script>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <fieldset class="adminform">
                    <input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>"/>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('product'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('product'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('category_exams'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('category_exams'); ?></div>
                    </div>
                    <div id="ajaxLoader" style="display:none"><img src="components/com_labgeneagrogene/assets/images/ajax-loader.gif" alt="loading..."></div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('code_exams'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('code_exams'); ?></div>
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
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('info'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('info'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('situationsid'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('situationsid'); ?></div>
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
</div>
