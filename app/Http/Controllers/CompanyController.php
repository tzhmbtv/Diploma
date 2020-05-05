<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create']);
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $this->validateRequestForCreate($request);
        $this->store($request);
    }

    public function getCompany(Request $request)
    {
        $this->validateCompanyId($request);

        $companyId = (integer) $request->get('company_id');
        $this->getSingleCompany($companyId);
    }

    /**
     * @param Request $request
     */
    private function validateRequestForCreate(Request $request)
    {
        $request->validate(Company::$rules);
    }

    /**
     * @param Request $request
     */
    private function store(Request $request)
    {
        $company = new Company();
        $company->setShortName($request->get('short_name'));
        $company->setOfficialName($request->get('official_name'));
        $company->save();
    }

    private function validateCompanyId(Request $request)
    {
        $request->validate(['id' => 'integer|required']);
    }

    private function getSingleCompany(int $companyId)
    {
        Company::find($companyId);
    }
}
