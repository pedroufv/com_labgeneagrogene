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
    js(document).ready(function () {

        // when any option from country list is selected
        js("select[id='jform_category_exams']").change(function(){

            // get the selected option value of country
            var optionValue = js("select[id='jform_category_exams']").val();

            js.ajax({
                type: "POST",
                url: "index.php?option=com_labgeneagrogene&task=populateExams",
                data: ({category: optionValue, status: 1}),
                beforeSend: function(){ js("#ajaxLoader").show(); },
                complete: function(){ js("#ajaxLoader").hide(); },
                dataType: 'json',
                success: function(response){
                    var options = js("select[id='jform_code_exam']");
                    options.empty();
                    js.each(response, function() {
                        options.append(js("<option />").val(this.id).text(this.title));
                        options.trigger("liszt:updated");
                    });
                }
            });
        });

        var valorTotal = 0;
        js(".checkexam").change(function() {
            var id = this.id;
            var labelText = js("label[for="+id+"]").text();
            var price = parseFloat(labelText.split('$')[1]);
            if(this.checked) {
                valorTotal = valorTotal + price;
            } else {
                valorTotal = valorTotal - price;
            }
            js('#jform_total').val(valorTotal.toFixed(2));
            js('#total').html(valorTotal.toFixed(2));
        });
    });
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
                        <div class="control-label"><?php echo $this->form->getLabel('category_exams'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('category_exams'); ?></div>
                    </div>
                    <div id="ajaxLoader" style="display:none"><img src="components/com_labgeneagrogene/assets/images/ajax-loader.gif" alt="loading..."></div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('code_exam'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('code_exam'); ?></div>
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
                </fieldset>
            </div>
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        <input type="hidden" name="task" value=""/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
