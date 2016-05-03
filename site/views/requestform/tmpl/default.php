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

            // when any option from country list is selected
            jQuery("select[id='jform_category_exams']").change(function(){

                // get the selected option value of country
                var optionValue = jQuery("select[id='jform_category_exams']").val();

                jQuery.ajax({
                    type: "POST",
                    url: "index.php?option=com_labgeneagrogene&task=populateExams",
                    data: ({category: optionValue, status: 1}),
                    beforeSend: function(){ jQuery("#ajaxLoader").show(); },
                    complete: function(){ jQuery("#ajaxLoader").hide(); },
                    dataType: 'json',
                    success: function(response){
                        var options = jQuery("select[id='jform_code_exam']");
                        options.empty();
                        jQuery.each(response, function() {
                            options.append(jQuery("<option />").val(this.id).text(this.title));
                            options.trigger("liszt:updated");
                        });
                    }
                });
            });

            var valorTotal = 0;
            jQuery(".checkexam").change(function() {
                var id = this.id;
                var labelText = jQuery("label[for="+id+"]").text();
                var price = parseFloat(labelText.split('$')[1]);
                if(this.checked) {
                    valorTotal = valorTotal + price;
                } else {
                    valorTotal = valorTotal - price;
                }
                jQuery('#total').html(valorTotal.toFixed(2));
            });

			jQuery('#form-request').submit(function (event) {

			});
		});
	}
</script>
<h1><?php echo JText::_('COM_LABGENEAGROGENE_ITEM_ADD'); ?></h1>
<form id="form-request" action="<?php echo JRoute::_('index.php?option=com_labgeneagrogene&task=requestform.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data" style="margin-top:25px">
    <fieldset>
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
    </fieldset>
    <fieldset>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_labgeneagrogene&task=requestform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        <input type="hidden" name="option" value="com_labgeneagrogene" />
        <input type="hidden" name="task" value="requestform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </fieldset>
</form>
