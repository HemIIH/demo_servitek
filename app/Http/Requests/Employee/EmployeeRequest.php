<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\HandleImage;
use App\Http\Requests\Request;

use App\Models\Employee\Employee;
use Carbon\Carbon;

class EmployeeRequest extends Request
{
    use HandleImage;

    public function rules()
    {
        return [
            // basics
            'first_name'     => 'sometimes|required',
            'last_name'      => 'sometimes|required',
            'sex'            => 'sometimes|required',
            'photo'          => 'sometimes|mimes:jpeg,png,jpg,gif|image|max:2000',
            'nationality'    => 'sometimes|required|exists:countries,name',
            'applicant'      => 'sometimes|boolean',

            // birthday
            'day'            => 'sometimes|required|integer',
            'month'          => 'sometimes|required|integer',
            'year'           => 'sometimes|required|integer',
            'date_of_birth'  => 'sometimes|required|date|date_format:"d.m.Y"',
            'place_of_birth' => '',

            // personal
            'married'        => 'boolean',
            'children'       => 'integer',

            // address
            'street'         => '',
            'postal_code'    => 'numeric',
            'city'           => '',

            // locations
            'locations'      => 'sometimes|required',
            'locations.*'    => 'sometimes|required',

            // contacts
            'email'          => 'sometimes|required|email',
            'phone'          => 'phone|nullable',
            'mobile'         => 'phone|nullable',

            'health_insurance'             => '',
            'social_security_number'       => 'alpha_num',
            'occupation_type'              => 'nullable',
            'contractual_working_hours'    => 'integer',
            'tax_id'                       => '',
            'tax_class'                    => 'numeric',
            'active'                       => 'boolean',

            // contract
            'entry_date'                   => 'sometimes|required|date|date_format:"d.m.Y"',
            'exit_date'                    => 'date|date_format:"d.m.Y"|after:entry_date',
            'wage'                         => 'decimal',

            // bank account
            'iban'                         => 'alpha_num',
            'bic'                          => 'alpha_num',

            'car'                          => 'boolean',
            'driving_license'              => 'boolean',
            'public_transportation'        => 'boolean',

            'working_time_account_balance' => 'integer'
        ];
    }

    public function conditionalRules()
    {
        $employee = $this->route('employee');

        return [
            [
                'fields'   => 'email',
                'rules'    => '|unique:employees,email,' . ($employee ? $employee->id : '')
            ]
        ];
    }

    public function store()
    {
        $data = $this->only([
            'first_name',
            'last_name',
            'sex',
            'nationality',
            'email',
            'entry_date',
            'applicant'
        ]);

        $data['date_of_birth'] = Carbon::createFromDate($this->get('year'), $this->get('month'), $this->get('day'))->format('d.m.Y');

        if ($this->filled('locations')) {
            $data['locations'] = json_encode($this->get('locations'));
        }

        $employee = Employee::create($data);

        $this->createWageEntry($employee);

        return $employee->id;
    }


    /**
     * Update employee.
     *
     * @param $employee
     */
    public function save($employee)
    {
        $data = $this->except(['locations']);

        if ($this->filled('locations')) {
            $data['locations'] = json_encode($this->get('locations'));
        }

        $employee->update($this->sanitizeData($data));

        $this->updateWorkingTimeAccount($employee);

//        $this->createFurtherOccupationEntry($employee);

        return $employee;
    }

    /**
     * Upload employee photp.
     *
     * @param $employee
     * @return mixed
     */
    public function upload($employee)
    {
        if (! $this->hasFile('photo'))
            return;

        $filename = $this->processImage($this->file('photo'));

        $employee->update([
            'photo' => $filename
        ]);

        return $filename;
    }

    /**
     * Process image.
     *
     * @param $image
     *
     * @return string
     */
    protected function processImage($image)
    {
        $filename = $this->createFilename($image);

        $this->uploadImage($image, 120, 120, 'uploads/images/photos/employees/' . $filename);

        return $filename;
    }

    /**
     * @param $employee
     */
    protected function createFurtherOccupationEntry($employee)
    {
        if ($this->filled(['monthly_wage', 'monthly_working_time', 'employed_since', 'occupation', 'employer'])) {
            $employee->furtherOccupation()->create([
                'monthly_wage'         => $this->get('monthly_wage'),
                'monthly_working_time' => $this->get('monthly_working_time'),
                'employed_since'       => \Date::germanToSql($this->get('employed_since')),
                'occupation'           => $this->get('occupation'),
                'employer'             => $this->get('employer'),
            ]);
        }
    }

    /**
     * @param $employee
     */
    protected function createWageEntry($employee)
    {
        if ($this->filled('wage')) {
            $employee->wages()->create([
                'valid_from' => $this->get('entry_date'),
                'amount'     => $this->get('wage')
            ]);
        }

    }

    /**
     * @param $employee
     */
    protected function updateWorkingTimeAccount($employee)
    {
        if ($this->filled('working_time_account')) {
            $employee->workingTimeAccounts()->updateOrCreate(
                ['starting_value' => 1],
                [
                    'date'           => carbon($this->get('entry_date'))->startOfMonth()->subMonth(),
                    'target'         => 0,
                    'actual'         => $this->get('working_time_account'),
                    'balance'        => $this->get('working_time_account'),
                    'starting_value' => 1
                ]);
        }
    }
}
