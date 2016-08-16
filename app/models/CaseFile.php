<?php

class CaseFile extends Eloquent {

	protected $table = 'case_files';

	public function caseModel() {
		return $this->BelongsTo('CaseModel', 'case_id');
	}

}