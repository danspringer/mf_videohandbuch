<?php
// add or edit profile (after form submit)
rex_extension::register('REX_FORM_SAVED', function() {
	// Wenn Speichern
	
});

// delete profile (after form submit)
rex_extension::register('REX_FORM_DELETED', function() {
	// Wenn löschen
	
});

$func = rex_request('func', 'string');

if ($func == '') {
	$list = rex_list::factory("SELECT `id`, `title`, `description`, `videoid` FROM `".rex::getTablePrefix()."mf_videohandbuch` ORDER BY `id` ASC");
	$list->addTableAttribute('class', 'table-striped');
	$list->setNoRowsMessage($this->i18n('mf_videohandbuch_norowsmessage'));
	
	// icon column
	$list->addColumn('Video', $tdVideo, 0, ['<th class="rex-table-icon">###VALUE###</th>', '<td><iframe width="560" height="315" src="https://www.youtube.com/embed/###videoid###?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe></td>']);
	$list->setColumnParams($thIcon, ['func' => 'edit', 'id' => '###id###']);
	
	$list->setColumnLabel('title', $this->i18n('mf_videohandbuch_column_name'));
	$list->setColumnLabel('description', $this->i18n('mf_videohandbuch_description'));
	
	$list->setColumnParams('name', ['id' => '###id###', 'func' => 'edit']);
	
	$list->removeColumn('id');
	$list->removeColumn('videoid');
	
	$content = $list->get();
	
	$fragment = new rex_fragment();
	$fragment->setVar('content', $content, false);
	$content = $fragment->parse('core/page/section.php');
	
	echo $content;
} else if ($func == 'add' || $func == 'edit') {
	$id = rex_request('id', 'int');
	
	if ($func == 'edit') {
		$formLabel = $this->i18n('mf_videohandbuch_formcaption_edit');
	} elseif ($func == 'add') {
		$formLabel = $this->i18n('mf_videohandbuch_formcaption_add');
	}
	
	$form = rex_form::factory(rex::getTablePrefix().'mf_videohandbuch', '', 'id='.$id);		

	$field = $form->addTextField('title');
	$field->setLabel($this->i18n('mf_videohandbuch_label_name'));

	$field = $form->addTextAreaField('description');
	$field->setLabel($this->i18n('mf_videohandbuch_label_description'));
	
	$field = $form->addTextField('videoid');
	$field->setLabel($this->i18n('mf_videohandbuch_label_videoid'));


	
	if ($func == 'edit') {
		$form->addParam('id', $id);
	}
	
	$content = $form->get();
	
	$fragment = new rex_fragment();
	$fragment->setVar('class', 'edit', false);
	$fragment->setVar('title', $formLabel, false);
	$fragment->setVar('body', $content, false);
	$content = $fragment->parse('core/page/section.php');
	
	echo $content;
}
?>
