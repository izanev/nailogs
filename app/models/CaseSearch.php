<?php

class CaseSearch extends Eloquent {

	protected $table = 'case_searches';

	protected $guarded = array();

	public function caseModel() {
		return $this->BelongsTo('CaseModel', 'case_id');
	}

}