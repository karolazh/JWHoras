<?php if(!defined('BASE_PATH')) exit('No se puede acceder al script');

class Html{


	/**
	 * Crea un elemento <select>
	 * @param  array $options   opciones del combo
	 * @param  array $atributos atributos del combo
	 * @return [type]            [description]
	 */
	public function createSelect($options,$atributos=null){
		$select = '<select';
		if(is_array(($atributos))){
			$attr = '';
			foreach($atributos as $name => $valor){
				$attr .= ' '.$name.'="'.$valor.'"' ;
			}
			$select .= $attr;
		}
		$select .= '>';

		if(is_array($options)){
			$opts = '';
			foreach($options as $name => $valor){
				$opts .= '<option value="'.$valor.'">'.$name.'</option>';
			}
			$select .= $opts;
		}

		$select .= '</select>';

		echo $select;
	}


	/**
	 * Crea un elemento <a>
	 * @param  [type] $href      [description]
	 * @param  [type] $atributos [description]
	 * @return [type]            [description]
	 */
	public function createAnchor($href,$texto,$atributos=null){
		if(empty($href)){
			$href = 'javascript:void(0)';
		}
		$a = '<a href="'.$href.'"';

		if(is_array($atributos)){
			$attr = '';
			foreach($atributos as $name => $valor){
				$attr .= ' '.$name.'="'.$valor.'"' ;
			}
			$a .= $attr;
		}

		$a .= '>'.$texto.'</a>';

		echo $a;
	}


	/**
	 * Crea un elemento <input>
	 * @param  [type] $atributos [description]
	 * @return [type]            [description]
	 */
	public function createInput($atributos){
		$input = '<input';
		
		if(is_array($atributos)){
			$attr = '';
			foreach($atributos as $name => $valor){
				$attr .= ' '.$name.'="'.$valor.'"' ;
			}
			$input .= $attr;
		}

		$input .= '/>';

		echo $input;
	}



	public function createTextArea($atributos,$texto=''){
		$textarea = '<textarea';

		if(is_array($atributos)){
			$attr = '';
			foreach($atributos as $name => $valor){
				$attr .= ' '.$name.'="'.$valor.'"' ;
			}
			$textarea .= $attr;
		}
		
		$textarea .= '>'.$texto.'</textarea>';

		echo $textarea;
	}


	public function createButton($atributos,$texto=''){
		$button = '<button';

		if(is_array($atributos)){
			$attr = '';
			foreach($atributos as $name => $valor){
				$attr .= ' '.$name.'="'.$valor.'"' ;	
			}
			$button .= $attr;
		}

		$button .= '>'.$texto.'</button>';

		echo $button;
	}

}

?>
