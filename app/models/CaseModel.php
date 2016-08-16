<?php

class CaseModel extends Eloquent {

	protected $table = 'cases';

	protected $dates = ['created_at', 'updated_at', 'arrival_date', 'inspection_date', 'accident_date', 'report_date'];

	protected $softDelete = true;

	public function user() {
		return $this->BelongsTo('User', 'user_id');
	}

	public function files() {
		return $this->HasMany('CaseFile', 'case_id');
	}

	public function scopeApplySearch($query, CaseSearch $caseSearch) {
		if ($caseSearch->hotel) {
			$query->where('hotel', 'like', '%' . $caseSearch->hotel . '%');
		}

		if ($caseSearch->resort) {
			$query->where('resort', 'like', '%' . $caseSearch->resort . '%');
		}

		if ($caseSearch->client_name) {
			$query->where('client_name', 'like', '%' . $caseSearch->client_name . '%');
		}

		if ($caseSearch->report_by) {
			$query->whereHas('user', function($q) use ($caseSearch) {
				$q->where('username', 'like', '%' . $caseSearch->report_by . '%');
			});
		}

		if ($caseSearch->report_date_start) {
			$query->where('report_date', '>', $caseSearch->report_date_start);
		}

		if ($caseSearch->report_date_end) {
			$query->where('report_date', '<', $caseSearch->report_date_end);
		}

		return $query;
	}

	public function delete()
	{
		$this->files()->delete();

		return parent::delete();
	}
}