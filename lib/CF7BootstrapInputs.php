<?php

class CF7BootstrapInputs
{
    private const INPUT_TYPES = [
        'submit' => 'type="submit"',
        'textarea' => 'textarea',
        'select' => '<select',
        'checkbox' => 'type="checkbox"',
        'radio' => 'type="radio"',
        'text' => 'type="text"',
        'date' => 'type="date"',
        'tel' => 'type="tel"',
        'number' => 'type="number"',
        'email' => 'type="email"',
        'url' => 'type="url"',
        'file' => 'type="file"',
    ];

    private const DEFAULT_CLASS = 'form-control';
    private const SELECT_CLASS = 'form-select';
    private const CHECKBOX_CLASS = 'form-check-input';
    private const RADIO_CLASS = 'form-check-input';
    private const SUBMIT_CLASS = 'btn btn-primary';

    public function init()
    {
        add_action('wpcf7_form_elements', [$this, 'add_input_classes']);
    }

    public function add_input_classes(string $stringified_form): string
    {
        $inputs = $this->get_all_inputs($stringified_form);
        return $this->replace_inputs($stringified_form, $inputs);
    }

    private function get_all_inputs(string $stringified_form): array
    {
        preg_match_all('/(<input[^>]+>|<textarea[^>]+>|<select[^>]+>)/', $stringified_form, $matches);
        return $matches[0];
    }

    private function replace_inputs(string $stringified_form, array $inputs): string
    {
        foreach ($inputs as $input) {
            $replaced_input = $this->replace_input_classes($input);
            $stringified_form = str_replace($input, $replaced_input, $stringified_form);
        }
        return $stringified_form;
    }

    private function replace_input_classes(string $input): string
    {
        foreach (self::INPUT_TYPES as $type => $identifier) {
            if (strpos($input, $identifier) !== false) {
                return $this->{"replace_{$type}_classes"}($input);
            }
        }
        return $input;
    }

    private function replace_file_classes(string $input): string
    {
        return $this->add_class($input, self::DEFAULT_CLASS);
    }

    private function replace_url_classes(string $input): string
    {
        return $this->add_class($input, self::DEFAULT_CLASS);
    }

    private function replace_select_classes(string $input): string
    {
        return $this->add_class($input, self::SELECT_CLASS);
    }

    private function replace_submit_classes(string $input): string
    {
        return $this->add_class($input, self::SUBMIT_CLASS);
    }

    private function replace_checkbox_classes(string $input): string
    {
        return $this->add_class($input, self::CHECKBOX_CLASS);
    }

    private function replace_radio_classes(string $input): string
    {
        return $this->add_class($input, self::RADIO_CLASS);
    }

    private function replace_textarea_classes(string $input): string
    {
        return $this->add_class($input, self::DEFAULT_CLASS);
    }

    private function replace_text_classes(string $input): string
    {
        return $this->add_class($input, self::DEFAULT_CLASS);
    }

    private function replace_date_classes(string $input): string
    {
        return $this->add_class($input, self::DEFAULT_CLASS);
    }

    private function replace_tel_classes(string $input): string
    {
        return $this->add_class($input, self::DEFAULT_CLASS);
    }

    private function replace_number_classes(string $input): string
    {
        return $this->add_class($input, self::DEFAULT_CLASS);
    }

    private function replace_email_classes(string $input): string
    {
        return $this->add_class($input, self::DEFAULT_CLASS);
    }

    private function add_class(string $input, string $class): string
    {
        if (strpos($input, 'class="') === false) {
            return str_replace('name=', 'class="' . $class . '" name=', $input);
        }
        return str_replace('class="', "class=\"$class ", $input);
    }
}
