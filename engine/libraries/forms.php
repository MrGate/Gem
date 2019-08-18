<?PHP  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// GEM Forms Librarie

class Forms
{
	// Form name
	public $name = null;
	
	// Form method (post = default)
	public $method = 'post';
	
	// Form action
	public $action = null;
	
	// Submit button value
	public $submit_btn_text = 'Submit';
	
	// Default character set
	public $charset = 'utf-8';
	
	// form errors
	public $form_error = false;
	
	// form session
	public $session = null;
	
	protected $csf_token = null;
	
	protected $field_array = array();
	
	public $htmlGenerated = null;
	
	public function __construct()
	{
		
	}
	
	public function create($action, $method = "post")
	{
		//$this->htmlGenerated .= '<form action="'.$action.'" method="'.$method.'">';
		
		$this->action = $action;
		$this->method = $method;
		
		return $this;
	}

	public function element_text($field_name)
	{
		//$this->htmlGenerated .= '<input type="text" name="'.$field_name.'" value=""/>';
		
		$fieldTemp = array(
			'type' 	=>	'text',
			'name'	=>	$field_name,
			'value'	=>	null,
			'class' =>	null,
			'id'	=>	null,
			'placeholder'	=>	null,
			'max_length'	=> null
		);
		
		array_push($this->field_array, $fieldTemp);
	
		return $this;
	}
	
	public function element_submit($button_text = false)
	{
		if($button_text == false) 
			$button_text = $this->submit_btn_text;
		
		//$this->htmlGenerated .= "<input type='submit' value='".$button_text."'/>";
		
		$fieldTemp = array(
			'type' 	=>	'submit',
			'name'	=>	null,
			'value'	=>	$button_text,
			'class' =>	null,
			'id'	=>	null
		);
		
		array_push($this->field_array, $fieldTemp);
		
		return $this;
	}
	
	
	public function getHtml()
	{
		
		$this->htmlGenerated = null; // clear it to be safe
		$this->htmlGenerated .= '<form action="'.$this->action.'" method="'.$this->method.'">';
		
		foreach($this->field_array as $html_field)
		{
			switch($html_field['type'])
			{
				case 'text':
					$this->htmlGenerated .= '<input type="text" name="'.$html_field['name'].'" value=""/>';
				break;
				case 'submit':
					$this->htmlGenerated .= '<input type="submit" value="'.$html_field['value'].'"/>';
				break;
			}
		}
		
		$this->htmlGenerated .= '</form>';
		
		return $this->htmlGenerated;
	}
}