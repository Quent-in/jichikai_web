<?php
class HatenaSyntax{
	var $result="";
	var $currentline="";
	var $currentlinetext="";
	var $lastTagFlag="";
	var $lastTagFlagNum="";
	var $currentlistTag="";
	function liSyntax($linenumber){
		$l=$this->$currntline;
		$identifie=substr($l,0,1);
		if($identifie=="-"){
			$tag="ul";
		}else{
			$tag="ol";
		}
		$pattern="/\\".$identifie."*/";
		preg_match($pattern,$l,$matches,PREG_OFFSET_CAPTURE);
		$match=$matches[0][0];
		$n=strlen($match);
		$text=substr($l,$n,-1);
		$this->$currentlinetext=$text;
		if($linenumber==0){
			//�ŏ��̍s�̏ꍇ�@but �قƂ�ǂ̃P�[�X��title�L�@�̂͂��Ȃ̂Ńe�X�g�p
			$this->$currentlistTag=str_repeat("<".$tag.">",$n)."\n"."<li>";
		}elseif($tag===$this->$lastTagFlag){
			//�O�̗�Ɠ����^�O�̎�ނ̏ꍇ
			if($n==$this->$lastTagFlagNum){
				//�O�̗�Ɠ������x���̏ꍇ
				$this->$currentlistTag="<li>";
			}elseif($n>$this->$lastTagFlagNum){
				//�O�̗��荂�����x���̏ꍇ
				$diff=$n-$this->$lastTagFlagNum;
				$this->$currentlistTag=str_repeat("<".$tag.">",$diff)."\n"."<li>";
			}elseif($n<$this->$lastTagFlagNum){
				//�O�̗���Ⴂ���x���̏ꍇ
				$diff=$this->$lastTagFlagNum-$n;
				$this->$currentlistTag=str_repeat("</".$tag.">",$diff)."\n"."<li>";
			}
		}else{
			//�O�̗�ƈႤ�^�O�̏ꍇ
			//�܂��O�̃^�O�����
			$cn=intval($this->$lastTagFlagNum);
			$closetag=str_repeat("</".$this->$lastTagFlag.">",$cn)."\n";
			//���ꂩ��V���ȃ^�O��t����
			$this->$currentlistTag=$closetag.str_repeat("<".$tag.">",$n)."\n"."<li>";
		}
		$this->$lastTagFlag=$tag;
		$this->$lastTagFlagNum=$n;
	}
	function ConvertHatenaSyntax($t){
		$lines=preg_split('/\n/',$t);
		$result="";
		for($i=0;$i<count($lines);$i++){
			$l=$lines[$i];
			//$this->$currentline=$l;
			//�s���ɃL�[���[�h�����邩���`�F�b�N
			if(preg_match("/^[\+-]/",$this->$currentline)){
				//list�L�@
				echo$this->currentline;
				$this->liSyntax($i);
			}elseif(preg_match("/^[\*]/",$this->$currentline)){
				//�^�C�g���L�@
				//$this->titleSyntax();
			}
			//block�n�̋L�@�̖ڈ���`�F�b�N
			elseif(preg_match("/^[\*]/",$this->$currentline)){
				//pre�L�@
				
			}
			//����ȊO�̋L�@ ex)http�L�@ image�L�@
			
			//�s����������
			
		}//end for
		//echo $this->$result;
	}//end function ConvertHatenaSyntax
}//end class
?>