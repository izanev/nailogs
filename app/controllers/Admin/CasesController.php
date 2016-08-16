<?php

namespace Admin;

use BaseController;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CasesController extends BaseController {

	public function __construct() {
		$this->layout = 'layouts.admin';
	}

	public function loadCase($id) {
		$caseEntity = \CaseModel::find($id);

		if (!$caseEntity) {
			throw new \Exception("Case not found");
		}

		return $caseEntity;
	}

	public function showList() {
		$input = \Input::all();

		$caseSearch = new \CaseSearch($input);

		$cases = \CaseModel::with('files')->applySearch($caseSearch)->paginate(10);

		return \View::make('admin.cases.list', array(
			'cases' => $cases,
			'caseSearch' => $caseSearch
		));
	}

	public function showAdd() {
		$case = new \CaseModel();

		return \View::make('admin.cases.add', array(
			'case' => $case,
			'submitRoute' => route('cases.doAdd')
		));
	}

	public function showView($case_id) {
		try {
			$case = $this->loadCase($case_id);

			return \View::make('admin.cases.view', array(
				'case' => $case,
				'submitRoute' => route('cases.doUpdate', array('case_id' => $case_id))
			));
		} catch (\Exception $ex) {
			return \Redirect::back()->withErrors(array($ex->getMessage()));
		}
	}

	public function processUpload(\CaseModel $case, UploadedFile $file) {
		$destinationPath = storage_path() . '/files/';
		$filename = str_random(6) . '_' . $file->getClientOriginalName();
		$uploadSuccess = $file->move($destinationPath, $filename);

		$cfData = array(
			'file' => $filename
		);

		$case->files()->save(new \CaseFile($cfData));
	}

	public function doAdd() {
		$input = \Input::except(array('_token', 'files', 'arrival_date_picker', 'inspection_date_picker', 'accident_date_picker', 'report_date_picker'));

		try {
			\Eloquent::unguard();

			$case = new \CaseModel($input);

			$user = \Auth::user();
			$user->cases()->save($case);

			if (is_array(\Input::file("files"))) {
				foreach(\Input::file("files") as $file) {
					if ($file) {
						$this->processUpload($case, $file);
					}
				}
			}

			return \Redirect::route('cases.list')->withSuccess('Case added successfully!');
		} catch (\Exception $ex) {
			var_dump($ex->getTraceAsString());
			return \Redirect::back()->withInput()->withErrors(array($ex->getMessage()));
		}
	}

	public function doUpdate($case_id) {
		$input = \Input::except(array('_token', 'files', 'arrival_date_picker', 'inspection_date_picker', 'accident_date_picker', 'report_date_picker'));

		try {
			\Eloquent::unguard();

			$case = $this->loadCase($case_id);
			$case->fill($input);
			$case->save();

			if (is_array(\Input::file("files"))) {
				foreach(\Input::file("files") as $file) {
					if ($file) {
						$this->processUpload($case, $file);
					}
				}
			}

			return \Redirect::back()->withSuccess('Case updated successfully!');
		} catch (\Exception $ex) {
			var_dump($ex->getTraceAsString());
			return \Redirect::back()->withInput()->withErrors(array($ex->getMessage()));
		}
	}

	public function doRemove($case_id) {
		try {
			$this->getAuthorizeService()->authorize('remove_case');

			$case = $this->loadCase($case_id);

			$case->delete();

			$response = \Event::fire('case.removed', array($case_id, $case));

			return \Redirect::back()->withSuccess('Case removed successfully!');
		} catch(\Exception $ex) {
			return \Redirect::back()->withErrors(array($ex->getMessage()));
		}
	}
}
