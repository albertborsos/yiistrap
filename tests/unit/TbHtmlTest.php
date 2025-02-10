<?php

require(__DIR__ . '/../../helpers/TbHtml.php');

class Dummy extends CModel
{
    public $text = 'text';
    public $password = 'secret';
    public $url = 'http://www.getyiistrap.com';
    public $email = 'christoffer.niska@gmail.com';
    public $number = 42;
    public $range = 3.33;
    public $date = '2013-08-28';
    public $file = '';
    public $radio = true;
    public $checkbox = false;
    public $uneditable = 'Uneditable text';
    public $search = 'Search query';
    public $textarea = 'Textarea text';
    public $dropdown = '1';
    public $listbox = '1';
    public $radioList = '0';
    public $checkboxList = ['0', '2'];

    public function attributeNames()
    {
        return [];
    }
}

class TbHtmlTest extends TbTestCase
{
    /**
     * @var \CodeGuy
     */
    protected $codeGuy;

    protected function _before()
    {
        $this->mockApplication();
    }

    public function testLead()
    {
        $I = $this->codeGuy;
        $html = TbHtml::lead('Lead text');
        $p = $I->createNode($html, 'p.lead');
        $I->seeNodeText($p, 'Lead text');
    }

    public function testSmall()
    {
        $I = $this->codeGuy;
        $html = TbHtml::small('Small text');
        $small = $I->createNode($html, 'small');
        $I->seeNodeText($small, 'Small text');
    }

    public function testBold()
    {
        $I = $this->codeGuy;
        $html = TbHtml::b('Bold text');
        $strong = $I->createNode($html, 'strong');
        $I->seeNodeText($strong, 'Bold text');
    }

    public function testItalic()
    {
        $I = $this->codeGuy;
        $html = TbHtml::i('Italic text');
        $em = $I->createNode($html, 'em');
        $I->seeNodeText($em, 'Italic text');
    }

    public function testEmphasize()
    {
        $I = $this->codeGuy;

        $html = TbHtml::em(
            'Warning text',
            [
                'color' => TbHtml::TEXT_COLOR_WARNING,
            ]
        );
        $span = $I->createNode($html, 'p.text-warning');
        $I->seeNodeText($span, 'Warning text');

        $html = TbHtml::em(
            'Success text',
            [
                'color' => TbHtml::TEXT_COLOR_SUCCESS,
            ],
            'span'
        );
        $span = $I->createNode($html, 'span.text-success');
        $I->seeNodeText($span, 'Success text');
    }

    public function testMuted()
    {
        $I = $this->codeGuy;
        $html = TbHtml::muted('Muted text');
        $p = $I->createNode($html, 'p.muted');
        $I->seeNodeText($p, 'Muted text');
    }

    public function testMutedSpan()
    {
        $I = $this->codeGuy;
        $html = TbHtml::mutedSpan('Muted text');
        $span = $I->createNode($html, 'span.muted');
        $I->seeNodeText($span, 'Muted text');
    }

    public function testAbbreviation()
    {
        $I = $this->codeGuy;
        $html = TbHtml::abbr('Abbreviation', 'Word');
        $abbr = $I->createNode($html, 'abbr');
        $I->seeNodeAttribute($abbr, 'title', 'Word');
        $I->seeNodeText($abbr, 'Abbreviation');
    }

    public function testSmallAbbreviation()
    {
        $I = $this->codeGuy;
        $html = TbHtml::smallAbbr('Abbreviation', 'Word');
        $abbr = $I->createNode($html, 'abbr');
        $I->seeNodeAttribute($abbr, 'title', 'Word');
        $I->seeNodeCssClass($abbr, 'initialism');
        $I->seeNodeText($abbr, 'Abbreviation');
    }

    public function testAddress()
    {
        $I = $this->codeGuy;
        $html = TbHtml::address('Address text');
        $addr = $I->createNode($html, 'address');
        $I->seeNodeText($addr, 'Address text');
    }

    public function testQuote()
    {
        $I = $this->codeGuy;
        $html = TbHtml::quote(
            'Quote text',
            [
                'paragraphOptions' => ['class' => 'paragraph'],
                'source' => 'Source text',
                'sourceOptions' => ['class' => 'source'],
                'cite' => 'Cited text',
                'citeOptions' => ['class' => 'cite'],
            ]
        );
        $blockquote = $I->createNode($html, 'blockquote');
        $I->seeNodeChildren($blockquote, ['p', 'small']);
        $p = $blockquote->filter('p');
        $I->seeNodeCssClass($p, 'paragraph');
        $I->seeNodeText($p, 'Quote text');
        $small = $blockquote->filter('blockquote > small');
        $I->seeNodeCssClass($small, 'source');
        $I->seeNodeText($small, 'Source text');
        $cite = $small->filter('small > cite');
        $I->seeNodeCssClass($cite, 'cite');
        $I->seeNodeText($cite, 'Cited text');
        // todo: consider writing a test including the pull-right quote as well.
    }

    public function testHelp()
    {
        $I = $this->codeGuy;
        $html = TbHtml::help('Help text');
        $span = $I->createNode($html, 'span.help-inline');
        $I->seeNodeText($span, 'Help text');
    }

    public function testHelpBlock()
    {
        $I = $this->codeGuy;
        $html = TbHtml::helpBlock('Help text');
        $p = $I->createNode($html, 'p.help-block');
        $I->seeNodeText($p, 'Help text');
    }

    public function testCode()
    {
        $I = $this->codeGuy;
        $html = TbHtml::code('Source code');
        $code = $I->createNode($html, 'code');
        $I->seeNodeText($code, 'Source code');
    }

    public function testCodeBlock()
    {
        $I = $this->codeGuy;
        $html = TbHtml::codeBlock('Source code');
        $pre = $I->createNode($html, 'pre');
        $I->seeNodeText($pre, 'Source code');
    }

    public function testTag()
    {
        $I = $this->codeGuy;
        $html = TbHtml::tag(
            'div',
            [
                'textAlign' => TbHtml::TEXT_ALIGN_RIGHT,
                'pull' => TbHtml::PULL_RIGHT,
                'span' => 3,
            ],
            'Content'
        );
        $div = $I->createNode($html, 'div');
        $I->seeNodeCssClass($div, 'pull-right span3 text-right');
    }

    public function testOpenTag()
    {
        $I = $this->codeGuy;
        $html = TbHtml::openTag(
            'p',
            [
                'class' => 'tag',
            ]
        );
        $p = $I->createNode($html, 'p');
        $I->seeNodeCssClass($p, 'tag');
    }

    public function testForm()
    {
        $I = $this->codeGuy;
        $html = TbHtml::formTb(
            TbHtml::FORM_LAYOUT_VERTICAL,
            '#',
            'post',
            [
                'class' => 'form',
            ]
        );
        $form = $I->createNode($html, 'form.form-vertical');
        $I->seeNodeCssClass($form, 'form');
        $I->seeNodeAttributes(
            $form,
            [
                'action' => '#',
                'method' => 'post'
            ]
        );
    }

    public function testBeginForm()
    {
        $I = $this->codeGuy;
        $html = TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_VERTICAL, '#');
        $form = $I->createNode($html, 'form');
        $I->seeNodeCssClass($form, 'form-vertical');
    }

    public function testStatefulForm()
    {
        $I = $this->codeGuy;
        $html = TbHtml::statefulFormTb(TbHtml::FORM_LAYOUT_VERTICAL, '#');
        $body = $I->createNode($html);
        $form = $body->filter('form');
        $I->seeNodeCssClass($form, 'form-vertical');
        $div = $body->filter('div');
        $I->seeNodeCssStyle($div, 'display: none');
        $input = $div->filter('input[type=hidden]');
        $I->seeNodeAttributes(
            $input,
            [
                'name' => 'YII_PAGE_STATE',
                'value' => '',
            ]
        );
    }

    public function testTextField()
    {
        $I = $this->codeGuy;

        $html = TbHtml::textField(
            'text',
            'text',
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=text]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'text',
                'name' => 'text',
                'value' => 'text',
            ]
        );

        $html = TbHtml::textField(
            'text',
            'text',
            [
                'prepend' => 'Prepend text',
            ]
        );
        $div = $I->createNode($html, 'div');
        $I->seeNodeCssClass($div, 'input-prepend');
        $I->seeNodeChildren($div, ['span', 'input']);
        $span = $div->filter('span.add-on');
        $I->seeNodeText($span, 'Prepend text');

        $html = TbHtml::textField(
            'text',
            'text',
            [
                'append' => 'Append text',
            ]
        );
        $div = $I->createNode($html, 'div');
        $I->seeNodeCssClass($div, 'input-append');
        $I->seeNodeChildren($div, ['input', 'span']);
        $span = $div->filter('span.add-on');
        $I->seeNodeText($span, 'Append text');

        $html = TbHtml::textField(
            'text',
            'text',
            [
                'prepend' => 'Prepend text',
                'append' => 'Append text',
            ]
        );
        $div = $I->createNode($html, 'div');
        $I->seeNodeCssClass($div, 'input-prepend input-append');
        $I->seeNodeChildren($div, ['span', 'input', 'span']);

        $html = TbHtml::textField(
            'text',
            'text',
            [
                'block' => true,
            ]
        );
        $input = $I->createNode($html, 'input');
        $I->seeNodeCssClass($input, 'input-block-level');
    }

    public function testPasswordField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::passwordField(
            'password',
            'secret',
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=password]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'password',
                'name' => 'password',
                'value' => 'secret',
            ]
        );
    }

    public function testUrlField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::urlField(
            'url',
            'http://www.getyiistrap.com',
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=url]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'url',
                'name' => 'url',
                'value' => 'http://www.getyiistrap.com',
            ]
        );
    }

    public function testEmailField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::emailField(
            'email',
            'christoffer.niska@gmail.com',
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=email]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'email',
                'name' => 'email',
                'value' => 'christoffer.niska@gmail.com',
            ]
        );
    }

    public function testNumberField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::numberField(
            'number',
            42,
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=number]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'number',
                'name' => 'number',
                'value' => '42',
            ]
        );
    }

    public function testRangeField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::rangeField(
            'range',
            3.33,
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=range]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'range',
                'name' => 'range',
                'value' => '3.33',
            ]
        );
    }

    public function testDateField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::dateField(
            'date',
            '2013-08-28',
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=date]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'date',
                'name' => 'date',
                'value' => '2013-08-28',
            ]
        );
    }

    public function testFileField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::fileField(
            'file',
            '',
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=file]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'file',
                'name' => 'file',
                'value' => '',
            ]
        );
    }

    public function testTextArea()
    {
        $I = $this->codeGuy;
        $html = TbHtml::textArea(
            'textarea',
            'Textarea text',
            [
                'class' => 'textarea',
            ]
        );
        $textarea = $I->createNode($html, 'textarea');
        $I->seeNodeAttributes(
            $textarea,
            [
                'class' => 'textarea',
                'id' => 'textarea',
                'name' => 'textarea',
            ]
        );
        $I->seeNodeText($textarea, 'Textarea text');
    }

    public function testRadioButton()
    {
        $I = $this->codeGuy;

        $html = TbHtml::radioButton(
            'radio',
            false,
            [
                'class' => 'input',
                'label' => 'Label text',
            ]
        );
        $label = $I->createNode($html, 'label');
        $I->seeNodeCssClass($label, 'radio');
        $I->seeNodePattern($label, '/> Label text$/');
        $input = $label->filter('input[type=radio]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'radio',
                'name' => 'radio',
                'value' => '1',
            ]
        );
        $I->dontSeeNodeAttribute($input, 'checked');

        $html = TbHtml::radioButton('radio', true);
        $input = $I->createNode($html, 'input[type=radio]');
        $I->seeNodeAttribute($input, 'checked', 'checked');
    }

    public function testCheckBox()
    {
        $I = $this->codeGuy;
        $html = TbHtml::checkBox(
            'checkbox',
            false,
            [
                'class' => 'input',
                'label' => 'Label text',
            ]
        );
        $label = $I->createNode($html, 'label');
        $I->seeNodeCssClass($label, 'checkbox');
        $I->seeNodePattern($label, '/> Label text$/');
        $input = $label->filter('input[type=checkbox]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'checkbox',
                'name' => 'checkbox',
                'value' => '1',
            ]
        );
        $I->dontSeeNodeAttribute($input, 'checked');

        $html = TbHtml::checkBox('checkbox', true);
        $input = $I->createNode($html, 'input[type=checkbox]');
        $I->seeNodeAttribute($input, 'checked', 'checked');
    }

    public function testDropDownList()
    {
        $I = $this->codeGuy;
        $html = TbHtml::dropDownList(
            'dropdown',
            null,
            ['1', '2', '3', '4', '5'],
            [
                'class' => 'list',
                'empty' => 'Empty text',
                'size' => TbHtml::INPUT_SIZE_LARGE,
                'textAlign' => TbHtml::TEXT_ALIGN_CENTER,
            ]
        );
        $select = $I->createNode($html, 'select');
        $I->seeNodeCssClass($select, 'input-large text-center list');
        $I->dontSeeNodeAttribute($select, 'size');
    }

    public function testListBox()
    {
        $I = $this->codeGuy;

        $html = TbHtml::listBox(
            'listbox',
            null,
            ['1', '2', '3', '4', '5'],
            [
                'class' => 'list',
                'empty' => 'Empty text',
                'size' => TbHtml::INPUT_SIZE_LARGE,
                'textAlign' => TbHtml::TEXT_ALIGN_CENTER,
            ]
        );
        $select = $I->createNode($html, 'select');
        $I->seeNodeCssClass($select, 'input-large text-center list');
        $I->seeNodeAttributes(
            $select,
            [
                'name' => 'listbox',
                'id' => 'listbox',
                'size' => 4,
            ]
        );

        $html = TbHtml::listBox(
            'listbox',
            null,
            ['1', '2', '3', '4', '5'],
            [
                'multiple' => true,
            ]
        );
        $select = $I->createNode($html, 'select');
        $I->seeNodeAttribute($select, 'name', 'listbox[]');
    }

    public function testRadioButtonList()
    {
        $I = $this->codeGuy;
        $html = TbHtml::radioButtonList(
            'radioList',
            null,
            ['Option 1', 'Option 2', 'Option 3'],
            [
                'separator' => '<br>',
                'container' => 'div',
                'containerOptions' => ['class' => 'container'],
            ]
        );
        $container = $I->createNode($html, 'div.container');
        $I->seeNodeChildren($container, ['label.radio', 'br', 'label.radio', 'br', 'label.radio']);
        $label = $container->filter('label')->first();
        $I->seeNodePattern($label, '/> Option 1$/');
        $input = $label->filter('input[type=radio]');
        $I->seeNodeAttributes(
            $input,
            [
                'id' => 'radioList_0',
                'name' => 'radioList',
                'value' => '0',
            ]
        );
    }

    public function testInlineRadioButtonList()
    {
        $I = $this->codeGuy;
        $html = TbHtml::inlineRadioButtonList(
            'radioList',
            null,
            ['Option 1', 'Option 2', 'Option 3']
        );
        $span = $I->createNode($html, 'span');
        $I->seeNodeNumChildren($span, 3);
        $I->seeNodeChildren($span, ['label.radio.inline', 'label.radio.inline', 'label.radio.inline']);
    }

    public function testCheckboxList()
    {
        $I = $this->codeGuy;

        $html = TbHtml::checkBoxList(
            'checkboxList',
            null,
            ['Option 1', 'Option 2', 'Option 3'],
            [
                'separator' => '<br>',
                'container' => 'div',
                'containerOptions' => ['class' => 'container'],
            ]
        );
        $container = $I->createNode($html, 'div.container');
        $I->seeNodeChildren($container, ['label.checkbox', 'br', 'label.checkbox', 'br', 'label.checkbox']);
        $label = $container->filter('label')->first();
        $I->seeNodePattern($label, '/> Option 1$/');
        $input = $label->filter('input[type=checkbox]');
        $I->seeNodeAttributes(
            $input,
            [
                'id' => 'checkboxList_0',
                'name' => 'checkboxList[]',
                'value' => '0',
            ]
        );

        $html = TbHtml::checkBoxList(
            'checkboxList',
            null,
            ['Option 1', 'Option 2', 'Option 3'],
            [
                'checkAll' => true,
            ]
        );
        $span = $I->createNode($html, 'span');
        $I->seeNodeChildren(
            $span,
            ['input[type=checkbox]', 'label.checkbox', 'label.checkbox', 'label.checkbox', 'label.checkbox']
        );
        $label = $span->filter('label')->first();
        $input = $label->filter('input');
        $I->seeNodeAttribute($input, 'name', 'checkboxList_all');

        $html = TbHtml::checkBoxList(
            'checkboxList',
            null,
            ['Option 1', 'Option 2', 'Option 3'],
            [
                'checkAll' => true,
                'checkAllLast' => true,
            ]
        );
        $span = $I->createNode($html, 'span');
        $I->seeNodeChildren(
            $span,
            ['label.checkbox', 'label.checkbox', 'label.checkbox', 'label.checkbox', 'input[type=checkbox]']
        );
        $label = $span->filter('label')->last();
        $input = $label->filter('input');
        $I->seeNodeAttribute($input, 'name', 'checkboxList_all');
    }

    public function testInlineCheckBoxList()
    {
        $I = $this->codeGuy;
        $html = TbHtml::inlineCheckBoxList(
            'checkboxList',
            null,
            ['Option 1', 'Option 2', 'Option 3']
        );
        $span = $I->createNode($html, 'span');
        $I->seeNodeNumChildren($span, 3);
        $I->seeNodeChildren(
            $span,
            ['label.checkbox.inline', 'label.checkbox.inline', 'label.checkbox.inline']
        );
    }

    public function testUneditableField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::uneditableField(
            'Uneditable text',
            [
                'class' => 'span',
            ]
        );
        $span = $I->createNode($html, 'span.uneditable-input');
        $I->seeNodeCssClass($span, 'span');
        $I->seeNodeText($span, 'Uneditable text');
    }

    public function testSearchQueryField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::searchQueryField(
            'search',
            'Search query',
            [
                'class' => 'input',
            ]
        );
        $input = $I->createNode($html, 'input[type=text].search-query');
        $I->seeNodeCssClass($input, 'input');
        $I->seeNodeAttributes(
            $input,
            [
                'id' => 'search',
                'name' => 'search',
                'value' => 'Search query',
            ]
        );
    }

    public function testTextFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::textFieldControlGroup('text', 'text');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=text]']);
    }

    public function testPasswordFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::passwordFieldControlGroup('password', 'secret');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=password]']);
    }

    public function testUrlFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::urlFieldControlGroup('url', 'url');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=url]']);
    }

    public function testEmailFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::emailFieldControlGroup('email', 'email');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=email]']);
    }

    public function testNumberFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::numberFieldControlGroup('number', 'number');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=number]']);
    }

    public function testRangeFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::rangeFieldControlGroup('range', 'range');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=range]']);
    }

    public function testDateFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::dateFieldControlGroup('date', 'date');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=date]']);
    }

    public function testFileFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::fileFieldControlGroup('file', 'file');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=file]']);
    }

    public function testTextAreaControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::textAreaControlGroup('textarea', 'Textarea text');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['textarea']);
    }

    public function testRadioButtonControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::radioButtonControlGroup(
            'radio',
            false,
            [
                'label' => 'Label text',
            ]
        );
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.radio');
        $I->seeNodeChildren($label, ['input[type=radio]']);
    }

    public function testCheckBoxControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::checkBoxControlGroup(
            'checkbox',
            false,
            [
                'label' => 'Label text',
            ]
        );
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.checkbox');
        $I->seeNodeChildren($label, ['input[type=checkbox]']);
    }

    public function testDropDownListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::dropDownListControlGroup(
            'dropdown',
            '',
            ['1', '2', '3', '4', '5']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['select']);
    }

    public function testListBoxControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::listBoxControlGroup(
            'listbox',
            '',
            ['1', '2', '3', '4', '5']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['select']);
    }

    public function testRadioButtonListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::radioButtonListControlGroup(
            'radioList',
            '1',
            ['Option 1', 'Option 2', 'Option 3']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['label.radio', 'label.radio', 'label.radio']);
    }

    public function testInlineRadioButtonListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::inlineRadioButtonListControlGroup(
            'radioList',
            '1',
            ['Option 1', 'Option 2', 'Option 3']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['label.radio.inline', 'label.radio.inline', 'label.radio.inline']);
    }

    public function testCheckBoxListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::checkBoxListControlGroup(
            'checkboxList',
            ['0', '2'],
            ['Option 1', 'Option 2', 'Option 3']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['label.checkbox', 'label.checkbox', 'label.checkbox']);
    }

    public function testInlineCheckBoxListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::inlineCheckBoxListControlGroup(
            'checkboxList',
            ['0', '2'],
            ['Option 1', 'Option 2', 'Option 3']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren(
            $controls,
            ['label.checkbox.inline', 'label.checkbox.inline', 'label.checkbox.inline']
        );
    }

    public function testUneditableFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::uneditableFieldControlGroup('Uneditable text');
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['span.uneditable-input']);
    }

    public function testSearchQueryControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::searchQueryControlGroup('Search query');
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['input[type=text].search-query']);
    }

    public function testControlGroup()
    {
        $I = $this->codeGuy;

        $html = TbHtml::controlGroup(
            TbHtml::INPUT_TYPE_TEXT,
            'text',
            '',
            [
                'color' => TbHtml::INPUT_COLOR_SUCCESS,
                'groupOptions' => ['class' => 'group'],
                'label' => 'Label text',
                'labelOptions' => ['class' => 'label'],
                'help' => 'Help text',
                'helpOptions' => ['class' => 'help'],
            ]
        );
        $group = $I->createNode($html, 'div.control-group');
        $I->seeNodeCssClass($group, 'success group');
        $I->seeNodeChildren($group, ['label.control-label', 'div.controls']);
        $label = $group->filter('label.control-label');
        $I->seeNodeCssClass($label, 'label');
        $I->seeNodeAttribute($label, 'for', 'text');
        $I->seeNodeText($label, 'Label text');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['input', 'span']);
        $input = $controls->filter('input[type=text]');
        $I->seeNodeAttributes(
            $input,
            [
                'id' => 'text',
                'name' => 'text',
                'value' => '',
            ]
        );
        $help = $controls->filter('span.help-inline');
        $I->seeNodeCssClass($help, 'help');
        $I->seeNodeText($help, 'Help text');

        $html = TbHtml::controlGroup(
            TbHtml::INPUT_TYPE_RADIOBUTTON,
            'radio',
            true,
            [
                'label' => 'Label text',
            ]
        );
        $group = $I->createNode($html, 'div.control-group');
        $I->seeNodeChildren($group, ['div.controls']);
        $controls = $group->filter('div.controls');
        $label = $controls->filter('label.radio');
        $I->seeNodePattern($label, '/> Label text$/');
        $radio = $label->filter('input[type=radio]');
        $I->seeNodeAttributes(
            $radio,
            [
                'checked' => 'checked',
                'id' => 'radio',
                'name' => 'radio',
                'value' => '1',
            ]
        );
    }

    public function testCustomControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::customControlGroup(
            '<div class="widget"></div>',
            'custom',
            [
                'label' => false,
            ]
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['div.widget']);
    }

    public function testActiveTextField()
    {
        $I = $this->codeGuy;

        $html = TbHtml::activeTextField(
            new Dummy,
            'text',
            [
                'class' => 'input'
            ]
        );
        $input = $I->createNode($html, 'input[type=text]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'Dummy_text',
                'name' => 'Dummy[text]',
                'value' => 'text',
            ]
        );

        $html = TbHtml::activeTextField(
            new Dummy,
            'text',
            [
                'prepend' => 'Prepend text',
            ]
        );
        $div = $I->createNode($html, 'div');
        $I->seeNodeCssClass($div, 'input-prepend');
        $I->seeNodeChildren($div, ['span.add-on', 'input']);
        $span = $div->filter('span.add-on');
        $I->seeNodeText($span, 'Prepend text');

        $html = TbHtml::activeTextField(
            new Dummy,
            'text',
            [
                'append' => 'Append text',
            ]
        );
        $div = $I->createNode($html, 'div');
        $I->seeNodeCssClass($div, 'input-append');
        $I->seeNodeChildren($div, ['input', 'span']);
        $span = $div->filter('span.add-on');
        $I->seeNodeText($span, 'Append text');

        $html = TbHtml::activeTextField(
            new Dummy,
            'text',
            [
                'prepend' => 'Prepend text',
                'append' => 'Append text',
            ]
        );
        $div = $I->createNode($html, 'div');
        $I->seeNodeCssClass($div, 'input-prepend input-append');
        $I->seeNodeChildren($div, ['span.add-on', 'input', 'span.add-on']);
    }

    public function testActivePasswordField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activePasswordField(
            new Dummy,
            'password',
            [
                'class' => 'input'
            ]
        );
        $input = $I->createNode($html, 'input[type=password]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'Dummy_password',
                'name' => 'Dummy[password]',
                'value' => 'secret',
            ]
        );
    }

    public function testActiveUrlField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeUrlField(
            new Dummy,
            'url',
            [
                'class' => 'input'
            ]
        );
        $input = $I->createNode($html, 'input[type=url]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'Dummy_url',
                'name' => 'Dummy[url]',
                'value' => 'http://www.getyiistrap.com',
            ]
        );
    }

    public function testActiveEmailField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeEmailField(
            new Dummy,
            'email',
            [
                'class' => 'input'
            ]
        );
        $input = $I->createNode($html, 'input[type=email]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'Dummy_email',
                'name' => 'Dummy[email]',
                'value' => 'christoffer.niska@gmail.com',
            ]
        );
    }

    public function testActiveNumberField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeNumberField(
            new Dummy,
            'number',
            [
                'class' => 'input'
            ]
        );
        $input = $I->createNode($html, 'input[type=number]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'Dummy_number',
                'name' => 'Dummy[number]',
                'value' => '42',
            ]
        );
    }

    public function testActiveRangeField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeRangeField(
            new Dummy,
            'range',
            [
                'class' => 'input'
            ]
        );
        $input = $I->createNode($html, 'input[type=range]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'Dummy_range',
                'name' => 'Dummy[range]',
                'value' => '3.33',
            ]
        );
    }

    public function testActiveDateField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeDateField(
            new Dummy,
            'date',
            [
                'class' => 'input'
            ]
        );
        $input = $I->createNode($html, 'input[type=date]');
        $I->seeNodeAttributes(
            $input,
            [
                'class' => 'input',
                'id' => 'Dummy_date',
                'name' => 'Dummy[date]',
                'value' => '2013-08-28',
            ]
        );
    }

    public function testActiveTextArea()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeTextArea(
            new Dummy,
            'textarea',
            [
                'class' => 'textarea',
            ]
        );
        $textarea = $I->createNode($html, 'textarea');
        $I->seeNodeAttributes(
            $textarea,
            [
                'class' => 'textarea',
                'id' => 'Dummy_textarea',
                'name' => 'Dummy[textarea]',
            ]
        );
        $I->seeNodeText($textarea, 'Textarea text');
    }

    public function testActiveRadioButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeRadioButton(
            new Dummy,
            'radio',
            [
                'class' => 'input',
                'label' => 'Label text',
            ]
        );
        $body = $I->createNode($html, 'body');
        $hidden = $body->filter('input[type=hidden]');
        $I->seeNodeAttributes(
            $hidden,
            [
                'id' => 'ytDummy_radio',
                'name' => 'Dummy[radio]',
                'value' => '0',
            ]
        );
        $label = $body->filter('label');
        $I->seeNodeCssClass($label, 'radio');
        $radio = $label->filter('input[type=radio]');
        $I->seeNodeAttributes(
            $radio,
            [
                'class' => 'input',
                'checked' => 'checked',
                'id' => 'Dummy_radio',
                'name' => 'Dummy[radio]',
                'value' => '1',
            ]
        );
        $I->seeNodePattern($label, '/> Label text$/');
    }

    public function testActiveCheckBox()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeCheckBox(
            new Dummy,
            'checkbox',
            [
                'class' => 'input',
                'label' => 'Label text',
            ]
        );
        $body = $I->createNode($html, 'body');
        $hidden = $body->filter('input[type=hidden]');
        $I->seeNodeAttributes(
            $hidden,
            [
                'id' => 'ytDummy_checkbox',
                'name' => 'Dummy[checkbox]',
                'value' => '0',
            ]
        );
        $label = $body->filter('label');
        $I->seeNodeCssClass($label, 'checkbox');
        $checkbox = $label->filter('input[type=checkbox]');
        $I->seeNodeAttributes(
            $checkbox,
            [
                'class' => 'input',
                'id' => 'Dummy_checkbox',
                'name' => 'Dummy[checkbox]',
                'value' => '1',
            ]
        );
        $I->seeNodePattern($label, '/> Label text$/');
    }

    public function testActiveDropDownList()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeDropDownList(
            new Dummy,
            'dropdown',
            ['1', '2', '3', '4', '5'],
            [
                'class' => 'list',
                'empty' => 'Empty text',
                'size' => TbHtml::INPUT_SIZE_LARGE,
                'textAlign' => TbHtml::TEXT_ALIGN_CENTER,
            ]
        );
        $select = $I->createNode($html, 'select');
        $I->seeNodeCssClass($select, 'input-large text-center list');
        $I->dontSeeNodeAttribute($select, 'size');
    }

    public function testActiveListBox()
    {
        $I = $this->codeGuy;

        $html = TbHtml::activeListBox(
            new Dummy,
            'listbox',
            ['1', '2', '3', '4', '5'],
            [
                'class' => 'list',
                'empty' => 'Empty text',
                'size' => TbHtml::INPUT_SIZE_LARGE,
                'textAlign' => TbHtml::TEXT_ALIGN_CENTER,
            ]
        );
        $select = $I->createNode($html, 'select');
        $I->seeNodeCssClass($select, 'input-large text-center list');
        $I->seeNodeAttributes(
            $select,
            [
                'name' => 'Dummy[listbox]',
                'id' => 'Dummy_listbox',
                'size' => 4,
            ]
        );

        $html = TbHtml::activeListBox(
            new Dummy,
            'listbox',
            ['1', '2', '3', '4', '5'],
            [
                'multiple' => true,
            ]
        );
        $select = $I->createNode($html, 'select');
        $I->seeNodeAttribute($select, 'name', 'Dummy[listbox][]');
    }

    public function testActiveRadioButtonList()
    {
        // todo: ensure that this test is actually correct.
        $I = $this->codeGuy;
        $html = TbHtml::activeRadioButtonList(
            new Dummy,
            'radioList',
            ['Option 1', 'Option 2', 'Option 3']
        );
        $body = $I->createNode($html);
        $I->seeNodeChildren(
            $body,
            ['input[type=hidden]', 'label.radio', 'label.radio', 'label.radio']
        );
        $label = $body->filter('label')->first();
        $I->seeNodePattern($label, '/> Option 1$/');
        $input = $label->filter('input[type=radio]');
        $I->seeNodeAttributes(
            $input,
            [
                'id' => 'Dummy_radioList_0',
                'name' => 'Dummy[radioList]',
                'value' => '0',
            ]
        );
    }

    public function testActiveInlineRadioButtonList()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeInlineRadioButtonList(
            new Dummy,
            'radioList',
            ['Option 1', 'Option 2', 'Option 3']
        );
        $container = $I->createNode($html);
        $I->seeNodeChildren($container, ['label.radio.inline', 'label.radio.inline', 'label.radio.inline']);
    }

    public function testActiveCheckBoxList()
    {
        // todo: ensure that this test is actually correct.
        $I = $this->codeGuy;
        $html = TbHtml::activeCheckBoxList(
            new Dummy,
            'checkboxList',
            ['Option 1', 'Option 2', 'Option 3']
        );
        $container = $I->createNode($html);
        $I->seeNodeChildren(
            $container,
            ['input[type=hidden]', 'label.checkbox', 'label.checkbox', 'label.checkbox']
        );
        $label = $container->filter('label')->first();
        $I->seeNodePattern($label, '/> Option 1$/');
        $input = $label->filter('input[type=checkbox]');
        $I->seeNodeAttributes(
            $input,
            [
                'id' => 'Dummy_checkboxList_0',
                'name' => 'Dummy[checkboxList][]',
                'value' => '0',
            ]
        );
    }

    public function testActiveInlineCheckBoxList()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeInlineCheckBoxList(
            new Dummy,
            'checkboxList',
            ['Option 1', 'Option 2', 'Option 3']
        );
        $container = $I->createNode($html);
        $I->seeNodeChildren(
            $container,
            ['label.checkbox.inline', 'label.checkbox.inline', 'label.checkbox.inline']
        );
    }

    public function testActiveUneditableField()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeUneditableField(
            new Dummy,
            'uneditable',
            [
                'class' => 'span'
            ]
        );
        $span = $I->createNode($html, 'span.uneditable-input');
        $I->seeNodeCssClass($span, 'span');
        $I->seeNodeText($span, 'Uneditable text');
    }

    public function testActiveSearchQueryField()
    {
        $I = $this->codeGuy;
        $model = new Dummy;
        $html = TbHtml::activeSearchQueryField(
            $model,
            'search',
            [
                'class' => 'input'
            ]
        );
        $input = $I->createNode($html, 'input[type=text].search-query');
        $I->seeNodeCssClass($input, 'input');
        $I->seeNodeAttributes(
            $input,
            [
                'id' => 'Dummy_search',
                'name' => 'Dummy[search]',
                'value' => 'Search query',
            ]
        );
    }

    public function testActiveTextFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeTextFieldControlGroup(new Dummy, 'text');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=text]']);
    }

    public function testActivePasswordFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activePasswordFieldControlGroup(new Dummy, 'password');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=password]']);
    }

    public function testActiveUrlFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeUrlFieldControlGroup(new Dummy, 'url');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=url]']);
    }

    public function testActiveEmailFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeEmailFieldControlGroup(new Dummy, 'email');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=email]']);
    }

    public function testActiveNumberFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeNumberFieldControlGroup(new Dummy, 'number');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=number]']);
    }

    public function testActiveRangeFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeRangeFieldControlGroup(new Dummy, 'range');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=range]']);
    }

    public function testActiveDateFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeDateFieldControlGroup(new Dummy, 'date');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=date]']);
    }

    public function testActiveFileFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeFileFieldControlGroup(new Dummy, 'file');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['input[type=file]']);
    }

    public function testActiveTextAreaControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeTextAreaControlGroup(new Dummy, 'textarea');
        $group = $I->createNode($html, 'div.control-group');
        $label = $group->filter('label.control-label');
        $I->seeNodeChildren($label, ['textarea']);
    }

    public function testActiveRadioButtonControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeRadioButtonControlGroup(new Dummy, 'radio');
        $group = $I->createNode($html, 'div.control-group');
        $I->seeNodeChildren($group, ['input[type=hidden]', 'label.radio']);
        $label = $group->filter('label.radio');
        $I->seeNodeChildren($label, ['input[type=radio]']);
    }

    public function testActiveCheckBoxControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeCheckBoxControlGroup(new Dummy, 'checkbox');
        $group = $I->createNode($html, 'div.control-group');
        $I->seeNodeChildren($group, ['input[type=hidden]', 'label.checkbox']);
        $label = $group->filter('label.checkbox');
        $I->seeNodeChildren($label, ['input[type=checkbox]']);
    }

    public function testActiveDropDownListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeDropDownListControlGroup(
            new Dummy,
            'dropdown',
            ['1', '2', '3', '4', '5']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['select']);
    }

    public function testActiveListBoxControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeListBoxControlGroup(
            new Dummy,
            'listbox',
            ['1', '2', '3', '4', '5']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['select']);
    }

    public function testActiveRadioButtonListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeRadioButtonListControlGroup(
            new Dummy,
            'radioList',
            ['Option 1', 'Option 2', 'Option 3']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['input[type=hidden]', 'label.radio', 'label.radio', 'label.radio']);
    }

    public function testActiveInlineRadioButtonListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeInlineRadioButtonListControlGroup(
            new Dummy,
            'radioList',
            ['Option 1', 'Option 2', 'Option 3']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren(
            $controls,
            ['input[type=hidden]', 'label.radio.inline', 'label.radio.inline', 'label.radio.inline']
        );
    }

    public function testActiveCheckBoxListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeCheckBoxListControlGroup(
            new Dummy,
            'checkboxList',
            ['0', '2'],
            ['Option 1', 'Option 2', 'Option 3']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren(
            $controls,
            ['input[type=hidden]', 'label.checkbox', 'label.checkbox', 'label.checkbox']
        );
    }

    public function testActiveInlineCheckBoxListControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeInlineCheckBoxListControlGroup(
            new Dummy,
            'checkboxList',
            ['0', '2'],
            ['Option 1', 'Option 2', 'Option 3']
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren(
            $controls,
            ['input[type=hidden]', 'label.checkbox.inline', 'label.checkbox.inline', 'label.checkbox.inline']
        );
    }

    public function testActiveUneditableFieldControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeUneditableFieldControlGroup(new Dummy, 'uneditable');
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['span.uneditable-input']);
    }

    public function testActiveSearchQueryControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::activeSearchQueryControlGroup(new Dummy, 'search');
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['input[type=text].search-query']);
    }

    public function testActiveControlGroup()
    {
        $I = $this->codeGuy;

        $html = TbHtml::activeControlGroup(
            TbHtml::INPUT_TYPE_TEXT,
            new Dummy,
            'text',
            [
                'color' => TbHtml::INPUT_COLOR_ERROR,
                'groupOptions' => ['class' => 'group'],
                'labelOptions' => ['class' => 'label'],
                'help' => 'Help text',
                'helpOptions' => ['class' => 'help'],
            ]
        );
        $group = $I->createNode($html, 'div.control-group');
        $I->seeNodeCssClass($group, 'error group');
        $I->seeNodeChildren($group, ['label.control-label', 'div.controls']);
        $label = $group->filter('label.control-label');
        $I->seeNodeCssClass($label, 'label');
        $I->seeNodeAttribute($label, 'for', 'Dummy_text');
        $I->seeNodeText($label, 'Text');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['input', 'span']);
        $input = $controls->filter('input[type=text]');
        $I->seeNodeAttributes(
            $input,
            [
                'id' => 'Dummy_text',
                'name' => 'Dummy[text]',
                'value' => 'text',
            ]
        );
        $help = $controls->filter('span.help-inline');
        $I->seeNodeCssClass($help, 'help');
        $I->seeNodeText($help, 'Help text');

        $html = TbHtml::activeControlGroup(
            TbHtml::INPUT_TYPE_RADIOBUTTON,
            new Dummy,
            'radio',
            [
                'labelOptions' => ['class' => 'label'],
            ]
        );
        $group = $I->createNode($html, 'div.control-group');
        $I->seeNodeChildren($group, ['div.controls']);
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['input[type=hidden]', 'label.radio']);
        $hidden = $controls->filter('input[type=hidden]');
        $I->seeNodeAttributes(
            $hidden,
            [
                'id' => 'ytDummy_radio',
                'name' => 'Dummy[radio]',
                'value' => '0',
            ]
        );
        $label = $controls->filter('label.radio');
        $I->seeNodePattern($label, '/> Radio$/');
        $radio = $label->filter('input[type=radio]');
        $I->seeNodeAttributes(
            $radio,
            [
                'checked' => 'checked',
                'id' => 'Dummy_radio',
                'name' => 'Dummy[radio]',
                'value' => '1',
            ]
        );
    }

    public function testActiveCustomControlGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::customActiveControlGroup(
            '<div class="widget"></div>',
            new Dummy,
            'text',
            [
                'label' => false,
            ]
        );
        $group = $I->createNode($html, 'div.control-group');
        $controls = $group->filter('div.controls');
        $I->seeNodeChildren($controls, ['div.widget']);
    }

    public function testErrorSummary()
    {
        $I = $this->codeGuy;
        $model = new Dummy;
        $model->addError('text', 'Error text');
        $html = TbHtml::errorSummary(
            $model,
            'Header text',
            'Footer text',
            [
                'class' => 'summary'
            ]
        );
        $div = $I->createNode($html, 'div.alert');
        $I->seeNodeCssClass($div, 'alert-block alert-error summary');
        $I->seeNodePattern($div, '/^Header text/');
        $I->seeNodePattern($div, '/Footer text$/');
        $li = $div->filter('ul > li')->first();
        $I->seeNodeText($li, 'Error text');
    }

    public function testError()
    {
        $I = $this->codeGuy;
        $model = new Dummy;
        $model->addError('text', 'Error text');
        $html = TbHtml::error(
            $model,
            'text',
            [
                'class' => 'error',
            ]
        );
        $span = $I->createNode($html, 'span.help-inline');
        $I->seeNodeCssClass($span, 'error');
        $I->seeNodeText($span, 'Error text');
    }

    public function testControls()
    {
        $I = $this->codeGuy;
        $html = TbHtml::controls(
            '<div class="control"></div><div class="control"></div>',
            [
                'before' => 'Before text',
                'after' => 'After text',
            ]
        );
        $controls = $I->createNode($html, 'div.controls');
        $I->seeNodeChildren($controls, ['div.control', 'div.control']);
        $I->seeNodePattern($controls, '/^Before text</');
        $I->seeNodePattern($controls, '/>After text$/');
    }

    public function testControlsRow()
    {
        $I = $this->codeGuy;
        $html = TbHtml::controlsRow(
            [
                '<div class="control"></div>',
                '<div class="control"></div>',
            ]
        );
        $controls = $I->createNode($html, 'div.controls');
        $I->seeNodeCssClass($controls, 'controls-row');
        $I->seeNodeChildren($controls, ['div.control', 'div.control']);
    }

    public function testFormActions()
    {
        $I = $this->codeGuy;

        $html = TbHtml::formActions('<div class="action"></div><div class="action"></div>');
        $this->assertEquals(
            '<div class="form-actions"><div class="action"></div><div class="action"></div></div>',
            $html
        );
        $actions = $I->createNode($html, 'div.form-actions');
        $I->seeNodeChildren($actions, ['div.action', 'div.action']);

        $html = TbHtml::formActions(
            [
                '<div class="action"></div>',
                '<div class="action"></div>',
            ]
        );
        $actions = $I->createNode($html, 'div.form-actions');
        $I->seeNodeChildren($actions, ['div.action', 'div.action']);
    }

    public function testSearchForm()
    {
        $I = $this->codeGuy;
        $html = TbHtml::searchForm(
            '#',
            'post',
            [
                'class' => 'form',
            ]
        );
        $form = $I->createNode($html, 'form.form-search');
        $I->seeNodeCssClass($form, 'form');
        $I->seeNodeAttributes(
            $form,
            [
                'action' => '#',
                'method' => 'post'
            ]
        );
        $input = $form->filter('input[type=text]');
        $I->seeNodeCssClass($input, 'search-query');
    }

    public function testLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::link(
            'Link',
            '#',
            [
                'class' => 'link'
            ]
        );
        $a = $I->createNode($html, 'a.link');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Link');
    }

    public function testButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::button(
            'Button',
            [
                'class' => 'button',
                'name' => 'button',
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                'size' => TbHtml::BUTTON_SIZE_LARGE,
                'block' => true,
                'disabled' => true,
                'loading' => 'Loading text',
                'toggle' => true,
                'icon' => TbHtml::ICON_CHECK
            ]
        );
        $button = $I->createNode($html, 'button[type=button].btn');
        $I->seeNodeCssClass($button, 'btn-primary btn-large btn-block disabled button');
        $I->seeNodeAttributes(
            $button,
            [
                'name' => 'button',
                'data-loading-text' => 'Loading text',
                'data-toggle' => 'button',
                'disabled' => 'disabled',
            ]
        );
        $I->seeNodeChildren($button, ['i.icon-check']);
        $I->seeNodePattern($button, '/> Button$/');
    }

    public function testHtmlButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::htmlButton(
            'Button',
            [
                'class' => 'button',
                'name' => 'button',
            ]
        );
        $button = $I->createNode($html, 'button[type=button].btn');
        $I->seeNodeCssClass($button, 'button');
        $I->seeNodeAttribute($button, 'name', 'button');
        $I->seeNodeText($button, 'Button');
    }

    public function testSubmitButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::submitButton(
            'Submit',
            [
                'class' => 'button',
                'name' => 'button',
            ]
        );
        $button = $I->createNode($html, 'button[type=submit].btn');
        $I->seeNodeCssClass($button, 'button');
        $I->seeNodeAttribute($button, 'name', 'button');
        $I->seeNodeText($button, 'Submit');
    }

    public function testResetButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::resetButton(
            'Reset',
            [
                'class' => 'button',
                'name' => 'button',
            ]
        );
        $button = $I->createNode($html, 'button[type=reset].btn');
        $I->seeNodeCssClass($button, 'button');
        $I->seeNodeAttribute($button, 'name', 'button');
        $I->seeNodeText($button, 'Reset');
    }

    public function testImageButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::imageButton(
            'image.png',
            [
                'class' => 'button',
                'name' => 'button',
            ]
        );
        $button = $I->createNode($html, 'input[type=image].btn');
        $I->seeNodeCssClass($button, 'button');
        $I->seeNodeAttributes(
            $button,
            [
                'name' => 'button',
                'src' => 'image.png',
            ]
        );
    }

    public function testLinkButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::linkButton(
            'Link',
            [
                'class' => 'button',
            ]
        );
        $a = $I->createNode($html, 'a.btn');
        $I->seeNodeCssClass($a, 'button');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Link');
    }

    public function testAjaxLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::ajaxLink(
            'Link',
            '#',
            [], // todo: figure out a way to test the ajax options as well.
            [
                'id' => 'button',
                'class' => 'button',
            ]
        );
        $a = $I->createNode($html, 'a');
        $I->seeNodeCssClass($a, 'button');
        $I->seeNodeAttributes(
            $a,
            [
                'id' => 'button',
                'href' => '#',
            ]
        );
        $I->seeNodeText($a, 'Link');
    }

    public function testAjaxButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::ajaxButton(
            'Button',
            '#',
            [],
            [
                'id' => 'button',
                'class' => 'button',
            ]
        );
        $button = $I->createNode($html, 'button[type=button].btn');
        $I->seeNodeCssClass($button, 'button');
        $I->seeNodeAttribute($button, 'id', 'button');
        $I->seeNodeText($button, 'Button');
    }

    public function testAjaxSubmitButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::ajaxSubmitButton(
            'Submit',
            '#',
            [],
            [
                'class' => 'button',
                'id' => 'button',
                'name' => 'button'
            ]
        );
        $button = $I->createNode($html, 'button[type=submit].btn');
        $I->seeNodeCssClass($button, 'button');
        $I->seeNodeAttributes(
            $button,
            [
                'id' => 'button',
                'name' => 'button'
            ]
        );
        $I->seeNodeText($button, 'Submit');
    }

    public function testImageRounded()
    {
        $I = $this->codeGuy;
        $html = TbHtml::imageRounded(
            'image.png',
            'Alternative text',
            [
                'class' => 'image',
            ]
        );
        $img = $I->createNode($html, 'img.img-rounded');
        $I->seeNodeCssClass($img, 'image');
        $I->seeNodeAttributes(
            $img,
            [
                'src' => 'image.png',
                'alt' => 'Alternative text',
            ]
        );
    }

    public function testImageCircle()
    {
        $I = $this->codeGuy;
        $html = TbHtml::imageCircle(
            'image.png',
            'Alternative text',
            [
                'class' => 'image',
            ]
        );
        $img = $I->createNode($html, 'img.img-circle');
        $I->seeNodeCssClass($img, 'image');
        $I->seeNodeAttributes(
            $img,
            [
                'src' => 'image.png',
                'alt' => 'Alternative text',
            ]
        );
    }

    public function testImagePolaroid()
    {
        $I = $this->codeGuy;
        $html = TbHtml::imagePolaroid(
            'image.png',
            'Alternative text',
            [
                'class' => 'image',
            ]
        );
        $img = $I->createNode($html, 'img.img-polaroid');
        $I->seeNodeCssClass($img, 'image');
        $I->seeNodeAttributes(
            $img,
            [
                'src' => 'image.png',
                'alt' => 'Alternative text',
            ]
        );
    }

    public function testIcon()
    {
        $I = $this->codeGuy;

        $html = TbHtml::icon(
            TbHtml::ICON_CHECK,
            [
                'class' => 'icon',
            ]
        );
        $i = $I->createNode($html, 'i.icon-check');
        $I->seeNodeEmpty($i);

        $html = TbHtml::icon(
            TbHtml::ICON_REMOVE,
            [
                'color' => TbHtml::ICON_COLOR_WHITE,
            ]
        );
        $i = $I->createNode($html, 'i.icon-remove');
        $I->seeNodeCssClass($i, 'icon-white');
        $I->seeNodeEmpty($i);

        $html = TbHtml::icon('pencil white');
        $i = $I->createNode($html, 'i.icon-pencil');
        $I->seeNodeCssClass($i, 'icon-white');
        $I->seeNodeEmpty($i);

        $html = TbHtml::icon([]);
        $this->assertEquals('', $html);
    }

    public function testDropdownToggleLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::dropdownToggleLink(
            'Link',
            [
                'class' => 'link',
            ]
        );
        $a = $I->createNode($html, 'a.btn.dropdown-toggle');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'href' => '#',
                'data-toggle' => 'dropdown',
            ]
        );
        $I->seeNodePattern($a, '/^Link </');
        $I->seeNodeChildren($a, ['b.caret']);
    }

    public function testDropdownToggleButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::dropdownToggleButton(
            'Button',
            [
                'class' => 'button',
                'name' => 'button',
            ]
        );
        $button = $I->createNode($html, 'button[type=button].btn.dropdown-toggle');
        $I->seeNodeCssClass($button, 'button');
        $I->seeNodeAttributes(
            $button,
            [
                'name' => 'button',
                'data-toggle' => 'dropdown',
            ]
        );
        $I->seeNodePattern($button, '/^Button </');
        $I->seeNodeChildren($button, ['b.caret']);
    }

    public function testDropdownToggleMenuLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::dropdownToggleMenuLink(
            'Link',
            '#',
            [
                'class' => 'link',
            ]
        );
        $a = $I->createNode($html, 'a.dropdown-toggle');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'href' => '#',
                'data-toggle' => 'dropdown',
            ]
        );
        $I->seeNodePattern($a, '/^Link </');
        $I->seeNodeChildren($a, ['b.caret']);
    }

    public function testButtonGroup()
    {
        $I = $this->codeGuy;

        $buttons = [
            ['label' => 'Left'],
            [
                'label' => 'Middle',
                'items' => [
                    ['label' => 'Action', 'url' => '#'],
                ],
                'htmlOptions' => ['color' => TbHtml::BUTTON_COLOR_INVERSE],
            ],
            ['label' => 'Right', 'visible' => false],
        ];

        $html = TbHtml::buttonGroup(
            $buttons,
            [
                'class' => 'div',
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                'toggle' => TbHtml::BUTTON_TOGGLE_CHECKBOX,
            ]
        );
        $group = $I->createNode($html, 'div.btn-group');
        $I->seeNodeCssClass($group, 'div');
        $I->seeNodeAttribute($group, 'data-toggle', 'buttons-checkbox');
        $I->seeNodeNumChildren($group, 2);
        foreach ($group->children() as $i => $btnElement) {
            $btn = $I->createNode($btnElement);
            if ($i === 1) {
                $I->seeNodeChildren($btn, ['a.dropdown-toggle', 'ul.dropdown-menu']);
                $a = $btn->filter('a.dropdown-toggle');
                $I->seeNodeCssClass($a, 'btn-inverse');
                $I->seeNodeText($a, 'Middle');
            } else {
                $I->seeNodeCssClass($btn, 'btn');
                $I->seeNodeAttribute($btn, 'href', '#');
                $I->seeNodeCssClass($btn, 'btn-primary');
                $I->seeNodeText($btn, $buttons[$i]['label']);
            }
        }

        $html = TbHtml::buttonGroup([]);
        $this->assertEquals('', $html);
    }

    public function testVerticalButtonGroup()
    {
        $I = $this->codeGuy;
        $html = TbHtml::verticalButtonGroup(
            [
                ['icon' => TbHtml::ICON_ALIGN_LEFT],
                ['icon' => TbHtml::ICON_ALIGN_CENTER],
                ['icon' => TbHtml::ICON_ALIGN_RIGHT],
                ['icon' => TbHtml::ICON_ALIGN_JUSTIFY],
            ]
        );
        $group = $I->createNode($html, 'div.btn-group');
        $I->seeNodeCssClass($group, 'btn-group-vertical');
    }

    public function testButtonToolbar()
    {
        $I = $this->codeGuy;

        $groups = [
            [
                'items' => [
                    ['label' => '1', 'color' => TbHtml::BUTTON_COLOR_DANGER],
                    ['label' => '2'],
                    ['label' => '3'],
                    ['label' => '4'],
                ],
                'htmlOptions' => [
                    'color' => TbHtml::BUTTON_COLOR_INVERSE,
                ],
            ],
            [
                'items' => [
                    ['label' => '5'],
                    ['label' => '6'],
                    ['label' => '7'],
                ]
            ],
            [
                'visible' => false,
                'items' => [
                    ['label' => '8'],
                ]
            ],
            [
                'items' => []
            ],
        ];

        $html = TbHtml::buttonToolbar(
            $groups,
            [
                'class' => 'div',
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            ]
        );
        $toolbar = $I->createNode($html, 'div.btn-toolbar');
        $I->seeNodeCssClass($toolbar, 'div');
        foreach ($toolbar->children() as $i => $groupElement) {
            $group = $I->createNode($groupElement);
            $I->seeNodeCssClass($group, 'btn-group');
            foreach ($group->children() as $j => $btnElement) {
                $btn = $I->createNode($btnElement);
                $I->seeNodeCssClass($btn, 'btn');
                if ($i === 0) {
                    $I->seeNodeCssClass($btn, $j === 0 ? 'btn-danger' : 'btn-inverse');
                } else {
                    $I->seeNodeCssClass($btn, 'btn-primary');
                }
                $I->seeNodeText($btn, $groups[$i]['items'][$j]['label']);
            }
        }

        $html = TbHtml::buttonToolbar([]);
        $this->assertEquals('', $html);
    }

    public function testButtonDropdown()
    {
        $I = $this->codeGuy;

        $items = [
            [
                'label' => 'Action',
                'url' => '#',
                'class' => 'item',
                'linkOptions' => ['class' => 'link'],
            ],
            ['label' => 'Another action', 'url' => '#'],
            ['label' => 'Something else here', 'url' => '#'],
            TbHtml::menuDivider(),
            ['label' => 'Separate link', 'url' => '#'],
        ];

        $html = TbHtml::buttonDropdown(
            'Action',
            $items,
            [
                'class' => 'link',
                'dropup' => true,
                'groupOptions' => ['class' => 'group'],
                'menuOptions' => ['class' => 'menu'],
            ]
        );
        $group = $I->createNode($html, 'div.btn-group');
        $I->seeNodeCssClass($group, 'dropup group');
        $I->seeNodeChildren($group, ['a.dropdown-toggle', 'ul.dropdown-menu']);
        $a = $group->filter('a.dropdown-toggle');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'data-toggle' => 'dropdown',
                'href' => '#',
            ]
        );
        $I->seeNodePattern($a, '/Action </');
        $b = $a->filter('b.caret');
        $I->seeNodeEmpty($b);
        $ul = $group->filter('ul.dropdown-menu');
        foreach ($ul->children() as $i => $liElement) {
            $li = $I->createNode($liElement);
            if ($i === 3) {
                $I->seeNodeCssClass($li, 'divider');
            } else {
                $a = $li->filter('a');
                if ($i === 0) {
                    $I->seeNodeCssClass($li, 'item');
                    $I->seeNodeCssClass($a, 'link');
                }
                $I->seeNodeAttributes(
                    $a,
                    [
                        'href' => '#',
                        'tabindex' => '-1',
                    ]
                );
                $I->seeNodeText($a, $items[$i]['label']);
            }
        }
    }

    public function testSplitButtonDropdown()
    {
        $I = $this->codeGuy;

        $items = [
            ['label' => 'Action', 'url' => '#'],
            ['label' => 'Another action', 'url' => '#'],
            ['label' => 'Something else here', 'url' => '#'],
            TbHtml::menuDivider(),
            ['label' => 'Separate link', 'url' => '#'],
        ];

        $html = TbHtml::splitButtonDropdown('Action',  $items);
        $group = $I->createNode($html, 'div.btn-group');
        $I->seeNodeChildren($group, ['a.btn', 'button.dropdown-toggle', 'ul.dropdown-menu']);
        CHtml::$count = 0;
    }

    public function testTabs()
    {
        $I = $this->codeGuy;
        $html = TbHtml::tabs(
            [
                ['label' => 'Link', 'url' => '#'],
            ]
        );
        $nav = $I->createNode($html, 'ul.nav');
        $I->seeNodeCssClass($nav, 'nav-tabs');
    }

    public function testStackedTabs()
    {
        $I = $this->codeGuy;
        $html = TbHtml::stackedTabs(
            [
                ['label' => 'Link', 'url' => '#'],
            ]
        );
        $nav = $I->createNode($html, 'ul.nav');
        $I->seeNodeCssClass($nav, 'nav-tabs nav-stacked');
    }

    public function testPills()
    {
        $I = $this->codeGuy;
        $html = TbHtml::pills(
            [
                ['label' => 'Link', 'url' => '#'],
            ]
        );
        $nav = $I->createNode($html, 'ul.nav');
        $I->seeNodeCssClass($nav, 'nav-pills');
    }

    public function testStackedPills()
    {
        $I = $this->codeGuy;

        $html = TbHtml::stackedPills(
            [
                ['label' => 'Link', 'url' => '#'],
            ]
        );
        $nav = $I->createNode($html, 'ul.nav');
        $I->seeNodeCssClass($nav, 'nav-pills nav-stacked');
    }

    public function testNavList()
    {
        $I = $this->codeGuy;

        $items = [
            ['label' => 'Header text'],
            ['label' => 'Link', 'url' => '#'],
            TbHtml::menuDivider(),
        ];

        $html = TbHtml::navList(
            $items,
            [
                'stacked' => true,
            ]
        );
        $nav = $I->createNode($html, 'ul.nav');
        $I->seeNodeCssClass($nav, 'nav-list');
        $I->dontSeeNodeCssClass($nav, 'nav-stacked');
        foreach ($nav->children() as $i => $liElement) {
            $li = $I->createNode($liElement);
            if ($i === 0) {
                $I->seeNodeCssClass($li, 'nav-header');
                $I->seeNodeText($li, 'Header text');
            } else if ($i === 1) {
                $a = $li->filter('a');
                $I->seeNodeText($a, $items[$i]['label']);
            } else if ($i === 2) {
                $I->seeNodeCssClass($li, 'divider');
            }
        }
    }

    public function testNav()
    {
        $I = $this->codeGuy;
        $html = TbHtml::nav(
            TbHtml::NAV_TYPE_NONE,
            [
                ['label' => 'Link', 'url' => '#'],
            ],
            [
                'stacked' => true,
            ]
        );
        $nav = $I->createNode($html, 'ul.nav');
        $I->seeNodeCssClass($nav, 'nav-stacked');
    }

    public function testMenu()
    {
        $I = $this->codeGuy;

        $items = [
            ['icon' => TbHtml::ICON_HOME, 'label' => 'Home', 'url' => '#'],
            ['label' => 'Profile', 'url' => '#', 'htmlOptions' => ['disabled' => true]],
            ['label' => 'Dropdown', 'active' => true, 'items' => [
                ['label' => 'Action', 'url' => '#'],
                ['label' => 'Another action', 'url' => '#'],
                ['label' => 'Dropdown', 'items' => [
                    ['label' => 'Action', 'url' => '#'],
                ]],
                TbHtml::menuDivider(),
                ['label' => 'Separate link', 'url' => '#'],
            ]],
            ['label' => 'Hidden', 'url' => '#', 'visible' => false],
        ];

        $html = TbHtml::menu(
            $items,
            [
                'class' => 'ul',
            ]
        );
        $nav = $I->createNode($html, 'ul');
        $I->seeNodeAttribute($nav, 'role', 'menu');
        $I->seeNodeNumChildren($nav, 3);
        foreach ($nav->children() as $i => $liElement) {
            $li = $I->createNode($liElement);
            if ($i === 2) {
                $I->seeNodeCssClass($li, 'dropdown active');
                $I->seeNodeChildren($li, ['a.dropdown-toggle', 'ul.dropdown-menu']);
                $ul = $li->filter('ul.dropdown-menu');
                $I->seeNodeNumChildren($ul, 5);
                foreach ($ul->children() as $j => $subLiElement) {
                    $subLi = $I->createNode($subLiElement);
                    if ($j === 2) {
                        $I->seeNodeCssClass($subLi, 'dropdown-submenu');
                        $I->seeNodeChildren($subLi, ['a.dropdown-toggle', 'ul.dropdown-menu']);
                        $subUl = $subLi->filter('ul.dropdown-menu');
                        $I->seeNodeNumChildren($subUl, 1);
                    } else {
                        if ($j === 3) {
                            $I->seeNodeCssClass($subLi, 'divider');
                        } else {
                            $subA = $subLi->filter('a');
                            $I->seeNodeText($subA, $items[$i]['items'][$j]['label']);
                        }
                    }
                }
            } else {
                if ($i === 0) {
                    $I->seeNodeChildren($li, ['i.icon-home', 'a']);
                }
                if ($i === 2) {
                    $I->seeNodeCssClass($li, 'disabled');
                }
                $a = $li->filter('a');
                $I->seeNodeAttributes(
                    $a,
                    [
                        'href' => '#',
                        'tabindex' => '-1',
                    ]
                );
                $I->seeNodeText($a, $items[$i]['label']);
            }
        }

        $html = TbHtml::menu([]);
        $this->assertEquals('', $html);
    }

    public function testMenuLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::menuLink(
            'Link',
            '#',
            [
                'class' => 'item',
                'linkOptions' => ['class' => 'link'],
            ]
        );
        $li = $I->createNode($html, 'li');
        $I->seeNodeCssClass($li, 'item');
        $a = $li->filter('a');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Link');
    }

    public function testMenuHeader()
    {
        $I = $this->codeGuy;
        $html = TbHtml::menuHeader(
            'Header text',
            [
                'class' => 'item',
            ]
        );
        $li = $I->createNode($html, 'li.nav-header');
        $I->seeNodeCssClass($li, 'item');
        $I->seeNodeText($li, 'Header text');
    }

    public function testMenuDivider()
    {
        $I = $this->codeGuy;
        $html = TbHtml::menuDivider(
            [
                'class' => 'item',
            ]
        );
        $li = $I->createNode($html, 'li.divider');
        $I->seeNodeCssClass($li, 'item');
        $I->seeNodeEmpty($li);
    }

    public function testTabbableTabs()
    {
        $I = $this->codeGuy;
        $html = TbHtml::tabbableTabs(
            [
                ['label' => 'Link', 'content' => 'Tab content'],
            ]
        );
        $tabbable = $I->createNode($html, 'div.tabbable');
        $ul = $tabbable->filter('ul.nav');
        $I->seeNodeCssClass($ul, 'nav-tabs');
    }

    public function testTabbablePills()
    {
        $I = $this->codeGuy;
        $html = TbHtml::tabbablePills(
            [
                ['label' => 'Link', 'content' => 'Tab content'],
            ]
        );
        $tabbable = $I->createNode($html, 'div.tabbable');
        $ul = $tabbable->filter('ul.nav');
        $I->seeNodeCssClass($ul, 'nav-pills');
    }

    public function testTabbable()
    {
        $I = $this->codeGuy;

        $tabs = [
            ['label' => 'Home', 'content' => 'Tab content', 'active' => true],
            ['label' => 'Profile', 'content' => 'Tab content', 'id' => 'profile'],
            [
                'label' => 'Messages',
                'items' => [
                    ['label' => '@fat', 'content' => 'Tab content'],
                    ['label' => '@mdo', 'content' => 'Tab content'],
                ]
            ],
        ];

        $html = TbHtml::tabbable(
            TbHtml::NAV_TYPE_NONE,
            $tabs,
            [
                'class' => 'div',
            ]
        );
        $tabbable = $I->createNode($html, 'div.tabbable');
        $I->seeNodeCssClass($tabbable, 'div');
        $ul = $tabbable->filter('ul.nav');
        $I->seeNodeNumChildren($ul, 3);
        foreach ($ul->children() as $i => $liElement) {
            $li = $I->createNode($liElement);
            if ($i === 0) {
                $I->seeNodeCssClass($li, 'active');
            }
            if ($i === 2) {
                $I->seeNodeCssClass($li, 'dropdown');
                $a = $li->filter('a.dropdown-toggle');
                $I->seeNodeText($a, 'Messages');
                $subUl = $li->filter('ul.dropdown-menu');
                foreach ($subUl->children() as $j => $subLiElement) {
                    $subLi = $I->createNode($subLiElement);
                    $subA = $subLi->filter('a');
                    $I->seeNodeAttributes(
                        $subA,
                        [
                            'data-toggle' => 'tab',
                            'tabindex' => '-1',
                            'href' => '#tab_' . ($i + $j + 1),
                        ]
                    );
                    $I->seeNodeText($subA, $tabs[$i]['items'][$j]['label']);
                }
            } else {
                $a = $li->filter('a');
                $I->seeNodeAttributes(
                    $a,
                    [
                        'data-toggle' => 'tab',
                        'tabindex' => '-1',
                        'href' => '#' . ($tabs[$i]['id'] ?? 'tab_' . ($i + 1)),
                    ]
                );
                $I->seeNodeText($a, $tabs[$i]['label']);
            }
        }
        $content = $tabbable->filter('div.tab-content');
        $I->seeNodeNumChildren($content, 4);
        foreach ($content->children() as $i => $paneElement) {
            $pane = $I->createNode($paneElement);
            $I->seeNodeCssClass($pane, 'tab-pane fade');
            if ($i === 0) {
                $I->seeNodeCssClass($pane, 'active in');
            }
            if ($i > 1) {
                $I->seeNodeText($pane, $tabs[2]['items'][$i - 2]['content']);
            } else {
                $I->seeNodeText($pane, $tabs[$i]['content']);
            }
        }
    }

    public function testNavbar()
    {
        $I = $this->codeGuy;

        $html = TbHtml::navbar(
            'Navbar content',
            [
                'class' => 'nav',
                'innerOptions' => ['class' => 'inner'],
            ]
        );
        $navbar = $I->createNode($html, 'div.navbar');
        $I->seeNodeCssClass($navbar, 'nav');
        $inner = $navbar->filter('div.navbar-inner');
        $I->seeNodeText($inner, 'Navbar content');

        $html = TbHtml::navbar(
            '',
            [
                'display' => TbHtml::NAVBAR_DISPLAY_STATICTOP,
            ]
        );
        $navbar = $I->createNode($html, 'div.navbar');
        $I->seeNodeCssClass($navbar, 'navbar-static-top');

        $html = TbHtml::navbar(
            '',
            [
                'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP,
            ]
        );
        $navbar = $I->createNode($html, 'div.navbar');
        $I->seeNodeCssClass($navbar, 'navbar-fixed-top');

        $html = TbHtml::navbar(
            '',
            [
                'display' => TbHtml::NAVBAR_DISPLAY_FIXEDBOTTOM,
            ]
        );
        $navbar = $I->createNode($html, 'div.navbar');
        $I->seeNodeCssClass($navbar, 'navbar-fixed-bottom');

        $html = TbHtml::navbar(
            '',
            [
                'color' => TbHtml::NAVBAR_COLOR_INVERSE,
            ]
        );
        $navbar = $I->createNode($html, 'div.navbar');
        $I->seeNodeCssClass($navbar, 'navbar-inverse');
    }

    public function testNavbarBrandLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::navbarBrandLink(
            'Brand text',
            '#',
            [
                'class' => 'link',
            ]
        );
        $a = $I->createNode($html, 'a.brand');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Brand text');
    }

    public function testNavbarText()
    {
        $I = $this->codeGuy;
        $html = TbHtml::navbarText(
            'Navbar text',
            [
                'class' => 'text',
            ]
        );
        $p = $I->createNode($html, 'p.navbar-text');
        $I->seeNodeCssClass($p, 'text');
        $I->seeNodeText($p, 'Navbar text');
    }

    public function testNavbarMenuDivider()
    {
        $I = $this->codeGuy;
        $html = TbHtml::navbarMenuDivider(
            [
                'class' => 'item',
            ]
        );
        $li = $I->createNode($html, 'li.divider-vertical');
        $I->seeNodeCssClass($li, 'item');
        $I->seeNodeEmpty($li);
    }

    public function testNavbarForm()
    {
        $I = $this->codeGuy;
        $html = TbHtml::navbarForm('#');
        $I->createNode($html, 'form.navbar-form');
    }

    public function testNavbarSearchForm()
    {
        $I = $this->codeGuy;
        $html = TbHtml::navbarSearchForm('#');
        $I->createNode($html, 'form.navbar-search');
    }

    public function testNavbarCollapseLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::navbarCollapseLink(
            '#',
            [
                'class' => 'link',
            ]
        );
        $a = $I->createNode($html, 'a.btn.btn-navbar');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'data-toggle' => 'collapse',
                'data-target' => '#',
            ]
        );
        $I->seeNodeChildren($a, ['span.icon-bar', 'span.icon-bar', 'span.icon-bar']);
    }

    public function testBreadcrumbs()
    {
        $I = $this->codeGuy;

        $links = [
            'Home' => '#',
            'Library' => '#',
            'Data',
        ];

        $html = TbHtml::breadcrumbs(
            $links,
            [
                'class' => 'ul',
            ]
        );
        $ul = $I->createNode($html, 'ul.breadcrumb');
        $I->seeNodeCssClass($ul, 'ul');
        $I->seeNodeNumChildren($ul, 3);
        foreach ($ul->children() as $i => $liElement) {
            $li = $I->createNode($liElement);
            switch ($i) {
                case 0:
                    $a = $li->filter('a');
                    $I->seeNodeAttribute($a, 'href', '#');
                    $I->seeNodeText($a, 'Home');
                    break;
                case 1:
                    $a = $li->filter('a');
                    $I->seeNodeAttribute($a, 'href', '#');
                    $I->seeNodeText($a, 'Library');
                    break;
                case 2:
                    $I->seeNodeText($li, 'Data');
                    break;
            }
        }
    }

    public function testPagination()
    {
        $I = $this->codeGuy;

        $items = [
            ['label' => 'Prev', 'url' => '#', 'disabled' => true],
            [
                'label' => '1',
                'url' => '#',
                'active' => true,
                'htmlOptions' => ['class' => 'item'],
                'linkOptions' => ['class' => 'link'],
            ],
            ['label' => '2', 'url' => '#'],
            ['label' => '3', 'url' => '#'],
            ['label' => '4', 'url' => '#'],
            ['label' => '5', 'url' => '#'],
            ['label' => 'Next', 'url' => '#'],
        ];

        $html = TbHtml::pagination(
            $items,
            [
                'class' => 'div',
                'listOptions' => ['class' => 'list'],
            ]
        );
        $div = $I->createNode($html, 'div.pagination');
        $I->seeNodeCssClass($div, 'div');
        $ul = $div->filter('ul');
        $I->seeNodeCssClass($ul, 'list');
        $I->seeNodeNumChildren($ul, 7);
        foreach ($ul->children() as $i => $liElement) {
            $li = $I->createNode($liElement);
            $a = $li->filter('a');
            if ($i === 0) {
                $I->seeNodeCssClass($li, 'disabled');
            }
            if ($i === 1) {
                $I->seeNodeCssClass($li, 'item active');
                $I->seeNodeCssClass($a, 'link');
            }
            $I->seeNodeAttribute($a, 'href', '#');
            $I->seeNodeText($a, $items[$i]['label']);
        }

        $html = TbHtml::pagination(
            $items,
            [
                'size' => TbHtml::PAGINATION_SIZE_LARGE,
            ]
        );
        $div = $I->createNode($html, 'div.pagination');
        $I->seeNodeCssClass($div, 'pagination-large');

        $html = TbHtml::pagination(
            $items,
            [
                'align' => TbHtml::PAGINATION_ALIGN_CENTER,
            ]
        );
        $div = $I->createNode($html, 'div.pagination');
        $I->seeNodeCssClass($div, 'pagination-centered');

        $html = TbHtml::pagination([]);
        $this->assertEquals('', $html);
    }

    public function testPaginationLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::paginationLink(
            'Link',
            '#',
            [
                'class' => 'item',
                'linkOptions' => ['class' => 'link'],
            ]
        );
        $li = $I->createNode($html, 'li');
        $I->seeNodeCssClass($li, 'item');
        $a = $li->filter('a');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttribute($a, 'href', '#');
    }

    public function testPager()
    {
        $I = $this->codeGuy;

        $items = [
            [
                'label' => 'Prev',
                'url' => '#',
                'previous' => true,
                'htmlOptions' => ['disabled' => true],
            ],
            ['label' => 'Next', 'url' => '#', 'next' => true],
        ];

        $html = TbHtml::pager(
            $items,
            [
                'class' => 'list',
            ]
        );
        $ul = $I->createNode($html, 'ul.pager');
        $I->seeNodeCssClass($ul, 'list');
        $I->seeNodeNumChildren($ul, 2);
        $prev = $ul->filter('li')->first();
        $I->seeNodeCssClass($prev, 'previous disabled');
        $a = $prev->filter('a');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Prev');
        $next = $ul->filter('li')->last();
        $I->seeNodeCssClass($next, 'next');
        $a = $next->filter('a');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Next');

        $html = TbHtml::pager([]);
        $this->assertEquals('', $html);
    }

    public function testPagerLink()
    {
        $I = $this->codeGuy;

        $html = TbHtml::pagerLink(
            'Link',
            '#',
            [
                'class' => 'item',
                'linkOptions' => ['class' => 'link'],
                'disabled' => true,
            ]
        );
        $li = $I->createNode($html, 'li');
        $I->seeNodeCssClass($li, 'item disabled');
        $a = $li->filter('a');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Link');

        $html = TbHtml::pagerLink(
            'Previous',
            '#',
            [
                'previous' => true,
            ]
        );
        $li = $I->createNode($html, 'li.previous');
        $a = $li->filter('a');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Previous');

        $html = TbHtml::pagerLink(
            'Next',
            '#',
            [
                'next' => true,
            ]
        );
        $li = $I->createNode($html, 'li.next');
        $a = $li->filter('a');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Next');
    }

    public function testLabel()
    {
        $I = $this->codeGuy;
        $html = TbHtml::labelTb(
            'Label text',
            [
                'color' => TbHtml::LABEL_COLOR_INFO,
                'class' => 'span',
            ]
        );
        $span = $I->createNode($html, 'span.label');
        $I->seeNodeCssClass($span, 'label-info span');
        $I->seeNodeText($span, 'Label text');
    }

    public function testBadge()
    {
        $I = $this->codeGuy;
        $html = TbHtml::badge(
            'Badge text',
            [
                'color' => TbHtml::BADGE_COLOR_WARNING,
                'class' => 'span',
            ]
        );
        $span = $I->createNode($html, 'span.badge');
        $I->seeNodeCssClass($span, 'badge-warning span');
        $I->seeNodeText($span, 'Badge text');
    }

    public function testHeroUnit()
    {
        $I = $this->codeGuy;
        $html = TbHtml::heroUnit(
            'Heading text',
            'Content text',
            [
                'class' => 'div',
                'headingOptions' => ['class' => 'heading'],
            ]
        );
        $hero = $I->createNode($html, 'div.hero-unit');
        $I->seeNodeCssClass($hero, 'div');
        $I->seeNodeText($hero, 'Content text');
        $h1 = $hero->filter('h1');
        $I->seeNodeCssClass($h1, 'heading');
        $I->seeNodeText($h1, 'Heading text');
    }

    public function testPageHeader()
    {
        $I = $this->codeGuy;
        $html = TbHtml::pageHeader(
            'Heading text',
            'Subtext',
            [
                'class' => 'header',
                'headerOptions' => ['class' => 'heading'],
                'subtextOptions' => ['class' => 'subtext']
            ]
        );
        $header = $I->createNode($html, 'div.page-header');
        $I->seeNodeCssClass($header, 'header');
        $h1 = $header->filter('h1');
        $I->seeNodeCssClass($h1, 'heading');
        $I->seeNodeText($h1, 'Heading text');
        $small = $h1->filter('small');
        $I->seeNodeCssClass($small, 'subtext');
        $I->seeNodeText($small, 'Subtext');
    }

    public function testThumbnails()
    {
        $I = $this->codeGuy;

        $items = [
            [
                'image' => 'image.png',
                'label' => 'Thumbnail label',
                'caption' => 'Caption text',
                'span' => 6,
                'imageOptions' => ['class' => 'image', 'alt' => 'Alternative text'],
                'captionOptions' => ['class' => 'div'],
                'labelOptions' => ['class' => 'heading'],
            ],
            ['image' => 'image.png', 'label' => 'Thumbnail label', 'caption' => 'Caption text'],
            ['image' => 'image.png', 'label' => 'Thumbnail label', 'caption' => 'Caption text'],
        ];

        $html = TbHtml::thumbnails(
            $items,
            [
                'span' => 3,
                'class' => 'list',
            ]
        );
        $thumbnails = $I->createNode($html, 'ul.thumbnails');
        $I->seeNodeCssClass($thumbnails, 'list');
        $I->seeNodeNumChildren($thumbnails, 3);
        $I->seeNodeChildren($thumbnails, ['li.span6', 'li.span3', 'li.span3']);
        foreach ($thumbnails->children() as $i => $liElement) {
            $li = $I->createNode($liElement);
            $thumbnail = $li->filter('div.thumbnail');
            $I->seeNodeChildren($thumbnail, ['img', 'div.caption']);
            $img = $thumbnail->filter('img');
            $I->seeNodeAttribute($img, 'src', 'image.png');
            $caption = $thumbnail->filter('div.caption');
            $h3 = $caption->filter('h3');
            $I->seeNodeText($caption, $items[$i]['caption']);
            $I->seeNodeText($h3, $items[$i]['label']);
            if ($i === 0) {
                $I->seeNodeCssClass($img, 'image');
                $I->seeNodeAttribute($img, 'alt', 'Alternative text');
                $I->seeNodeCssClass($caption, 'div');
                $I->seeNodeCssClass($h3, 'heading');
            }
        }

        $html = TbHtml::thumbnails([]);
        $this->assertEquals('', $html);
    }

    public function testThumbnail()
    {
        $I = $this->codeGuy;
        $html = TbHtml::thumbnail(
            'Thumbnail text',
            [
                'class' => 'div',
                'itemOptions' => ['class' => 'item'],
            ]
        );
        $li = $I->createNode($html, 'li');
        $I->seeNodeCssClass($li, 'item');
        $thumbnail = $li->filter('div.thumbnail');
        $I->seeNodeCssClass($thumbnail, 'div');
        $I->seeNodeText($thumbnail, 'Thumbnail text');
    }

    public function testThumbnailLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::thumbnailLink(
            'Thumbnail text',
            '#',
            [
                'class' => 'link',
                'itemOptions' => ['class' => 'item'],
            ]
        );
        $li = $I->createNode($html, 'li');
        $I->seeNodeCssClass($li, 'item');
        $thumbnail = $li->filter('a.thumbnail');
        $I->seeNodeCssClass($thumbnail, 'link');
        $I->seeNodeAttribute($thumbnail, 'href', '#');
        $I->seeNodeText($thumbnail, 'Thumbnail text');
    }

    public function testAlert()
    {
        $I = $this->codeGuy;

        $html = TbHtml::alert(
            TbHtml::ALERT_COLOR_SUCCESS,
            'Alert message',
            [
                'class' => 'div',
                'closeText' => 'Close',
                'closeOptions' => ['class' => 'text'],
            ]
        );
        $alert = $I->createNode($html, 'div.alert');
        $I->seeNodeCssClass($alert, 'alert-success in fade div');
        $I->seeNodeText($alert, 'Alert message');
        $close = $alert->filter('a[type=button].close');
        $I->seeNodeCssClass($close, 'text');
        $I->seeNodeAttributes(
            $close,
            [
                'href' => '#',
                'data-dismiss' => 'alert',
            ]
        );
        $I->seeNodeText($close, 'Close');

        $html = TbHtml::alert(
            TbHtml::ALERT_COLOR_INFO,
            'Alert message',
            [
                'closeText' => false,
                'in' => false,
                'fade' => false,
            ]
        );
        $alert = $I->createNode($html, 'div.alert');
        $I->seeNodeCssClass($alert, 'alert-info');
        $I->dontSeeNodeCssClass($alert, 'fade in');
        $I->dontSeeNodeChildren($alert, ['.close']);
        $I->seeNodeText($alert, 'Alert message');
    }

    public function testBlockAlert()
    {
        $I = $this->codeGuy;
        $html = TbHtml::blockAlert(TbHtml::ALERT_COLOR_WARNING, 'Alert message');
        $alert = $I->createNode($html, 'div.alert');
        $I->seeNodeCssClass($alert, 'alert-warning alert-block fade in');
        $I->seeNodeText($alert, 'Alert message');
        $I->seeNodeChildren($alert, ['div.alert > a[type=button].close']);
    }

    public function testProgressBar()
    {
        $I = $this->codeGuy;

        $html = TbHtml::progressBar(
            60,
            [
                'class' => 'div',
                'color' => TbHtml::PROGRESS_COLOR_INFO,
                'content' => 'Bar text',
                'barOptions' => ['class' => 'div'],
            ]
        );
        $progress = $I->createNode($html, 'div.progress');
        $I->seeNodeCssClass($progress, 'progress-info div');
        $bar = $progress->filter('div.bar');
        $I->seeNodeCssClass($bar, 'div');
        $I->seeNodeCssStyle($bar, 'width: 60%');
        $I->seeNodeText($bar, 'Bar text');

        $html = TbHtml::progressBar(
            35,
            [
                'barOptions' => ['color' => TbHtml::PROGRESS_COLOR_SUCCESS],
            ]
        );
        $progress = $I->createNode($html, 'div.progress');
        $bar = $progress->filter('div.bar');
        $I->seeNodeCssClass($bar, 'bar-success');
        $I->seeNodeCssStyle($bar, 'width: 35%');

        $html = TbHtml::progressBar(-1);
        $progress = $I->createNode($html, 'div.progress');
        $bar = $progress->filter('div.bar');
        $I->seeNodeCssStyle($bar, 'width: 0');

        $html = TbHtml::progressBar(100.1);
        $progress = $I->createNode($html, 'div.progress');
        $bar = $progress->filter('div.bar');
        $I->seeNodeCssStyle($bar, 'width: 100%');
    }

    public function testStripedProgressBar()
    {
        $I = $this->codeGuy;
        $html = TbHtml::stripedProgressBar(20);
        $progress = $I->createNode($html, 'div.progress');
        $I->seeNodeCssClass($progress, 'progress-striped');
        $bar = $progress->filter('div.bar');
        $I->seeNodeCssStyle($bar, 'width: 20%');
    }

    public function testAnimatedProgressBar()
    {
        $I = $this->codeGuy;
        $html = TbHtml::animatedProgressBar(40);
        $progress = $I->createNode($html, 'div.progress');
        $I->seeNodeCssClass($progress, 'progress-striped active');
        $bar = $progress->filter('div.bar');
        $I->seeNodeCssStyle($bar, 'width: 40%');
    }

    public function testStackedProgressBar()
    {
        $I = $this->codeGuy;

        $html = TbHtml::stackedProgressBar(
            [
                ['color' => TbHtml::PROGRESS_COLOR_SUCCESS, 'width' => 35],
                ['color' => TbHtml::PROGRESS_COLOR_WARNING, 'width' => 20],
                ['color' => TbHtml::PROGRESS_COLOR_DANGER, 'width' => 10],
            ]
        );
        $progress = $I->createNode($html, 'div.progress');
        $I->seeNodeChildren($progress, ['div.bar-success', 'div.bar-warning', 'div.bar-danger']);
        $success = $progress->filter('div.bar-success');
        $I->seeNodeCssClass($success, 'bar');
        $I->seeNodeCssStyle($success, 'width: 35%');
        $warning = $progress->filter('div.bar-warning');
        $I->seeNodeCssClass($warning, 'bar');
        $I->seeNodeCssStyle($warning, 'width: 20%');
        $danger = $progress->filter('div.bar-danger');
        $I->seeNodeCssClass($danger, 'bar');
        $I->seeNodeCssStyle($danger, 'width: 10%');

        $html = TbHtml::stackedProgressBar(
            [
                ['width' => 35],
                ['width' => 20],
                ['width' => 100],
            ]
        );
        $progress = $I->createNode($html, 'div.progress');
        $last = $progress->filter('div.bar')->last();
        $I->seeNodeCssStyle($last, 'width: 45%');

        $html = TbHtml::stackedProgressBar(
            [
                ['width' => 35],
                ['width' => 20],
                ['width' => 10, 'visible' => false],
            ]
        );
        $progress = $I->createNode($html, 'div.progress');
        $last = $progress->filter('div.bar')->last();
        $I->seeNodeCssStyle($last, 'width: 20%');

        $html = TbHtml::stackedProgressBar([]);
        $this->assertEquals('', $html);
    }

    public function testMediaList()
    {
        $I = $this->codeGuy;

        $items = [
            ['image' => 'image.png', 'heading' => 'Media heading', 'content' => 'Content text'],
            ['heading' => 'Media heading', 'content' => 'Content text'],
        ];

        $html = TbHtml::mediaList(
            $items,
            [
                'class' => 'list',
            ]
        );
        $ul = $I->createNode($html, 'ul.media-list');
        $I->seeNodeNumChildren($ul, 2);
        $I->seeNodeChildren($ul, ['li.media', 'li.media']);

        $html = TbHtml::mediaList([]);
        $this->assertEquals('', $html);
    }

    public function testMedias()
    {
        $I = $this->codeGuy;

        $items = [
            [
                'image' => 'image.png',
                'heading' => 'Media heading',
                'content' => 'Content text',
                'items' => [
                    [
                        'image' => '#',
                        'heading' => 'Media heading',
                        'content' => 'Content text',
                    ],
                    [
                        'image' => '#',
                        'heading' => 'Media heading',
                        'content' => 'Content text',
                        'visible' => false,
                    ],
                ]
            ],
            ['heading' => 'Media heading', 'content' => 'Content text'],
        ];

        $html = TbHtml::medias($items);
        $body = $I->createNode($html, 'body');
        $medias = $body->filter('div.media');
        $first = $medias->first();
        $I->seeNodeChildren($first, ['a.pull-left', 'div.media-body']);
        $img = $first->filter('img.media-object');
        $I->seeNodeAttribute($img, 'src', 'image.png');
        $mediaBody = $first->filter('div.media-body');
        $I->seeNodeChildren($mediaBody, ['h4.media-heading', 'div.media']);
        $I->seeNodeText($mediaBody, 'Content text');
        $h4 = $body->filter('h4.media-heading');
        $I->seeNodeText($h4, 'Media heading');
        $I->seeNodeNumChildren($mediaBody, 1, 'div.media');
        $last = $medias->last();
        $I->seeNodeChildren($last, ['div.media-body']);

        $html = TbHtml::medias([]);
        $this->assertEquals('', $html);
    }

    public function testMedia()
    {
        $I = $this->codeGuy;

        $html = TbHtml::media(
            'image.png',
            'Heading text',
            'Content text',
            [
                'class' => 'div',
                'linkOptions' => ['class' => 'link'],
                'imageOptions' => ['class' => 'image', 'alt' => 'Alternative text'],
                'contentOptions' => ['class' => 'content'],
                'headingOptions' => ['class' => 'heading'],
            ]
        );
        $div = $I->createNode($html, 'div.media');
        $I->seeNodeCssClass($div, 'div');
        $I->seeNodeChildren($div, ['a.pull-left', 'div.media-body']);
        $a = $div->filter('a.pull-left');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttribute($a, 'href', '#');
        $img = $a->filter('img.media-object');
        $I->seeNodeCssClass($img, 'image');
        $I->seeNodeAttributes(
            $img,
            [
                'src' => 'image.png',
                'alt' => 'Alternative text',
            ]
        );
        $content = $div->filter('div.media-body');
        $I->seeNodeCssClass($content, 'content');
        $I->seeNodeText($content, 'Content text');
        $h4 = $content->filter('h4.media-heading');
        $I->seeNodeCssClass($h4, 'heading');
        $I->seeNodeText($h4, 'Heading text');
    }

    public function testWell()
    {
        $I = $this->codeGuy;
        $html = TbHtml::well(
            'Well text',
            [
                'class' => 'div',
                'size' => TbHtml::WELL_SIZE_LARGE,
            ]
        );
        $well = $I->createNode($html, 'div.well');
        $I->seeNodeCssClass($well, 'well-large');
        $I->seeNodeText($well, 'Well text');
    }

    public function testCloseLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::closeLink(
            'Close',
            '#',
            [
                'class' => 'link',
                'dismiss' => TbHtml::CLOSE_DISMISS_ALERT,
            ]
        );
        $a = $I->createNode($html, 'a[type=button].close');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'href' => '#',
                'data-dismiss' => 'alert',
            ]
        );
        $I->seeNodeText($a, 'Close');
    }

    public function testCloseButton()
    {
        $I = $this->codeGuy;
        $html = TbHtml::closeButton(
            'Close',
            [
                'dismiss' => TbHtml::CLOSE_DISMISS_MODAL,
                'class' => 'button',
            ]
        );
        $button = $I->createNode($html, 'button[type=button].close');
        $I->seeNodeCssClass($button, 'button');
        $I->seeNodeAttribute($button, 'data-dismiss', 'modal');
        $I->seeNodeText($button, 'Close');
    }


    public function testCollapseLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::collapseLink(
            'Link',
            '#',
            [
                'class' => 'link',
            ]
        );
        $a = $I->createNode($html, 'a[data-toggle=collapse]');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttribute($a, 'href', '#');
        $I->seeNodeText($a, 'Link');
    }

    public function testTooltip()
    {
        $I = $this->codeGuy;

        $html = TbHtml::tooltip(
            'Link',
            '#',
            'Tooltip text',
            [
                'class' => 'link',
                'animation' => true,
                'html' => true,
                'selector' => '.selector',
                'placement' => TbHtml::TOOLTIP_PLACEMENT_RIGHT,
                'trigger' => TbHtml::TOOLTIP_TRIGGER_CLICK,
                'delay' => 350,
            ]
        );
        $a = $I->createNode($html, 'a[rel=tooltip]');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'title' => 'Tooltip text',
                'data-animation' => 'true',
                'data-html' => 'true',
                'data-selector' => '.selector',
                'data-placement' => 'right',
                'data-trigger' => 'click',
                'data-delay' => '350',
                'href' => '#'
            ]
        );
        $I->seeNodeText($a, 'Link');
    }

    public function testPopover()
    {
        $I = $this->codeGuy;

        $html = TbHtml::popover(
            'Link',
            'Heading text',
            'Content text',
            [
                'class' => 'link',
            ]
        );
        $a = $I->createNode($html, 'a[rel=popover]');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'title' => 'Heading text',
                'data-content' => 'Content text',
                'data-toggle' => 'popover',
                'href' => '#'
            ]
        );
        $I->seeNodeText($a, 'Link');
    }

    public function testCarousel()
    {
        $I = $this->codeGuy;

        $items = [
            [
                'image' => 'image.png',
                'label' => 'First Thumbnail label',
                'url' => '#',
                'caption' => 'Caption text',
            ],
            ['image' => 'image.png', 'label' => 'Second Thumbnail label'],
            ['image' => 'image.png', 'imageOptions' => ['class' => 'image', 'alt' => 'Alternative text']],
        ];

        $html = TbHtml::carousel(
            $items,
            [
                'id' => 'carousel',
                'class' => 'div',
            ]
        );
        $carousel = $I->createNode($html, 'div.carousel');
        $I->seeNodeCssClass($carousel, 'div slide');
        $I->seeNodeAttribute($carousel, 'carousel');
        $I->seeNodeChildren($carousel, ['ol.carousel-indicators', 'div.carousel-inner', 'a.carousel-control', 'a.carousel-control']);
        $inner = $carousel->filter('div.carousel-inner');
        foreach ($inner->children() as $i => $divElement) {
            $div = $I->createNode($divElement);
            $I->seeNodeCssClass($div, 'item');
            switch ($i) {
                case 0:
                    $I->seeNodeCssClass($div, 'active');
                    $I->seeNodeChildren($div, ['a', 'div.carousel-caption']);
                    $a = $div->filter('a');
                    $I->seeNodeAttribute($a, 'href', '#');
                    break;
                case 1:
                    $I->seeNodeChildren($div, ['img', 'div.carousel-caption']);
                    break;
                case 2:
                    $img = $div->filter('img.image');
                    $I->seeNodeAttributes(
                        $img,
                        [
                            'src' => 'image.png',
                            'alt' => 'Alternative text',
                        ]
                    );
                    break;
            }
        }
    }

    public function testCarouselItem()
    {
        $I = $this->codeGuy;
        $html = TbHtml::carouselItem(
            'Content text',
            'Label text',
            'Caption text',
            [
                'class' => 'div',
                'overlayOptions' => ['class' => 'overlay'],
                'labelOptions' => ['class' => 'label'],
                'captionOptions' => ['class' => 'caption'],
            ]
        );
        $div = $I->createNode($html, 'div.item');
        $I->seeNodeCssClass($div, 'div');
        $I->seeNodeText($div, 'Content text');
        $overlay = $div->filter('div.carousel-caption');
        $I->seeNodeCssClass($overlay, 'overlay');
        $I->seeNodeChildren($overlay, ['h4', 'p']);
        $h4 = $overlay->filter('h4');
        $I->seeNodeCssClass($h4, 'label');
        $caption = $overlay->filter('p');
        $I->seeNodeCssClass($caption, 'caption');
        $I->seeNodeText($caption, 'Caption text');
    }

    public function testCarouselPrevLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::carouselPrevLink(
            'Previous',
            '#',
            [
                'class' => 'link',
            ]
        );
        $a = $I->createNode($html, 'a.carousel-control.left');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'href' => '#',
                'data-slide' => 'prev',
            ]
        );
        $I->seeNodeText($a, 'Previous');
    }

    public function testCarouselNextLink()
    {
        $I = $this->codeGuy;
        $html = TbHtml::carouselNextLink(
            'Next',
            '#',
            [
                'class' => 'link',
            ]
        );
        $a = $I->createNode($html, 'a.carousel-control.right');
        $I->seeNodeCssClass($a, 'link');
        $I->seeNodeAttributes(
            $a,
            [
                'href' => '#',
                'data-slide' => 'next',
            ]
        );
        $I->seeNodeText($a, 'Next');
    }

    public function testCarouselIndicators()
    {
        $I = $this->codeGuy;
        $html = TbHtml::carouselIndicators(
            '#',
            3,
            [
                'class' => 'list',
            ]
        );
        $ol = $I->createNode($html, 'ol.carousel-indicators');
        $I->seeNodeCssClass($ol, 'list');
        $I->seeNodeChildren($ol, ['li.active', 'li', 'li']);
        foreach ($ol->filter('li') as $i => $element) {
            $node = $I->createNode($element);
            $I->seeNodeAttributes(
                $node,
                [
                    'data-target' => '#',
                    'data-slide-to' => $i,
                ]
            );
            $I->seeNodeEmpty($node);
        }
    }

    public function testAddCssClass()
    {
        $htmlOptions = ['class' => 'my'];
        TbHtml::addCssClass(['class'], $htmlOptions);
        $this->assertEquals('my class', $htmlOptions['class']);
        TbHtml::addCssClass('more classes', $htmlOptions);
        $this->assertEquals('my class more classes', $htmlOptions['class']);
        TbHtml::addCssClass(['my'], $htmlOptions);
        $this->assertEquals('my class more classes', $htmlOptions['class']);
        TbHtml::addCssClass('class more classes', $htmlOptions);
        $this->assertEquals('my class more classes', $htmlOptions['class']);
    }

    public function testAddCssStyle()
    {
        $htmlOptions = ['style' => 'display: none'];
        TbHtml::addCssStyle('color: purple', $htmlOptions);
        TbHtml::addCssStyle('background: #fff;', $htmlOptions);
        TbHtml::addCssStyle(['font-family: "Open sans"', 'font-weight: bold;'], $htmlOptions);
        $this->assertEquals(
            'display: none; color: purple; background: #fff; font-family: "Open sans"; font-weight: bold',
            $htmlOptions['style']
        );
    }
}