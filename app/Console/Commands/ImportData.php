<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from CSV files';

    protected $types = [
        'App\Models\Order\Order'       => 'orders',
        'App\Models\Employee\Employee' => 'employees',
        'App\Models\Client\Client'     => 'clients',
        'App\Models\Client\Invoice'    => 'invoices'
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->importClients();
        $this->importContacts();
        $this->importEmployees();
        $this->importOrders();
        $this->importInvoices();
        $this->importMails();
        $this->importNotes();
        $this->importDocuments();

        \DB::unprepared(file_get_contents('dump.sql'));
        \DB::unprepared(file_get_contents('dump2.sql'));

        $this->info('Weitere Daten importiert.');
    }

    protected function importClients()
    {
        $handle = fopen('resources/data/clients.csv', 'r');

        while (!feof($handle)) {

            try {
                $clientData = fgetcsv($handle, 2000, '|');

                $data = [
                    'id'      => $clientData[0],
                    'user_id' => $clientData[1],

                    'name'        => $clientData[2],
                    'short_name'  => $clientData[3] == 'NULL' ? $clientData[2] : $clientData[3],

                    // address
                    'street'      => $clientData[4] == 'NULL' ? '' : $clientData[4],
                    'postal_code' => $clientData[5] == 'NULL' ? '' : $clientData[5],
                    'city'        => $clientData[6] == 'NULL' ? '' : $clientData[6],
                    'country'     => $clientData[7] == 'NULL' ? '' : $clientData[7],

                    // bank account
                    'iban'        => $clientData[8] == 'NULL' ? NULL : $clientData[8],
                    'bic'         => $clientData[9] == 'NULL' ? NULL : $clientData[9],
                    'vat'         => $clientData[11] == 'NULL' ? NULL : $clientData[11],

                    'active' => $clientData[21],

                    'logo' => $clientData[22] == 'NULL' ? NULL : $clientData[22],

                    'type_of_contract' => $clientData[23] == 'NULL' ? NULL : $clientData[23],
                    'location'         => $clientData[24] == 'NULL' ? NULL : $clientData[24],

                    'created_at' => $clientData[25],
                    'updated_at' => $clientData[26],
                    'deleted_at' => $clientData[27],
                ];

                \App\Models\Client\Client::create($data);

                $invoiceData = [
                    'client_id'        => $clientData[0],

                    // address
                    'name'             => $clientData[12] == 'NULL' ? NULL : $clientData[2],
                    'street'           => $clientData[13] == 'NULL' ? NULL : $clientData[4],
                    'address_addition' => NULL,
                    'postal_code'      => $clientData[14] == 'NULL' ? NULL : $clientData[5],
                    'city'             => $clientData[15] == 'NULL' ? NULL : $clientData[6],
                    'country'          => 'Deutschland',

                    // invoice related
                    'intro'            => $clientData[18],
                    'outro'            => $clientData[19],
                    'default_tax_rate' => 19,
                    'payment_period'   => $clientData[20] == 'NULL' ? NULL : 14,
                ];

                \DB::table('invoice_data')->insert($invoiceData);
            } catch (\Exception $e) {
                dd($e->getMessage(), $clientData);
            }
        }

        $this->info('Kunden importiert.');
    }

    protected function importEmployees()
    {
        $handle = fopen('resources/data/employees.csv', 'r');

        while (!feof($handle)) {

            try {
                $employeeData = fgetcsv($handle, 2000, '|');

                $data = [
                    'id'              => $employeeData[0],
                    'user_id'         => $employeeData[1],

                    // basics
                    'sex'             => $employeeData[2],
                    'first_name'      => $employeeData[3],
                    'last_name'       => $employeeData[4],

                    // birthday
                    'date_of_birth'   => $employeeData[5] == 'NULL' ? NULL : \Date::sqlToGerman($employeeData[5]),
                    'place_of_birth'  => $employeeData[6] == 'NULL' ? NULL : $employeeData[6],

                    // personal
                    'married'         => $employeeData[8],
                    'children'        => $employeeData[9],
                    'disability'      => $employeeData[13] == 'NULL' ? NULL : $employeeData[13],
                    'education_level' => $employeeData[10] == 'NULL' ? NULL : $employeeData[10],
                    'religion'        => $employeeData[12] == 'NULL' ? NULL : $employeeData[12],
                    'nationality'     => $employeeData[7],

                    'locations'   => $employeeData[33],

                    // address
                    'street'      => $employeeData[30] == 'NULL' ? '-' : $employeeData[30],
                    'postal_code' => $employeeData[31] == 'NULL' ? '-' : $employeeData[31],
                    'city'        => $employeeData[32] == 'NULL' ? '-' : $employeeData[32],

                    // contacts
                    'email'       => $employeeData[3] . '_'. $employeeData[4] . '@example.com',
                    'mobile'      => $employeeData[15],
                    'phone'       => $employeeData[16],

                    'photo'     => $employeeData[17] == 'NULL' ? NULL : $employeeData[17],
                    'signature' => $employeeData[18] == 'NULL' ? NULL : $employeeData[18],

                    'type_of_health_insurance' => $employeeData[19] == 'NULL' ? 'statutory' : $employeeData[19],
                    'health_insurance'         => $employeeData[20] == 'NULL' ? '-' : $employeeData[19],
                    'social_security_number'   => $employeeData[21] == 'NULL' ? NULL : $employeeData[21],
                    'tax_id'                   => $employeeData[23] == 'NULL' ? NULL : $employeeData[23],
                    'tax_class'                => $employeeData[22] == 'NULL' ? NULL : $employeeData[22],

                    // bank account
                    'account_holder'           => $employeeData[34] == 'NULL' ? NULL : $employeeData[34],
                    'institute'                => $employeeData[35] == 'NULL' ? NULL : $employeeData[35],
                    'iban'                     => $employeeData[36] == 'NULL' ? NULL : $employeeData[36],
                    'bic'                      => $employeeData[37] == 'NULL' ? NULL : $employeeData[37],

                    'active'                    => $employeeData[24],

                    // contract
                    'occupation_type'           => $employeeData[25],
                    'contractual_working_hours' => $employeeData[28],
                    'entry_date'                => $employeeData[26] == 'NULL' ? NULL : \Date::sqlToGerman($employeeData[26]),
                    'exit_date'                 => $employeeData[27] == 'NULL' ? NULL : \Date::sqlToGerman($employeeData[27]),

                    'working_time_account' => 0,

                    'car'                   => $employeeData[38],
                    'driving_license'       => $employeeData[39],
                    'public_transportation' => $employeeData[40],

                    'deleted_at' => $employeeData[41] == 'NULL' ? NULL : $employeeData[27],
                    'created_at' => $employeeData[42],
                    'updated_at' => $employeeData[43]
                ];

                $employee = \App\Models\Employee\Employee::create($data);

                $employee->workingHours()->create([
                    'hours'      => $employeeData[28],
                    'valid_from' => \Date::sqlToGerman($employeeData[26]),
                    'editor'     => 1
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage(), $employeeData);
            }
        }

        $this->info('Mitarbeiter importiert.');
    }

    protected function importContacts()
    {
        $handle = fopen('resources/data/contacts.csv', 'r');

        while (!feof($handle)) {

            try {
                $contactData = fgetcsv($handle, 2000, '|');

                $data = [
                    'id'                 => $contactData[0],
                    'client_id'          => $contactData[1],

                    // basics
                    'sex'                => $contactData[2],
                    'first_name'         => $contactData[3],
                    'last_name'          => $contactData[4],

                    // responsibility
                    'function'           => null,
                    'personnel_planning' => false,
                    'accounting'         => false,
                    'other'              => false,

                    // contacts
                    'phone'              => $contactData[5],
                    'mobile'             => $contactData[6],
                    'fax'                => $contactData[8],
                    'email'              => $contactData[3] . '_'. $contactData[4] . '@example.com',

                    'information' => null,

                    'deleted_at' => null,
                    'created_at' => $contactData[9],
                    'updated_at' => $contactData[10],
                ];

                \DB::table('contacts')->insert($data);
            } catch (\Exception $e) {
                dd($e->getMessage(), $contactData);
            }

        }

        $this->info('Kontakte importiert.');
    }

    protected function importOrders()
    {
        $handle = fopen('resources/data/orders.csv', 'r');

        while (!feof($handle)) {
            $orderData = fgetcsv($handle, 2000, '|');

            try {

                $data = [
                    'id'        => $orderData[0],

                    // parent
                    'is_parent' => $orderData[1],
                    'parent_id' => $orderData[2],

                    'client_id'  => $orderData[5],

                    // basics
                    'title'      => $orderData[3],
                    'start_date' => $orderData[6],
                    'end_date'   => $orderData[7] == 'NULL' ? null : $orderData[6],
                    'start_time' => $orderData[8],
                    'end_time'   => $orderData[9] == 'NULL' ? null : $orderData[9],

                    'work_location'   => $orderData[10],
                    'meeting_point'   => $orderData[19],
                    'meeting_time'    => $orderData[20],
                    'requirements'    => $orderData[21],
                    'client_location' => $orderData[11],

                    'important_change' => null,

                    // staff
                    'staff_planned'    => $orderData[12],
                    'staff_required'   => $orderData[13],

                    // flags
                    'status'           => $orderData[4],
                    'public'           => 0,
                    'time_recorded'    => $orderData[24],
                    'billed'           => $orderData[25],
                    'sent'             => $orderData[26] == 'NULL' ? null : $orderData[26],

                    // accounting
                    'total_min'        => $orderData[14],
                    'total_income'     => $orderData[15],
                    'total_wage'       => $orderData[16],
                    'total_cost'       => $orderData[17],
                    'other_costs'      => $orderData[18],

                    // meta
                    'created_by'       => $orderData[27],
                    'edited_by'        => $orderData[28] == 'NULL' ? null : $orderData[28],
                    'requested_by'     => null,


                    'created_at' => $orderData[29],
                    'updated_at' => $orderData[30],
                    'deleted_at' => $orderData[31] == 'NULL' ? null : $orderData[31]

                ];

                \DB::table('orders')->insert($data);
            } catch (\Exception $e) {
                dd($e->getMessage(), $orderData);
            }

        }

        $this->info('Aufträge importiert.');
    }

    protected function importInvoices()
    {
        $handle = fopen('resources/data/invoices.csv', 'r');

        while (!feof($handle)) {
            $invoiceData = fgetcsv($handle, 2000, '|');

            try {

                $clientInvoiceData = \App\Models\Client\Client::find($invoiceData[1])->invoiceData;

                $data = [
                    'id'               => $invoiceData[0],
                    'client_id'        => $invoiceData[1],

                    // address
                    'name'             => $clientInvoiceData->name,
                    'street'           => $clientInvoiceData->street,
                    'address_addition' => $clientInvoiceData->address_addition,
                    'postal_code'      => $clientInvoiceData->postal_code,
                    'city'             => $clientInvoiceData->city,
                    'country'          => $clientInvoiceData->country,

                    // basics
                    'invoice_date'     => $invoiceData[2],
                    'intro'            => $invoiceData[3],
                    'outro'            => $invoiceData[4],
                    'payment_period'   => $invoiceData[10],
                    'sum'              => $invoiceData[11],

                    // others
                    'archived'         => $invoiceData[7],
                    'pay_date'         => $invoiceData[9] == 'NULL' ? NULL : $invoiceData[9],
                    'sent'             => $invoiceData[8],
                ];

                \DB::table('invoices')->insert($data);
            } catch (\Exception $e) {
                dd($e->getMessage(), $invoiceData);
            }

        }

        $this->info('Rechnungen importiert.');
    }

    protected function importMails()
    {
        $handle = fopen('resources/data/mails.csv', 'r');

        while (!feof($handle)) {
            $mailData = fgetcsv($handle, 2000, '|');

            $editor = [
                'servite24'         => 1,
                'Georg Hüwel'       => 2,
                'Payam R. Monfared' => 3,
                'Dino Pergola'      => 4,
                'Marcel Engels'     => 5
            ];

            try {
                $data = [
                    'id'          => $mailData[0],
                    'sent_id'     => $mailData[1],
                    'sent_type'   => $this->types[$mailData[2]],
                    'information' => $mailData[3],
                    'sent_by'     => isset($editor[$mailData[4]]) ? $editor[$mailData[4]] : 1,
                    'created_at'  => $mailData[5],
                    'updated_at'  => $mailData[6]
                ];

                \DB::table('mail_log')->insert($data);
            } catch (\Exception $e) {
                dd($e->getMessage(), $mailData);
            }
        }

        $this->info('Mails importiert.');
    }

    protected function importNotes()
    {
        $handle = fopen('resources/data/notes.csv', 'r');

        while (!feof($handle)) {
            $noteData = fgetcsv($handle, 2000, '|');

            try {
                $data = [
                    'id'            => $noteData[0],
                    'loggable_id'   => $noteData[1],
                    'loggable_type' => $this->types[$noteData[2]],
                    'date'          => $noteData[3],
                    'information'   => $noteData[4],
                    'editor'        => $noteData[5],
                    'created_at'    => $noteData[6],
                    'updated_at'    => $noteData[7]
                ];

                \DB::table('notes')->insert($data);
            } catch (\Exception $e) {
                dd($e->getMessage(), $noteData);
            }
        }

        $this->info('Notizen importiert.');
    }

    protected function importDocuments()
    {
        $handle = fopen('resources/data/documents.csv', 'r');

        while (!feof($handle)) {
            $documentData = fgetcsv($handle, 2000, '|');

            try {
                $data = [
                    'id'                  => $documentData[0],
                    'with_documents_id'   => $documentData[1],
                    'with_documents_type' => 'employees',
                    'name'                => $documentData[2],
                    'path'                => 'documents/employees/' . substr(basename($documentData[3]), 0, 10) . '_MA-' . $documentData[1] . '_' . substr(basename($documentData[3]), 11),
                    'valid_to'            => null,
                    'created_by'          => $documentData[4],
                    'created_at'          => $documentData[5],
                    'updated_at'          => $documentData[6]
                ];

                \DB::table('documents')->insert($data);
            } catch (\Exception $e) {
                dd($e->getMessage(), $documentData);
            }
        }

        $this->info('Dokumente importiert.');
    }
}
