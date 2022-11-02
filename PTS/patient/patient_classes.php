<?php
class CheckTables{
	private $container_style = "";
	private $table_style = "";
	private $row = 0;
	private $readonly = "";
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function __construct($row,$container_style,$table_style,$readonly=false){
		$this->row = $row;
		$this->container_style = $container_style;
		$this->table_style = $table_style;
		//checkbox read-only status
		if($readonly)
			$this->readonly = "onclick='return false' onkeydown='return false'";
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function BeginContainer(){
		echo "<div id='$this->container_style'>";
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function EndContainer(){
		echo "</div>";
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function BeginYN(){
		echo 	"<table id='$this->table_style'>
					<tr>
						<th>Condition</th>
						<th>YES</th>
					</tr>";
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function EndYN(){
		echo "</table>";
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function BeginLR($title){
		echo 	"<table id='$this->table_style'>
					<tr>
						<th>$title</th>
						<th>L</th>
						<th>R</th>
					</tr>";
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function EndLR(){
		echo "</table>";
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function CheckPair($text,$name){
		$L = "";
		$R = "";
		
		switch($this->row[$name]){
		case 1:
			$L = "checked";
			break;
		case 2:
			$R = "checked";
			break;
		case 3:
			$L = "checked";
			$R = "checked";
		}
	
		echo	"<tr>
					<td>$text</td>
					<td><input type='checkbox' $L name='chk" . $name . "_Left' $this->readonly/></td>
					<td><input type='checkbox' $R name='chk" . $name . "_Right' $this->readonly/></td>
				</tr>";
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function Check($text,$name){
		$y = "";
		if($this->row[$name]==1)
			$y = "checked";
	
		echo	"<tr>
					<td>$text</td>
					<td><input type='checkbox' $y name='chk" . $name . "_Yes' $this->readonly/></td>
				</tr>";
	}
}

#*****************************************************************************************************************************
#*****************************************************************************************************************************
#*****************************************************************************************************************************

class CheckData{
	//LR
	private $LV_Eczema = "";
	private $LV_Itch = "";
	private $LV_Pigmentation = "";
	private $LV_Oedema = "";
	private $LV_Ankle_flare = "";
	private $LV_Induration = "";
	private $LV_AtrophIe_Blanche = "";
	private $LV_Palpable_pulse = "";
	private $LV_RPI_08 = "";
	//LR
	private $PMC_Varicose_Veins = "";
	private $PMC_VV_Surgery = "";
	private $PMC_Sclerotherapy = "";
	private $PMC_Thrombophlebitis = "";
	private $PMC_DVT = "";
	private $PMC_Leg_Fracture = "";
	private $PMC_Leg_Infection = "";
	//YN
	private $PMC_Pregnancy = "";
	private $PMC_Bypass_Surgery = "";
	private $PMC_Ischaemic_HD = "";
	private $PMC_Hypertension = "";
	private $PMC_TIA = "";
	private $PMC_CVA = "";
	private $PMC_Diabetes = "";
	private $PMC_Rheumatoid_Arthritis = "";
	private $PMC_Claudication = "";
	//LR
	private $LA_Loss_of_hair = "";
	private $LA_Atrophic_shiny_skin = "";
	private $LA_Skin_cold_white_blue = "";
	private $LA_Poor_capillary_filling = "";
	private $LA_Night_pain_leg = "";
	private $LA_Calf_Thigh_muscle_wasting = "";
	private $LA_RPI_08 = "";
	//LR
	private $UV_Wound_shallow = "";
	private $UV_Flat_margins = "";
	private $UV_Sited_lateral_mm = "";
	//LR
	private $UA_Wound_deep = "";
	private $UA_Punched_irregular_shape = "";
	private $UA_Sited_foot_lateral_leg = "";
	//YN
	private $PER_Obese = "";
	private $PER_Smoker = "";
	private $PER_Poor_nutrition = "";
	private $PER_Anaemia = "";
	private $PER_Poor_mobility = "";
	private $PER_Poor_ankle_movement = "";
	private $PER_Psycho_social_factors = "";
	private $PER_Previous_leg_ulcers = "";
	private $PER_IV_drug_use = "";
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function GetDataFromPost(){
		$this->LV_Eczema = $this->CheckPair('LV_Eczema');
		$this->LV_Itch = $this->CheckPair('LV_Itch');
		$this->LV_Pigmentation = $this->CheckPair('LV_Pigmentation');
		$this->LV_Oedema = $this->CheckPair('LV_Oedema');
		$this->LV_Ankle_flare = $this->CheckPair('LV_Ankle_flare');
		$this->LV_Induration = $this->CheckPair('LV_Induration');
		$this->LV_AtrophIe_Blanche = $this->CheckPair('LV_AtrophIe_Blanche');
		$this->LV_Palpable_pulse = $this->CheckPair('LV_Palpable_pulse');
		$this->LV_RPI_08 = $this->CheckPair('LV_RPI_08');
		
		$this->PMC_Varicose_Veins = $this->CheckPair('PMC_Varicose_Veins');
		$this->PMC_VV_Surgery = $this->CheckPair('PMC_VV_Surgery');
		$this->PMC_Sclerotherapy = $this->CheckPair('PMC_Sclerotherapy');
		$this->PMC_Thrombophlebitis = $this->CheckPair('PMC_Thrombophlebitis');
		$this->PMC_DVT = $this->CheckPair('PMC_DVT');
		$this->PMC_Leg_Fracture = $this->CheckPair('PMC_Leg_Fracture');
		$this->PMC_Leg_Infection = $this->CheckPair('PMC_Leg_Infection');
		
		$this->LA_Loss_of_hair = $this->CheckPair('LA_Loss_of_hair');
		$this->LA_Atrophic_shiny_skin = $this->CheckPair('LA_Atrophic_shiny_skin');
		$this->LA_Skin_cold_white_blue = $this->CheckPair('LA_Skin_cold_white_blue');
		$this->LA_Poor_capillary_filling = $this->CheckPair('LA_Poor_capillary_filling');
		$this->LA_Night_pain_leg = $this->CheckPair('LA_Night_pain_leg');
		$this->LA_Calf_Thigh_muscle_wasting = $this->CheckPair('LA_Calf_Thigh_muscle_wasting');
		$this->LA_RPI_08 = $this->CheckPair('LA_RPI_08');
				
		$this->UV_Wound_shallow = $this->CheckPair('UV_Wound_shallow');
		$this->UV_Flat_margins = $this->CheckPair('UV_Flat_margins');
		$this->UV_Sited_lateral_mm = $this->CheckPair('UV_Sited_lateral_mm');

		$this->UA_Wound_deep = $this->CheckPair('UA_Wound_deep');
		$this->UA_Punched_irregular_shape = $this->CheckPair('UA_Punched_irregular_shape');
		$this->UA_Sited_foot_lateral_leg = $this->CheckPair('UA_Sited_foot_lateral_leg');
		
		$this->PMC_Pregnancy = $this->CheckSingle('PMC_Pregnancy');
		$this->PMC_Bypass_Surgery = $this->CheckSingle('PMC_Bypass_Surgery');
		$this->PMC_Ischaemic_HD = $this->CheckSingle('PMC_Ischaemic_HD');
		$this->PMC_Hypertension = $this->CheckSingle('PMC_Hypertension');
		$this->PMC_TIA = $this->CheckSingle('PMC_TIA');
		$this->PMC_CVA = $this->CheckSingle('PMC_CVA');
		$this->PMC_Diabetes = $this->CheckSingle('PMC_Diabetes');
		$this->PMC_Rheumatoid_Arthritis = $this->CheckSingle('PMC_Rheumatoid_Arthritis');
		$this->PMC_Claudication = $this->CheckSingle('PMC_Claudication');
		
		$this->PER_Obese = $this->CheckSingle('PER_Obese');
		$this->PER_Smoker = $this->CheckSingle('PER_Smoker');
		$this->PER_Poor_nutrition = $this->CheckSingle('PER_Poor_nutrition');
		$this->PER_Anaemia = $this->CheckSingle('PER_Anaemia');
		$this->PER_Poor_mobility = $this->CheckSingle('PER_Poor_mobility');
		$this->PER_Poor_ankle_movement = $this->CheckSingle('PER_Poor_ankle_movement');
		$this->PER_Psycho_social_factors = $this->CheckSingle('PER_Psycho_social_factors');
		$this->PER_Previous_leg_ulcers = $this->CheckSingle('PER_Previous_leg_ulcers');
		$this->PER_IV_drug_use = $this->CheckSingle('PER_IV_drug_use');
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	private function CheckSingle($text){
		if(isset($_POST["chk$text" . "_Yes"]))
			return 1;
		else
			return 0;
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	private function CheckPair($text){
		$n = 0;
		if(isset($_POST["chk$text" . "_Left"]))
			$n = 1;
		if(isset($_POST["chk$text" . "_Right"]))
			$n += 2;
		return $n;
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function GetInsertSql($pid){
		$com = "','";
		$sql = "INSERT INTO medical_condition (
				PID,
				LV_Eczema,
				LV_Itch,
				LV_Pigmentation,
				LV_Oedema,
				LV_Ankle_flare,
				LV_Induration,
				LV_AtrophIe_Blanche,
				LV_Palpable_pulse,
				LV_RPI_08,

				PMC_Varicose_Veins,
				PMC_VV_Surgery,
				PMC_Sclerotherapy,
				PMC_Thrombophlebitis,
				PMC_DVT,
				PMC_Leg_Fracture,
				PMC_Leg_Infection,

				PMC_Pregnancy,
				PMC_Bypass_Surgery,
				PMC_Ischaemic_HD,
				PMC_Hypertension,
				PMC_TIA,
				PMC_CVA,
				PMC_Diabetes,
				PMC_Rheumatoid_Arthritis,
				PMC_Claudication,

				LA_Loss_of_hair,
				LA_Atrophic_shiny_skin,
				LA_Skin_cold_white_blue,
				LA_Poor_capillary_filling,
				LA_Night_pain_leg,
				LA_Calf_Thigh_muscle_wasting,
				LA_RPI_08,

				UV_Wound_shallow,
				UV_Flat_margins,
				UV_Sited_lateral_mm,

				UA_Wound_deep,
				UA_Punched_irregular_shape,
				UA_Sited_foot_lateral_leg,

				PER_Obese,
				PER_Smoker,
				PER_Poor_nutrition,
				PER_Anaemia,
				PER_Poor_mobility,
				PER_Poor_ankle_movement,
				PER_Psycho_social_factors,
				PER_Previous_leg_ulcers,
				PER_IV_drug_use
				
				)VALUES('" . 
				
				$pid . $com . 
				$this->LV_Eczema . $com . 
				$this->LV_Itch . $com . 
				$this->LV_Pigmentation . $com . 
				$this->LV_Oedema . $com . 
				$this->LV_Ankle_flare . $com . 
				$this->LV_Induration . $com . 
				$this->LV_AtrophIe_Blanche . $com . 
				$this->LV_Palpable_pulse . $com . 
				$this->LV_RPI_08 . $com . 

				$this->PMC_Varicose_Veins . $com . 
				$this->PMC_VV_Surgery . $com . 
				$this->PMC_Sclerotherapy . $com . 
				$this->PMC_Thrombophlebitis . $com . 
				$this->PMC_DVT . $com . 
				$this->PMC_Leg_Fracture . $com . 
				$this->PMC_Leg_Infection . $com . 

				$this->PMC_Pregnancy . $com . 
				$this->PMC_Bypass_Surgery . $com . 
				$this->PMC_Ischaemic_HD . $com . 
				$this->PMC_Hypertension . $com . 
				$this->PMC_TIA . $com . 
				$this->PMC_CVA . $com . 
				$this->PMC_Diabetes . $com . 
				$this->PMC_Rheumatoid_Arthritis . $com . 
				$this->PMC_Claudication . $com . 

				$this->LA_Loss_of_hair . $com . 
				$this->LA_Atrophic_shiny_skin . $com . 
				$this->LA_Skin_cold_white_blue . $com . 
				$this->LA_Poor_capillary_filling . $com . 
				$this->LA_Night_pain_leg . $com . 
				$this->LA_Calf_Thigh_muscle_wasting . $com . 
				$this->LA_RPI_08 . $com . 

				$this->UV_Wound_shallow . $com . 
				$this->UV_Flat_margins . $com . 
				$this->UV_Sited_lateral_mm . $com . 

				$this->UA_Wound_deep . $com . 
				$this->UA_Punched_irregular_shape . $com . 
				$this->UA_Sited_foot_lateral_leg . $com . 

				$this->PER_Obese . $com . 
				$this->PER_Smoker . $com . 
				$this->PER_Poor_nutrition . $com . 
				$this->PER_Anaemia . $com . 
				$this->PER_Poor_mobility . $com . 
				$this->PER_Poor_ankle_movement . $com . 
				$this->PER_Psycho_social_factors . $com . 
				$this->PER_Previous_leg_ulcers . $com . 
				$this->PER_IV_drug_use . "')";
				
		return $sql;	
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
	public function GetUpdateSql($pid){
		$com = "','";
		$sql = "UPDATE medical_condition SET " .
				"LV_Eczema = '$this->LV_Eczema',
				LV_Itch = '$this->LV_Itch',
				LV_Pigmentation = '$this->LV_Pigmentation',
				LV_Oedema = '$this->LV_Oedema',
				LV_Ankle_flare = '$this->LV_Ankle_flare',
				LV_Induration = '$this->LV_Induration',
				LV_AtrophIe_Blanche = '$this->LV_AtrophIe_Blanche',
				LV_Palpable_pulse = '$this->LV_Palpable_pulse',
				LV_RPI_08 = '$this->LV_RPI_08',

				PMC_Varicose_Veins = '$this->PMC_Varicose_Veins',
				PMC_VV_Surgery = '$this->PMC_VV_Surgery',
				PMC_Sclerotherapy = '$this->PMC_Sclerotherapy',
				PMC_Thrombophlebitis = '$this->PMC_Thrombophlebitis',
				PMC_DVT = '$this->PMC_DVT',
				PMC_Leg_Fracture = '$this->PMC_Leg_Fracture',
				PMC_Leg_Infection = '$this->PMC_Leg_Infection',

				PMC_Pregnancy = '$this->PMC_Pregnancy',
				PMC_Bypass_Surgery = '$this->PMC_Bypass_Surgery',
				PMC_Ischaemic_HD = '$this->PMC_Ischaemic_HD',
				PMC_Hypertension = '$this->PMC_Hypertension',
				PMC_TIA = '$this->PMC_TIA',
				PMC_CVA = '$this->PMC_CVA',
				PMC_Diabetes = '$this->PMC_Diabetes',
				PMC_Rheumatoid_Arthritis = '$this->PMC_Rheumatoid_Arthritis',
				PMC_Claudication = '$this->PMC_Claudication',

				LA_Loss_of_hair = '$this->LA_Loss_of_hair',
				LA_Atrophic_shiny_skin = '$this->LA_Atrophic_shiny_skin',
				LA_Skin_cold_white_blue = '$this->LA_Skin_cold_white_blue',
				LA_Poor_capillary_filling = '$this->LA_Poor_capillary_filling',
				LA_Night_pain_leg = '$this->LA_Night_pain_leg',
				LA_Calf_Thigh_muscle_wasting = '$this->LA_Calf_Thigh_muscle_wasting',
				LA_RPI_08 = '$this->LA_RPI_08',

				UV_Wound_shallow = '$this->UV_Wound_shallow',
				UV_Flat_margins = '$this->UV_Flat_margins',
				UV_Sited_lateral_mm = '$this->UV_Sited_lateral_mm',

				UA_Wound_deep = '$this->UA_Wound_deep',
				UA_Punched_irregular_shape = '$this->UA_Punched_irregular_shape',
				UA_Sited_foot_lateral_leg = '$this->UA_Sited_foot_lateral_leg',

				PER_Obese = '$this->PER_Obese',
				PER_Smoker = '$this->PER_Smoker',
				PER_Poor_nutrition = '$this->PER_Poor_nutrition',
				PER_Anaemia = '$this->PER_Anaemia',
				PER_Poor_mobility = '$this->PER_Poor_mobility',
				PER_Poor_ankle_movement = '$this->PER_Poor_ankle_movement',
				PER_Psycho_social_factors = '$this->PER_Psycho_social_factors',
				PER_Previous_leg_ulcers = '$this->PER_Previous_leg_ulcers',
				PER_IV_drug_use = '$this->PER_IV_drug_use' WHERE PID='$pid'"; 
				
		return $sql;	
	}
	/* ------------------------------------------------------------------------------------------------------------------- */
}
?>